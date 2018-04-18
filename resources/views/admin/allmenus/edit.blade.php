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
            <h3 class="box-title"><i class="fa fa-plus-circle fa-fw"></i>{{ trans('quickadmin::templates.templates-view_edit-edit') }}</h3>
        </div>

        {!! Form::model($allmenus, array('files' => true, ', 'id' => 'form-with-validation', 'method' => 'PATCH', 'route' => array(config('quickadmin.route').'.allmenus.update', encrypt($allmenus->id)))) !!}

        <div class="box-body">

        <div class="form-group">
    {!! Form::label('sTitle', 'Title', array('class'=>'col-sm-2 control-label')) !!}
    <div class="col-sm-10">
        {!! Form::text('sTitle', old('sTitle',$allmenus->sTitle), array('class'=>'form-control')) !!}
        <p class="help-block">option</p>
    </div>
</div><div class="form-group">
    {!! Form::label('sEmail', 'Email', array('class'=>'col-sm-2 control-label')) !!}
    <div class="col-sm-10">
        {!! Form::email('sEmail', old('sEmail',$allmenus->sEmail), array('class'=>'form-control')) !!}
        <p class="help-block">option</p>
    </div>
</div><div class="form-group">
    {!! Form::label('sNUmber', 'Number', array('class'=>'col-sm-2 control-label')) !!}
    <div class="col-sm-10">
        {!! Form::number('sNUmber', old('sNUmber',$allmenus->sNUmber), array('class'=>'form-control')) !!}
        <p class="help-block">option</p>
    </div>
</div><div class="form-group">
    {!! Form::label('sLocation', 'Location', array('class'=>'col-sm-2 control-label')) !!}
    <div class="col-sm-10">
        {!! Form::text('sLocation', old('sLocation',$allmenus->sLocation), array('class'=>'form-control map-input')) !!}
         <input id="sLocation-latitude" name="sLocation_latitude" type="hidden" value="0">
         <input id="sLocation-longitude" name="sLocation_longitude" type="hidden" value="0">
        <p class="help-block">option</p>
         <div id="sLocation-map-container" style="width:100%;height:200px; ">
               <div style="width: 100%; height: 100%" id="sLocation-map"></div>
         </div>
    </div>
</div><div class="form-group">
    {!! Form::label('sColor', 'Color', array('class'=>'col-sm-2 control-label')) !!}
    <div class="col-sm-10">
          <div class="input-group colorpicker">
                     {!! Form::text('sColor', old('sColor',$allmenus->sColor), array('class'=>'form-control')) !!}
                      <p class="help-block">option</p>
                      <div class="input-group-addon">
                         <i></i>
                      </div>
          </div>

    </div>
</div><div class="form-group">
    {!! Form::label('iTime', 'Time', array('class'=>'col-sm-2 control-label')) !!}
    <div class="col-sm-10">
          <div class="input-group">

                      {!! Form::text('iTime', old('iTime',$allmenus->iTime), array('class'=>'form-control timepicker')) !!}


                      <div class="input-group-addon">
                                           <i class="fa fa-clock-o"></i>
                                          </div>


                </div>
            <p class="help-block">option</p>
    </div>
</div><div class="form-group">
    {!! Form::label('sToggle', 'Toggle', array('class'=>'col-sm-2 control-label')) !!}
    <div class="col-sm-10">
        {!! Form::checkbox('sToggle', 1, 1, array('data-toggle'=>'toggle')) !!}
        <p class="help-block">option</p>
    </div>
</div><div class="form-group">
    {!! Form::label('books_id[]', 'Title', array('class'=>'col-sm-2 control-label')) !!}
    <div class="col-sm-10">
        {!! Form::select('books_id[]', $books, $old_books, array('class'=>'form-control select2', 'width'=>'100', 'multiple'=>'multiple')) !!}
        <p class="help-block">option</p>
    </div>
</div><div class="form-group">
    {!! Form::label('sT', 'No MCE Editor', array('class'=>'col-sm-2 control-label')) !!}
    <div class="col-sm-10">
        {!! Form::textarea('sT', old('sT',$allmenus->sT), array('class'=>'form-control mceNoEditor')) !!}
        <p class="help-block">option</p>
    </div>
</div><div class="form-group">
    {!! Form::label('sSFa', 'MCE Editor', array('class'=>'col-sm-2 control-label')) !!}
    <div class="col-sm-10">
        {!! Form::textarea('sSFa', old('sSFa',$allmenus->sSFa), array('class'=>'form-control mceEditor')) !!}
        <p class="help-block">option</p>
    </div>
</div><div class="form-group">
    {!! Form::label('sRadio', 'Radio', array('class'=>'col-sm-2 control-label')) !!}
    <div class="col-sm-10">
        {!! Form::radio('sRadio', '', false) !!}
        <p class="help-block">option</p>
    </div>
</div><div class="form-group">
    {!! Form::label('bCheckBox', 'CheckBox', array('class'=>'col-sm-2 control-label')) !!}
    <div class="col-sm-10">
        {!! Form::hidden('bCheckBox','') !!}
        {!! Form::checkbox('bCheckBox', 1, $allmenus->bCheckBox == 1) !!}
        <p class="help-block">option</p>
    </div>
</div><div class="form-group">
    {!! Form::label('bDatePicker', 'DatePicker', array('class'=>'col-sm-2 control-label')) !!}
    <div class="col-sm-10">
        <div class="input-group date">

             {!! Form::text('bDatePicker', old('bDatePicker',$allmenus->bDatePicker), array('class'=>'form-control pull-right datepicker')) !!}
              <div class="input-group-addon">
                         <i class="fa fa-calendar"></i>
                         </div>

        </div>
    <p class="help-block">option</p>
    </div>
</div>

<div class="form-group">
    {!! Form::label('bDateTimePicker', 'DateTimePicker', array('class'=>'col-sm-2 control-label')) !!}
    <div class="col-sm-10">
          <div class="input-group date">

                      {!! Form::text('bDateTimePicker', old('bDateTimePicker',$allmenus->bDateTimePicker), array('class'=>'form-control datetimepicker')) !!}
                       <div class="input-group-addon">
                                          <i class="fa fa-calendar"></i>
                                          </div>

                </div>
            <p class="help-block">option</p>
    </div>
</div><div class="form-group">
    {!! Form::label('user_id', 'Name', array('class'=>'col-sm-2 control-label')) !!}
    <div class="col-sm-10">
        {!! Form::select('user_id', $user, old('user_id',$allmenus->user_id), array('class'=>'form-control select2', 'width'=>'100')) !!}
        <p class="help-block">option</p>
    </div>
</div><div class="form-group">
    {!! Form::label('sFile', 'File', array('class'=>'col-sm-2 control-label')) !!}
    <div class="col-sm-10">
        {!! Form::file('sFile') !!}
        <p class="help-block">option</p>
    </div>
</div><div class="form-group">
    {!! Form::label('sPhoto', 'Photo', array('class'=>'col-sm-2 control-label')) !!}
    <div class="col-sm-10">
        {!! Form::file('sPhoto') !!}
        {!! Form::hidden('sPhoto_w', 4096) !!}
        {!! Form::hidden('sPhoto_h', 4096) !!}
        <p class="help-block">option</p>
    </div>
</div><div class="form-group">
    {!! Form::label('sPassword', 'Password', array('class'=>'col-sm-2 control-label')) !!}
    <div class="col-sm-10">
        {!! Form::password('sPassword', array('class'=>'form-control')) !!}
        <p class="help-block">option</p>
    </div>
</div><div class="form-group">
    {!! Form::label('dMoney', 'Money', array('class'=>'col-sm-2 control-label')) !!}
    <div class="col-sm-10">
        {!! Form::text('dMoney', old('dMoney',$allmenus->dMoney), array('class'=>'form-control')) !!}
        <p class="help-block">option</p>
    </div>
</div><div class="form-group">
    {!! Form::label('sEnum', 'Enum', array('class'=>'col-sm-2 control-label')) !!}
    <div class="col-sm-10">
        {!! Form::select('sEnum', $sEnum, old('sEnum',$allmenus->sEnum), array('class'=>'form-control select2' , 'width'=>'100')) !!}
        <p class="help-block">option</p>
    </div>
</div>

        </div>
        <div class="box-footer">
           {!! Form::submit(trans('quickadmin::templates.templates-view_edit-update'), array('class' => 'btn btn-primary')) !!}
                 {!! link_to_route(config('quickadmin.route').'.allmenus.index', trans('quickadmin::templates.templates-view_edit-cancel'), null, array('class' => 'btn btn-default')) !!}
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