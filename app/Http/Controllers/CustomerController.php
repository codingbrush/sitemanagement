<?php

namespace App\Http\Controllers;

use App\Customer;
use App\Package;
use Highlight\RegEx;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class CustomerController extends Controller
{
    protected $customer;

    protected $package;

    public function __construct(Customer $customer,Package $package)
    {
        $this->customer = $customer;
        $this->package = $package;
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
        $customers = DB::table('customers')
        ->join('customer_package', 'customer_package.customer_id', '=', 'customers.id')
        ->join('packages', 'packages.id', '=', 'customer_package.package_id')
        ->select('customer_package.package_id','customers.*')
        ->where('customer_package.customer_id','=', $id)
        ->get();
        //$customers = (object) $customers;
        //dd($customers);
        return view('customer.edit',['customers' => $customers->toArray(), 'packages' => $packages]);
    }

    
}
