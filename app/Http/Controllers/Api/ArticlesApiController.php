<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Article;
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
        $query="";
        if(count($filterList)>0){
            //artikel filtern
            for ($i=0; isset($filterList[$i]); $i++){
                if ($i>0) $query=$query . " AND ";
                $query=$query . "(name LIKE '%".$filterList[$i]."%' OR artno LIKE '%".$filterList[$i]."%')";
            }

            // Warengruppen filtern

            
            $articles=Article::with('category.parent.parent.parent.parent.parent.parent')->whereRaw($query)->orderBy($sort, 'asc')->paginate($limit);
        }
        else{
            //eager loading (recursion possible?)
            $articles=Article::with('category.parent.parent.parent.parent.parent.parent')->orderBy($sort, 'asc')->paginate($limit);
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
     * Show the form for creating a new resource.
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
        //
    }
}
