<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use DB;
use Auth;
class SuccessCandidateController extends Controller
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
        $this->middleware(function ($request, $next) {
            if (Auth::user()==null)
            {
                return redirect("/login");
            }
            return $next($request);
        });
        $data['success_candidates'] = DB::table('success_candidates')
        ->join('employees', 'employees.id', '=', 'success_candidates.employee_id')
        ->select('employees.*', 'success_candidates.id as cadidate_id')
        ->where('success_candidates.active',1)
        ->paginate(18);
        return view('success_candidate.index' , $data);
    }
     // create
     public function create()
     {
        $this->middleware(function ($request, $next) {
            if (Auth::user()==null)
            {
                return redirect("/login");
            }
            return $next($request);
        });
        $data['employees'] = DB::table('employees')
        ->where('active',1)
        ->get();
         return view('success_candidate.create', $data);
     }

    // save
    public function save(Request $r)
    {
    $this->middleware(function ($request, $next) {
        if (Auth::user()==null)
        {
            return redirect("/login");
        }
        return $next($request);
    });
    $data = array (
        'employee_id' => $r->employee
    );
    $i = DB::table('success_candidates')->insert($data);
    
    if($i)
    {
        $r->session()->flash('sms', "New success candidate has been add successfully.");
        return redirect('/success-candidate/create');
    }
    else{
        $r->session()->flash('sms1', "Fail to create the new success candidate, please check again!");
        return redirect('/success-candidate/create');
    }
    }
     
    public function edit($id)
    {   
        $this->middleware(function ($request, $next) {
            if (Auth::user()==null)
            {
                return redirect("/login");
            }
            return $next($request);
        });
        $data['success_candidate'] = DB::table('success_candidates')
        ->join('employees', 'employees.id', '=', 'success_candidates.employee_id')
        ->select('employees.*', 'success_candidates.id as cadidate_id', 'success_candidates.description as description')
        ->where('success_candidates.active',1)
        ->where('success_candidates.id',$id)
        ->first();
        
        $data['employees'] = DB::table('employees')
        ->where('active',1)
        ->get();
        return view('success_candidate.edit', $data);
    }
    // update
    public function update(Request $r)
    {
        $this->middleware(function ($request, $next) {
            if (Auth::user()==null)
            {
                return redirect("/login");
            }
            return $next($request);
        });
        $data = array(
            'employee_id' => $r->employee,
            'description' => $r->description,
        );
        $sms = "All changes have been saved successfully.";
        $sms1 = "Fail to to save changes, please check again!";
        $i = DB::table('success_candidates')->where('id', $r->id)->update($data);
        if ($r->id)
        {
            $r->session()->flash('sms', $sms);
            return redirect('/success-candidate/edit/'.$r->id);
        }
        else
        {
            $r->session()->flash('sms1', $sms1);
            return redirect('/success-candidate/edit/'.$r->id);
        }
    }
      // delete
    public function delete($id)
    {
        $this->middleware(function ($request, $next) {
            if (Auth::user()==null)
            {
                return redirect("/login");
            }
            return $next($request);
        });
        DB::table('success_candidates')->where('id', $id)->update(['active'=>0]);
        return redirect('/success-candidate');
    }
}
