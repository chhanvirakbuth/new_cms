@extends('layouts.admin')
@section('script')
<script>
  $(document).ready(function(){
      $("#btn-user").addClass('nav-link active');
  });
</script>
@endsection

@section('content')
@if (session('status'))
    <div class="alert alert-success" role="alert">
          {{ session('status') }}
    </div>
@endif

<table class="table table-hover">
  <thead class="bg-dark">
    <tr>
      <th scope="col">#</th>
      <th scope="col">Name</th>
      <th scope="col">Role</th>
      <th scope="col">Image</th>
      <th scope="col">Action</th>
    </tr>
  </thead>
  <tbody>
    @if($users->count()>0)
    @foreach($users as $user)
    <tr>
      <th scope="row">{{$user->id}}</th>
      <td>{{$user->name}}</td>
      <td>{{$user->role}}</td>
      <td><img style="border-radius:50%;" src="{{Gravatar::src($user->email)}}" width="40px" height="40px"/
        alt="user profile image"></td>
      <td>
        @if($user->isAdmin())
        <button type="button" class="btn btn-success" disabled>Admin</button>
        @else
        <form class="" action="{{route('users.make-admin',$user->id)}}" method="post">
          @csrf
          <button type="submit" class="btn btn-success">Make As Admin</button>
        </form>
        @endif
      </td>
    </tr>
    @endforeach
    @else
    <p>
      fuck
    </p>
    @endif
  </tbody>
</table>
@endsection
