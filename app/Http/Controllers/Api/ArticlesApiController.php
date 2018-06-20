<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Article;
use App\Category;
use App\Http\Resources\ArticleResource;

class ArticlesApiController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        
        //get paramaters
        $limit=request('limit',15);
        $sort=request('sort', 'id');
        $filterList= [];

        for ($i=0; request('filter'.$i); $i++){
            $filterList[]=request('filter'.$i);
        }

        //validate parameters

        //generate querystring
        if(count($filterList)>0){
            $query="";

            for ($i=0; isset($filterList[$i]); $i++){
                //artikel filtern
                if ($i>0) $query=$query . " AND ";
                $query=$query . "(name LIKE '%".$filterList[$i]."%' OR artno LIKE '%".$filterList[$i]."%')";
            }
            $articles=Article::select('id', 'artno', 'name', 'category_id')
                ->whereRaw($query)
                ->with(['category' => function($query){
                    $query->select('id', 'name', 'parent_id')
                        ->with(['parent' => function($query){
                            $query->select('id', 'name', 'parent_id');
                        }]);
                }])
                ->orderBy($sort, 'asc')
                ->paginate($limit);
        }
        else{
            $articles=Article::select('id', 'artno', 'name', 'category_id')
                ->with(['category' => function($query){
                    $query->select('id', 'name', 'parent_id')
                        ->with(['parent' => function($query){
                            $query->select('id', 'name', 'parent_id');
                        }]);
                    }])
                ->orderBy($sort, 'asc')
                ->paginate($limit);
        }
        


        // adding parameter to paginationlinks
        $articles->appends([
            'limit'=>$limit,
            'sort'=>$sort
            ])->links();

        
        //return collection of articles as a resource
        return ArticleResource::collection($articles)->additional(['meta' => [
            'sort' =>$sort
            ]]);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //
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
        //
    }
}
