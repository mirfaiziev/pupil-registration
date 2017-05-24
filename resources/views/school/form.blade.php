@extends('layouts.main')

@section('content')

<h2>
    @if(isset($id))
        Редактировать школу
    @else
        Добавить школу
    @endif
</h2>
<br>

<form action="{{ isset($id) ? route('school-edit', ['id' => $id]) : route('school-add') }}" method="post" class="form-horizontal">
    {{ csrf_field() }}
    <div class="form-group
         @if (isset($errors) and $errors->has('name'))
            has-error
        @endif
    ">
        <label for="school-form-name" class="col-sm-2 control-label">Название школы:</label>
        <div class="col-sm-5">
            <input type="text" class="form-control" name="name" id="school-form-name"
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
             @if (isset($errors) and $errors->has('city'))
            has-error
        @endif
            ">
        <label for="school-form-city" class="col-sm-2 control-label">Город:</label>
        <div class="col-sm-5">
            <input type="text" id="school-form-city" class="form-control" name="city[name]"
                   value="{{$form['city']['name'] or 'Киев'}}"
                   placeholder="Введите город"
            />
            @if (isset($errors) and $errors->has('city'))
                @foreach($errors->get('city') as $message)
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
    <script type="application/javascript" src="/js/school-form.js"></script>
    <script type="application/javascript">
      $(function () {
        var schoolForm = new SchoolForm('{{route("city-search")}}');
      });
    </script>
@stop
