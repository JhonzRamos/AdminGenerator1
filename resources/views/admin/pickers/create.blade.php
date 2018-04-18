@extends('admin.layouts.master')

@section('content')

<div class="row">
    <div class="col-sm-10 col-sm-offset-2">
        <h1>{{ trans('quickadmin::templates.templates-view_create-add_new') }}</h1>

        @if ($errors->any())
        	<div class="alert alert-danger">
        	    <ul>
                    {!! implode('', $errors->all('<li class="error">:message</li>')) !!}
                </ul>
        	</div>
        @endif
    </div>
</div>

{!! Form::open(array('route' => config('quickadmin.route').'.pickers.store', 'id' => 'form-with-validation', 'class' => 'form-horizontal')) !!}

<div class="form-group">
    {!! Form::label('sTime', 'Time*', array('class'=>'col-sm-2 control-label')) !!}
    <div class="col-sm-10">
          <div class="input-group">

                      {!! Form::text('sTime', old('sTime'), array('class'=>'form-control timepicker')) !!}


                      <div class="input-group-addon">
                                           <i class="fa fa-clock-o"></i>
                                          </div>

                                          
                </div>

    </div>
</div><div class="form-group">
    {!! Form::label('iDAtePicker', 'Date', array('class'=>'col-sm-2 control-label')) !!}
    <div class="col-sm-10">
        <div class="input-group date">

             {!! Form::text('iDAtePicker', old('iDAtePicker'), array('class'=>'form-control pull-right datepicker')) !!}
              <div class="input-group-addon">
                         <i class="fa fa-calendar"></i>
                         </div>
             
        </div>

    </div>
</div>

<div class="form-group">
    {!! Form::label('iDateTime', 'Date TIme', array('class'=>'col-sm-2 control-label')) !!}
    <div class="col-sm-10">
          <div class="input-group date">

                      {!! Form::text('iDateTime', old('iDateTime'), array('class'=>'form-control datetimepicker')) !!}
                       <div class="input-group-addon">
                                          <i class="fa fa-calendar"></i>
                                          </div>
                      <p class="help-block">Da</p>
                </div>

    </div>
</div>

<div class="form-group">
    <div class="col-sm-10 col-sm-offset-2">
      {!! Form::submit( trans('quickadmin::templates.templates-view_create-create') , array('class' => 'btn btn-primary')) !!}
    </div>
</div>

{!! Form::close() !!}

@endsection

@section('javascript')
<script src="{{asset('adminlte/plugins/tinymce/tinymce.min.js')}}"></script>
<script type="text/javascript">
    tinymce.init({
        mode : "textareas",
        editor_selector : "mceEditor",
        editor_deselector : "mceNoEditor"
    });
</script>
@endsection