@extends('admin.layouts.master')

@section('content')


 @if ($errors->any())
        	<div class="alert alert-danger">
        	    <ul>
                    {!! implode('', $errors->all('<li class="error">:message</li>')) !!}
                </ul>
        	</div>
@endif

 <div class="box">
        <div class="box-header with-border">
            <h3 class="box-title"><i class="fa fa-plus-circle fa-fw"></i>{{ trans('quickadmin::templates.templates-view_create-add_new') }}</h3>
        </div>
        {!! Form::open(array('route' => config('quickadmin.route').'.relationshipdebug3.store', 'id' => 'form-with-validation', )) !!}
        <div class="box-body">

        <div class="form-group">
    {!! Form::label('relationship_id', 'User') !!}
        {!! Form::select('relationship_id', $relationship, old('relationship_id'), array('class'=>'form-control select2', 'width'=>'100%')) !!}
        
</div>

        </div>
        <div class="box-footer">
            {!! Form::submit( trans('quickadmin::templates.templates-view_create-create') , array('class' => 'btn btn-primary')) !!}
        </div>
        {!! Form::close() !!}
 </div>



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