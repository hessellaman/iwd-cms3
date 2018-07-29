@extends('layouts.frontend')
<!-- View voor het tonen van het archief op het blog. -->
@section('content')
  <div class="col-sm-8 blog-main">
    @foreach ($posts as $post)
      <div class="blog-post">
        <h2 class="blog-post-title">
          <a href="{{ route('blog.view', ['slug' => $post->slug]) }}">{{$post->title}}</a>
        </h2>        
        <p class="blog-post-meta">
          Gepost door {{$post->user->name }} op {{ $post->present()->publishedDate}}
        </p>
          {{ $post->excerpt}}
      </div>
    @endforeach
  </div>
@endsection
