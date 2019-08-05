@extends('layouts.admin')
@section('toplabel')
<h3 class="m-0 text-success">All TAGs</h3>
@endsection
@section('script')
<script>
  $(document).ready(function(){
      $("#btn-tag").addClass('nav-link active');
  });
</script>
@endsection
@section('content')
<div class="col-sm-6">
  <!--show errors when input nothing  -->
  @if ($errors->any())
    <div class="alert alert-danger">
        <ul>
            @foreach ($errors->all() as $error)
                <li>{{ $error }} Try again mader fuker</li>
            @endforeach
        </ul>
    </div>
@endif
  <form action="{{isset($tag) ? route('tag.update',$tag->id) : route('tag.store') }}" method="POST">
    @csrf
    @if(isset($tag))
      @method('PUT')
    @endif
  <div class="form-group row">
    <label for="Category" class="col-sm-2 col-form-label">TAGs</label>
    <div class="col-sm-10">
      <input type="text" class="form-control" id="category_name" name="name"
      value="{{isset($tag) ? $tag->name :''}}"
      autocomplete="off" required>
    </div>
  </div>
  <div class="form-group float-right">
    <button type="submit" class="btn btn-success">{{ isset($tag) ? 'UPDATE' : 'CREATE'}}</button>
  </div>
</form>
</div>
@endsection
