@extends('layouts.admin')
@section('toplabel')
<h3 class="m-0 text-success">All TAGs</h3>
@endsection
@section('script')
<script>
  $(document).ready(function(){

      $("#btn-tag").addClass('nav-link active');
  });

  function deleteTag(id){
    var form=document.getElementById('deleteTagfrm')
    form.action='tag/'+id
    $('#deleteModal').modal('show');
    console.log(form);
  };
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

  <a href="{{route('tag.create')}}" class="btn btn-success my-1">Add Tags</a>

  <table class="table table-hover">
    <thead class="bg-dark">
      <tr>
        <th scope="col">#</th>
        <th scope="col">Name</th>
        <th scope="col">Posted Count</th>
        <th scope="col">Action</th>
      </tr>
    </thead>
    <tbody>
      @if(count($tags)>0)
      @foreach($tags as $tag)
      <tr>
        <th scope="row">{{$tag->id}}</th>
        <th class="text-left">{{$tag->name}}</th>
        <th class="text-left">{{$tag->posts->count()}}</th>
        <td>

            <a class="btn btn-success" href="{{route('tag.edit',$tag->id)}}">Edit</a>

            <button type="button" class="btn btn-success" id="btn-delete"
            onclick="deleteTag({{$tag->id}})">Delete</button>

        </td>
      </tr>
      @endforeach
      @else
      <td colspan="3" class="text-center text-danger">
        there are no any records to display..
      </td>
      @endif
    </tbody>
  </table>
</div>

<!-- modal -->
<form class="" id="deleteTagfrm" action="" method="post">
<div class="modal" tabindex="-1" role="dialog" id="deleteModal">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header bg-dark">
        <h5 class="modal-title">Tags delete</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true" style="color:#fff;">&times;</span>
        </button>
      </div>
      <div class="modal-body">
        <p class="text text-success">are you sure to delete this tags?</p>
      </div>
      <div class="modal-footer">

          @csrf
          @method('DELETE')
          <button type="button" class="btn btn-danger" data-dismiss="modal">No</button>
          <button type="submit" class="btn btn-success" id="btn-delete">Yes i'm Sure</button>

      </div>
    </div>
  </div>
</div>
</form>
@endsection
