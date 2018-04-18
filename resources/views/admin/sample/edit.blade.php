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

{!! Form::model($sample, array('files' => true, 'class' => 'form-horizontal', 'id' => 'form-with-validation', 'method' => 'PATCH', 'route' => array(config('quickadmin.route').'.sample.update', encrypt($sample->id)))) !!}

<div class="form-group">
    {!! Form::label('sTitle', 'Title*', array('class'=>'col-sm-2 control-label')) !!}
    <div class="col-sm-10">
        {!! Form::text('sTitle', old('sTitle',$sample->sTitle), array('class'=>'form-control')) !!}
        
    </div>
</div><div class="form-group">
    {!! Form::label('sEmail', 'Email', array('class'=>'col-sm-2 control-label')) !!}
    <div class="col-sm-10">
        {!! Form::email('sEmail', old('sEmail',$sample->sEmail), array('class'=>'form-control')) !!}
        
    </div>
</div><div class="form-group">
    {!! Form::label('sFile', 'File', array('class'=>'col-sm-2 control-label')) !!}
    <div class="col-sm-10">
        {!! Form::file('sFile') !!}
        
    </div>
</div><div class="form-group">
    {!! Form::label('sLocation', 'Location', array('class'=>'col-sm-2 control-label')) !!}
    <div class="col-sm-10">
        {!! Form::text('sLocation', old('sLocation',$sample->sLocation), array('class'=>'form-control map-input')) !!}
         <input id="sLocation-latitude" name="sLocation_latitude" type="hidden" value="0">
         <input id="sLocation-longitude" name="sLocation_longitude" type="hidden" value="0">
        
         <div id="sLocation-map-container" style="width:100%;height:200px; ">
               <div style="width: 100%; height: 100%" id="sLocation-map"></div>
         </div>
    </div>
</div>

<div class="form-group">
    <div class="col-sm-10 col-sm-offset-2">
      {!! Form::submit(trans('quickadmin::templates.templates-view_edit-update'), array('class' => 'btn btn-primary')) !!}
      {!! link_to_route(config('quickadmin.route').'.sample.index', trans('quickadmin::templates.templates-view_edit-cancel'), null, array('class' => 'btn btn-default')) !!}
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