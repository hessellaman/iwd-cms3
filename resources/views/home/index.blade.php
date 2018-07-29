@extends('layouts.frontend')

@section('content')

<!-- Homepage invulling. Toont alleen de drie meest recente blog post op de homepage -->
    <div class="col-sm-8 blog-main">

  @foreach ($posts as $post)
      <div class="card bg-dark text-white">
        <img class="card-img" src="images/cardbackground.png" alt="Card image">
        <div class="card-img-overlay" href="{{ route('blog.view', ['slug' => $post->slug]) }}">
          <h2 class="mb-0">
              <a class="text-white" href="{{ route('blog.view', ['slug' => $post->slug]) }}">{{$post->title}}</a>
          </h2>
          <p class="card-text">{{ $post->excerpt }}</p>
          <br>
          <p class="card-text">Gepost door {{$post->user->name }} op {{ $post->present()->publishedDate}}</p>
        </div>
      </div>
      <hr>
  @endforeach
    </div>

@endsection
