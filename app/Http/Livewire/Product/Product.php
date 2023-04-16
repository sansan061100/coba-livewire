<?php

namespace App\Http\Livewire\Product;

use Livewire\Component;
use App\Models\Product as ProductModel;

class Product extends Component
{
    public $name, $price, $product_id, $modalTitle = 'Create New Product',
        $showModal = false;

    protected $listeners = [
        'deleteProduct' => 'destroy',
        'editProduct' => 'edit',
    ];

    public function render()
    {
        return view('livewire.product.product');
    }

    public function resetForm()
    {
        $this->name = '';
        $this->price = '';
        $this->product_id = '';
    }

    public function openModal()
    {
        $this->showModal = true;
    }

    public function closeModal()
    {
        $this->showModal = false;
    }

    public function create()
    {
        $this->resetForm();
        $this->openModal();

        $this->modalTitle = 'Create New Product';
    }

    public function store()
    {
        $this->validate([
            'name' => 'required',
            'price' => 'required',
        ]);

        ProductModel::updateOrCreate(['id' => $this->product_id], [
            'name' => $this->name,
            'price' => $this->price,
        ]);

        session()->flash(
            'message',
            $this->product_id ? 'Product Updated Successfully.' : 'Product Created Successfully.'
        );

        $this->closeModal();
        $this->resetForm();

        $this->emit('refreshDatatable');
    }

    public function edit($id)
    {
        $product = ProductModel::find($id);
        $this->product_id = $id;
        $this->name = $product->name;
        $this->price = $product->price;

        $this->openModal();
        $this->modalTitle = 'Edit Product';
    }

    public function destroy($id)
    {
        $product = ProductModel::find($id);

        if ($product) {
            $product->delete();
        }

        $this->emit('refreshDatatable');
    }
}
