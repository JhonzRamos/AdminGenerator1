@extends('admin.layouts.master')

@section('content')



 <div class="box">
        <div class="box-header with-border">
            <h3 class="box-title"><i class="fa fa-plus-circle fa-fw"></i>{{ trans('quickadmin::templates.templates-view_create-add_new') }}</h3>
        </div>
        {!! Form::open(array('route' => config('quickadmin.route').'.relationshipdebug2.store', 'id' => 'form-with-validation', )) !!}
        <div class="box-body">

        <div class="form-group">
    {!! Form::label('user_id', 'User') !!}
        {!! Form::select('user_id', $user, old('user_id'), array('class'=>'form-control select2', 'width'=>'100%')) !!}
        
</div>

        </div>
        <div class="box-footer">
            {!! Form::submit( trans('quickadmin::templates.templates-view_create-create') , array('class' => 'btn btn-primary')) !!}
        </div>
        {!! Form::close() !!}
 </div>



@endsectio

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