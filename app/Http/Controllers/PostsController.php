<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Requests\Posts\CreatePostsRequest;
use App\Http\Requests\Posts\UpdatePostRequest;

use App\Models\Post;
use App\Models\Tag;
use App\Models\Category;


class PostsController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $post = Post::all();
        return view('posts.index',compact('post'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('posts.create')->with('categories',Category::all())->with('tags',Tag::all());
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(CreatePostsRequest $request)
    {

        $image =  $request->image->store('posts');

        $post = Post::create([
       'title'=>$request->title,
       'description'=>$request->description,
       'content'=>$request->content,
       'image'=>$image,
       'published_at'=>$request->published_at,
        'category_id'=>$request->category
        ]);

        if($request->tags)
        {

           $post->tags()->attach($request->tags);
        }

        session()->flash('success','Post created successfully');
        return redirect('/posts');


    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show()
    {
        return view('blog.show');
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit(Post $post)
    {
        return view('posts.create')->with('post',$post)->with('tags',Tag::all())->with('categories',Category::all());
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(UpdatePostRequest $request, Post $post)
    {
        $data = $request->all();
        if($request->hasFile('image'))
        {
        $image = $request->image->store('posts');


        $post->deleteImage();
        $data['image'] = $image;
        if($request->tags)
        {

            $post->tags()->sync($request->tags);
        }
        }
            $post->update($data);
            session()->flash('success','Post successfully updated');
            return redirect('/posts');

    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {


        $post= Post::withTrashed()->where('id',$id)->firstOrFail();
        if($post->trashed())
        $post->forceDelete();
        else
        $post->delete();


        session()->flash('success','Post successfully deleted');

        return redirect('/posts');
    }

    public function trashed(){

   $trashed = Post::onlyTrashed()->get();
   return view('posts.index')->with('post',$trashed);

    }

    public function restore($id)
    {
        $post= Post::withTrashed()->where('id',$id)->first();
        $post->restore();
        session()->flash('success','Post restored successfully');

        return redirect()->back();

    }

}
