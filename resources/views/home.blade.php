@extends('layouts.app')

@section('content')
<div class="">
    <div class="">

        @if(!Auth::guest())
            @if(Auth::user()->role=='admin')
            <div class="panel-group">
                <div class="panel panel-default">
                    <div class="panel-heading" style="background: darkred; color: white; font-weight: bold;">
                        <h4 class="panel-title" id="collapse-title" style="font-weight: bold">
                            <a data-toggle="collapse" href="#collapse1" >Create New Category
                                <span class="pull-right glyphicon glyphicon-plus"></span>
                            </a>
                        </h4>
                    </div>
                    <div id="collapse1" class="panel-collapse collapse">
                        <form method="POST" action="{{ url('admin/new/category') }}">
                            {{ csrf_field() }}
                            <div class="panel-body" style="position: relative;">
                                <label>Forum Category Name:</label>
                                <input type="text" name="category_name" placeholder="title here" style="width: 30%; border-radius: 4px; box-shadow: 0; padding: 5px; box-sizing: border-box;">
                                <input type="submit" class="btn btn-md btn-success pull-right" name="create-category-btn" value="Create">
                            </div>
                        </form>
                        {{-- <div class="panel-footer">Footer</div> --}}
                    </div>
                </div>
            </div>

            <script type="text/javascript">
                $('#create-category-btn').click(function(e)
                {
                    e.preventDefault();
                });

            </script>

            @if(Session::has('message'))
            <div class="alert alert-success alert-dismissable">
                <a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a>
                <span>{{ Session::get('message') }}</span>
            </div>
            @endif

            @endif
        @endif

        @foreach($categories as $category)
        <section class="sections">
            <div class="col-xs-12 no-float border-bottom section-title" style="padding-top: 5px; padding-bottom: 5px; font-weight: bold">
                <span class="section-name">{{ $category->name }}</span>
                @if(!Auth::guest() && Auth::user()->role == 'admin')
                <a data-toggle="modal" data-target="#add-section-modal{{$category->id}}" class="pull-right" title="Create New Section" style="padding-left: 10px; cursor: pointer;"><span class="glyphicon glyphicon-plus"></span></a>
                <a data-toggle="modal" data-target="#edit-category-modal{{$category->id}}" class="pull-right" title="Edit Section Details" style="padding-left: 10px; cursor: pointer;"><span class="glyphicon glyphicon-edit"></span></a>
                <a data-toggle="modal" data-target="#delete-category-modal{{$category->id}}" class="pull-right" title="Remove Section" style="padding-left: 10px; cursor: pointer;"><span class="glyphicon glyphicon-remove"></span></a>

                <!-- Add Section Modal -->
                <div id="add-section-modal{{$category->id}}" class="modal fade" role="dialog">
                    <div class="modal-dialog">

                        <!-- Modal content-->
                        <div class="modal-content" style="color: #636b6f;">
                            <div class="modal-header">
                                <button type="button" class="close" data-dismiss="modal">&times;</button>
                                <h4 class="modal-title">{{ $category->name }}: Create Section</h4>
                            </div>
                            <form method="POST" action="{{ url('admin/new/section/'.$category->id) }}">
                            {{ csrf_field() }}
                                <div class="modal-body">
                                    <div class="form-group">
                                        <label>Section Name:</label>
                                        <input type="text" class="form-control" name="section_name" placeholder="">
                                    </div>
                                    <div class="form-group">
                                        <label>Section Description:</label>
                                        <input type="text" class="form-control" name="section_content">
                                    </div>
                                    <div class="form-group">
                                        <label>Section URL Route:</label>
                                        <input type="text" class="form-control" placeholder="ex. 'math' = www.alab.com/section/math" name="section_route">
                                    </div>
                                    <input type="submit" class="btn btn-success" value="Create">
                                </div>

                                <div class="modal-footer">
                                    <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>
                {{-- End Add Section Modal --}}


                <!-- Edit Category Modal -->
                <div id="edit-category-modal{{$category->id}}" class="modal fade" role="dialog">
                    <div class="modal-dialog">

                        <!-- Modal content-->
                        <div class="modal-content" style="color: #636b6f;">
                            <div class="modal-header">
                                <button type="button" class="close" data-dismiss="modal">&times;</button>
                                <h4 class="modal-title">{{ $category->name }}: Edit Category</h4>
                            </div>
                            <form method="POST" action="{{ url('admin/edit/category/'.$category->id) }}">
                            {{ csrf_field() }}
                                <div class="modal-body">
                                    <div class="form-group">
                                        <label>Category Name:</label>
                                        <input type="text" class="form-control" name="category_name" value="{{$category->name}}">
                                    </div>
                                    <input type="submit" class="btn btn-success" value="Modify">
                                </div>

                                <div class="modal-footer">
                                    <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>
                {{-- End Edit Category Modal --}}

                <!-- Delete Category Modal -->
                <div id="delete-category-modal{{$category->id}}" class="modal fade" role="dialog">
                    <div class="modal-dialog">

                        <!-- Modal content-->
                        <div class="modal-content" style="color: #636b6f;">
                            <div class="modal-header">
                                <button type="button" class="close" data-dismiss="modal">&times;</button>
                                <h4 class="modal-title">{{ $category->name }}: Delete Category</h4>
                            </div>
                            <form method="POST" action="{{ url('admin/delete/category/'.$category->id) }}">
                                {{ csrf_field() }}
                                <div class="modal-body">
                                    <div class="form-group">
                                        <label>Do you want to delete {{$category->name}} category?</label>
                                        <input type="submit" class="btn btn-danger pull-right" value="Delete">
                                    </div>
                                    {{-- <input type="submit" class="btn btn-success" value="Create"> --}}
                                </div>
                                <div class="modal-footer">
                                    <button type="button" class="btn btn-default" data-dismiss="modal">Go Back</button>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>
                {{-- End Delete Category Modal --}}


                @endif
            </div>
            @if($category->id == 2)
                @foreach($subjects as $subject)
                <div class="col-xs-12 no-float border-bottom">
                    <div class="col-xs-5 full-mobile">
                        <span><a href='{{ url("section/".$subject->route) }}'>{{ $subject->name }}</a></span>
                        <span class="block"><small>{{ $subject->content }}</small></span>
                        <span class="indicators"><i class="fa fa-comments-o" aria-hidden="true" title="Messages"></i><small>&nbsp;{{ $post_count[$subject->id] }}</small></span>
                        <span class="indicators"><i class="fa fa-wpforms" aria-hidden="true" title="Discussions"></i><small>&nbsp;{{ $thread_count[$subject->id] }}</small></span>
                        @if(!Auth::guest() && Auth::user()->role == 'admin')
                            <input type="button" data-toggle="modal" data-target="#edit-section-modal{{$subject->id}}" class="btn btn-xs btn-info" value="Edit"  name="" style="color: white">
                            <input type="button" data-toggle="modal" data-target="#delete-section-modal{{$subject->id}}" class="btn btn-xs btn-warning" value="Delete"  name="" style="color: white">

                            <!-- Edit Section Modal -->
                            <div id="edit-section-modal{{$subject->id}}" class="modal fade" role="dialog">
                                <div class="modal-dialog">

                                    <!-- Modal content-->
                                    <div class="modal-content" style="color: #636b6f;">
                                        <div class="modal-header">
                                            <button type="button" class="close" data-dismiss="modal">&times;</button>
                                            <h4 class="modal-title">{{ $subject->name }}: Edit Section</h4>
                                        </div>
                                        <form method="POST" action="{{ url('admin/edit/section/'.$section->id) }}">
                                        {{ csrf_field() }}
                                            <div class="modal-body">
                                                <div class="form-group">
                                                    <label>Section Name:</label>
                                                    <input type="text" class="form-control" name="section_name" value="{{$subject->name}}">
                                                </div>
                                                <div class="form-group">
                                                    <label>Section Description:</label>
                                                    <input type="text" class="form-control" name="section_content" value="{{$subject->content}}">
                                                </div>
                                                <div class="form-group">
                                                    <label>Section URL Route:</label>
                                                    <input type="text" class="form-control" placeholder="ex. 'math' = www.alab.com/section/math" value="{{$subject->route}}" name="section_route">
                                                </div>
                                                <input type="submit" class="btn btn-success" value="Modify">
                                            </div>

                                            <div class="modal-footer">
                                                <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
                                            </div>
                                        </form>
                                    </div>
                                </div>
                            </div>
                            {{-- End Edit Section Modal --}}

                            <!-- Delete Section Modal -->
                            <div id="delete-section-modal{{$subject->id}}" class="modal fade" role="dialog">
                                <div class="modal-dialog">

                                    <!-- Modal content-->
                                    <div class="modal-content" style="color: #636b6f;">
                                        <div class="modal-header">
                                            <button type="button" class="close" data-dismiss="modal">&times;</button>
                                            <h4 class="modal-title">{{ $subject->name }}: Delete section</h4>
                                        </div>
                                        <form method="POST" action="{{ url('admin/delete/section/'.$subject->id) }}">
                                            {{ csrf_field() }}
                                            <div class="modal-body">
                                                <div class="form-group">
                                                    <label>Do you want to delete {{$subject->name}} section?</label>
                                                    <input type="submit" class="btn btn-danger pull-right" value="Delete">
                                                </div>
                                                {{-- <input type="submit" class="btn btn-success" value="Create"> --}}
                                            </div>
                                            <div class="modal-footer">
                                                <button type="button" class="btn btn-default" data-dismiss="modal">Go Back</button>
                                            </div>
                                        </form>
                                    </div>
                                </div>
                            </div>
                            {{-- End Delete Section Modal --}}
                        @endif
                    </div>
                    <div class="text-center col-sm-2 hide-768px">
                        <span>{{ $post_count[$subject->id] }}</span>
                        <span class="block"><small>Messages</small></span>
                    </div>
                    <div class="text-center col-sm-2 hide-768px">
                        <span>{{ $thread_count[$subject->id] }}</span>
                        <span class="block"><small>Discussions</small></span>
                    </div>
                    <div class="col-sm-3 latest">
                        <span>Latest: {{ $latest_thread[$subject->id] }}</span>
                            <span class="block"><small>{{-- {{ User::find()}},  --}}{{  date('M j Y g:i:s A', strtotime($latest_date[$subject->id])) }}</small></span>
                    </div>
                </div>
                @endforeach
            @else
                @foreach($sections as $section)
                    @if($section->category_id == $category->id)
                    <div class="col-xs-12 no-float border-bottom">
                        <div class="col-xs-5 full-mobile">
                            <span><a href='{{ url("section/".$section->route) }}'>{{ $section->name }}</a></span>
                            <span class="block"><small>{{ $section->content }}</small></span>
                            <span class="indicators"><i class="fa fa-comments-o" aria-hidden="true" title="Messages"></i><small>&nbsp;{{ $post_count[$section->id] }}</small></span>
                            <span class="indicators"><i class="fa fa-wpforms" aria-hidden="true" title="Discussions"></i><small>&nbsp;{{ $thread_count[$section->id] }}</small></span>
                            @if(!Auth::guest() && Auth::user()->role == 'admin')
                            <input type="button" data-toggle="modal" data-target="#edit-section-modal{{$section->id}}" class="btn btn-xs btn-info" value="Edit"  name="" style="color: white">
                            <input type="button" data-toggle="modal" data-target="#delete-section-modal{{$section->id}}" class="btn btn-xs btn-warning" value="Delete"  name="" style="color: white">

                            <!-- Edit Section Modal -->
                            <div id="edit-section-modal{{$section->id}}" class="modal fade" role="dialog">
                                <div class="modal-dialog">

                                    <!-- Modal content-->
                                    <div class="modal-content" style="color: #636b6f;">
                                        <div class="modal-header">
                                            <button type="button" class="close" data-dismiss="modal">&times;</button>
                                            <h4 class="modal-title">{{ $section->name }}: Edit Section</h4>
                                        </div>
                                        <form method="POST" action="{{ url('admin/edit/section/'.$section->id) }}">
                                        {{ csrf_field() }}
                                            <div class="modal-body">
                                                <div class="form-group">
                                                    <label>Section Name:</label>
                                                    <input type="text" class="form-control" name="section_name" value="{{$section->name}}">
                                                </div>
                                                <div class="form-group">
                                                    <label>Section Description:</label>
                                                    <input type="text" class="form-control" name="section_content" value="{{$section->content}}">
                                                </div>
                                                <div class="form-group">
                                                    <label>Section URL Route:</label>
                                                    <input type="text" class="form-control" placeholder="ex. 'math' = www.alab.com/section/math" value="{{$section->route}}" name="section_route">
                                                </div>
                                                <input type="submit" class="btn btn-success" value="Modify">
                                            </div>

                                            <div class="modal-footer">
                                                <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
                                            </div>
                                        </form>
                                    </div>
                                </div>
                            </div>
                            {{-- End Edit Section Modal --}}

                            <!-- Delete Section Modal -->
                            <div id="delete-section-modal{{$section->id}}" class="modal fade" role="dialog">
                                <div class="modal-dialog">

                                    <!-- Modal content-->
                                    <div class="modal-content" style="color: #636b6f;">
                                        <div class="modal-header">
                                            <button type="button" class="close" data-dismiss="modal">&times;</button>
                                            <h4 class="modal-title">{{ $section->name }}: Delete section</h4>
                                        </div>
                                        <form method="POST" action="{{ url('admin/delete/section/'.$section->id) }}">
                                            {{ csrf_field() }}
                                            <div class="modal-body">
                                                <div class="form-group">
                                                    <label>Do you want to delete {{$section->name}} section?</label>
                                                    <input type="submit" class="btn btn-danger pull-right" value="Delete">
                                                </div>
                                                {{-- <input type="submit" class="btn btn-success" value="Create"> --}}
                                            </div>
                                            <div class="modal-footer">
                                                <button type="button" class="btn btn-default" data-dismiss="modal">Go Back</button>
                                            </div>
                                        </form>
                                    </div>
                                </div>
                            </div>
                            {{-- End Delete Section Modal --}}
                        @endif
                        </div>
                        <div class="text-center col-sm-2 hide-768px">
                            <span>{{ $post_count[$section->id] }}</span>
                            <span class="block"><small>Messages</small></span>
                        </div>
                        <div class="text-center col-sm-2 hide-768px">
                            <span>{{ $thread_count[$section->id] }}</span>
                            <span class="block"><small>Discussions</small></span>
                        </div>
                        <div class="col-sm-3 latest">
                            <span>Latest: {{ $latest_thread[$section->id] }}</span>
                            <span class="block"><small>{{-- Johndoy,  --}}{{  date('M j Y g:i:s A', strtotime($latest_date[$section->id])) }}</small></span>
                        </div>
                    </div>
                    @endif
                @endforeach
            @endif

        </section>            
        @endforeach



    </div>
</div>
@endsection
