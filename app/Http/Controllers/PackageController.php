<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use DB;
use Auth;
class PackageController extends Controller
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
        if(!Right::check('Package', 'l'))
        {
            return view('permissions.no');
        }
        $data['packages'] = DB::table('packages')->where('active', 1)->orderBy('name')->get();
        return view('packages.index', $data);
    }
    // load create form
    public function create()
    {
        if(!Right::check('Package', 'i'))
        {
            return view('permissions.no');
        }
        $data['package_types'] = DB::table('package_types')->where('active', 1)->orderBy('name')->get();
        return view('packages.create', $data);
    }
    public function save(Request $r)
    {
        $data = [
            'name' => $r->name,
            'type' => $r->type,
            'description' => $r->description,
            'price' => $r->price,
            'job_number' => $r->job,
            'day_number' => $r->day,
            'download' => $r->download
        ];
        $sms = "New package has been created successfully!";
        $sms1 = "Fail to create the new package, please check again!";
        $i = DB::table('packages')->insert($data);
        if ($i)
        {
            $r->session()->flash('sms', $sms);
            return redirect('/package/create');
        }
        else
        {
            $r->session()->flash('sms1', $sms1);
            return redirect('/package/create')->withInput();
        }
    }
    // load edit form
    public function edit($id)
    {
        if(!Right::check('Package', 'u'))
        {
            return view('permissions.no');
        }
        $data['package'] = DB::table('packages')->where('id', $id)->first();
        $data['package_types'] = DB::table('package_types')->where('active', 1)->orderBy('name')->get();
        return view('packages.edit', $data);
    }
    public function update(Request $r)
    {
        $data = [
            'name' => $r->name,
            'type' => $r->type,
            'description' => $r->description,
            'price' => $r->price,
            'job_number' => $r->job,
            'day_number' => $r->day,
            'download' => $r->download
        ];
        $sms = "All changes have been saved successfully.";
        $sms1 = "Fail to to save changes, please check again!";
        $i = DB::table('packages')->where('id', $r->id)->update($data);
        if ($i)
        {
            $r->session()->flash('sms', $sms);
            return redirect('/package/edit/'.$r->id);
        }
        else
        {
            $r->session()->flash('sms1', $sms1);
            return redirect('/package/edit/'.$r->id);
        }
    }
    // delete package
    public function delete($id)
    {
        if(!Right::check('Package', 'd'))
        {
            return view('permissions.no');
        }
        DB::table('packages')->where('id', $id)->update(['active'=>0]);
        return redirect('/package');
    }
}
