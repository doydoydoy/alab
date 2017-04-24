<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Category;
use Carbon\Carbon;
use Session;


class CategoriesController extends Controller
{
    public function create(Request $request)
    {
    	$category = new Category();
    	$category->name = $request->category_name;
    	$category->save();
    	Session::flash('message', 'Successfully Created Category');

    	return redirect('/');
    }

    public function edit($category_id, Request $request)
    {
    	$category = Category::find($category_id);
    	$category->name = $request->category_name;
    	$category->save();
    	Session::flash('message', 'Successfully Edited Category');

    	return redirect('/');
    }

    public function delete($category_id, Request $request)
    {
    	Category::destroy($category_id);
    	Session::flash('message', 'Successfully Removed Category');

    	return redirect('/');
    }
}
