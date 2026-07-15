<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Http;
use Carbon\Carbon;

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

        // Filter by date (fix: use createFromTimestampMs)
        $dateFilter = $request->input('date', Carbon::today()->toDateString());
        $scanHistory = $scanHistory->filter(function ($item) use ($dateFilter) {
            if (!isset($item['timestamp'])) {
                return false;
            }

            try {
                $itemDate = Carbon::createFromTimestampMs($item['timestamp'])->toDateString();
                return $itemDate === $dateFilter;
            } catch (\Exception $e) {
                return false;
            }
        });

        // Get UIDs of present students
        $presentUIDs = $scanHistory->pluck('uid')->unique();

        // Separate present and absent
        $present = $authorizedCards->filter(fn($student) => $presentUIDs->contains($student['uid']));
        $absent  = $authorizedCards->filter(fn($student) => !$presentUIDs->contains($student['uid']));

        // Totals
        $totalStudents = $authorizedCards->count();
        $totalPresent  = $present->count();
        $totalAbsent   = $absent->count();

        return view('dashboard', compact(
            'present',
            'absent',
            'dateFilter',
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
