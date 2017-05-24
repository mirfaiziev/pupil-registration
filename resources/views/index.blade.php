@extends('layouts.main')
@section('content')
  <h2>И шо вы уже хотите?</h2>
  <ul>
    @can('view', \App\Model\School::class)
    <li><a href="{{route('school-list')}}">Список школ (должен быть виден администратору)</a></li>
    @endcan
    <li><a href="{{route('pupil-register-form')}}">Зарегестрировать ученика (должен быть виден всем)</a></li>
    <li><a href="{{route('pupil-confirm')}}">А был ли мальчик? (должен быть виден "менеджеру")</a></li>
    <li><a href="{{route('pupil-list')}}">Список учеников (Видны админу) </a></li>
    <li><a href="{{route('event-list')}}">Мероприятия (видны зареганым) </a></li>
    <li><a href="">Управление пользователями (только суперадмие)</a></li>
  </ul>

  <hr> <br>
  <ul class="nav">
    <li><a href="{{route('pupil-register-form')}}">Зарегестрировать ученика (все)</a></li>

    @can('any', \App\Model\Event::class)
      <li><a href="{{route('event-list')}}">Управление мероприятиями (админы и те, кто могут выставлять оценки)</a></li>
    @endcan

    <li>Текущие мероприятия (зарегестрированные) -> подтвердить участие ученика, выставить оценки</li>

    @can('any', \App\Model\School::class)
      <li><a href="{{route('school-list')}}">Список школ (админ)</a></li>
    @endcan

    @can('any', \App\User::class)
      <li><a href="{{route('user-list')}}">Управление пользователями (суперадмин)</a></li>
    @endcan
  </ul>
@stop
