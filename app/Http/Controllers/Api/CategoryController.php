<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Http\Requests\Api\CategoryRequest;
use App\Models\Category;
use App\Repositories\CategoryRepository;
use Illuminate\Http\Request;

class CategoryController extends Controller
{
    private $CategoryRepository;
    public function __construct(CategoryRepository $CategoryRepository){

        $this->CategoryRepository = $CategoryRepository;
    }

    public function index()
    {
    // get paginated data from category repository
    $categories = $this->CategoryRepository->index();
    return response()->json(['categories'=> $categories],200);
    }

    public function store(CategoryRequest $r)
    {
        //  call store method in repository file
       $category = $this->CategoryRepository->store($r->all());
       return $category;
    }

    public function show(Category $category)
    {
        //  call show method in repository file
        $category = $this->CategoryRepository->show($category);
        return $category;
    }


    public function update(Category $category, CategoryRequest $r)
    {
        //  call store method in repository file
        $category = $this->CategoryRepository->update($category,$r->all());
        return $category;
    }


    public function destroy(Category $category)
    {
        $category = $this->CategoryRepository->destroy($category);
        return $category;
    }
    public function search(Request $r){
        // search between the products
        return response()->json(['data'=>$this->CategoryRepository->search($r->q),200]);
    }
}
