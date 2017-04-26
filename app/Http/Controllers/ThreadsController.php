<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\Auth;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use App\Post;
use App\Thread;
use App\Section;
use Carbon\Carbon;
use Session;

class ThreadsController extends Controller
{
    public function index($id, Request $request)
    {

    	$thread = Thread::find($id);
    	$posts = Post::where('thread_id', $id)
    				->join('users', 'posts.author_id', '=', 'users.id')
                    ->select(DB::raw('*, users.id as user_id, posts.id as post_id, posts.created_at as post_create_date, posts.updated_at as post_update_date'))
                    ->orderby('posts.created_at', 'asc')
                    ->get();
        $colors = ['red', 'lightblue', 'lightpink', 'gold', 'yellowgreen', 'orange', 'skyblue', 'violet'];


        $section = Section::find($thread->section_id);

        $crumbs = 
        [
        	"Forums" => "",
        	$section->name => 'section/'.$section->route,
        	"Thread: ".$thread->content => $thread->id,
        ];

        // echo $section->route;

        // foreach ($posts as $post) 
        // {
        // 	print_r($post);
        // 	echo "<hr>";
        // }

    	return view('thread', compact('posts', 'colors', 'thread', 'crumbs'));
    }

    public function create($section_route, Request $request)
    {

    	$section = Section::where('route', $section_route)->get();
    	$curr_date = Carbon::now();

		$thread_id = DB::table('threads')->insertGetId(
			[
				"content" => $request->thread_name,
				"author_id" => Auth::user()->id,
				"section_id" => $section[0]->id,
				"created_at" => $curr_date,
				"updated_at" => $curr_date, 
			]);

		DB::table('posts')->insert(
	        [
	            'content' => $request->post_content,
	        	'author_id' => Auth::user()->id,
	        	'thread_id' => $thread_id,
				"created_at" => $curr_date,
				"updated_at" => $curr_date, 
	        ]);

    	return redirect('/thread/'.$thread_id);
    }

    public function edit($id, Request $request)
    {
    	$thread = Thread::find($id);
    	$thread->content = $request->thread_title;
    	$thread->save();

    	Session::flash('message', 'Successfully Edited Thread');
    	return redirect('/thread/'.$id);
   }

    public function delete($id, Request $request)
    {
    	$thread = Thread::find($id);
    	$section = $thread->section_id;
    	$section = Section::find($section);
    	
    	Thread::destroy($id);

    	Session::flash('message', 'Successfully Removed Thread');
    	return redirect('/section/'.$section->route);	
    }


}
