@extends('layouts.main')
@section('content')

<?php if (empty($schools)) : ?>
    Школ пока нету, может <a href="<?php echo route('school-show-add-form') ?>"> таки добавим хоть шото</a>?
  Или уже <a href="<?php echo route('home') ?>"> пойдем отсюда</a>?
<?php else: ?>
    Cмотрите шо я нашел, но если вам мало, всегда можно
    <a href="<?php echo route('school-show-add-form') ?>"> добавить еще одну</a>?
    Или уже <a href="<?php echo route('home') ?>"> пойдем отсюда</a>?
    <hr/>
    <div class="table">
        <?php foreach ($schools as $school) : ?>
            <div class="row">
                <div class="col-md-4"><?php echo $school->name ?></div>
                <div class="col-md-1">
                  <a href="<?php echo route('school-show-edit-form', ['id'=> $school->id]); ?>">
                    <span class="glyphicon glyphicon glyphicon-pencil text-info" aria-hidden="true"></span>
                  </a>
                </div>
                <div class="col-md-1">
                      <span class="glyphicon glyphicon glyphicon-remove text-danger remove-button"
                            aria-hidden="true"
                            data-delete-url="<?php echo route('school-delete', ['id' => $school->id])?>"
                      />
                </div>
            </div>
        <?php endforeach; ?>
    </div>
<?php endif; ?>
@stop

@section('footer-js')
    @parent
    <script type="application/javascript" src="/js/school-list.js"></script>
    <script type="application/javascript">
      $(function () {
        var schoolList = new SchoolList('{{csrf_token()}}');
      });
    </script>
@stop