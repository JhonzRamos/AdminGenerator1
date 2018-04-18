@extends('admin.layouts.master')

@section('content')


    @if ($errors->any())
        <div class="alert alert-danger">
            <ul>
                {!! implode('', $errors->all('
                <li class="error">:message</li>
                ')) !!}
            </ul>
        </div>
    @endif
    <div class="box">
        <div class="box-header with-border">
            <h3 class="box-title"><i
                        class="fa fa-plus-circle fa-fw"></i>{{ trans('quickadmin::admin.roles-create-create_role') }}
            </h3>
        </div>
        {!! Form::open(['route' => 'roles.store']) !!}
        <div class="box-body">


            <div class="form-group">
                {!! Form::label('title', trans('quickadmin::admin.roles-create-title')) !!}
                {!! Form::text('title', old('title'), ['class'=>'form-control', 'placeholder'=> trans('quickadmin::admin.roles-create-title_placeholder')]) !!}

            </div>


        </div>
        <div class="box-footer">
            {!! Form::submit(trans('quickadmin::admin.roles-create-btncreate'), ['class' => 'btn btn-primary']) !!}
        </div>
        {!! Form::close() !!}
    </div>



@endsection


