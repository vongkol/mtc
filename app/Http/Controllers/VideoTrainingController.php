<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use DB;
use Session;
use Auth;
class VideoTrainingController extends Controller
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

        $data['video_trainings'] = DB::table('video_trainings')
            ->where('active',1)
            ->orderBy('order_number', 'asc')
            ->get();
        return view('video-trainings.index', $data);
    }
    // load create form
    public function create()
    {
        // if(!Right::check('Advertisement', 'i'))
        // {
        //     return view('permissions.no');
        // }
        return view('video-trainings.create');
    }
    // save new social
    public function save(Request $r)
    {
        $data = array(
            'url' => $r->url,
            'order_number' => $r->order_number,
        );
        $sms = "The new video training has been created successfully.";
        $sms1 = "Fail to create the newvideo training, please check again!";
        $i = DB::table('video_trainings')->insert($data);
        if ($i)
        {
            $r->session()->flash('sms', $sms);
            return redirect('/video-training/create');
        }
        else
        {
            $r->session()->flash('sms1', $sms1);
            return redirect('/video-training/create')->withInput();
        }
    }
    // delete
    public function delete($id)
    {
        // if(!Right::check('Advertisement', 'd'))
        // {
        //     return view('permissions.no');
        // }

        DB::table('video_trainings')->where('id', $id)->update(['active'=>0]);
        return redirect('/video-training');
    }

    public function edit($id)
    {
        // if(!Right::check('Advertisement', 'u'))
        // {
        //     return view('permissions.no');
        // }
        $data['video_training'] = DB::table('video_trainings')
            ->where('id',$id)->first();
        return view('video-trainings.edit', $data);
    }
    
    public function update(Request $r)
    {
    	$data = array(
            'url' => $r->url,
            'order_number' => $r->order_number
        );
        $sms = "All changes have been saved successfully.";
        $sms1 = "Fail to to save changes, please check again!";
        $i = DB::table('video_trainings')->where('id', $r->id)->update($data);
        if ($i)
        {
            $r->session()->flash('sms', $sms);
            return redirect('/video-training/edit/'.$r->id);
        }
        else
        {
            $r->session()->flash('sms1', $sms1);
            return redirect('/video-training/edit/'.$r->id);
        }
    }
}
