<?php

namespace App\Http\Controllers;

use App\Post;
use App\Category;
use App\Tag;
use Illuminate\Http\Request;
class PostController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $posts=Post::paginate(4);
        $trashed=Post::onlyTrashed()->get();
        return view('post.index',compact('posts','trashed'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('post.create')->with('categories',Category::all())->with('tags',Tag::all());
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
      $this->validate($request,[
        'title'=>'required',
        'description'=>'required',
        'content'=>'required',
        'image'=>'required',
        'published_at'=>'required',
        'category'=>'required'
      ]);
    $image = $request->file('image')->store('images');
    $post=Post::create([
      'title'=>$request->title,
      'description'=>$request->description,
      'content'=>$request->content,
      'published_at'=>$request->published_at,
      'image'=>$image,
      'category_id'=>$request->category
    ]);
    if($request->tags){
      $post->tags()->attach($request->tags);
    }
    return redirect(route('post.index'))->with('status', 'Post created !');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Post  $post
     * @return \Illuminate\Http\Response
     */
    public function show(Post $post)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Post  $post
     * @return \Illuminate\Http\Response
     */
    public function edit(Post $post)
    {

        return view('post.edit')->with('posts',$post)->with('categories',Category::all())->with('tags',Tag::all());
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Post  $post
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Post $post)
    {
      $this->validate($request,[
        'title'=>'required',
        'description'=>'required',
        'content'=>'required',
        'published_at'=>'required'
      ]);

        $data=$request->only(['title','content','description','published_at']);
        //check if new images
        if($request->hasFile('image')){
          //upload it
          $image=$request->image->store('images');
          //delete the old images
          $post->deleteImage();

          $data['image']=$image;

        }

        if($request->tags){
          $post->tags()->sync($request->tags);
        }
        //upload attribute
          $post->update($data);
          return redirect(route('post.index'))->with('status', 'Post updated successfully !');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Post  $post
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $post=Post::withTrashed()->where('id',$id)->firstOrFail();
        if($post->trashed()){
          $post->forceDelete();
          $post->deleteImage();
          return redirect(route('post.index'))->with('status', 'Post deleted successfully !');
        }else{
          $post->delete();
          return redirect(route('post.index'))->with('status', 'Post has been trashed !');
        }

    }

    public function trashed(){
    $posts = Post::onlyTrashed()->get();
    return view('post.trashed',compact('posts'));
    }


    public function restore($id){
      Post::withTrashed()->where('id',$id)->restore();
      return redirect(route('post.index'))->with('status', 'Post has been restored !');
    }
}
