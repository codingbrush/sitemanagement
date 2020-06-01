<?php

namespace App\Http\Livewire;

use App\Customer;
use Illuminate\Support\Facades\DB;
use Livewire\Component;
use Livewire\WithPagination;

class ContactList extends Component
{
    use WithPagination;

    public $perPage = 5;
    public $sortField = 'name';
    public $sorAsc = true;
    public $search = '';

    public function sortBy($field)
    {
        if ($this->sortField === $field) {
            $this->sortAsc = ! $this->sortAsc;
        } else {
            $this->sortAsc = true;
        }

        $this->sortField = $field;
    }

    public function edit($id)
    {
        $customer = Customer::findOrFail($id);
        return view('livewire.customer.form',[
            'customer' => $customer
        ]);
    }

    public function deleteCustomer($id)
    {
        dd($id);
    }

    public function render()
    {
        return view('livewire.contact-list',[
            'customers'=> Customer::search($this->search)
                            ->orderBy($this->sortField,$this->sorAsc ? 'asc':'desc')
                            ->paginate($this->perPage)
        ]);
    }
}
