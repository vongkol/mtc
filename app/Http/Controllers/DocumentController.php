<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use DB;
use Auth;
use File;
use Session;
class DocumentController extends Controller
{
    public function __construct()
    {
        $this->middleware(function ($request, $next) {
           app()->setLocale(Session::get("lang"));
            return $next($request);
        });
    }
    // index
    public function index(Request $r)
    {
        $seeker = $r->session()->get('seeker');
        if($seeker==NULL)
        {
            return redirect('/seeker/login');
        }
        $data['documents'] = DB::table('documents')
            ->where("seeker_id", $seeker->id)
            ->get();
        return view("fronts.seekers.document", $data);
    }
    public function create(Request $r)
    {
        return view("fronts.seekers.document-create");
    }
    public function delete($id)
    {
        $file = DB::table('documents')->where('id', $id)->first();
        $file_path = public_path("uploads/docs/".$file->name);
        $i=0;
        if(File::exists($file_path))
        {
            File::delete($file_path);
            $i = DB::table('documents')->where('id', $id)->delete();
        }
        else{
            $i = DB::table('documents')->where('id', $id)->delete();
        }
        
        return redirect("/seeker/document");
    }
    // save
    public function save(Request $r)
    {
        $seeker = $r->session()->get('seeker');
        if($seeker==NULL)
        {
            return redirect('/seeker/login');
        }
        if($r->hasFile("name"))
        {
            $lang = $r->session()->get('lang');
            if($lang == "en")
            {
                $sms = "Your file has been uploaded successfully!";
                $sms1 = "Please select a file to upload!";
            }
            else{
                $sms = "ឯកសាររបស់អ្នកត្រូវបានបញ្ចូលដោយជោគជ័យ!";
                $sms1 = "សូមជ្រើសរើសឯកសារដើម្បីបញ្ចូល!";
            }
            $r->session()->flash('sms', $sms);
            $data = array(
                'name' => "",
                'description' => $r->description,
                'seeker_id' => $seeker->id
            );
            $i = DB::table('documents')->insertGetId($data);
            if($i)
            {
                // upload file
                $file = $r->file('name');
                $file_name = $i . "-" .$file->getClientOriginalName();
                $destinationPath = 'uploads/docs/';
                $file->move($destinationPath, $file_name);
                $data = array(
                    'name' => $file_name
                );
                DB::table('documents')->where('id', $i)->update($data);
            }
            return redirect("/seeker/document/create");
        }
        else{
            $r->session()->flash('sms1', $sms1);
            return redirect("/seeker/document/create");
        }
    }
}
