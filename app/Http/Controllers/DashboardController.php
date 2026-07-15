<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Http;
use Carbon\Carbon;

class DashboardController extends Controller
{
    public function index(Request $request)
    {
        $dbUrl = env('FIREBASE_DB_URL'); // put your Firebase DB URL in .env
        $response = Http::get("$dbUrl/rfid_lock.json");
        $data = $response->json();

$authorizedCards = collect($data['authorizedCards'] ?? [])
    ->map(function ($item, $key) {
        return [
            'uid'        => $key, // dito natin ilalagay yung UID galing sa key
            'name'       => $item['name'] ?? 'Unknown',
            'authorized' => $item['authorized'] ?? false,
        ];
    });

$scanHistory = collect($data['scanHistory'] ?? []);

// Filter by date
$dateFilter = $request->input('date', \Carbon\Carbon::today()->toDateString());
$scanHistory = $scanHistory->filter(function ($item) use ($dateFilter) {
    return isset($item['timestamp']) &&
           \Carbon\Carbon::parse($item['timestamp'])->toDateString() === $dateFilter;
});

// Get UIDs of present students
$presentUIDs = $scanHistory->pluck('uid')->unique();

// Separate present and absent
$present = $authorizedCards->filter(fn($student) => $presentUIDs->contains($student['uid']));
$absent  = $authorizedCards->filter(fn($student) => !$presentUIDs->contains($student['uid']));

// After filtering present and absent
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
}
