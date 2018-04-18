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

{!! Form::open(array('route' => config('quickadmin.route').'.test.store', 'id' => 'form-with-validation', 'class' => 'form-horizontal')) !!}

<div class="form-group">
    {!! Form::label('sClassification', 'Class Type', array('class'=>'col-sm-2 control-label')) !!}
    <div class="col-sm-10">
        {!! Form::select('sClassification', $sClassification, old('sClassification'), array('class'=>'form-control select2')) !!}
        
    </div>
</div><div class="form-group">
    {!! Form::label('sTitle', 'Title*', array('class'=>'col-sm-2 control-label')) !!}
    <div class="col-sm-10">
        {!! Form::text('sTitle', old('sTitle'), array('class'=>'form-control')) !!}
        
    </div>
</div><div class="form-group">
    {!! Form::label('bRadio', 'Rasio', array('class'=>'col-sm-2 control-label')) !!}
    <div class="col-sm-10">
        {!! Form::radio('bRadio', '1', false) !!}
        
    </div>
</div><div class="form-group">
    {!! Form::label('bCheck', 'Checkbox', array('class'=>'col-sm-2 control-label')) !!}
    <div class="col-sm-10">
        {!! Form::hidden('bCheck','') !!}
        {!! Form::checkbox('bCheck', 1, false) !!}
        
    </div>
</div><div class="form-group">
    {!! Form::label('fMoney', 'Money', array('class'=>'col-sm-2 control-label')) !!}
    <div class="col-sm-10">
        {!! Form::text('fMoney', old('fMoney'), array('class'=>'form-control')) !!}
        
    </div>
</div><div class="form-group">
    {!! Form::label('iDateEntry', 'Entry Date', array('class'=>'col-sm-2 control-label')) !!}
    <div class="col-sm-10">
        {!! Form::text('iDateEntry', old('iDateEntry'), array('class'=>'form-control datepicker')) !!}
        
    </div>
</div><div class="form-group">
    {!! Form::label('sEmail', 'EmailField', array('class'=>'col-sm-2 control-label')) !!}
    <div class="col-sm-10">
        {!! Form::email('sEmail', old('sEmail'), array('class'=>'form-control')) !!}
        
    </div>
</div>

<div class="form-group">
    <div class="col-sm-10 col-sm-offset-2">
      {!! Form::submit( trans('quickadmin::templates.templates-view_create-create') , array('class' => 'btn btn-primary')) !!}
    </div>
</div>

{!! Form::close() !!}

@endsection