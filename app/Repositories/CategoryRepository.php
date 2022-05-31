<?php

namespace App\Repositories;
use App\Models\Category;
use App\Models\Photo;
use App\Repositories\Interfaces\CrudInterface;

class CategoryRepository implements CrudInterface{
    public function index()
    {
        return response()->json(['categories'=>Category::paginate(10),200]);
    }

    public function store($data)
    {
        //create category depend on requested data
        $category = Category::create([
            'name'=>$data['name'],
            'description'=>$data['description']
        ]);
        // check photos if exists
        if(array_key_exists('photos', $data)){
            foreach ($data['photos'] as  $photo) {
            // looping on the photos and move to public path from temp
                $filename = time() . '_' . $photo->getClientOriginalName();
                $location = 'photos';
                $photo->move($location, $filename);
                $category->photos()->create(['path' => $location . '/' . $filename]);
            }
        }
        // return json response
        return response()->json(['category added successfully with data' => $category->load('photos')], 200);
    }

    public function show($model)
    {
        // return requested category
        return response()->json(['category '=> $model], 200);
    }

    public function update($model, $data)
    {
        //create category depend on requested data
        $model->update([
            'name'=>$data['name'],
            'description'=>$data['description']
        ]);
        // check photos if exists
        if(array_key_exists('photos',$data)){
            // looping on the photos and move to public path from temp
            foreach ($data['photos'] as  $photo) {
                $filename = time() . '_' . $photo->getClientOriginalName();
                $location = 'photos/categories';
                $photo->move($location, $filename);
                $model->photos()->create(['path' => $location . '/' . $filename]);
            }
        }
        // return json response
        return response()->json(['category updated successfully with data'=> $model->load('photos')],200);
    }

    public function destroy($model)
    {
        $model->photos()->delete();
        $model->products()->delete();
        $model->delete();
        return response()->json( ['category deleted successfully'],200);
    }
    public function search($q){
        // search filter
        return Category::Filter($q);

    }

}
