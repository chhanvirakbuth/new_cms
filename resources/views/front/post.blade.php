@extends('layouts.front_end')
@section('content')
<!-- Main Content -->
  <main class="main-content">


    <!--
    |‒‒‒‒‒‒‒‒‒‒‒‒‒‒‒‒‒‒‒‒‒‒‒‒‒‒‒‒‒‒‒‒‒‒‒‒‒‒‒‒‒‒‒‒‒‒‒‒‒‒‒‒‒‒‒‒‒‒‒‒‒‒‒‒‒‒‒‒‒‒‒‒‒‒
    | Blog content
    |‒‒‒‒‒‒‒‒‒‒‒‒‒‒‒‒‒‒‒‒‒‒‒‒‒‒‒‒‒‒‒‒‒‒‒‒‒‒‒‒‒‒‒‒‒‒‒‒‒‒‒‒‒‒‒‒‒‒‒‒‒‒‒‒‒‒‒‒‒‒‒‒‒‒
    !-->
    <div class="section">
      <div class="container">

        <div class="text-center mt-8">
          <h2>{{$posts->title}}</h2>
          <p>{{\Carbon\Carbon::parse($posts->published_at)->diffForHumans()}} in <a href="#">{{$posts->category->name}}</a></p>
        </div>


        <div class="text-center my-8">
          <img class="rounded-md" src="/{{$posts->image}}" alt="{{$posts->image}}">
        </div>


        <div class="row">
          <div class="col-lg-8 mx-auto">

            <p class="lead">{{$posts->description}}</p>

            <hr class="w-100px">

            {!!$posts->content!!}

            <p>A then low win variety own this every real all the salesman be I don't thin it if bed in anchors slowly he you have I young picture same the your own absolutely question everyday. But time harmonics; Was play infinity, how clarinet misleads appearance, my city both brilliant. Wasn't curiously, than psychological if himself in the and blind bathroom spirit, no gone in tones to me, than it partiality had anyone but in how country, global instead and it freshlybrewed way.</p>

          </div>
        </div>

            <div class="gap-xy-2 mt-6">
              @foreach($posts->tags as $tag)
              <a class="badge badge-pill badge-secondary" href="#">{{$tag->name}}</a>
              @endforeach
            </div>

          </div>
        </div>


      </div>
    </div>

@endsection
