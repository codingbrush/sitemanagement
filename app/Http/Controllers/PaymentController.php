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

    public function index($id)
    {
        $customers = $this->customer->all(['id','name']);
        $payments = $this->payment->where('customer_id','=',$id)->get();
        //dd($payments);
        return view('payment.index',['customers' => $customers,'payments' => $payments->toArray()]);
    }

    public function getDetails($id)
    {
        $payments = DB::table('customers')
            ->join('customer_package','customer_package.customer_id','=','customers.id')
            ->join('packages','packages.id','=','customer_package.package_id')
            ->join('package_details','package_details.id','=','customer_package.package_id')
            ->leftJoin('payments','payments.customer_id','=','customers.id')
            ->select('customers.*','package_details.*','packages.name as packagename','packages.description as description','customers.id as customerid','payments.amount_left','payments.defaulted','payments.defaulted_amount')
            ->where('customers.id','=',$id)
            ->get();
        //dd($payments);
        return response()->json($payments);
        //echo json_encode($payments);
    }

    public function store(Request $request)
    {
        $validated = $this->validate($request,[
            'amount_left' => 'nullable',
            'defaulted_amount' => 'nullable'
        ]);
        if(!$validated)
        {
            return redirect()->route('customer.index');
        }
        $payments = $this->payment->create([
           'customer_id' => $request->customer_id,
           'amount_left' => (intval($request->amount_due) - intval($request->amount_paid)),
            'amount_paid' => $request->amount_paid,
            'defaulted_amount' => $request->defaulted_amount,
            'defaulted' => $request->defaulted
        ]);
        if(!$payments)
        {
            echo 'Error storing data';
            return redirect()->back()->withInput();
        }
        return redirect()->back();
    }
}
