<?php

namespace App\Http\Controllers\Backend;

use App\Http\Controllers\Controller;
use App\Models\Dashboard;

class DashboardController extends Controller
{
    public function index()
    {
        $stats = Dashboard::getStats();

        return view('admin.dashboard', $stats);
    }
}