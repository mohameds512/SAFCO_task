<?php

namespace App\Http\Controllers;
use Illuminate\Support\Facades\Auth;
use Illuminate\Http\Request;
use App\Models\Product;
use Illuminate\Support\Facades\Gate;
class ProductController extends Controller
{
    public function index()
    {
        $products = Product::with('user')->get();
        return view('products.index', compact('products'));
    }

    public function store(Request $request)
    {
        if (Gate::denies('create products')) {
            abort(403, 'You do not have permission to create a product.');
        }
        $request->validate([
            'name' => 'required',
            'description' => 'required',
            'price' => 'required|numeric',
        ]);

        Product::create([
            'name' => $request->name,
            'description' => $request->description,
            'price' => $request->price,
            'user_id' => Auth::id(),
        ]);

        return redirect()->route('products.index')
            ->with('success', 'Product created successfully');
    }


    public function update(Request $request, Product $product)
    {
        if (Gate::denies('edit products')) {
            abort(403, 'You do not have permission to create a product.');
        }
        $request->validate([
            'name' => 'required',
            'description' => 'required',
            'price' => 'required|numeric',
        ]);

        $product->update([
            'name' => $request->name,
            'description' => $request->description,
            'price' => $request->price,
        ]);

        return redirect()->route('products.index')
            ->with('success', 'Product updated successfully');
    }

    public function destroy(Product $product)
    {
        if (Gate::denies('delete products')) {
            abort(403, 'You do not have permission to create a product.');
        }
        $product->delete();

        return redirect()->route('products.index')
            ->with('success', 'Product deleted successfully');
    }
}
