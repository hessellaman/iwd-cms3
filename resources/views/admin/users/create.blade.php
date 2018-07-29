@extends('layouts.app')
Wordt eigenlijk niet echt gebruikt, excuus
@section('content')

<div class="container">
    <h1>Create</h1>
    <br>
    <form action="{{ route('users.store') }}" method="POST">

        @include('admin.users.partials.fields')
    
    </form>
</div>


@endsection
