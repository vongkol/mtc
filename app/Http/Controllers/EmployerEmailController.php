<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use DB;
use Session;
use Auth;
class EmployerEmailController extends Controller
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
        if(!Right::check('Employer Email', 'l'))
        {
            return view('permissions.no');
        }
        $data['employer_emails'] = DB::table('employers')
            ->where('active',1)
            ->paginate(18);
        return view('employer_emails.index', $data);
    }
}
