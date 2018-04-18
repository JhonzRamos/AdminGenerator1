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

{!! Form::open(array('route' => config('quickadmin.route').'.textarea.store', 'id' => 'form-with-validation', 'class' => 'form-horizontal')) !!}

<div class="form-group">
    {!! Form::label('password', 'Password', array('class'=>'col-sm-2 control-label')) !!}
    <div class="col-sm-10">
        {!! Form::password('password', array('class'=>'form-control')) !!}
        
    </div>
</div><div class="form-group">
    {!! Form::label('sEditor', 'Editor', array('class'=>'col-sm-2 control-label')) !!}
    <div class="col-sm-10">
        {!! Form::textarea('sEditor', old('sEditor'), array('class'=>'form-control mceEditor')) !!}
        
    </div>
</div><div class="form-group">
    {!! Form::label('sNotEditor', 'Not Editor', array('class'=>'col-sm-2 control-label')) !!}
    <div class="col-sm-10">
        {!! Form::textarea('sNotEditor', old('sNotEditor'), array('class'=>'form-control mceNoEditor')) !!}
        
    </div>
</div><div class="form-group">
    {!! Form::label('user_id', 'User*', array('class'=>'col-sm-2 control-label')) !!}
    <div class="col-sm-10">
        {!! Form::select('user_id', $user, old('user_id'), array('class'=>'form-control select2', 'width'=>'100')) !!}
        
    </div>
</div>



<div class="form-group">
    <label for="locadsfas_address" class="col-sm-2 control-label">Locadsfas</label>
    <div class="col-sm-10">
        <input class="form-control map-input" id="locadsfas-input" name="locadsfas_address" type="text">
        <input id="locadsfas-latitude" name="locadsfas_latitude" type="hidden" value="0">
        <input id="locadsfas-longitude" name="locadsfas_longitude" type="hidden" value="0">
        <p class="help-block"></p>
        <div id="locadsfas-map-container" style="width:100%;height:200px; ">
            <div style="width: 100%; height: 100%" id="locadsfas-map"></div>
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
<script src="{{asset('adminlte/plugins/tinymce.js')}}"></script>
<script type="text/javascript">
    tinymce.init({
        mode : "textareas",
        editor_selector : "mceEditor",
        editor_deselector : "mceNoEditor"
    });
</script>
@endsection
