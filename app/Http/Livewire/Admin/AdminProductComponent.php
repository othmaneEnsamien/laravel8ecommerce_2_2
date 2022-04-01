<?php

namespace App\Http\Livewire\Admin;

use App\Models\Product;
use Livewire\Component;
use Livewire\WithPagination;

class AdminProductComponent extends Component
{
    use WithPagination;
    public $searchTerm;

    public function deleteProduct($id)
    {
        $product = Product::find($id);
        if ($product->image) {
            unlink('assets/images/products' . '/' . $product->image);
        }

        if ($product->images) {
            $images = explode(",", $product->images);
            foreach ($images as $image) {
                if ($image) {
                    unlink('assets/images/products' . '/' . $image);
                }
            }
        }

        $product->delete();
        session()->flash('message', 'product has been deleted successfuly');
    }
    public function render()
    {
        $search = '%' . $this->searchTerm . '%';
        $products = Product::where('name', 'LIKE', $search)
            ->orwhere('stock_status', 'LIKE', $search)
            ->orwhere('regular_price', 'LIKE', $search)
            ->orwhere('sale_price', 'LIKE', $search)
            ->orderBY('id', 'DESC')->paginate(10);
        return view('livewire.admin.admin-product-component', compact('products'))->layout("layouts.base");
    }
}
