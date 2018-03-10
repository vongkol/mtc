<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use DB;
use Auth;
class SubscriptionController extends Controller
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
        if(!Right::check('Subscription List', 'l'))
        {
            return view('permissions.no');
        }
        $data['subscriptions'] = DB::table('subscriptions')
            ->join('employers', 'subscriptions.employer_id', 'employers.id')
            ->join('packages', 'subscriptions.package_id', 'packages.id')
            ->where('subscriptions.active', 1)
            ->orderBy('subscriptions.id', 'desc')
            ->select(
                'subscriptions.*',
                'employers.first_name',
                'employers.last_name',
                'employers.email',
                'employers.phone',
                'packages.name'
            )
            ->paginate(18);
        return view('subscriptions.index', $data);
    }
    // detail
    public function detail($id)
    {
        $data['subscription'] = DB::table('subscriptions')
            ->join('employers', 'subscriptions.employer_id', 'employers.id')
            ->join('packages', 'subscriptions.package_id', 'packages.id')
            ->where('subscriptions.active', 1)
            ->where("subscriptions.id", $id)
            ->select(
                'subscriptions.*',
                'employers.first_name',
                'employers.last_name',
                'employers.email',
                'employers.phone',
                'packages.name'
            )->first();
        return view('subscriptions.detail', $data);
    }
    // load create form
    public function create()
    {
        if(!Right::check('Subscription List', 'i'))
        {
            return view('permissions.no');
        }
        $data['packages'] = DB::table('packages')->where('active', 1)->orderBy('name')->get();
        return view('subscriptions.create', $data);
    }
    // save
    public function save(Request $r)
    {
        $package = DB::table('packages')->where('id', $r->package)->first();
        $expired_date = date('Y-m-d', strtotime("+{$package->day_number} day"));
        $data = [
            'employer_id' => $r->employer_id,
            'package_id' => $r->package,
            'expired_date' => $expired_date,
            'price' => $package->price,
            'day_number' => $package->day_number,
            'job_number' => $package->job_number,
            'download' => $package->download
        ];
        $i = DB::table('subscriptions')->insert($data);
        if($i)
        {
            $r->session()->flash('sms', "New subscription has been create successfully!");
            return redirect('/subscription/create');
        }
        else{
            $r->session()->flash('sms1', "Cannot create new subscription!");
            return redirect('/subscription/create');
        }
    }
    // update
    public function update(Request $r)
    {
        $data = [
          'price' => $r->price,
            'day_number' => $r->day,
            'expired_date' => $r->expired_date,
            'job_number' => $r->job,
            "download" => $r->download
        ];
        $i = DB::table('subscriptions')->where('id', $r->id)->update($data);
        if ($i)
        {
            $r->session()->flash('sms', "All changes have been saved successfully!");
            return redirect('/subscription/edit/'.$r->id);
        }
        else{
            $r->session()->flash('sms1', "Fail to save changes. It seems you don't make any change!");
            return redirect('/subscription/edit/'.$r->id);
        }
    }
    // edit
    public function edit($id)
    {
        $data['subscription'] = DB::table('subscriptions')
            ->where('id', $id)
            ->first();
        return view('subscriptions.edit', $data);
    }
    // delete
    public function delete($id)
    {
        if (Auth::user()==null)
        {
            return redirect("/login");
        }
        if(!Right::check('Subscription List', 'd'))
        {
            return view('permissions.no');
        }
        DB::table('subscriptions')->where('id', $id)->update(['active'=>0]);
        return redirect('/subscription');
    }
    public function approve(Request $r)
    {
        if($r->status==0)
        {
            DB::table('subscriptions')->where('id', $r->id)->update(['status'=>1]);
            $r->session()->flash('sms', "Subscription has been approved successfully!");
            return redirect('/subscription/detail/'.$r->id);
        }
        else{

            DB::table('subscriptions')->where('id', $r->id)->update(['status'=>0]);
            $r->session()->flash('sms1', "Subscription has been de-approved successfully!");
            return redirect('/subscription/detail/'.$r->id);
        }
    }
    // get expired
    public function expire(Request $r)
    {
        if(!Right::check('Subscription Expire', 'l'))
        {
            return view('permissions.no');
        }
        if ($r->from && $r->to)
        {
            $data['from'] = $r->from;
            $data['to'] = $r->to;
            $data['subscriptions'] = DB::table('subscriptions')
                ->join('employers', 'subscriptions.employer_id', 'employers.id')
                ->join('packages', 'subscriptions.package_id', 'packages.id')
                ->where('subscriptions.active', 1)
                ->whereDate('subscriptions.expired_date', '>=', $r->from)
                ->whereDate('subscriptions.expired_date', '<=', $r->to)
                ->orderBy('subscriptions.id', 'desc')
                ->select(
                    'subscriptions.*',
                    'employers.first_name',
                    'employers.last_name',
                    'employers.email',
                    'employers.phone',
                    'packages.name'
                )->get();
        }
        else{
            $m = date('m');
            $y = date('Y');
            $data['from'] ="";
            $data['to'] = "";
            $data['subscriptions'] = DB::table('subscriptions')
                ->join('employers', 'subscriptions.employer_id', 'employers.id')
                ->join('packages', 'subscriptions.package_id', 'packages.id')
                ->where('subscriptions.active', 1)
                ->whereMonth('subscriptions.expired_date', '<=', $m)
                ->whereYear('subscriptions.expired_date', '<=', $y)
                ->orderBy('subscriptions.id', 'desc')
                ->select(
                    'subscriptions.*',
                    'employers.first_name',
                    'employers.last_name',
                    'employers.email',
                    'employers.phone',
                    'packages.name'
                )->get();
        }

        return view('subscriptions.expire', $data);
    }
}
