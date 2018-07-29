@extends('layouts.app')
<!-- View voor het maken van een pagina -->
@section('content')

<div class="container">
    <h1>Create</h1>
    <br>
    <form action="{{ route('pages.store') }}" method="POST">

        @include('admin.pages.partials.fields')
    
    </form>
</div>


@endsection
