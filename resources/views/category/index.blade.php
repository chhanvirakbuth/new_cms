@extends('layouts.admin')
@section('toplabel')
<h3 class="m-0 text-success">All Category</h3>
@endsection
@section('script')
<script>
  $(document).ready(function(){

      $("#btn-category").addClass('nav-link active');

  });
</script>
@endsection

@section('content')
<div class="col-sm-6">
  <!-- success alert -->
  @if (session('status'))
      <div class="alert alert-success" role="alert">
          {{ session('status') }}
      </div>
  @endif

  <a href="{{route('category.create')}}" class="btn btn-success my-1">Add New</a>

  <table class="table table-hover">
    <thead class="bg-dark">
      <tr>
        <th scope="col">#</th>
        <th scope="col">Category</th>
        <th scope="col">Posts Count</th>
        <th scope="col">Action</th>
      </tr>
    </thead>
    <tbody>
      @if(count($categories)>0)
      @foreach($categories as $category)
      <tr>
        <th scope="row">{{$category->id}}</th>
        <th class="text-left">{{$category->name}}</th>
        <th scope="row">{{$category->post->count()}}</th>
        <td>
          <form action="{{ route('category.destroy',$category->id) }}" method="POST">
            <a class="btn btn-success" href="{{ route('category.edit',$category->id) }}">Edit</a>
              @csrf
              @method('DELETE')
              <button type="submit" class="btn btn-success">Delete</button>
          </form>
        </td>
      </tr>
      @endforeach
      @endif
    </tbody>
  </table>
</div>

@endsection
