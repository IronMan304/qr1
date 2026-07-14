<?php

namespace App\Http\Controllers\DashBoard;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Http;

class DashboardListController extends Controller
{
//     public function index()
//     {
//         //$response = Http::get('https://jsonplaceholder.typicode.com/users');

//         //$students = $response->json();
// $students = [1,2];
//         return view('Dashboard.DashboardList', compact('students'));
//     }

public function index()
{
    $students = [
        ['name' => 'Barloso'],
        ['name' => 'Bob'],
    ];

    return view('Dashboard.DashboardList', compact('students'));
}

}
