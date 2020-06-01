@extends('welcome')

@section('content')
<div class="row p-3">
    <a href="{{route('customer.index')}}" class="btn btn-outline-primary btn-sm">BACK</a>
    @if ($errors->any())
    <div class="alert alert-danger">
        <ul>
            @foreach ($errors->all() as $error)
                <li>{{ $error }}</li>
            @endforeach
        </ul>
    </div>
@endif
</div>
{{($customers->packages[0]->id)}}
<form method="post"
    action="{{Route::is('customer.edit') ? route('customer.update',$customers->id) : route('customer.store')}}">
    @if (Route::is('customer.edit'))
    @method('PUT')
    @endif
    @csrf
    <div class="form-row">
        <div class="form-group col-md-6">
            <label for="name">Name</label>
            <input type="text" class="form-control" name="name" id="name" value="{{$customers->name ?? ''}}">
        </div>
        <div class="form-group col-md-6">
            <label for="inputPassword4">Password</label>
            <input type="email" class="form-control" name="email" id="inputPassword4" value="{{$customers->email ?? ''}}">
        </div>
    </div>
    <div class="form-row">
        <div class="form-group col">
            <label for="inputAddress">Address</label>
            <input type="address" class="form-control" name="address" id="inputAddress"
                value="{{$customers->address ?? ''}}">
        </div>
        <div class="form-group col">
            <label for="inputAddress2">Telephone</label>
            <input type="text" class="form-control" name="telephone" id="inputAddress2"
                value="{{$customers->telephone ?? ''}}">
        </div>
    </div>
    <div class="form-row">
        <div class="form-group col-md-6">
            <label for="mobile">Mobile</label>
            <input type="text" class="form-control" name="mobile" id="inputCity" value="{{$customers->mobile ?? ''}}">
        </div>
        <div class="form-group col-md-4">
            <label for="inputState">Package</label>
            <select id="inputState" name="packagename" class="form-control">
                @if (Route::is('customer.create'))
                <option selected>Choose...</option>
                @foreach ($packages as $package)
            <option value="{{$package->id}}">{{$package->name}}</option>

                @endforeach
                @else
                <option selected>Choose...</option>
                @foreach ($packages as $package)
            <option value="{{$package->id}}" {{$package->id === $customers->packages[0]->id ? 'selected': '' }}>{{$package->name}}</option>

                @endforeach
                @endif

            </select>
        </div>

    </div>

<button type="submit" class="btn btn-primary">{{Route::is('customer.create') ? 'Add New Customer' : 'Update Customer'}}</button>
</form>
@endsection
