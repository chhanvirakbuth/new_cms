@extends('layouts.admin')
@section('toplabel')
<h3 class="m-0 text-success">Create Category</h3>
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
  <form action="{{isset($category) ? route('category.update',$category->id) : route('category.store') }}" method="POST">
    @csrf
    @if(isset($category))
      @method('PUT')
    @endif
  <div class="form-group row">
    <label for="Category" class="col-sm-2 col-form-label">CATEGORY</label>
    <div class="col-sm-10">
      <input type="text" class="form-control" id="category_name" name="name"
      value="{{isset($category) ? $category->name :''}}"
      autocomplete="off" required>
    </div>
  </div>
  <div class="form-group float-right">
    <button type="submit" class="btn btn-success">{{ isset($category) ? 'UPDATE' : 'CREATE'}}</button>
  </div>
</form>
</div>
@endsection
