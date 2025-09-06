@extends('layouts.app')

@section('content')
<h1>User Details</h1>
<p><strong>Username:</strong> {{ $user->username }}</p>
<p><strong>Email:</strong> {{ $user->email }}</p>
<p><strong>Status:</strong> {{ $user->status }}</p>
<p><strong>Last Login:</strong> {{ $user->last_login ? $user->last_login : 'Never' }}</p>
<p><strong>Attempt:</strong> {{ $user->attempt }}</p>
<a href="{{ route('users.index') }}" class="btn btn-primary">Back</a>
@endsection
