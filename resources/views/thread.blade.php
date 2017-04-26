@extends('layouts.app')

@section('content')



<div>

    @if(Session::has('message'))
        <div class="alert alert-success alert-dismissable">
            <a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a>
            <span>{{ Session::get('message') }}</span>
        </div>
    @endif


    <h3 style="display: inline-block; margin-top: 0;">Title: <small>{{ $thread->content }}</small></h3>
    @if(!Auth::guest() && Auth::user()->id == $thread->author_id)
        {{-- <input type="button" class="btn btn-danger btn-xs pull-right glyphicon glyphicon-trash" style="margin-left: 5px"> --}}
        <button type="button" class="btn btn-danger btn-sm pull-right" style="margin-left: 5px;" data-toggle='modal' data-target="#delete-thread-modal" title="Delete Thread"><span class="glyphicon glyphicon-trash"></span></button>
        <button type="button" class="btn btn-default btn-sm pull-right" style="margin-left: 5px;" data-toggle='modal' data-target="#edit-thread-modal" title="Edit Thread Title"><span class="glyphicon glyphicon-pencil"></span></button>

        <!-- Edit Thread Modal -->
        <div id="edit-thread-modal" class="modal fade" role="dialog">
            <div class="modal-dialog">

                <!-- Modal content-->
                <div class="modal-content" style="color: #636b6f;">
                    <div class="modal-header">
                        <button type="button" class="close" data-dismiss="modal">&times;</button>
                        <h4 class="modal-title">Change Thread Name</h4>
                    </div>
                    <form method="POST" action="{{ url('edit/thread/'.$thread->id) }}">
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
        <div id="delete-thread-modal" class="modal fade" role="dialog">
            <div class="modal-dialog">

                <!-- Modal content-->
                <div class="modal-content" style="color: #636b6f;">
                    <div class="modal-header">
                        <button type="button" class="close" data-dismiss="modal">&times;</button>
                        <h4 class="modal-title">Delete Thread</h4>
                    </div>
                    <form method="POST" action="{{ url('delete/thread/'.$thread->id) }}">
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



<div class="sections" style="margin-bottom: 5px;">
	<?php $count = 1; ?>
    @foreach($posts as $post)
    <div style="position: relative; border-bottom: 1px solid #d3e0e9; overflow: hidden;">
        <div class="col-xs-3 col-sm-2 encircle thread-post" style="border-right:  1px solid #d3e0e9;">
            <div class='circle' style=" background-color: <?php echo $colors[rand(0,count($colors)-1)]; ?>; position: relative;">
                <span style="position: absolute; top: 50%; left: 50%; transform: translate(-50%, -50%); font-weight: bold;">
                    <?php echo strtoupper(substr($post->username, 0, 1)); ?>
                </span>
            </div>
            <span class="block">{{ $post->username }}</span>
            <span><small>{{ date('M j Y g:i:s A', strtotime($post->post_create_date)) }}</small></span>
        </div>
        <div class="col-xs-9 col-sm-10 thread-post" style="">
            <div style="min-height: 50px; width: 100%">
                <?= $post->content; ?>
            </div>
            <div class="show-400px">
                <span style="font-size: 12px"><small>By: {{ $post->username }},</small></span>
                <span style="font-size: 12px"><small>{{ date('M j Y g:i:s A', strtotime($post->post_create_date)) }}</small></span>
            </div>
        </div>
        <div style="position: absolute; bottom: 5px; right: 5px;">
            <span class="pull-right" style="margin-left: 5px;">#{{ $count }}</span>
            @if(!Auth::guest()&&(Auth::user()->role == 'admin' || Auth::user()->id == $post->user_id))
                <button type="button" class="btn btn-danger btn-xs pull-right" style="margin-left: 5px;" title="Delete Post" data-toggle='modal' data-target='#delete-post-modal{{$post->post_id}}'><span class="glyphicon glyphicon-trash"></span></button>
                <form class="pull-right" method="POST" action="{{ url('/edit/post/'.$post->post_id) }}">
                    {{ csrf_field() }}
                    <button type="submit" class="btn btn-default btn-xs" style="margin-left: 5px;" title="Edit Post"><span class="glyphicon glyphicon-pencil"></span></button></a>
                </form>


                <!-- Delete Post Modal -->
                <div id="delete-post-modal{{ $post->post_id }}" class="modal fade" role="dialog">
                    <div class="modal-dialog">

                        <!-- Modal content-->
                        <div class="modal-content" style="color: #636b6f;">
                            <div class="modal-header">
                                <button type="button" class="close" data-dismiss="modal">&times;</button>
                                <h4 class="modal-title">Delete post</h4>
                            </div>
                            <form method="POST" action="{{ url('delete/post/'.$post->post_id) }}">
                                {{ csrf_field() }}
                                <div class="modal-body">
                                    <div class="form-group">
                                        <label>Do you want to delete this post?</label>
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
                {{-- End Delete Post Modal --}}

            @endif

        </div>
    </div>
    <?php $count++; ?>
    @endforeach
</div>

<hr>
<div>
    <form method="POST" action="{{ url('/new/post/'.$thread->id) }}">
        {{ csrf_field() }}
        <textarea id="summernote-thread" name="content">
            
        </textarea>
        <div style="overflow: hidden;">
            <input type="submit" class="btn btn-success btn-md pull-right" value="Send Post">
        </div>
    </form>
</div>

@endsection