@extends('layouts.app')
<!-- View voor het bewerken van blog posts.  -->
@section('content')

<div class="container">
    <h1>Edit Blog</h1>
    <br>
    <form action="{{ route('blog.update', ['blog' => $model->id]) }}" method="post">
    	<!-- Nodig wanneer we iets willen kunnen bewerken -->
        {{ method_field('PUT') }}

        @include('admin.blog.partials.fields')

    </form>
</div>

@include('admin.blog.partials.scripts')

@endsection