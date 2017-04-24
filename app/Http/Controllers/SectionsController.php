<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\DB;
use Illuminate\Http\Request;
use App\Section;
use App\Post;
use App\Thread;
use Session;

class SectionsController extends Controller
{
    public function index($section, Request $request)
    {
        /*
        * Pagination setup segment
        */
    	// $page = 1;
    	// if(isset($_GET['page']))
    	// {
    	// 	$page = $_GET['page'];
    	// }

        $curr_section = Section::where("route", $section)->get();
        // $currSection[0]->name;

        $threads = Thread::where("section_id", $curr_section[0]->id)
                        ->join('users', 'threads.author_id', '=', 'users.id')
                        ->select(DB::raw('*, threads.id as thread_id, threads.updated_at as thread_update_date, threads.created_at as thread_create_date'))
                        ->orderby('threads.updated_at', 'desc')
                        ->get();

        $posts = Post::all();

        $crumbs = 
        [
            'Forums'=>'',
            $curr_section[0]->name => 'section/'.$curr_section[0]->route,
        ];

        $post_count = [];
        foreach ($threads as $thread)
        {
            $p_count = 0;
            foreach ($posts as $post) 
            {
                if($post->thread_id == $thread->thread_id)
                {
                    ++$p_count;
                }
            }
            $post_count[$thread->thread_id] = $p_count;
        }

    	return view('section', compact('threads', 'curr_section', 'post_count', 'crumbs'));
    }

    public function create($category_id, Request $request)
    {
        $section = new Section();
        $section->name = $request->section_name;
        $section->route = $request->section_route;
        $section->content = $request->section_content;
        $section->category_id = $category_id;
        $section->save();

        Session::flash('message', 'Successfully Added Section');
        return redirect('/');
    }

    public function edit($section_id, Request $request)
    {
        $section = Section::find($section_id);
        $section->name = $request->section_name;
        $section->content = $request->section_content;
        $section->route = $request->section_route;
        $section->save();

        // echo $section_id;

        Session::flash('message', 'Successfully Edited Section');
        return redirect('/');
    }

    public function delete($section_id, Request $request)
    {
        Section::destroy($section_id);

        Session::flash('message', 'Successfully Removed Section');
        return redirect('/');   
    }
}
