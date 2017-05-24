@extends('layouts.main')

@section('content')
    @if(Auth::check())
    Бедному ребенку уже можно зарегестрироваться, <a href="{{route('home')}}">или ну его</a>? <hr/>
    @endif
    @if (count($events))
    <form action="{{route('pupil-register')}}" method="POST" class="form-horizontal">
        {{ csrf_field() }}
        <!-- Имя -->
        <div class="form-group
            @if (isset($errors) and $errors->has('first_name'))
                has-error
            @endif
            ">
            <label for="pupil-register-form-first-name" class="col-sm-2 control-label">Имя:</label>
            <div class="col-sm-7">
                <input type="text" id="pupil-register-form-first-name" class="form-control" name="first_name"
                       value="{{$form['first_name'] or ''}}"
                       placeholder="Введите имя"
                />
                @if (isset($errors) and $errors->has('first_name'))
                    @foreach($errors->get('first_name') as $message)
                        <span class="help-block">{{$message}}</span>
                    @endforeach
                @endif
            </div>
        </div>

        <!-- Фамилия -->
        <div class="form-group
             @if (isset($errors) and $errors->has('family_name'))
                has-error
            @endif
                ">
            <label for="pupil-register-form-family-name" class="col-sm-2 control-label">Фамилия:</label>
            <div class="col-sm-7">
                <input type="text" id="pupil-register-form-family-name" class="form-control" name="family_name"
                       value="{{$form['family_name'] or ''}}"
                       placeholder="Введите фамилию"
                />
                @if (isset($errors) and $errors->has('family_name'))
                    @foreach($errors->get('family_name') as $message)
                        <span class="help-block">{{$message}}</span>
                    @endforeach
                @endif
            </div>
        </div>

        <!-- Город -->
        <div class="form-group
             @if (isset($errors) and $errors->has('city'))
                has-error
            @endif
                ">
            <label for="pupil-register-form-city" class="col-sm-2 control-label">Город:</label>
            <div class="col-sm-7">
                <input type="text" id="pupil-register-form-city" class="form-control" name="city"
                       value="{{$form['city'] or 'Киев'}}"
                       placeholder="Введите город"
                />
                @if (isset($errors) and $errors->has('city'))
                    @foreach($errors->get('city') as $message)
                        <span class="help-block">{{$message}}</span>
                    @endforeach
                @endif
            </div>
        </div>

        <!-- Школа -->
        <div class="form-group
             @if (isset($errors) and $errors->has('school'))
                has-error
             @endif
                ">
            <label for="pupil-register-form-school" class="col-sm-2 control-label">Школа:</label>
            <div class="col-sm-7">
                <input type="text" id="pupil-register-form-school" class="form-control" name="school"
                       value="{{$form['school'] or ''}}"
                       placeholder="Введите школу"
                />
                @if (isset($errors) and $errors->has('school'))
                    @foreach($errors->get('school') as $message)
                        <span class="help-block">{{$message}}</span>
                    @endforeach
                @endif
            </div>
        </div>

        <!-- Класс -->
        <div class="form-group
         @if (isset($errors) and $errors->has('class'))
                has-error
             @endif
                ">
            <label for="pupil-register-form-class" class="col-sm-2 control-label">Класс:</label>
            <div class="col-sm-7">
                <input type="text" id="pupil-register-form-class" class="form-control" name="class"
                       value="{{$form['class'] or ''}}"
                       placeholder="Введите класс"
                />
                @if (isset($errors) and $errors->has('class'))
                    @foreach($errors->get('class') as $message)
                        <span class="help-block">{{$message}}</span>
                    @endforeach
                @endif
            </div>
        </div>

        <!-- Имя учителя -->
        <div class="form-group
            @if (isset($errors) and $errors->has('teacher'))
                has-error
            @endif
                ">
            <label for="pupil-register-form-teacher" class="col-sm-2 control-label">Учитель:</label>
            <div class="col-sm-7">
                <input type="text" id="pupil-register-form-teacher" class="form-control" name="teacher"
                       value="{{$form['teacher'] or ''}}"
                       placeholder="Как зовут учителя"
                />
                @if (isset($errors) and $errors->has('teacher'))
                    @foreach($errors->get('teacher') as $message)
                        <span class="help-block">{{$message}}</span>
                    @endforeach
                @endif
            </div>
        </div>

        <!-- Емейл -->
        <div class="form-group
        @if (isset($errors) and $errors->has('email'))
                has-error
            @endif
                ">
            <label for="pupil-register-form-email" class="col-sm-2 control-label">Email:</label>
            <div class="col-sm-7">
                <input type="text" id="pupil-register-form-email" class="form-control" name="email"
                       value="{{$form['email'] or ''}}"
                       placeholder="Email"
                />
                @if (isset($errors) and $errors->has('email'))
                    @foreach($errors->get('email') as $message)
                        <span class="help-block">{{$message}}</span>
                    @endforeach
                @endif
            </div>
        </div>

        <!-- Телефон -->
        <div class="form-group
            @if (isset($errors) and $errors->has('phone'))
                has-error
            @endif
                ">
            <label for="pupil-register-form-phone" class="col-sm-2 control-label">Телефон:</label>
            <div class="col-sm-7">
                <input type="text" id="pupil-register-form-phone" class="form-control" name="phone"
                       value="{{$form['phone'] or ''}}"
                       placeholder="Телефон"
                />
                @if (isset($errors) and $errors->has('phone'))
                    @foreach($errors->get('phone') as $message)
                        <span class="help-block">{{$message}}</span>
                    @endforeach
                @endif
            </div>
        </div>

        <!-- Мероприятия -->
        <div class="form-group
            @if (isset($errors) and $errors->has('event'))
                has-error
             @endif
        ">
            <label class="col-sm-2 control-label">
                Мероприятия:
            </label>
            <div class="col-sm-7">
                @foreach($events as $event)
                    <div class="checkbox">
                        <label>
                            <input type="checkbox"
                                   id="pupil-register-form-event"
                                   name="event[{{$event->id}}]"
                                   @if ( (isset($form['event'][$event->id]) and $form['event'][$event->id] == 'on')
                                    or count($events) == 1
                                   )
                                       checked="true"
                                   @endif
                                   />
                            {{$event->name}}
                        </label>
                    </div>
                @endforeach
                @if (isset($errors) and $errors->has('event'))
                    @foreach($errors->get('event') as $message)
                        <span class="help-block">{{$message}}</span>
                    @endforeach
                @endif
            </div>

        </div>

        <div class="form-group">
            <div class="col-sm-offset-2 col-sm-10">
                <button type="submit" class="btn btn-default">Регистрация</button>
            </div>
        </div>
    </form>
    @else
        Нет мероприятий для регистрации
    @endif
@stop

@section('footer-js')
    @parent

    <script type="application/javascript" src="/js/pupil-register.js"></script>
    <script type="application/javascript">

      $(function () {
        var pupilRegisterPage = new PupilRegisterPage(
          '{{route("pupil-suggest-name")}}',
          '{{route("city-search")}}',
          '{{route("school-search")}}'
        );
      });
    </script>
@stop