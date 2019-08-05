<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Category;
use App\Post;
use App\Tag;
class FrontController extends Controller
{
    public function index(){
      return view('front.index')
      ->with('categories',Category::all())
      ->with('tags',Tag::all())
      ->with('posts',Post::paginate(4))
      ;

    }

    public function show($id){
      $post=Post::findOrfail($id);
      return view('front.post')->with('posts',$post)->with('tag',Tag::all());

    }
}
