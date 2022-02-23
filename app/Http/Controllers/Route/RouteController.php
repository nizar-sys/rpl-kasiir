<?php

namespace App\Http\Controllers\Route;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Inertia\Inertia;

class RouteController extends Controller
{
    public function home()
    {
        return Inertia::render('Dashboard/Index');
    }

    public function myActivities()
    {
        return Inertia::render('Dashboard/Profile/Activity');
    }
}
