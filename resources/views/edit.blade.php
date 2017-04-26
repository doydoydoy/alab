@extends('layouts.app')

@section('content')

<div>
	<h3>Edit Post</h3>

	<form method="POST" action="{{ url('/edit/post/'.$post->id.'/save') }}" style="overflow: hidden;">
		{{ csrf_field() }}		
		<textarea id="summernote-edit" name="post_edit">
			{{ $post->content }}
		</textarea>
		<input type="submit" value="Modify Post" class="btn btn-md btn-success pull-right">
	</form>
</div>

@endsection