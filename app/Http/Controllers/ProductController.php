<?php

namespace App\Http\Controllers;

use App\Models\Product;

use Illuminate\View\View;
use Illuminate\Http\Request;
use Illuminate\Database\Eloquent\Collection;
use Symfony\Contracts\Service\Attribute\Required;
use Illuminate\Support\Facades\Storage;

class ProductController extends Controller
{
    /**
     * index
     *
     * @return View
     */
    public function index(Request $request)
    {
        //get posts
        $category = $request->query('category', 'all');
        $products = Product::query();

        if ($category !== 'all') {
            $products->where('category', $category);
        }

        $products = $products->get();

        return view('products.products', ['products' => $products, 'category' => $category]);

        //render view with posts


    }

    public function store(Request $req)
    {
        $req->validate([
            'jenis' => 'required',
            'code' => 'required|unique:products,code',
            'name' => 'required|unique:products,name',
            'price' => 'required|numeric',
            'stock' => 'required|numeric',
            'image' => 'required|image|mimes:jpeg,png,jpg,gif,svg|max:2048'
        ], [
            'name.unique' => 'PRODUCT NAME ALREADY EXIST',
        ]);

        $image = $req->file('image');
        $imageName = time() . '.' . $image->getClientOriginalExtension();
        $image->move(public_path('images'), $imageName);

        // Logic to save product to database
        $product = new Product();
        $product->jenis = $req->input('jenis');
        $product->code = $req->input('code');
        $product->name = $req->input('name');
        $product->price = $req->input('price');
        $product->stock = $req->input('stock');
        $product->image = $imageName;

        $product->save();

        return redirect('products')->with('success', 'Product added successfully.');
    }

    public function edit(Product $product)
    {
        return view('products.edit', compact('product'));
    }

    public function update(Request $request, Product $product)
    {
        $request->validate([
            'price' => 'required|numeric',
            'stock' => 'required|numeric',
        ]);

        $product->price = $request->input('price');
        $product->stock = $request->input('stock');
        $product->save();

        return redirect()->route('products')->with('success', 'Product updated successfully');
    }

    public function destroy(Request $request, $uuid)
    {
        $product = Product::where('uuid', $uuid)->first();
        if ($product) {
            $product->delete();
            session()->flash('danger', 'Product deleted successfully');
        } else {
            session()->flash('error', 'Product not found');
        }
        return redirect()->route('products');
    }

    public function search(Request $request)
    {
        $searchTerm = $request->input('search');
        $products = Product::where('name', 'like', '%' . $searchTerm . '%')
            ->orWhere('price', 'like', '%' . $searchTerm . '%')
            ->orWhere('stock', 'like', '%' . $searchTerm . '%')
            ->get();

        return response()->json($products);
    }
}
