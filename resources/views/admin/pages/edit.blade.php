@extends('layouts.app')

@section('content')

<div class="container">
    <h1>Edit Page</h1>
    <form action="{{ route('pages.update', ['page' => $model->id]) }}" method="post">
    	<!-- Nodig wanneer we iets willen kunnen bewerken -->
        {{ method_field('PUT') }}

        @include('admin.pages.partials.fields')

    </form>
</div>

@endsection