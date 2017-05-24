<?php

namespace App\Http\Controllers;

use App\Http\Requests\CategoryReq;
use Illuminate\Http\Request;
use App\Category;
use Exception;
use Response;

class CategoriesController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $categories = Category::all();
        $response = $this->createCollectionCategoryResponse($categories);
        return response($response)->setStatusCode(200);
    }

    /**
     * Show the form for creating a new resopurce.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(CategoryReq $request)
    {
        try {
            $category = Category::create($request->all());
            $response = $this->createItemCategoryResponse($category);
            return response($response)->setStatusCode(201);
        } catch (Exception $e) {
            $response = $this->createErrorResponse(['message' => 'la categoria con el nombre '.$request['name'].' ya existe']);
            return response($response)->setStatusCode(400);
        }
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        try {
            $category = Category::findOrFail($id);
            $category->delete();
            $response = $this->createItemcategoryResponse($category);
            return response($response)->setStatusCode(200);
        } catch (Exception $e) {
            $response = $this->createErrorResponse(['message' => 'la categoria con el id: '.$id.' no existe']);
            return response($response)->setStatusCode(404);
        }
    }
}
