<?php

namespace App\Http\Controllers;

use App\Http\Requests\TagRequest;
use App\Models\Post;
use App\Models\Tag;
use Exception;

class TagController extends Controller
{
    public readonly Tag $tag;

    public string $post_id;

    public $tags;

    public function __construct()
    {
       $this -> tag = new Tag();
       $this->tags = $this -> tag -> all();
    }

    /**
     * Display a listing of the resource.
     */
    public function index(string $id)
    {   
        try{
            $this -> post_id = "";
            $this->tags = $this -> tag -> all();
            $this->post_id = $id;

            return view('tags.index',['tags'=>$this->tags],['post'=>$this->post_id]);
        }
        catch(Exception $exception){
            return redirect()->route('posts.index')->withErrors(['error' => $exception->getMessage()]);;
        }  
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create(string $post_id)
    {
        try{
            return view('tags.create',['post'=>$post_id]);
        }
        catch(Exception $exception){
            return redirect()->route('tags.index',['tags'=>$this->tags,'post'=> $post_id])->withErrors(['error' => $exception->getMessage()]);
        }

    }

    /**
     * Validate and store a newly created resource in storage.
     */
    public function store(TagRequest $request, string $post_id)
    {
        try{
            $request->validated();

            $this->tag->name = $request->name;
    
            $this->tag->save();
    
            return redirect()->route('tags.index',['tags'=>$this->tags,'post'=> $post_id])->with('success','Tag edited successfull');
    
        }
        catch(Exception $exception){
            return redirect()->route('tags.index',['tags'=>$this->tags,'post'=> $post_id])->withErrors(['error' => $exception->getMessage()]);
        }
   }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id, string $post_id)
    {
        try{
            $tag = Tag::find($id);

            return view('tags.edit',['tag'=>$tag,'post'=>$post_id]);
        }
        catch(Exception $exception){
            return redirect()->route('tags.index',['tags'=>$this->tags,'post'=> $post_id])->withErrors(['error' => $exception->getMessage()]);
        }
    }

    /**
     * Validate and update the specified resource in storage.
     */
    public function update(TagRequest $request, Tag $tag,string $post_id)
    {   
        try{
            $request->validated();

            $tag->update([
                'name' => $request->name,
            ]);
            return redirect()->route('tags.index',['tags'=>$this->tags,'post'=> $post_id])->with('success','Tag edited successfull');

        }
        catch(Exception $exception){
            return redirect()->route('tags.edit',['tag'=>$tag,'post'=> $post_id])->withErrors(['error' => $exception->getMessage()]);
        }
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id, string $post_id)
    {
        try{
            $tag = Tag::find($id);
        
            $tag->posts()->detach();
    
            $tag->delete();
    
            return redirect()->route('tags.index',['tags'=>$this->tags,'post'=> $post_id]);
        }
        catch(Exception $exception){
            return redirect()->route('tags.index',['tags'=>$this->tags,'post'=> $post_id])->withErrors(['error' => $exception->getMessage()]);
        }

    }

    /**
     * Method that assigns a relationship between entities
     */
    public function joinPost(string $tagId, string $post_id)
    {
        try{
            $post = Post::find($post_id);
            $post->tags()->attach($tagId);
            
            return redirect()->route('posts.index',['post'=>$post_id])->with('success','Tag linked successfull');    
    
        }
        catch(Exception $exception){
            return redirect()->route('tags.index',['tags'=>$this->tags,'post'=> $post_id])->withErrors(['error' => $exception->getMessage()]);
        }
    }

    /**
     * Method that remove a relationship between entities
     */
    public function destroyJoinPost(string $tagId, string $post_id)
    {   
        try{
            $post = Post::find($post_id);
            $post->tags()->detach($tagId);
    
            return redirect()->route('posts.index',['post'=>$post_id])->with('success','Tag linked successfull');        
    
        }
        catch(Exception $exception){
            return redirect()->route('tags.index',['tags'=>$this->tags,'post'=> $post_id])->withErrors(['error' => $exception->getMessage()]);
        }
    }
}
