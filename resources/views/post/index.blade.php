@extends('layouts.app')
@section('title', 'List of Posts')

@section('content')
    @foreach($posts as $post)
        <h1>{{$post['title']}}</h1>
        <p>{{$post['content']}}</p>
    @endforeach
@endsection
