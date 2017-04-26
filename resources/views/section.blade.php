@extends('layouts.app')

@section('content')


<div class="text-center" style="margin-top: 20px; margin-bottom: 20px;">
	<h3>{{$curr_section[0]->name}}</h3>
</div>

@if(Session::has('message'))
    <div class="alert alert-success alert-dismissable">
        <a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a>
        <span>{{ Session::get('message') }}</span>
    </div>
@endif


@if(!Auth::guest())
<div style="position: relative; height: 30px; padding-right: 15px; margin-bottom: 10px;">
    <!-- Trigger the modal with a button -->
    <button type="button" class="btn btn-danger btn-sm pull-right" data-toggle="modal" data-target="#myModal" style="background: orange; border: 1px solid rgba(234, 155, 9, 0.952941);">Create New Thread&nbsp;&nbsp;<span class="glyphicon glyphicon-plus"></span></button>
</div>

<!-- Modal -->
<div id="myModal" class="modal fade" role="dialog">
    <div class="modal-dialog modal-lg">
        <!-- Modal content-->
        <div class="modal-content">
        <form method="POST" action="{{ url('new/thread/'.$curr_section[0]->route) }}">
            {{ csrf_field() }}
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal">&times;</button>
                <h4 class="modal-title"><span name="section_name">{{$curr_section[0]->name}}</span>: Make A New Thread</h4>
            </div>
            <div class="modal-body">
                <input type="text" name="thread_name" value="" placeholder="New Thread" class="form-control" style="resize: none;"><br>
                <textarea id="summernote" name="post_content"></textarea>
                <input type="submit" value="Submit" class="btn btn-sm btn-info form-control">
                <input type="hidden" name="section_name" value="">
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
            </div>
        </form>
        </div>
    </div>
</div>
@endif




@foreach($threads as $thread)
<div class="sections" style="margin-bottom: 5px;">
	<div class="border-bottom">
		<div class="col-xs-7 full-mobile">
            <span class="thread-sub">Title:&nbsp;<strong><a href='{{ url("thread/".$thread->thread_id) }}' title="{{ url("thread/".$thread->thread_id) }}">{{ $thread->content }}</a></strong></span>
            <span class="block"><small>Author:&nbsp;{{ $thread->username }}</small></span>
            <span class="indicators"><i class="fa fa-comments-o" aria-hidden="true" title="Messages"></i><small>&nbsp;3&nbsp;</small></span>
            <span class="indicators-2">
                <span class="glyphicon glyphicon-pushpin" title="Creation Date">
                    <span style="font-size: 80%"> {{ date('M j Y g:i:s A', strtotime($thread->thread_update_date)) }}</span>
                </span>
            </span>
            @if(!Auth::guest() && Auth::user()->role == 'admin')
                <input type="button" class="btn btn-xs btn-info" name="" value="Edit" data-toggle="modal" data-target="#edit-thread-modal{{ $thread->thread_id }}">
                <input type="button" class="btn btn-xs btn-warning" name="" value="Delete" data-toggle="modal" data-target="#delete-thread-modal{{ $thread->thread_id }}">

                <!-- Edit Thread Modal -->
                <div id="edit-thread-modal{{ $thread->thread_id }}" class="modal fade" role="dialog">
                    <div class="modal-dialog">

                        <!-- Modal content-->
                        <div class="modal-content" style="color: #636b6f;">
                            <div class="modal-header">
                                <button type="button" class="close" data-dismiss="modal">&times;</button>
                                <h4 class="modal-title">Change Thread Name</h4>
                            </div>
                            <form method="POST" action="{{ url('edit/thread/'.$thread->thread_id) }}">
                            {{ csrf_field() }}
                                <div class="modal-body">
                                    <div class="form-group">
                                        <label>Thread Name:</label>
                                        <input type="text" class="form-control" name="thread_title" value="{{$thread->content}}">
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
                {{-- End Edit Thread Modal --}}

                <!-- Delete Thread Modal -->
                <div id="delete-thread-modal{{ $thread->thread_id }}" class="modal fade" role="dialog">
                    <div class="modal-dialog">

                        <!-- Modal content-->
                        <div class="modal-content" style="color: #636b6f;">
                            <div class="modal-header">
                                <button type="button" class="close" data-dismiss="modal">&times;</button>
                                <h4 class="modal-title">Delete Thread</h4>
                            </div>
                            <form method="POST" action="{{ url('delete/thread/'.$thread->thread_id) }}">
                                {{ csrf_field() }}
                                <div class="modal-body">
                                    <div class="form-group">
                                        <label>Do you want to delete {{$thread->name}} thread?</label>
                                        <input type="submit" class="btn btn-danger pull-right" value="Delete">
                                    </div>
                                </div>
                                <div class="modal-footer">
                                    <button type="button" class="btn btn-default" data-dismiss="modal">Go Back</button>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>
                {{-- End Delete Thread Modal --}}
            @endif
        </div>
        <div class="text-center col-sm-2 hide-768px">
            <span>{{ $post_count[$thread->thread_id] }}</span>
            <span class="block"><small>Messages</small></span>
        </div>
        <div class="col-sm-3 latest">
            <span style="font-size: 100%;">Last Post: <small>{{ date('M j Y g:i:s A', strtotime($thread->thread_update_date)) }}</small></span>
            <span class="block" style="font-size: 90%;">Created: <small>{{ date('M j Y g:i:s A', strtotime($thread->thread_create_date)) }}</small></span>
        </div>
	</div>
</div>
@endforeach

@endsection