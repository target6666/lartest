<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Session;
use App\Article;

class ArticlesController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return view("articles.index");
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view("articles.create");
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //validate
        $this->validate($request, array(
            'name' => 'required|max:127',
            'artno' => 'required|unique:articles|max:31'
        ));

        //store
        $article=new Article;
        $article->name=$request->name;
        $article->artno=$request->artno;
        $article->active=isset($request->active);
        $article->desc1=$request->desc1;
        $article->vol_l=$request->vol_l;
        $article->vol_b=$request->vol_b;
        $article->vol_h=$request->vol_h;
        $article->weight=$request->weight;
        $article->save();

        Session::flash('success', 'Artikel erfolgreich angelegt!');
        
        //redirect
        return redirect()->route('articles.show', $article->id);
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //show benutzt index, und uebergibt $article
        $article = Article::find($id);
        return view('articles.index')->with('article', $article);
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
        $article = Article::find($id);
        return view('articles.edit')->with('article', $article);
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
