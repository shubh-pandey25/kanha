<?php

namespace App\Http\Controllers;

use App\Models\Product;
use App\Models\Category;
use Illuminate\Contracts\View\View;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class ProductController extends Controller
{
    /**
     * Display a paginated list of products,
     * optionally filtered by category or search query.
     *
     * @param  Request  $request
     * @return View
     */
    public function index(Request $request): View
    {
        // 1) Fetch categories for navbar & category grid
        $categories = Category::all();

        // 2) Build the products query
        $query = Product::with('category');

        if ($catId = $request->query('category')) {
            $query->where('category_id', $catId);
        }
        if ($search = $request->query('q')) {
            $query->where('name', 'like', "%{$search}%");
        }

        // 3) Paginate with query string so filters persist
        $products = $query->paginate(12)->withQueryString();

        // 4) Define static testimonials for the slider
        $testimonials = [
            ['name' => 'Rohit S.', 'text' => 'Amazing quality and service!'],
            ['name' => 'Priya M.',  'text' => 'My living room never looked better!'],
            ['name' => 'Ankit P.',  'text' => 'Fast delivery and great prices.'],
        ];

        // 5) Pass everything into the index view
        return view('products.index', compact(
            'products',
            'categories',
            'testimonials'
        ));
    }

    /**
     * Show form to create a new product.
     */
    public function create(): View
    {
        $categories = Category::all();
        return view('products.create', compact('categories'));
    }

    /**
     * Validate and store a new product.
     */
    public function store(Request $request): RedirectResponse
    {
        $data = $request->validate([
            'category_id' => 'required|exists:categories,id',
            'name'        => 'required|string|max:255',
            'description' => 'nullable|string',
            'price'       => 'required|numeric',
            'image'       => 'nullable|image|max:2048',
        ]);

        if ($request->hasFile('image')) {
            $path          = $request->file('image')->store('images', 'public');
            $data['image'] = "/storage/{$path}";
        }

        Product::create($data);

        return redirect()
            ->route('products.index')
            ->with('success', 'Product added');
    }

    /**
     * Show form to edit an existing product.
     */
    public function edit(Product $product): View
    {
        $categories = Category::all();
        return view('products.edit', compact('product', 'categories'));
    }

    /**
     * Validate and update an existing product.
     */
    public function update(Request $request, Product $product): RedirectResponse
    {
        $data = $request->validate([
            'category_id' => 'required|exists:categories,id',
            'name'        => 'required|string|max:255',
            'description' => 'nullable|string',
            'price'       => 'required|numeric',
            'image'       => 'nullable|image|max:2048',
        ]);

        if ($request->hasFile('image')) {
            if ($product->image) {
                Storage::disk('public')
                    ->delete(str_replace('/storage/', '', $product->image));
            }
            $path          = $request->file('image')->store('images', 'public');
            $data['image'] = "/storage/{$path}";
        }

        $product->update($data);

        return redirect()
            ->route('products.index')
            ->with('success', 'Product updated');
    }

    /**
     * Delete a product and its image.
     */
    public function destroy(Product $product): RedirectResponse
    {
        if ($product->image) {
            Storage::disk('public')
                ->delete(str_replace('/storage/', '', $product->image));
        }
        $product->delete();

        return redirect()
            ->route('products.index')
            ->with('success', 'Product deleted');
    }
}