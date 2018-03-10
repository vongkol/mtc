<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use DB;
use Session;
use Auth;
class EmployeeEmailController extends Controller
{
    public function __construct()
    {
        $this->middleware(function ($request, $next) {
            if (Auth::user()==null)
            {
                return redirect("/login");
            }
            return $next($request);
        });
    }
    // index
    public function index()
    {
        if(!Right::check('Employee Email', 'l'))
        {
            return view('permissions.no');
        }
        $data['employee_emails'] = DB::table('employees')
            ->where('active',1)
            ->paginate(18);
        return view('employee_emails.index', $data);
    }
}
