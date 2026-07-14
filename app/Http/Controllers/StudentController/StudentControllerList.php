<?php

namespace App\Http\Controllers\StudentController;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Http;
use Illuminate\Pagination\LengthAwarePaginator;

class StudentControllerList extends Controller
{
    public function index(Request $request)
    {
        // Fetch data from Firebase
        $dbUrl = env('FIREBASE_DB_URL');
        $data  = Http::get("$dbUrl/rfid_lock.json")->json();

        $scanHistory     = $data['scanHistory'] ?? [];
        $authorizedCards = $data['authorizedCards'] ?? [];

        // Build lookup table for authorized cards
        $authorizedLookup = collect($authorizedCards)->mapWithKeys(fn($card, $uid) => [
            $uid => [
                'name'       => $card['name'] ?? 'Unknown',
                'authorized' => $card['authorized'] ?? false,
            ]
        ]);

        // Merge scan history with authorization info
        $records = collect($scanHistory)->map(fn($item) => [
            'uid'         => $item['uid'] ?? 'No UID',
            'name'        => $item['name'] ?? ($authorizedLookup[$item['uid']]['name'] ?? 'Unknown'),
            'status'      => $item['status'] ?? 'No Status',
            'timeReadable'=> $item['timeReadable'] ?? 'No Timestamp',
            'authorized'  => $authorizedLookup[$item['uid']]['authorized'] ?? false,
        ]);

        // Apply filters
        if ($request->filled('statusFilter')) {
            $records = $records->where('status', $request->statusFilter);
        }

        if ($request->filled('authorized')) {
            $records = $records->where('authorized', $request->authorized === 'true');
        }

        // 🔍 Search filter
if ($request->filled('search')) {
    $search = strtolower($request->search);
    $records = $records->filter(function ($item) use ($search) {
        return str_contains(strtolower($item['uid']), $search) ||
               str_contains(strtolower($item['name']), $search) ||
               str_contains(strtolower($item['status']), $search);
    });
}
if ($request->filled('date')) {
    $date = $request->date;

    $records = $records->filter(function ($item) use ($date) {
        $time = $item['timeReadable'] ?? null;

        // Skip kung empty o invalid
        if (empty($time) || $time === 'N/A') {
            return false;
        }

        try {
            $itemDate = \Carbon\Carbon::parse($time)->toDateString();
            return $itemDate === $date;
        } catch (\Exception $e) {
            // kung hindi ma-parse, huwag isama
            return false;
        }
    });
}


        // Paginate
        $page     = LengthAwarePaginator::resolveCurrentPage();
        $perPage  = 10;
        $paginated = new LengthAwarePaginator(
            $records->forPage($page, $perPage)->values(),
            $records->count(),
            $perPage,
            $page,
            ['path' => $request->url(), 'query' => $request->query()]
        );

        return view('StudentView.StudentViewList', [
            'paginated'     => $paginated,
            'statusFilter'  => $request->statusFilter,
            'authorizedOnly'=> $request->authorized,
        ]);
    }
}
