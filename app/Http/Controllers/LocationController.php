<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use DB;
use Session;
use Auth;
class locationController extends Controller
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
        if(!Right::check('Location', 'l'))
        {
            return view('permissions.no');
        }
        $data['locations'] = DB::table('locations')
            ->where('active',1)
            ->orderBy('name')
            ->paginate(18);
        return view('locations.index', $data);
    }
    // load create form
    public function create()
    {
        if(!Right::check('Location', 'i'))
        {
            return view('permissions.no');
        }
        return view('locations.create');
    }
    // save new location
    public function save(Request $r)
    {
        $data = array(
            'name' => $r->name
        );
        $sms = "The new branch has been created successfully.";
        $sms1 = "Fail to create the new branch, please check again!";
        $i = DB::table('locations')->insert($data);
        if ($i)
        {
            $r->session()->flash('sms', $sms);
            return redirect('/location/create');
        }
        else
        {
            $r->session()->flash('sms1', $sms1);
            return redirect('/location/create')->withInput();
        }
    }
    // delete
    public function delete($id)
    {
        if(!Right::check('Location', 'd'))
        {
            return view('permissions.no');
        }
        DB::table('locations')->where('id', $id)->update(['active'=>0]);
        return redirect('/location');
    }

    public function edit($id)
    {
        if(!Right::check('Location', 'u'))
        {
            return view('permissions.no');
        }
        $data['location'] = DB::table('locations')
            ->where('id',$id)->first();
        return view('locations.edit', $data);
    }
    public function update(Request $r)
    {
        $data = array(
            'name' => $r->name
        );
        $sms = "All changes have been saved successfully.";
        $sms1 = "Fail to to save changes, please check again!";
        $i = DB::table('locations')->where('id', $r->id)->update($data);
        if ($i)
        {
            $r->session()->flash('sms', $sms);
            return redirect('/location/edit/'.$r->id);
        }
        else
        {
            $r->session()->flash('sms1', $sms1);
            return redirect('/location/edit/'.$r->id);
        }
    }
}
