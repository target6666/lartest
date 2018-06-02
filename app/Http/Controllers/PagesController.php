<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class PagesController extends Controller
{
    public function index(){
        return view('pages.index');
    }

    public function customers(){
        return view('pages.customers');
    }

    public function articles(){
        return view('pages.articles');
    }

    public function orders(){
        return view('pages.orders');
    }

    public function purchase(){
        return view('pages.purchase');
    }

}
