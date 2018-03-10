<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use DB;
use Session;
use Auth;
class JobTypeController extends Controller
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
        if(!Right::check('Job Type', 'l'))
        {
            return view('permissions.no');
        }
        $data['job_types'] = DB::table('job_types')
            ->where('active',1)
            ->orderBy('name')
            ->paginate(18);
        return view('job_types.index', $data);
    }
    // load create form
    public function create()
    {
        if(!Right::check('Job Type', 'i'))
        {
            return view('permissions.no');
        }
        return view('job_types.create');
    }
    // save new category
    public function save(Request $r)
    {
        $data = array(
            'name' => $r->name
        );
        $sms = "The new job type has been created successfully.";
        $sms1 = "Fail to create the new job type, please check again!";
        $i = DB::table('job_types')->insert($data);
        if ($i)
        {
            $r->session()->flash('sms', $sms);
            return redirect('/job_type/create');
        }
        else
        {
            $r->session()->flash('sms1', $sms1);
            return redirect('/job_type/create')->withInput();
        }
    }
    // delete
    public function delete($id)
    {
        if(!Right::check('Job Type', 'd'))
        {
            return view('permissions.no');
        }
        DB::table('job_types')->where('id', $id)->update(['active'=>0]);
        return redirect('/job_type');
    }

    public function edit($id)
    {
        if(!Right::check('Job Type', 'u'))
        {
            return view('permissions.no');
        }
        $data['job_type'] = DB::table('job_types')
            ->where('id',$id)->first();
        return view('job_types.edit', $data);
    }
    public function update(Request $r)
    {
        $data = array(
            'name' => $r->name
        );
        $sms = "All changes have been saved successfully.";
        $sms1 = "Fail to to save changes, please check again!";
        $i = DB::table('job_types')->where('id', $r->id)->update($data);
        if ($i)
        {
            $r->session()->flash('sms', $sms);
            return redirect('/job_type/edit/'.$r->id);
        }
        else
        {
            $r->session()->flash('sms1', $sms1);
            return redirect('/job_type/edit/'.$r->id);
        }
    }
}
