<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use DB;
use Session;
use Auth;
class CategoryController extends Controller
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
        if(!Right::check('Category', 'l'))
        {
            return view('permissions.no');
        }
        $data['categories'] = DB::table('categories')
            ->where('active',1)
            ->orderBy('name')
            ->paginate(18);
        return view('categories.index', $data);
    }
    // load create form
    public function create()
    {
        if(!Right::check('Category', 'i'))
        {
            return view('permissions.no');
        }
        return view('categories.create');
    }
    // save new category
    public function save(Request $r)
    {

        $data = array(
            'name' => $r->name
        );
        $sms = "New category has been created successfully.";
        $sms1 = "Fail to create the new category, please check again!";
        $i = DB::table('categories')->insert($data);
        if ($i)
        {
            $r->session()->flash('sms', $sms);
            return redirect('/category/create');
        }
        else
        {
            $r->session()->flash('sms1', $sms1);
            return redirect('/category/create')->withInput();
        }
    }
    // delete
    public function delete($id)
    {
        if(!Right::check('Category', 'd'))
        {
            return view('permissions.no');
        }
        DB::table('categories')->where('id', $id)->update(['active'=>0]);
        return redirect('/category');
    }

    public function edit($id)
    {
        if(!Right::check('Category', 'u'))
        {
            return view('permissions.no');
        }
        $data['categories'] = DB::table('categories')
            ->where('id',$id)->first();
        return view('categories.edit', $data);
    }
    public function update(Request $r)
    {

        $data = array(
            'name' => $r->name
        );
        $sms = "All changes have been saved successfully.";
        $sms1 = "Fail to to save changes, please check again!";
        $i = DB::table('categories')->where('id', $r->id)->update($data);
        if ($i)
        {
            $r->session()->flash('sms', $sms);
            return redirect('/category/edit/'.$r->id);
        }
        else
        {
            $r->session()->flash('sms1', $sms1);
            return redirect('/category/edit/'.$r->id);
        }
    }
}
