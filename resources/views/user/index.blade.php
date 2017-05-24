@extends('layouts.main')

@section('content')
<ul class="list-unstyled">
    @foreach($users as $user)
        <li><a href="{{route('user-show-edit-form', ['id' => $user->id])}}">{{$user->name}}</a></li>
    @endforeach
</ul>
<a href="{{route('user-show-add-form')}}">Добавить</a>
@stop