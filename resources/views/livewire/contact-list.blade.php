<div>
    {{-- In work, do what you enjoy. --}}
    <div class="row mb-4">
        <a href="{{route('customer.create')}}" class="btn btn-info">Add New Customer</a>
        <div class="col form-inline">
            Per Page: &nbsp;
            <select wire:model="perPage" class="form-control">
                <option>5</option>
                <option>10</option>
                <option>15</option>
                <option>25</option>
            </select>
        </div>

        <div class="col">
            <input wire:model="search" class="form-control" type="text" placeholder="Search customers...">
        </div>
    </div>
    <table class="table table-hover">
        <thead>
            <th>customer name</th>
            <th>customer email</th>
            <th>customer telephone</th>
            <th>Modify</th>
        </thead>
        <tbody>
{{--        {{dd($customers)}}--}}
        @foreach ($customers as $customer)
            <tr>
                <td>{{ $customer->name}}</td>
                <td>{{ $customer->email }}</td>
                <td>{{$customer->telephone}}</td>
                <td>
                <a class="btn btn-primary btn-sm"  href="{{route('customer.edit',$customer->id)}}">edit</a>
                    <a class="btn btn-danger btn-sm" wire:click="deleteCustomer({{$customer->id}})">del</a>
                </td>
            </tr>
        @endforeach
        </tbody>
    </table>

    <div class="row">
        <div class="col">
            {{ $customers->links() }}
        </div>

        <div class="col text-right text-muted">
            Showing {{ $customers->firstItem() }} to {{ $customers->lastItem() }} out of {{ $customers->total() }} results
        </div>
    </div>

</div>
