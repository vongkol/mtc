<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use DB;
use Session;
use Auth;
class TrainingCourseController extends Controller
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
        // if(!Right::check('Advertisement', 'l'))
        // {
        //     return view('permissions.no');
        // }

        $data['training_courses'] = DB::table('training_courses')
            ->where('active',1)
            ->orderBy('order_number', 'asc')
            ->get();
        return view('training-courses.index', $data);
    }
    // load create form
    public function create()
    {
        // if(!Right::check('Advertisement', 'i'))
        // {
        //     return view('permissions.no');
        // }
        return view('training-courses.create');
    }
    // save new social
    public function save(Request $r)
    {

    	$file_name = '';
        if($r->photo) {
            $file = $r->file('photo');
            $file_name = $file->getClientOriginalName();
            $destinationPath = 'ads/';
            $file->move($destinationPath, $file_name);
        }
        $data = array(
            'url' => $r->url,
            'photo' => $file_name,
            'order_number' => $r->order_number,
        );
        $sms = "The new training course has been created successfully.";
        $sms1 = "Fail to create the new training course, please check again!";
        $i = DB::table('training_courses')->insert($data);
        if ($i)
        {
            $r->session()->flash('sms', $sms);
            return redirect('/training-course/create');
        }
        else
        {
            $r->session()->flash('sms1', $sms1);
            return redirect('/training-course/create')->withInput();
        }
    }
    // delete
    public function delete($id)
    {
        // if(!Right::check('Advertisement', 'd'))
        // {
        //     return view('permissions.no');
        // }

        DB::table('training_courses')->where('id', $id)->update(['active'=>0]);
        return redirect('/training-course');
    }

    public function edit($id)
    {
        // if(!Right::check('Advertisement', 'u'))
        // {
        //     return view('permissions.no');
        // }
        $data['training_course'] = DB::table('training_courses')
            ->where('id',$id)->first();
        return view('training-courses.edit', $data);
    }
    
    public function update(Request $r)
    {
    	$data = array(
            'url' => $r->url,
            'order_number' => $r->order_number
        );

        $file_name = '';
        if($r->photo) {
            $file = $r->file('photo');
            $file_name = $file->getClientOriginalName();
            $destinationPath = 'ads/';
            $file->move($destinationPath, $file_name);
            $data = array(
	            'photo' => $file_name
	        ); 
        } 
        $sms = "All changes have been saved successfully.";
        $sms1 = "Fail to to save changes, please check again!";
        $i = DB::table('training_courses')->where('id', $r->id)->update($data);
        if ($i)
        {
            $r->session()->flash('sms', $sms);
            return redirect('/training-course/edit/'.$r->id);
        }
        else
        {
            $r->session()->flash('sms1', $sms1);
            return redirect('/training-course/edit/'.$r->id);
        }
    }
}
