@extends('admin.layouts.master')



 @if ($errors->any())
        	<div class="alert alert-danger">
        	    <ul>
                     {!! implode('', $errors->all('<li class="error">:message</li>')) !!}
                </ul>
        	</div>
@endif

 <div class="box">
        <div class="box-header with-border">
            <h3 class="box-title"><i class="fa fa-plus-circle fa-fw"></i>{{ trans('quickadmin::templates.templates-view_edit-edit') }}</h3>
        </div>

        {!! Form::model($relationshipdebug2, array( 'id' => 'form-with-validation', 'method' => 'PATCH', 'route' => array(config('quickadmin.route').'.relationshipdebug2.update', encrypt($relationshipdebug2->id)))) !!}

        <div class="box-body">

        <div class="form-group">
    {!! Form::label('user_id', 'User') !!}
        {!! Form::select('user_id', $user, old('user_id',$relationshipdebug2->user_id), array('class'=>'form-control select2', 'width'=>'100%')) !!}
        
</div>

        </div>
        <div class="box-footer">
           {!! Form::submit(trans('quickadmin::templates.templates-view_edit-update'), array('class' => 'btn btn-primary')) !!}
                 {!! link_to_route(config('quickadmin.route').'.relationshipdebug2.index', trans('quickadmin::templates.templates-view_edit-cancel'), null, array('class' => 'btn btn-default')) !!}
        </div>
        {!! Form::close() !!}
 </div>

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