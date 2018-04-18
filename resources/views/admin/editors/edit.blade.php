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

{!! Form::model($editors, array('class' => 'form-horizontal', 'id' => 'form-with-validation', 'method' => 'PATCH', 'route' => array(config('quickadmin.route').'.editors.update', $editors->id))) !!}

<div class="form-group">
    {!! Form::label('sNoMceEditor', 'No MCE Editor*', array('class'=>'col-sm-2 control-label')) !!}
    <div class="col-sm-10">
        {!! Form::textarea('sNoMceEditor', old('sNoMceEditor',$editors->sNoMceEditor), array('class'=>'form-control mceNoEditor')) !!}
        
    </div>
</div><div class="form-group">
    {!! Form::label('sMceEditor', 'MCE Editor', array('class'=>'col-sm-2 control-label')) !!}
    <div class="col-sm-10">
        {!! Form::textarea('sMceEditor', old('sMceEditor',$editors->sMceEditor), array('class'=>'form-control mceEditor')) !!}
        
    </div>
</div>

<div class="form-group">
    <div class="col-sm-10 col-sm-offset-2">
      {!! Form::submit(trans('quickadmin::templates.templates-view_edit-update'), array('class' => 'btn btn-primary')) !!}
      {!! link_to_route(config('quickadmin.route').'.editors.index', trans('quickadmin::templates.templates-view_edit-cancel'), null, array('class' => 'btn btn-default')) !!}
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