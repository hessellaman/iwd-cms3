@extends('layouts.app')
<!-- View voor het bewerken van users in de backend -->
@section('content')

<div class="container">
    @if (session('status'))
    <div class="alert alert-info">
        {{ session('status') }}
    </div>
    @endif
    <table class="table">
        <thead>
            <tr>
                <th>Name</th>
                <th>Email</th>
                <th>Roles</th>
            </tr>
        </thead>

        @foreach ($model as $user)
            <tr>
                <td>
                    <a href="{{ route('users.edit', ['user' => $user->id])}}">{{ $user->name }}</a>
                </td>
                <td>{{ $user->email }}</td>
                <td>
                    {{ implode(', ', $user->roles()->get()->pluck('name')->toArray())}}
                </td>
                <td class="text-right">
                    <!-- Waarschuwing bij het verwijderen van een post -->
                    <a href="{{ route('users.destroy', ['user'=>$user->id])}}" class="btn btn-danger delete-link" 
                        data-message="Are you sure you want to delete this user?" 
                        data-form="delete-form">
                            Delete
                    </a>
                    
                </td>
            </tr>

        @endforeach
    
    </table>
    {{ $model->links() }}
</div>
<!-- Voor het verwijderen van een post moet dit eerst mogelijk worden gemaakt met method_field('DELETE') -->
<form id="delete-form" action="" method="POST">
    {{ method_field('DELETE') }}
    {!! csrf_field() !!}
</form>

@endsection
