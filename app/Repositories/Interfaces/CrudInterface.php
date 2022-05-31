<?php
namespace App\Repositories\Interfaces;

use App\Http\Requests\Api\CategoryRequest;
use App\Models\Category;

interface CrudInterface
{
public function search($data);
public function index();

public function store($data);

public function show($model);

public function update($model, $data);

public function destroy($model);
}
