@extends('layouts.app')

@section('content')



<div>
    <h3>Title: <small>{{ $thread->content }}</small></h3>
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
        <span style="position: absolute; bottom: 5px; right: 5px;"><small>#{{ $count }}</small></span>
    </div>
    <?php $count++; ?>
    @endforeach
</div>

@endsection