<?php

namespace App\Http\Controllers;

use App\Package;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class PackageController extends Controller
{
    public function index()
    {
        //$package = Package::all();
        $package = DB::table('customers')
            ->join('customer_package', 'customer_package.customer_id', '=', 'customers.id')
            ->join('packages', 'packages.id', '=', 'customer_package.package_id')
            ->select('packages.name as packagename' ,'customer_package.package_id','customers.*')
           // ->where('customers.id','=','customer_package.customer_id')
            ->get();
        return response()->json($package);
    }
}
