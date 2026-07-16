<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Http;
use Carbon\Carbon;
use Illuminate\Pagination\LengthAwarePaginator;

class DashboardController extends Controller
{
   public function index(Request $request)
{
    $dbUrl = env('FIREBASE_DB_URL');
    $response = Http::get("$dbUrl/rfid_lock.json");
    $data = $response->json();

    $authorizedCards = collect($data['authorizedCards'] ?? [])
        ->map(function ($item, $key) {
            return [
                'uid'        => $key,
                'name'       => $item['name'] ?? 'Unknown',
                'authorized' => $item['authorized'] ?? false,
            ];
        });

    $scanHistory = collect($data['scanHistory'] ?? []);

    $dateFilter = $request->input('date', Carbon::today()->toDateString());
    $scanHistory = $scanHistory->filter(function ($item) use ($dateFilter) {
        if (!isset($item['timestamp'])) return false;
        try {
            $itemDate = Carbon::createFromTimestampMs($item['timestamp'])->toDateString();
            return $itemDate === $dateFilter;
        } catch (\Exception $e) {
            return false;
        }
    });
// ✅ Build map: UID → latest scan
$scanMap = $scanHistory
    ->sortByDesc('timestamp')
    ->groupBy('uid')
    ->map(function ($items) {
        $scan = $items->first();

        $time = $scan['timeReadable'] ?? null;

        if (!$time || $time === 'N/A') {
            try {
                $time = Carbon::createFromTimestampMs($scan['timestamp'])
                    ->format('h:i A');
            } catch (\Exception $e) {
                $time = '-';
            }
        }

        return [
            'time' => $time,
            'timestamp' => $scan['timestamp'] ?? 0
        ];
    });


// ✅ Present students WITH time
$present = $authorizedCards->filter(function ($student) use ($scanMap) {
    return isset($scanMap[$student['uid']]);
})->map(function ($student) use ($scanMap) {
    return $student + [
        'status' => 'Present',
        'time' => $scanMap[$student['uid']]['time'],
        'timestamp' => $scanMap[$student['uid']]['timestamp']
    ];
})
->sortBy('timestamp') // ✅ earliest first
->values();



// ✅ Absent students
$absent = $authorizedCards->filter(function ($student) use ($scanMap) {
    return !isset($scanMap[$student['uid']]);
})->map(function ($student) {
    return $student + [
        'status' => 'Absent',
        'time'   => null,
        'timestamp' => null
    ];
});


//$students = $present->merge($absent)->values();
$students = $present->merge($absent)->values();



// ✅ FILTER BEFORE PAGINATION
$statusFilter = $request->input('status');

if ($statusFilter === 'present') {
    $students = $students->where('status', 'Present')->values();
} elseif ($statusFilter === 'absent') {
    $students = $students->where('status', 'Absent')->values();
}

// ✅ PAGINATION
$page = LengthAwarePaginator::resolveCurrentPage();
$perPage = 10;

$studentsPaginated = new LengthAwarePaginator(
    $students->forPage($page, $perPage)->values(),
    $students->count(),
    $perPage,
    $page,
    [
        'path' => $request->url(),
        'query' => $request->query()
    ]
);

        // Totals
        $totalStudents = $authorizedCards->count();
        $totalPresent  = $present->count();
        $totalAbsent   = $absent->count();

        //dd($studentsPaginated->items());


    return view('dashboard', compact(
        'present',
        'absent',
        'dateFilter',
        'studentsPaginated',
        'totalStudents',
        'totalPresent',
        'totalAbsent'
    ));
}

    public function update(Request $request)
{
    $slice = $request->input('slice'); // "Present" or "Absent"
    $date  = $request->input('date');

    // Example: log to DB or update a table
    \DB::table('attendance_logs')->insert([
        'slice' => $slice,
        'date'  => $date,
        'created_at' => now(),
    ]);

    return response()->json(['status' => 'ok', 'message' => 'Record updated']);
}
public function fetch(Request $request)
{
    $dbUrl = env('FIREBASE_DB_URL');
    $response = Http::get("$dbUrl/rfid_lock.json");
    $data = $response->json();

    $authorizedCards = collect($data['authorizedCards'] ?? [])
        ->map(function ($item, $key) {
            return [
                'uid'        => $key,
                'name'       => $item['name'] ?? 'Unknown',
                'authorized' => $item['authorized'] ?? false,
            ];
        });

    $scanHistory = collect($data['scanHistory'] ?? []);
    $dateFilter = $request->input('date', \Carbon\Carbon::today()->toDateString());

    $scanHistory = $scanHistory->filter(function ($item) use ($dateFilter) {
        if (!isset($item['timestamp'])) return false;
        try {
            $itemDate = \Carbon\Carbon::createFromTimestampMs($item['timestamp'])->toDateString();
            return $itemDate === $dateFilter;
        } catch (\Exception $e) {
            return false;
        }
    });

    $presentUIDs = $scanHistory->pluck('uid')->unique();
    $present = $authorizedCards->filter(fn($student) => $presentUIDs->contains($student['uid']))->values();
    $absent  = $authorizedCards->filter(fn($student) => !$presentUIDs->contains($student['uid']))->values();

    return response()->json([
        'present' => $present,
        'absent' => $absent,
        'totalStudents' => $authorizedCards->count(),
        'totalPresent' => $present->count(),
        'totalAbsent' => $absent->count(),
    ]);
}

}
