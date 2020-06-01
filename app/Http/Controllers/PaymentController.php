<?php

namespace App\Http\Controllers;

use App\Customer;
use App\Payment;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class PaymentController extends Controller
{
    public $payment;
    /**
     * @var Customer
     */
    public $customer;

    public function __construct(Payment $payment,Customer $customer)
    {
        $this->payment = $payment;
        $this->customer = $customer;
    }

    public function index()
    {
        $customers = $this->customer->all(['id','name']);
        return view('payment.index',['customers' => $customers]);
    }

    public function getDetails($id)
    {
        $payments = DB::table('customers')
            ->join('customer_package','customer_package.customer_id','=','customers.id')
            ->join('packages','packages.id','=','customer_package.package_id')
            ->join('package_details','package_details.id','=','customer_package.package_id')
            ->select('customers.*','package_details.*','packages.name as packagename','packages.description as description','customers.id as customerid')
            ->where('customers.id','=',$id)
            ->get();
//        return response()->json($payments);
        echo json_encode($payments);
    }
}
