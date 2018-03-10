<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use DB;
class JobSeekerDashboardController extends Controller
{
    // load job seeker dashboard
    public function index()
    {
        return view('fronts.job_seeker_dashboards.index');
    }
}
