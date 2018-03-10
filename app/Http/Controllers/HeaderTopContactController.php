<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use DB;
use Session;
use Auth;
class HeaderTopContactController extends Controller
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
        if(!Right::check('Header Top Contact', 'l'))
        {
            return view('permissions.no');
        }
        $data['header_top_contact'] = DB::table('header_top_contact')->get();
        return view('header_top_contacts.index', $data);
    }
    // load create form
    public function create()
    {
        if(!Right::check('Header Top Contact', 'i'))
        {
            return view('permissions.no');
        }
        return view('header_top_contacts.create');
    }
    // save new category
    public function save(Request $r)
    {

        $data = array(
            'phone' => $r->phone,
            'email' => $r->email,
            'work_time' => $r->work_time
        );
        $sms = "The new branch has been created successfully.";
        $sms1 = "Fail to create the new branch, please check again!";
        $i = DB::table('header_top_contact')->insert($data);
        if ($i)
        {
            $r->session()->flash('sms', $sms);
            return redirect('/header_top_contact');
        }
        else
        {
            $r->session()->flash('sms1', $sms1);
            return redirect('/header_top_contact/create')->withInput();
        }
    }

    public function edit($id)
    {
        if(!Right::check('Header Top Contact', 'u'))
        {
            return view('permissions.no');
        }
        $data['header_top_contact'] = DB::table('header_top_contact')
            ->where('id',$id)->first();
        return view('header_top_contacts.edit', $data);
    }
    public function update(Request $r)
    {

        $data = array(
            'phone' => $r->phone,
            'email' => $r->email,
            'work_time' => $r->work_time
        );
        $sms = "All changes have been saved successfully.";
        $sms1 = "Fail to to save changes, please check again!";
        $i = DB::table('header_top_contact')->where('id', $r->id)->update($data);
        if ($i)
        {
            $r->session()->flash('sms', $sms);
            return redirect('/header_top_contact/edit/'.$r->id);
        }
        else
        {
            $r->session()->flash('sms1', $sms1);
            return redirect('/header_top_contact/edit/'.$r->id);
        }
    }
}
