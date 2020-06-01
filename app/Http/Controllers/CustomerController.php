<?php

namespace App\Http\Controllers;

use App\Customer;
use App\Package;
use App\PackageDetail;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class CustomerController extends Controller
{
    protected $customer;

    protected $package;

    public function __construct(Customer $customer, Package $package,PackageDetail $packagedetail)
    {
        $this->customer = $customer;
        $this->package = $package;
        $this->packagedetail = $packagedetail;
    }

    public function index()
    {
        return view('customer.index');
    }

    public function create()
    {
        $packages = $this->package->all();
        return view('customer.edit',['packages' => $packages]);
    }

    public function show($id)
    {
//        $customers = $this->customer->with('packages','packagedetail')->find($id);
//        $package = $this->packagedetail->with('package')->where('id','=',$customers->packages[0]->id)->get();
        $customers = DB::table('customers')
            ->join('customer_package','customer_package.customer_id','=','customers.id')
            ->join('packages','packages.id','=','customer_package.package_id')
            ->join('package_details','package_details.id','=','customer_package.package_id')
            ->select('customers.*','package_details.*','packages.name as packagename','packages.description as description','customers.id as customerid')
            ->where('customers.id','=',$id)
            ->get();
        //dd($customers);
        return view('customer.show',['customers' => $customers]);
    }

    public function store(Request $request)
    {
        //dd($request);
        $validated = $request->validate([
            'name' => 'required',
            'email' => 'required',
            'address' => 'nullable',
            'telephone' => 'required',
            'mobile' => 'nullable'
        ]);
        if (!$validated) {
            dd('Error');
        }
       $customer = $this->customer->create([
            'name' => $request->name,
            'email' => $request->email,
            'address' => $request->address,
            'telephone' => $request->telephone,
            'mobile' => $request->mobile
        ]);
        //dd($request->packagename);
        $customer->packages()->attach($request->packagename);
        return redirect()->route('customer.index');
    }

    public function edit($id)
    {
        $packages = $this->package->all();
//        $customers = DB::table('customers')
//        ->join('customer_package', 'customer_package.customer_id', '=', 'customers.id')
//        ->join('packages', 'packages.id', '=', 'customer_package.package_id')
//        ->select('customer_package.package_id','customers.*')
//        ->where('customer_package.customer_id','=', $id)
//        ->get();
        $customers = $this->customer->with('packages')->find($id);
        //$customers = (object) $customers;
        //dd($customers);
        return view('customer.edit',['customers' => $customers, 'packages' => $packages]);
    }

    public function update($id, Request $request)
    {
        $validated = $request->validate([
            'name' => 'required',
            'email' => 'required',
            'address' => 'nullable',
            'telephone' => 'required',
            'mobile' => 'nullable'
        ]);
        if (!$validated) {
            dd('Error');
        }
        $customer = $this->customer->findOrFail($id);
        $customer->packages()->sync(['package_id'=>$request->packagename]);
        $customer->update([
            'name' => $request->name,
            'email' => $request->email,
            'address' => $request->address,
            'telephone' => $request->telephone,
            'mobile' => $request->mobile
        ]);


        return redirect()->route('customer.index');
    }


}
