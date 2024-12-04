@extends('layouts.app')
@section('title', 'Post author')

@section('content')

    <h1>{{$post['title']}}</h1>
    <p>Author: {{ "{$author['name']}, {$author['surname']}" }}</p>

@endsection
