@extends('layouts.front_end')
@section('content')
<main class="main-content">
  <section class="section p-0">
    <div class="container">

      <div class="row">
        <div class="col-md-8 col-xl-6 mx-auto">
@if($posts->count()>0)
@foreach($posts as $post)
<article class="my-8">
  <header class="text-center mb-7">
    <p><a class="small-4 text-lighter text-uppercase ls-2 fw-600" href="#">{{$post->category->name}}</a></p>
    <h3><a href="post-2.html">{{$post->title}}</a></h3>
  </header>

  <a href="post-2.html"><img class="rounded-md" src="{{$post->image}}" alt="...posts image"></a>

  <div class="card-body">
    <div class="row mb-5 small-2 text-lighter">
      <div class="col-auto">
        <a class="text-inherit" href="#">by Hossein</a>
        <span class="align-middle px-1">&bull;</span>
        <time datetime="2018-05-15T19:00">{{\Carbon\Carbon::parse($post->published_at)->diffForHumans()}}</time>
      </div>

      <div class="col-auto ml-auto">
        <span><i class="fa fa-eye pr-1 opacity-60"></i> 12800</span>
        <a class="text-inherit ml-5" href="#"><i class="fa fa-comments pr-1 opacity-60"></i> 6</a>
      </div>
    </div>

    <p class="text-justify">{{$post->description}}</p>

    <p class="text-center mt-7">
      <a class="btn btn-primary btn-round" href="{{route('show_page',$post->id)}}" target="_blank">Read more</a>
    </p>
  </div>
</article>


<hr>
@endforeach
@endif
<nav >
  <!-- paggination -->
  {{$posts->links()}}
</nav>
</div>
</div>

</div>
</section>
</main>
@endsection
