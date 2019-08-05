@extends('layouts.admin')
@section('toplabel')
<h3 class="m-0 text-success">All Post</h3>
@endsection
@section('script')
<script>
  $(document).ready(function(){

      $("#btn-post").addClass('nav-link active');

  });
</script>
@endsection

@section('content')
<!-- success alert -->
@if (session('status'))
    <div class="alert alert-success" role="alert">
          {{ session('status') }}
    </div>
@endif

<a class="btn btn-success my-1" href="{{route('post.create')}}">ADD POST</a>
<a class="btn btn-success my-1 float-right btn-sm" href="{{route('trashed-post.index')}}">
  Trashed
  <span class="badge badge-danger">{{ $trashed->count() }}</span>
</a>
<table class="table table-hover">
  <thead class="bg-dark">
    <tr>
      <th scope="col">#</th>
      <th scope="col">Title</th>
      <th scope="col">Description</th>
      <th scope="col">Image</th>
      <th scope="col">Published At</th>
      <th scope="col">Action</th>
    </tr>
  </thead>
  <tbody>
    @if(count($posts)>0)
    @foreach($posts as $post)
    <tr>
      <th scope="row">{{$post->id}}</th>
      <td>{{str_limit($post->title,10)}}</td>
      <td>{{ str_limit($post->description,15) }}</td>
      <td><img src="{{$post->image}}" width="50px;"/></td>
      <td>{{$post->published_at}}</td>
      <td>
        <form action="{{ route('post.destroy',$post->id) }}" method="POST">
          <a class="btn btn-success" href="{{ route('post.edit',$post->id) }}">Edit</a>
            @csrf
            @method('DELETE')
            <button type="submit" class="btn btn-success">Trash</button>
        </form>
      </td>
    </tr>
    @endforeach
    @endif
  </tbody>
</table>
<nav>
  {{$posts->links()}}
</nav>
@endsection
