@extends('welcome')

@section('content')

<div class="card">
{{--    {{dd($payments[0]['id'])}}--}}
    <div class="card-body">
    <form action="{{route('payment.store')}}" method="POST">
        @csrf
            <div class="row">
                <div class="form-group col">
                    <label for="name">Name</label>
                    <select name="customer_id" id="customer_id" class="form-control">
                        <option>Choose Customer</option>
                        @foreach($customers as $customer)
                        <option value="{{$customer->id}}">{{$customer->name}}</option>
                        @endforeach
                    </select>
                </div>
                <div class="form-group col">
                    <label for="email">Customer Mail:</label>
                    <input type="text" name="email" id="email" class="form-control" readonly>
                </div>
                <div class="form-group col">
                    <label for="telephone">Monthly Price:</label>
                    <input type="text" name="telephone" id="telephone" class="form-control" value="" readonly>
                </div>
            </div>
            <div class="row">
                <div class="form-group col">
                    <label for="amount_due">Total Price:</label>
                    <input type="text" name="total_price" id="total_price" class="form-control" value="" readonly>
                </div>
                <div class="form-group col">
                    <label for="amount_paid">Monthly Price:</label>
                    <input type="text" name="monthly_price" id="monthly_price" class="form-control" readonly>
                </div>
                <div class="form-group col">
                    <label for="packagename">Package Name:</label>
                    <input type="text" name="packagename" id="packagename" class="form-control" readonly>
                </div>
            </div>
        <div class="row">
        <div class="form-group col">
            <label for="amount_due">Amount Due:</label>
            <input type="text" name="amount_left"  id="amount_left" class="form-control" value="">

        </div>
            <div class="form-group col">
                <label for="defaulted">Defaulted</label>
                <input type="checkbox" value="1" name="defaulted"  class="form-control" id="defaulted">
            </div>
            <div class="form-group col">
                <label for="defaulted">Defaulted Amount</label>
                <input type="text"  name="defaulted_amount" id="defaulted_amount" class="form-control" value="">
            </div>
        </div>
            <div class="row mt-3">
                <div class="form-group col">
                    <label for="amount_paid">Amount Paid:</label>
                    <input type="text" class="form-control" name="amount_paid" id="amount_paid">
                </div>
                <div class="form-group col text-center ">
                    <button type="submit" class="btn btn-primary btn-md text-center align-content-center">Process Payment!</button>
                </div>
            </div>
        </form>
    </div>
</div>

@endsection
@section('scripts')
<script>
    const customers = document.querySelector('#customer_id');
    const totalprice = document.querySelector('#total_price');
    const monthly = document.querySelector('#monthly_price');
    const email = document.querySelector('#email');
    const telephone = document.querySelector('#telephone');
    const packages = document.querySelector('#packagename');
    const amountdue = document.querySelector('#amount_left');
    const defaulted = document.querySelector('#defaulted');
    const defaultedamt = document.querySelector('#defaulted_amount');

    customers.addEventListener('change', function (event) {
        getData(event.target.value)
    });

    function getData(id) {

        let url = "{{url('/getDetails')}}";
        let cid = id;
        let amount_left;
        let defaulted_amount;
        console.log(cid);
        fetch(url + '/' + cid)
            .then((resp) => resp.json()) // Transform the data into json
            .then(function (data) {
                console.log(data)

                if(data[0].defaulted_amount === null )
                {
                     defaulted_amount = 0;
                }
                if(data[0].amount_left === null )
                {
                     amount_left = 0;
                }
                totalprice.value = data[0].total_price;
                monthly.value = data[0].monthly_price;
                email.value = data[0].email;
                telephone.value = data[0].telephone;
                packages.value = data[0].packagename;
                amountdue.value = amount_left ?? data[0].amount_left;
                defaulted.value = data[0].defaulted;
                defaultedamt.value = defaulted_amount ?? data[0].defaulted_amount;
                if(data[0].defaulted === 1)
                {
                    defaulted.checked = true;
                }
            })
    }

</script>
@endsection
