<?php

namespace App\Http\Livewire;

use Livewire\Component;
use App\Models\Product;
use App\Models\ShoppingCart;

class ProductList extends Component
{
    public $products;

    public function render()
    {
        $this->products = Product::get();
        return view('livewire.product-list');
    }

    public function addToCart($id)
    {   
        if(auth()->user()){
            // add to cart
            $data = [
                'user_id' => auth()->user()->id,
                'product_id' => $id
            ];

            ShoppingCart::updateOrCreate($data);

            $this->emit('updateCartCount');

            session()->flash('success', 'Product added to the cart successfully');
        } else {
            return redirect(route('login'));
        }
    }
}
