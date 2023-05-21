@extends('layouts.app')

@section('content')
<a href="{{ route('profile', $user->id) }}">{{ $user->name }}</a>

@endsection