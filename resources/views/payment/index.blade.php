@extends('welcome')

@section('content')

    <div class="card">
        <div class="card-body">
            <div class="row">
                <div class="form-group col">
                    <label for="name">Name</label>
                    <select name="customer_id" id="customer_id" class="form-control">
                        <option >Choose Customer</option>
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
                    <input type="text" name="telephone" id="telephone" class="form-control" readonly>
                </div>
            </div>
            <div class="row">
                <div class="form-group col">
                    <label for="amount_due">Amount Due:</label>
                    <input type="text" name="amount_due" id="amount_due" class="form-control" readonly>
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
        </div>
    </div>

@endsection
@section('scripts')
    <script>

        const customers = document.querySelector('#customer_id');
        const amountdue = document.querySelector('#amount_due');
        const monthly = document.querySelector('#monthly_price');
        const email = document.querySelector('#email');
        const telephone = document.querySelector('#telephone');
        const package = document.querySelector('#packagename');

        customers.addEventListener('change',function(event){
            //console.log(event.target.value);
            getData(event.target.value)
        });
        function getData(id){
            //alert(value)
            let url = 'http://sitemanagement.test:8080/getDetails/';
            let cid = id;
            console.log(cid);
            fetch(url+cid)
                .then((resp) => resp.json()) // Transform the data into json
                .then(function(data) {
                    console.log(data)
                    amountdue.value = data[0].total_price;
                    monthly.value = data[0].monthly_price;
                    email.value = data[0].email;
                    telephone.value = data[0].telephone;
                    package.value = data[0].packagename;
                })
        }
    </script>
@endsection
