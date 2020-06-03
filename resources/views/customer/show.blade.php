@extends('vendor.multiauth.layouts.app')

@section('content')
    <div class="row">
        <div class="col-sm-12">

            <div class="card">
                <div class="card-body ">
                    <a href="{{route('customer.index')}}" class="btn btn-outline-primary btn-md mb-3">Back</a>

                    <div class="row text-center">
                    <div class="form-group col-md-4">
                        <label for="">Customer Name</label>

                        <p class="text-uppercase font-weight-bolder">{{$customers[0]->name}}</p>
                    </div>
                    <div class="form-group col-4">
                        <label for="">Customer Email</label>
                        <p class="text-uppercase font-weight-bolder">{{$customers[0]->email}}</p>
                    </div>
                        <div class="form-group col-4">
                            <label for="">Customer Tel:</label>
                            <p class="text-uppercase font-weight-bolder">{{$customers[0]->telephone}}</p>
                        </div>

                    </div>

                <div class="row text-center">
                    <div class="form-group col-md-4">
                        <label for="">Customer Mobile:</label>

                        <p class="text-uppercase font-weight-bolder">{{$customers[0]->mobile}}</p>
                    </div>
                    <div class="form-group col-4">
                        <label for="">Package</label>
                        <p class="text-uppercase font-weight-bolder">{{$customers[0]->packagename}}</p>
                    </div>
                    <div class="form-group col-4">
                        <label for="">Total Price:</label>
                        <p class="text-uppercase font-weight-bolder">¢{{$customers[0]->total_price}}</p>
                    </div>

                </div>
                <div class="row text-center">
                    <div class="form-group col-md-4">
                        <label for="">Down Payment:</label>

                        <p class="text-uppercase font-weight-bolder">{{($customers[0]->down_payment == '0')? 'None': '¢'.$customers[0]->down_payment}}</p>
                    </div>
                    <div class="form-group col-4">
                        <label for="">Monthly Price:</label>
                        <p class="text-uppercase font-weight-bolder">{{($customers[0]->monthly_price == '0')? 'None': '¢'.$customers[0]->monthly_price}}</p>
                    </div>
                    <div class="form-group col-4">
                        <label for="">Duration:</label>
                        <p class="text-uppercase font-weight-bolder">{{($customers[0]->payment_duration == null ) ? 'Immediate': $customers[0]->payment_duration.' months'}}</p>
                    </div>

                </div>
                <div class="row text-center align-content-center">
                    <a href="{{route('customer.edit',$customers[0]->customerid)}}" class="btn btn-primary btn-md ml-auto mr-auto">Edit {{$customers[0]->name}}</a>
                </div>

            </div>
            </div>
        </div>
        </div>

    </div>
@endsection
