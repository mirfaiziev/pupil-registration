@extends('layouts.main')

@section('content')
    <h2>
    @if(isset($id))
        Изменить событие
    @else
        Добавить событие
    @endif
    </h2>
    <br/>
    <form action="{{ isset($id) ? route('event-edit', ['id' => $id]) : route('event-add') }}"
        method="post" class="form-horizontal"
    >
        {{ csrf_field() }}
        <div class="form-group
            @if (isset($errors) and $errors->has('name'))
                has-error
            @endif
                ">
            <label for="event-form-name" class="col-sm-2 control-label">Название события:</label>
            <div class="col-sm-5">
                <input type="text" id="event-form-name" class="form-control" name="name"
                       value="{{$form['name'] or ''}}"
                       placeholder="Введите название"
                />
                @if (isset($errors) and $errors->has('name'))
                    @foreach($errors->get('name') as $message)
                        <span class="help-block">{{$message}}</span>
                    @endforeach
                @endif
            </div>
        </div>

        <div class="form-group
            @if (isset($errors) and $errors->has('registration_start'))
                has-error
            @endif
                ">
            <label for="event-form-registration_start" class="col-sm-2 control-label">Начало регистрации:</label>
            <div class="col-sm-5">
                <input type="text" id="event-form-registration-start" class="form-control" name="registration_start"
                       value="{{$form['registration_start'] or ''}}"
                       placeholder="Введите дату начала регистрации"
                />
                @if (isset($errors) and $errors->has('registration_start'))
                    @foreach($errors->get('registration_start') as $message)
                        <span class="help-block">{{$message}}</span>
                    @endforeach
                @endif
            </div>
        </div>

        <div class="form-group
            @if (isset($errors) and $errors->has('registration_stop'))
                has-error
            @endif
                ">
            <label for="event-form-registration_stop" class="col-sm-2 control-label">Конец регистрации:</label>
            <div class="col-sm-5">
                <input type="text" id="event-form-registration-stop" class="form-control" name="registration_stop"
                       value="{{$form['registration_stop'] or ''}}"
                       placeholder="Введите дату окончания регистрации"
                />
                @if (isset($errors) and $errors->has('registration_stop'))
                    @foreach($errors->get('registration_stop') as $message)
                        <span class="help-block">{{$message}}</span>
                    @endforeach
                @endif
            </div>
        </div>

        <div class="form-group">
            <div class="col-sm-offset-2 col-sm-10">
                <button type="submit" class="btn btn-default">Сохранить</button>
            </div>
        </div>
    </form>
@stop

@section('footer-js')
    @parent
    <script type="application/javascript" src="/js/event-form.js"></script>
@stop