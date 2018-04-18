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

{!! Form::model($examplemenu, array('files' => true, 'class' => 'form-horizontal', 'id' => 'form-with-validation', 'method' => 'PATCH', 'route' => array(config('quickadmin.route').'.examplemenu.update', encrypt($examplemenu->id)))) !!}

<div class="form-group">
    {!! Form::label('sPhoto', 'Photo', array('class'=>'col-sm-2 control-label')) !!}
    <div class="col-sm-10">
        {!! Form::file('sPhoto') !!}
        {!! Form::hidden('sPhoto_w', 4096) !!}
        {!! Form::hidden('sPhoto_h', 4096) !!}
        
    </div>
</div><div class="form-group">
    {!! Form::label('sLocation', 'Location*', array('class'=>'col-sm-2 control-label')) !!}
    <div class="col-sm-10">
        {!! Form::text('sLocation', old('sLocation',$examplemenu->sLocation), array('class'=>'form-control map-input')) !!}
         <input id="sLocation-latitude" name="sLocation_latitude" type="hidden" value="0">
         <input id="sLocation-longitude" name="sLocation_longitude" type="hidden" value="0">
        
         <div id="sLocation-map-container" style="width:100%;height:200px; ">
               <div style="width: 100%; height: 100%" id="sLocation-map"></div>
         </div>
    </div>
</div><div class="form-group">
    {!! Form::label('bToggle', 'Toggle*', array('class'=>'col-sm-2 control-label')) !!}
    <div class="col-sm-10">
        {!! Form::checkbox('bToggle', 1, 1, array('data-toggle'=>'toggle')) !!}
        
    </div>
</div><div class="form-group">
    {!! Form::label('sDesc', 'with Editor*', array('class'=>'col-sm-2 control-label')) !!}
    <div class="col-sm-10">
        {!! Form::textarea('sDesc', old('sDesc',$examplemenu->sDesc), array('class'=>'form-control mceEditor')) !!}
        
    </div>
</div><div class="form-group">
    {!! Form::label('sDesc2', 'without Editor*', array('class'=>'col-sm-2 control-label')) !!}
    <div class="col-sm-10">
        {!! Form::textarea('sDesc2', old('sDesc2',$examplemenu->sDesc2), array('class'=>'form-control mceNoEditor')) !!}
        
    </div>
</div><div class="form-group">
    {!! Form::label('sFile', 'File Upload', array('class'=>'col-sm-2 control-label')) !!}
    <div class="col-sm-10">
        {!! Form::file('sFile') !!}
        
    </div>
</div><div class="form-group">
    {!! Form::label('oEnum', 'Enumeration*', array('class'=>'col-sm-2 control-label')) !!}
    <div class="col-sm-10">
        {!! Form::select('oEnum', $oEnum, old('oEnum',$examplemenu->oEnum), array('class'=>'form-control select2' , 'width'=>'100')) !!}
        
    </div>
</div><div class="form-group">
    {!! Form::label('sPassword', 'Password', array('class'=>'col-sm-2 control-label')) !!}
    <div class="col-sm-10">
        {!! Form::password('sPassword', array('class'=>'form-control')) !!}
        
    </div>
</div>



<div class="form-group">
    <div class="col-sm-10 col-sm-offset-2">
      {!! Form::submit(trans('quickadmin::templates.templates-view_edit-update'), array('class' => 'btn btn-primary')) !!}
      {!! link_to_route(config('quickadmin.route').'.examplemenu.index', trans('quickadmin::templates.templates-view_edit-cancel'), null, array('class' => 'btn btn-default')) !!}
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