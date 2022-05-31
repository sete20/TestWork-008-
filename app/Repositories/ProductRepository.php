<?php
namespace App\Repositories;

use App\Models\Product;
use App\Repositories\Interfaces\CrudInterface;

class ProductRepository implements CrudInterface{
    public function index()
    {
        return response()->json(['products' => Product::paginate(10), 200]);
    }

    public function store($data)
    {
        //create product depend on requested data
        $product = Product::create([
            'name' => $data['name'],
            'details' => $data['details'],
            'price' => $data['price'],
            'quantity' => $data['quantity']
        ]);
        // assign categories to products
        if (array_key_exists('categories_id', $data)) {
            $product->categories()->attach($data['categories_id']);
        }
        // check photos if exists
        if (array_key_exists('photos', $data)) {
            foreach ($data['photos'] as  $photo) {
                // looping on the photos and move to public path from temp
                $filename = time() . '_' . $photo->getClientOriginalName();
                $location = 'photos/products';
                $photo->move($location, $filename);
                $product->photos()->create(['path' => $location . '/' . $filename,

            ]);
            }
        }
        // return json response
        return response()->json(['product added successfully with data' => $product->load(['photos','categories'])], 200);
    }

    public function show($model)
    {
        // return requested product
        return response()->json(['product ' => $model], 200);
    }

    public function update($model, $data)
    {
        //create product depend on requested data
        $model->update([
            'name' => $data['name'],
            'details' => $data['details'],
            'price' => $data['price'],
            'quantity' => $data['quantity']
        ]);
        // assign categories to products
        if (array_key_exists('categories_id', $data)){
            $model->categories()->attach($data['categories_id']);
        }
        // check photos if exists
        if (array_key_exists('photos', $data)) {
            // looping on the photos and move to public path from temp
            foreach ($data['photos'] as  $photo) {
                $filename = time() . '_' . $photo->getClientOriginalName();
                $location = 'photos/products';
                $photo->move($location, $filename);
                $model->photos()->create(['path' => $location . '/' . $filename]);
            }
        }
        // return json response
        return response()->json(['product updated successfully with data' => $model->load(['photos', 'categories'])], 200);
    }

    public function destroy($model)
    {
        $model->photos()->delete();
        $model->delete();
        return response()->json(['product deleted successfully'], 200);
    }
    public function search($q)
    {
        // search filter
       return Product::Filter($q);
    }
}


