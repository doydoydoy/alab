<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Post;
use App\Section;
use App\Thread;
use Auth;
use Session;


class PostsController extends Controller
{
    public function create($id, Request $request)
    {
    	$post = new Post();
    	$post->content = $request->content;
    	$post->author_id = Auth::user()->id;
    	$post->thread_id = $id;
    	$post->save();

    	return redirect('/thread/'.$id);
    }

    public function showEdit($post_id)
    {
    	$post = Post::find($post_id);
    	$thread = Thread::find($post->thread_id);
    	$section = Section::find($thread->section_id);

    	$crumbs = 
    	[
    		"Forums" => "",
    		$section->name => "section/".$section->route,
    		$thread->content => "thread/".$thread->id,
    		"Edit Post" => "edit",
    	];
    	return view('edit', compact('post', 'crumbs'));
    }

    public function edit($post_id, Request $request)
    {
    	$post = Post::find($post_id);
    	$thread_id = $post->thread_id;
    	$post->content = $request->post_edit;
    	$post->save();

    	Session::flash('message', 'Successfully Edited Post');
    	return redirect('thread/'.$thread_id);
    }

    public function delete($post_id)
    {
    	$post = Post::find($post_id);
    	$thread = Thread::find($post->thread_id);
    	$post->delete();


    	Session::flash('message', 'Successfully Removed Post');
    	return redirect('thread/'.$thread->id);
    }
}
