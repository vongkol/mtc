<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use DB;
use Session;
use Auth;
class LogoController extends Controller
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
        if(!Right::check('Logo', 'l'))
        {
            return view('permissions.no');
        }
        $data['logo'] = DB::table('logos')
            ->get();
        return view('logos.index', $data);
    }
    // load create form
    public function create()
    {
        if(!Right::check('Logo', 'i'))
        {
            return view('permissions.no');
        }
        return view('logos.create');
    }
    // save new logo
    public function save(Request $r)
    {
    	$file_name = '';
        if($r->photo) {
            $file = $r->file('photo');
            $file_name = $file->getClientOriginalName();
            $destinationPath = 'img/';
            $file->move($destinationPath, $file_name);
        }
        $data = array(
            'name' => $r->name,
            'photo' => $file_name,
        );
        $sms = "The new branch has been created successfully.";
        $sms1 = "Fail to create the new branch, please check again!";
        $i = DB::table('logos')->insert($data);
        if ($i)
        {
            $r->session()->flash('sms', $sms);
            return redirect('/logo');
        }
        else
        {
            $r->session()->flash('sms1', $sms1);
            return redirect('/logo/create')->withInput();
        }
    }

    public function edit($id)
    {
        if(!Right::check('Logo', 'u'))
        {
            return view('permissions.no');
        }
        $data['logo'] = DB::table('logos')
            ->where('id',$id)->first();
        return view('logos.edit', $data);
    }
    
    public function update(Request $r)
    {
        $data = array(
            'name' => $r->name,
        );
        if ($r->photo) {
            $file = $r->file('photo');
            $file_name = $file->getClientOriginalName();
            $destinationPath = 'img/';
            $file->move($destinationPath, $file_name);
            $data = array(
	            'photo' => $file_name,
            );
        }
        $sms = "All changes have been saved successfully.";
        $sms1 = "Fail to to save changes, please check again!";
        $i = DB::table('logos')->where('id', $r->id)->update($data);
        if ($i)
        {
            $r->session()->flash('sms', $sms);
            return redirect('/logo/edit/'.$r->id);
        }
        else
        {
            $r->session()->flash('sms1', $sms1);
            return redirect('/logo/edit/'.$r->id);
        }
    }
}

