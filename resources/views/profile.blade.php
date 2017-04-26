@extends('layouts.app')

@section('content')

<div class="row">
	<div class="col-md-3 text-center">
		<img src="https://processing.org/tutorials/pixels/imgs/tint1.jpg" width="200px" height="200px">
		<div>
			<h4>{{$username}}</h4>
		</div>
		<div>
			@if(Auth::user()->username == $username)
			<div class="profile-menu" style=""><a href="">Inbox</a></div>
			@else
			<div class="profile-menu"><a href="{{ url('/message/'.$username) }}">Message {{$username}}</a></div>
			@endif
			<div class="profile-menu"><a href="">Friends</a></div>	
		</div>
		
	</div>
	<div class="col-md-9">
		@if(Auth::user()->username == $username)
		<textarea id="summernote-post"></textarea>
		<div style="overflow: hidden;">
			<input type="submit" class="btn btn-md btn-success pull-right" value="Make Post" name="">
		</div>
		<hr>
		@endif

	</div>
</div>

@endsection