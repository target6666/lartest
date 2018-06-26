<?php

namespace App\Http\Controllers\Api;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Category;
use App\Http\Resources\CategoryResource;

class CategoriesApiController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $categories=Category::select('id', 'name', 'parent_id')
            ->where('parent_id', 0)
            ->with(['children' => function($query){
                $query->select('id', 'name', 'parent_id');
                }])
            ->get();
        return new CategoryResource($categories);
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $category=Category::select('id', 'name', 'parent_id', 'artno_min', 'artno_max')
            ->where('id', $id)
            ->with(['parent' => function($query){
                $query->select('id', 'name', 'parent_id', 'artno_min', 'artno_max');
            }])
            ->get();
        return new CategoryResource($category);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        // $request->validate([
        //         'name' => 'required|string|unique:categories|max:255',
        //         'artno_min' => 'numeric',
        //         'artno_max' => 'numeric'
        //     ]);
        return response()->json(['error'=>'foobar'],202);
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
        $request->validate([
            'name' => 'required|string|unique:categories,name,'.$id.'|max:255',    //unique name, except id=$id
            'artno_min' => 'nullable|numeric',
            'artno_max' => 'nullable|numeric'
        ]);

        $data=$request->json()->all();
        $category=Category::findOrFail($id);
       
        $category->name = $data['name'];
        $category->artno_min = $data['artno_min'];
        $category->artno_max = $data['artno_max'];

        if ($category->save()){
            return new CategoryResource($category);
        }
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }
}
