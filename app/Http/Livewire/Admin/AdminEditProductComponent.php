<?php

namespace App\Http\Livewire\Admin;

use App\Models\AttributeValue;
use Carbon\Carbon;
use App\Models\Product;
use Livewire\Component;
use App\Models\Categoryy;
use App\Models\ProductAttribute;
use App\Models\Subcategory;
use Illuminate\Support\Str;
use Livewire\WithFileUploads;

class AdminEditProductComponent extends Component
{
    use WithFileUploads;
    public $name;
    public $slug;
    public $short_description;
    public $description;
    public $regular_price;
    public $sale_price;
    public $SKU;
    public $stock_status;
    public $featured;
    public $quantity;
    public $image;
    public $category_id;
    public $newimage;
    public $product_id;

    public $images;
    public $newimages;

    public $scategory_id;

    public $attr;
    public $inputs = [];
    public $attribute_arr = [];
    public $attribute_values = [];


    public function mount($product_slug)
    {
        $product = Product::where('slug', $product_slug)->first();
        $this->name = $product->name;
        $this->slug = $product->slug;
        $this->short_description = $product->short_description;
        $this->description = $product->description;
        $this->regular_price = $product->regular_price;
        $this->sale_price = $product->sale_price;
        $this->SKU = $product->SKU;
        $this->stock_status = $product->stock_status;
        $this->featured = $product->featured;
        $this->quantity = $product->quantity;
        $this->image = $product->image;
        $this->images = explode(",", $product->images);
        $this->category_id = $product->category_id;
        $this->scategory_id = $product->subcategory_id;
        $this->product_id = $product->id;
        $this->inputs = $product->attributeValues->where('product_id', $product->id)->unique('product_attribute_id')->pluck('product_attribute_id');
        $this->attribute_arr = $product->attributeValues->where('product_id', $product->id)->unique('product_attribute_id')->pluck('product_attribute_id');

        foreach ($this->attribute_arr as $a_arr) {
            $allAttributeValue = AttributeValue::where('product_id', $product->id)->where('product_attribute_id', $a_arr)->get()->pluck('value');
            $valueString = '';
            foreach ($allAttributeValue as $value) {
                $valueString = $valueString . $value . ',';
            }
            $this->attribute_values[$a_arr] = rtrim($valueString, ",");
        }
    }

    public function add()
    {
        if (!$this->attribute_arr->contains($this->attr)) {
            $this->inputs->push($this->attr);
            $this->attribute_arr->push($this->attr);
        }
    }
    public function remove($attr)
    {
        unset($this->inputs[$attr]);
    }
    public function generateslug()
    {
        $this->slug = Str::slug($this->name, '-');
    }
    public function updated($fields)
    {
        $this->validateOnly($fields, [
            'name' => 'required',
            'slug' => 'required|unique:products',
            'description' => 'required',
            'regular_price' => 'required|numeric',
            'sale_price' => 'required|numeric',
            'SKU' => 'required',
            'stock_status' => 'required',
            'quantity' => 'required|numeric',
            'category_id' => 'required',
            'attr' => 'required'

        ]);
        if ($this->newimage) {
            $this->validateOnly($fields, [
                'newimage' => 'required|mimes:jpeg,png',
            ]);
        }
    }
    public function updateproduct()
    {
        $this->validate([
            'name' => 'required',
            'slug' => 'required',
            'description' => 'required',
            'regular_price' => 'required|numeric',
            'sale_price' => 'required|numeric',
            'SKU' => 'required',
            'stock_status' => 'required',
            'quantity' => 'required|numeric',
            'category_id' => 'required',
            // 'attr' => 'required'


        ]);

        if ($this->newimage) {
            $this->validate([
                'newimage' => 'required|mimes:jpeg,png',
            ]);
        }
        $product = Product::find($this->product_id);
        $product->name = $this->name;
        $product->slug = $this->slug;
        $product->short_description = $this->short_description;
        $product->description = $this->description;
        $product->regular_price = $this->regular_price;
        $product->sale_price = $this->sale_price;
        $product->SKU = $this->SKU;
        $product->featured = $this->featured;
        $product->quantity = $this->quantity;
        if ($this->newimage) {
            unlink('assets/images/products' . '/' . $product->image);
            $imageName = Carbon::now()->timestamp . '.' . $this->newimage->extension();
            $this->newimage->storeAs('products', $imageName);
            $product->image = $imageName;
        }
        if ($this->newimages) {
            if ($product->images) {
                $images = explode(",", $product->images);
                foreach ($images as $image) {
                    if ($image) {
                        unlink('assets/images/products' . '/' . $image);
                    }
                }
            }
            $imagesname = '';
            foreach ($this->newimages as $key => $image) {
                $imgName = Carbon::now()->timestamp . $key . '.' . $image->extension();
                $image->storeAs('products', $imgName);
                $imagesname = $imagesname . ',' . $imgName;
            }

            $product->images = $imagesname;
        }



        $product->category_id = $this->category_id;
        if ($this->scategory_id) {
            $product->subcategory_id = $this->scategory_id;
        }
        $product->save();
        AttributeValue::where('product_id', $product->id)->delete();
        foreach ($this->attribute_values as $key => $attribute_value) {
            $avalues = explode(',', $attribute_value);
            foreach ($avalues as $avalue) {
                $attribute_value = new AttributeValue();
                $attribute_value->product_attribute_id = $key;
                $attribute_value->value = $avalue;
                $attribute_value->product_id = $product->id;
                $attribute_value->save();
            }
            session()->flash('message', 'product updated succcessfully');
        }
    }
    public function changeSubcategory()
    {
        $this->scategory_id = 0;
    }
    public function render()
    {

        $categories = Categoryy::all();
        $scategories = Subcategory::where('category_id', $this->category_id)->get();
        $pattributes = ProductAttribute::all();
        return view('livewire.admin.admin-edit-product-component', compact('categories', 'scategories', 'pattributes'))->layout("layouts.base");
    }
}
