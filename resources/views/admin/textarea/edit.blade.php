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

{!! Form::model($textarea, array('class' => 'form-horizontal', 'id' => 'form-with-validation', 'method' => 'PATCH', 'route' => array(config('quickadmin.route').'.textarea.update', $textarea->id))) !!}

<div class="form-group">
    {!! Form::label('password', 'Password', array('class'=>'col-sm-2 control-label')) !!}
    <div class="col-sm-10">
        {!! Form::password('password', array('class'=>'form-control')) !!}
        
    </div>
</div><div class="form-group">
    {!! Form::label('sEditor', 'Editor', array('class'=>'col-sm-2 control-label')) !!}
    <div class="col-sm-10">
        {!! Form::textarea('sEditor', old('sEditor',$textarea->sEditor), array('class'=>'form-control mceEditor')) !!}
        
    </div>

</div><div class="form-group">
    {!! Form::label('sNotEditor', 'Not Editor', array('class'=>'col-sm-2 control-label')) !!}
    <div class="col-sm-10">
        {!! Form::textarea('sNotEditor', old('sNotEditor',$textarea->sNotEditor), array('class'=>'form-control mceNoEditor')) !!}
        
    </div>
</div><div class="form-group">
    {!! Form::label('user_id', 'User*', array('class'=>'col-sm-2 control-label')) !!}
    <div class="col-sm-10">
        {!! Form::select('user_id', $user, old('user_id',$textarea->user_id), array('class'=>'form-control select2', 'width'=>'100')) !!}
        
    </div>
</div>

<div class="form-group">
    <div class="col-sm-10 col-sm-offset-2">
      {!! Form::submit(trans('quickadmin::templates.templates-view_edit-update'), array('class' => 'btn btn-primary')) !!}
      {!! link_to_route(config('quickadmin.route').'.textarea.index', trans('quickadmin::templates.templates-view_edit-cancel'), null, array('class' => 'btn btn-default')) !!}
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