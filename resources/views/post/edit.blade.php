
@extends('layouts.admin')
@section('toplabel')
<h3 class="m-0 text-success">Edit Post</h3>
@endsection
@section('script')
<script>
  $(document).ready(function(){

      $("#btn-post").addClass('nav-link active');
      $('.tag-selector').select2();
  });
</script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/select2/4.0.8/js/select2.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/trix/1.1.1/trix.js"></script>
<script src="https://cdn.jsdelivr.net/npm/flatpickr"></script>
<script>
  flatpickr('#published_at',{
    enableTime:true
  });
</script>
@endsection

@section('css')
<link href="https://cdnjs.cloudflare.com/ajax/libs/select2/4.0.8/css/select2.min.css" rel="stylesheet" />
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/trix/1.1.1/trix.css"/>
<link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/flatpickr/dist/flatpickr.min.css">
@endsection
@section('content')
<!-- show errors -->
@if ($errors->any())
  <div class="alert alert-danger">
      <ul>
          @foreach ($errors->all() as $error)
              <li>{{ $error }} Try again mader fuker</li>
          @endforeach
      </ul>
  </div>
@endif
<div class="container">
  <form action="{{route('post.update',$posts->id)}}" method="post" enctype="multipart/form-data">
    @csrf
    @method('PUT')
  <div class="form-group">
    <label for="title">Title</label>
    <input type="text" class="form-control" id="title"name="title" value="{{$posts->title}}" required>
  </div>
  <div class="form-group">
    <label for="description">Description</label>
    <textarea name="description" rows="3" cols="80" class="form-control" required>{{$posts->description}}</textarea>
  </div>
  <div class="form-group">
    <label for="content">Content</label>
    <input id="content" type="hidden" name="content" value="{{$posts->content}}">
    <trix-editor input="content"></trix-editor>
  </div>
  <div class="form-group">
    <label for="published_at">Published At</label>
    <input type="text" class="form-control" id="published_at" name="published_at" placeholder="Published At..."
    value="{{$posts->published_at}}"
    >
  </div>
  <div class="form-group">
    <label for="image">Image</label>
    <img src="<?php echo "/".$posts->image;?>" width="400px" class="pb-3"/>
    <input type="file" class="form-control" id="image" name="image">
  </div>
  <div class="form-group">
    <label for="content">Category</label>
    <select name="category" class="form-control">
      @foreach($categories as $category)
        <option value="{{$category->id}}"
          @if($category->id == $posts->category_id)
            selected
          @endif
          >{{$category->name}}</option>
      @endforeach
    </select>
  </div>
  <div class="form-group">
    <label for="tag">Tag</label>
    <select class="form-control tag-selector" name="tags[]" id="tags" multiple>
      @if($tags->count()>0)
      @foreach($tags as $tag)
      <option value="{{$tag->id}}"
        @if($posts->hasTag($tag->id))
        selected
        @endif
      >
        {{$tag->name}}</option>
      @endforeach
      @else
      <option selected>NO TAGS IN LIST RECORDS</option>
      @endif
    </select>
  </div>
  <div class="form-group">
    <button type="submit" class="btn btn-success">UPDATE POST</button>
  </div>
</form>
</div>
@endsection
