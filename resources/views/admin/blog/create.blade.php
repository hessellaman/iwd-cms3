@extends('layouts.app')
<!-- View voor het aanmaken van blog posts -->
@section('content')

<div class="container">
    <h1>Create</h1>
    <br>
    <form action="{{ route('blog.store') }}" method="POST">
    	
        @include('admin.blog.partials.fields')
    
    </form>
</div>

@include('admin.blog.partials.scripts')

@endsection
