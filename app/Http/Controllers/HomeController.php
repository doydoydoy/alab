<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Category;
use App\Section;
use App\Thread;
use App\Post;
use Session;

class HomeController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        // $this->middleware('auth'); // 
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $categories = Category::all();
        $sections = Section::all();
        $subjects = Section::where('category_id', '=', '2')->orderby('name', 'asc')->get();
        $threads = Thread::all();
        $posts = Post::all();
        $thread_count = [];

        // $crumbs = ['name', route];
        $crumbs = ['Forums' => ''];

        foreach($sections as $section)
        {
            $tcount = 0;
            $pcount = 0;
            foreach($threads as $thread)
            {
                if($thread->section_id == $section->id)
                {
                    $tcount++;
                    foreach ($posts as $post) 
                    {
                        if($post->thread_id == $thread->id)
                        {
                            $pcount++;
                        }
                    }
                }

            }
            $thread_count[$section->id] = $tcount;
            $post_count[$section->id] = $pcount;
        }

        return view('home', compact('categories', 'subjects', 'sections', 'thread_count', 'post_count', 'crumbs'));
    }
}
