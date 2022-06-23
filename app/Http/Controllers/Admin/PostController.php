<?php

namespace App\Http\Controllers\Admin;

use App\Models\Post;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Http\Requests\PostRequest;
use Illuminate\Support\Str;

class PostController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {   
        /* $posts= Post::all(); */
        $posts = Post::orderByDesc('id')->get();
       /*  dd($posts); */
        return view ('admin.posts.index', compact('posts'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('admin.posts.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  App\Http\Requests\PostRequest $request
     * @return \Illuminate\Http\Response
     */
    public function store(PostRequest $request)
    {
        /* dd($request->all()); */

        //validiamo i dati
        $val_data = $request->validated();

        //Generiamo lo slug
        $slug = Str::slug($request->title,'-');
        /* dd($slug); */
        $val_data['slug'] = $slug;

        //Creiamo la risorsa (resource)
        Post::create($val_data);

        //rindirizziamo alla rotta get (get route)
        return redirect()->route('admin.posts.index')->with('message', 'Post creato con successo');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Post  $post
     * @return \Illuminate\Http\Response
     */
    public function show(Post $post)
    {
        return view('admin.posts.show', compact('post'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Post  $post
     * @return \Illuminate\Http\Response
     */
    public function edit(Post $post)
    {
        return view('admin.posts.edit', compact('post'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  App\Http\Requests\PostRequest  $request
     * @param  \App\Models\Post  $post
     * @return \Illuminate\Http\Response
     */
    public function update(PostRequest $request, Post $post)
    {
        /* dd($request->all()); */

        //validazione dati
        $val_data=$request->validated();
        /* dd($val_data);  */

        //generazione dello slug

        $slug = Str::slug($request->title,'-');
        /* dd($slug); */
        $val_data['slug'] = $slug;
    

        //aggiornamento della risorsa
       
        $post->update($val_data);

        // reindirizzamento alla rotta di tipo get
        return redirect()->route('admin.posts.index')->with('message', '$post->title aggiornato con successo');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Post  $post
     * @return \Illuminate\Http\Response
     */
    public function destroy(Post $post)
    {
        $post->delete();
        return redirect()->route('admin.posts.index')->with('message', '$post->title rimosso con successo');
    }
}
