<?php

namespace App\Http\Controllers;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use DB;
use Auth;
class CompanyController extends Controller
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
        if(!Right::check('Company', 'l'))
        {
            return view('permissions.no');
        }
        // index
        $data['companies'] = DB::table('companies')
            ->join('employers', 'companies.employer_id', '=', 'employers.id')
            ->where('companies.active', 1)
            ->select('companies.*', 'employers.first_name', 'employers.last_name')
            ->paginate(18);
        return view('companies.index', $data);
    }
    public function create()
    {
        if(!Right::check('Company', 'i'))
        {
            return view('permissions.no');
        }
        return view('companies.create');
    }
    public function save(Request $r)
    {

        // check if the employer id already in use or not
        $emp = DB::table('companies')->where('active', 1)->where('employer_id', $r->employer_id)->count();
        if($emp>0)
        {
            $r->session()->flash('sms1', "Employer ID already in use for another company. Please use a different one!");
            return redirect('/com/create')->withInput();
        }
        else{
            // check if the employer id exist or not
            $ch = DB::table('employers')->where('active', 1)->where('id', $r->employer_id)->count();
            if($ch<=0)
            {
                $r->session()->flash('sms1', "Employer ID '{$r->employer_id}' does not exist. Make sure you type it correctly!");
                return redirect('/com/create')->withInput();
            }
            else{
                // insert data first
                $data = [
                    'name' => $r->name,
                    'address' => $r->address,
                    'email' => $r->email,
                    'phone' => $r->phone,
                    'contact_person' => $r->contact_person,
                    'website' => $r->website,
                    'employer_id' => $r->employer_id
                ];
                $i = DB::table('companies')->insertGetId($data);
                if($i)
                {
                    // upload logo if user select
                    if($r->hasFile('logo'))
                    {
                        $file = $r->file('logo');
                        $file_name = $i . '-' . $file->getClientOriginalName();
                        $destinationPath = 'company/';
                        $file->move($destinationPath, $file_name);
                        DB::table('companies')->where('id', $i)->update(['logo'=>$file_name]);
                    }
                    $r->session()->flash('sms', "New company has been created successfully!");
                    return redirect('/com/create');
                }
            }
        }
    }
    // edit form
    public function edit($id)
    {
        if(!Right::check('Company', 'u'))
        {
            return view('permissions.no');
        }
        $data['company'] = DB::table('companies')->where('id', $id)->first();
        return view('companies.edit', $data);
    }
    // update
    public function update(Request $r)
    {

        // check if the employer id already in use or not
        $emp = DB::table('companies')->where('active', 1)->where('employer_id', $r->employer_id)->where('id','!=',$r->id)->count();
        if($emp>0)
        {
            $r->session()->flash('sms1', "Employer ID already in use for another company. Please use a different one!");
            return redirect('/com/create')->withInput();
        }
        else{
            // check if the employer id exist or not
            $ch = DB::table('employers')->where('active', 1)->where('id', $r->employer_id)->count();
            if($ch<=0)
            {
                $r->session()->flash('sms1', "Employer ID '{$r->employer_id}' does not exist. Make sure you type it correctly!");
                return redirect('/com/create')->withInput();
            }
            else{
                // insert data first
                $data = [
                    'name' => $r->name,
                    'address' => $r->address,
                    'email' => $r->email,
                    'phone' => $r->phone,
                    'contact_person' => $r->contact_person,
                    'website' => $r->website,
                    'employer_id' => $r->employer_id
                ];
                // upload logo if user select
                if($r->hasFile('logo'))
                {
                    $file = $r->file('logo');
                    $file_name = $r->id . '-' . $file->getClientOriginalName();
                    $destinationPath = 'company/';
                    $file->move($destinationPath, $file_name);
                    $data['logo'] = $file_name;
                }
                $i = DB::table('companies')->where('id', $r->id)->update($data);
                if($i)
                {
                    $r->session()->flash('sms', "All changes have been saved successfully!");
                    return redirect('/com/edit/'.$r->id);
                }
                else{
                    $r->session()->flash('sms1', "Fail to save changes. It seems you don't make any change!");
                    return redirect('/com/edit/'.$r->id);
                }
            }
        }
    }
    public function delete($id)
    {
        if(!Right::check('Company', 'd'))
        {
            return view('permissions.no');
        }
        DB::table('companies')->where('id', $id)->update(['active'=>0]);
        return redirect('/com');
    }
}
