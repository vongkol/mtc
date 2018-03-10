<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use DB;
use Session;
use Auth;
class FrontPageController extends Controller
{
    public function __construct()
    {
        $this->middleware(function ($request, $next) {
           app()->setLocale(Session::get("lang"));
            return $next($request);
        });
    }
    public function index($id)
    {    
        $data['partners'] = DB::table('partners')
            ->orderBy('sequence', "asc")
            ->where('active',1)
            ->get();
        $data['companies'] = DB::table('companies')
            ->join('employers', 'companies.employer_id', '=', 'employers.id')
            ->where('companies.active', 1)
            ->select('companies.*', 'employers.first_name', 'employers.last_name')
            ->get();
        $data['contact_us'] = DB::table('pages')
            ->where('id', 1)
            ->where('active', 1)
            ->first();
        $data['page'] = DB::table('pages')
            ->where('id',$id)->first();
        return view('.fronts.pages.index', $data);
    }
}

