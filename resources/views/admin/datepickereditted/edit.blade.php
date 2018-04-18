@extends('admin.layouts.master')

@section('content')

<div class="row">
    <div class="col-sm-10 col-sm-offset-2">
        <h1>{{ trans('quickadmin::templates.templates-view_edit-edit') }}</h1>

        @if ($errors->any())
        	<div class="alert alert-danger">
        	    <ul>
                    {!! implode('', $errors->all('<li class="error">:message</li>')) !!}
                </ul>
        	</div>
        @endif
    </div>
</div>

{!! Form::model($datepickereditted, array('class' => 'form-horizontal', 'id' => 'form-with-validation', 'method' => 'PATCH', 'route' => array(config('quickadmin.route').'.datepickereditted.update', encrypt($datepickereditted->id)))) !!}

<div class="form-group">
    {!! Form::label('sDatePicker', 'Date Picker*', array('class'=>'col-sm-2 control-label')) !!}
    <div class="col-sm-10">
        <div class="input-group date">
            <div class="input-group-addon">
            <i class="fa fa-calendar"></i>
            </div>
             {!! Form::text('sDatePicker', old('sDatePicker',$datepickereditted->sDatePicker), array('class'=>'form-control pull-right datepicker')) !!}
             
        </div>

    </div>
</div>

<div class="form-group">
    {!! Form::label('iDateTime', 'Date TIme', array('class'=>'col-sm-2 control-label')) !!}
    <div class="col-sm-10">
          <div class="input-group date">
                    <div class="input-group-addon">
                    <i class="fa fa-calendar"></i>
                    </div>
                      {!! Form::text('iDateTime', old('iDateTime',$datepickereditted->iDateTime), array('class'=>'form-control datetimepicker')) !!}
                      
                </div>

    </div>
</div>

<div class="form-group">
    <div class="col-sm-10 col-sm-offset-2">
      {!! Form::submit(trans('quickadmin::templates.templates-view_edit-update'), array('class' => 'btn btn-primary')) !!}
      {!! link_to_route(config('quickadmin.route').'.datepickereditted.index', trans('quickadmin::templates.templates-view_edit-cancel'), null, array('class' => 'btn btn-default')) !!}
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