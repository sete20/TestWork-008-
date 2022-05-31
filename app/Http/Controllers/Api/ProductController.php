<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Http\Requests\Api\ProductRequest;
use App\Models\Product;
use App\Repositories\ProductRepository;
use Illuminate\Http\Request;

class ProductController extends Controller
{
    private $ProductRepository;
    public function __construct(ProductRepository $ProductRepository)
    {
        $this->ProductRepository = $ProductRepository;
    }

    public function index()
    {
        // get paginated data from product repository
        $products = $this->ProductRepository->index();
        return response()->json(['products' => $products], 200);
    }

    public function store(ProductRequest $r)
    {
        //  call store method in repository file
        $product = $this->ProductRepository->store($r->all());
        return $product;
    }

    public function show(Product $product)
    {
        //  call show method in repository file
        $product = $this->ProductRepository->show($product);
        return $product;
    }


    public function update(Product $product, ProductRequest $r)
    {
        //  call store method in repository file
        $product = $this->ProductRepository->update($product, $r->all());
        return $product;
    }


    public function destroy(product $product)
    {
        // delete product and photos
        $product = $this->ProductRepository->destroy($product);
        return $product;
    }
    public function search(Request $r){
        // search between the products
        return response()->json(['results'=>$this->ProductRepository->search($r->q)],200);
    }
}
