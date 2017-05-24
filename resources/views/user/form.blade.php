@extends('layouts.main')

@section('content')
    <h2>
        @if(isset($id))
            Редактировать пользователя
        @else
            Добавить пользователя
        @endif
    </h2>
    <br/>
    <form action="{{ isset($id) ? route('user-edit', ['id' => $id]) : route('user-add') }}"
          method="post" class="form-horizontal"
    >
        {{ csrf_field() }}
        <div class="form-group
            @if (isset($errors) and $errors->has('name'))
                has-error
            @endif
                ">
            <label for="user-form-name" class="col-sm-4 control-label">Имя пользователя:</label>
            <div class="col-sm-5">
                <input type="text" id="user-form-name" class="form-control" name="name"
                       value="{{$form['name'] or ''}}"
                       placeholder="Введите имя"
                />
                @if (isset($errors) and $errors->has('name'))
                    @foreach($errors->get('name') as $message)
                        <span class="help-block">{{$message}}</span>
                    @endforeach
                @endif
            </div>
        </div>

        <div class="form-group
            @if (isset($errors) and $errors->has('password'))
                has-error
            @endif
                ">
            <label for="user-form-password" class="col-sm-4 control-label">Пароль:</label>
            <div class="col-sm-5">
                <input type="text" id="user-form-password" class="form-control" name="password"
                       placeholder="Введите пароль"
                />
                @if (isset($errors) and $errors->has('password'))
                    @foreach($errors->get('password') as $message)
                        <span class="help-block">{{$message}}</span>
                    @endforeach
                @endif
            </div>
        </div>

        <div class="form-group
            @if (isset($errors) and $errors->has('role'))
                has-error
            @endif
                ">
            <label for="user-form-role" class="col-sm-4 control-label">Роль:</label>
            <div class="col-sm-5">
                <select  id="user-form-role" class="form-control" name="role">
                @foreach($roles as $role)
                    <option value="{{$role}}"
                            @if ($form['role'] and $form['role'] == $role)
                                selected="selected"
                            @endif
                    >{{$role}}</option>
                @endforeach
                </select>
                @if (isset($errors) and $errors->has('role'))
                    @foreach($errors->get('role') as $message)
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

