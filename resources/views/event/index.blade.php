@extends('layouts.main')

@section('content')
    <h2>События</h2>
    <hr/>

    @if (!$events)
        Событий нет, <a href="{{route('event-show-add-form')}}">добавляем</a>?
    @else
        Если вам этого мало, всегда можно <a href="{{route('event-show-add-form')}}">добавить еще</a>.
        <hr/>
        <div class="table">
            <div class="row">
                <div class="col-md-4"><b>Название события</b></div>
                <div class="col-md-2"><b>Начало регистрации</b></div>
                <div class="col-md-3"><b>Окончание регистрации</b></div>
                <div class="col-md-1">&nbsp;</div>
                <div class="col-md-1">&nbsp;</div>
            </div>
            @foreach($events as $event)
                <div class="row">
                    <div class="col-md-4">{{$event->name}}</div>
                    <div class="col-md-2">{{$event->registration_start}}</div>
                    <div class="col-md-3">{{$event->registration_stop}}</div>
                    <div class="col-md-1">
                        <a href="<?php echo route('event-show-edit-form', ['id'=> $event->id]); ?>">
                            <span class="glyphicon glyphicon glyphicon-pencil text-info" aria-hidden="true"></span>
                        </a>
                    </div>
                    <div class="col-md-1">
                      <span class="glyphicon glyphicon glyphicon-remove text-danger remove-button"
                            aria-hidden="true"
                            data-delete-url="{{route('event-remove', ['id' => $event->id])}}"
                      ></span>
                    </div>
                </div>
            @endforeach
        </div>
    @endif
@stop

@section('footer-js')
    @parent
    <script type="application/javascript" src="/js/event-index.js"></script>
    <script type="application/javascript">
      $(function () {
        var eventIndex = new EventIndex({{csrf_token()}});
      });
    </script>
@stop