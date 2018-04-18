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

        {!! Form::model($updatedmenus, array('files' => true, 'id' => 'form-with-validation', 'method' => 'PATCH', 'route' => array(config('quickadmin.route').'.updatedmenus.update', encrypt($updatedmenus->id)))) !!}

        <div class="box-body">

        <div class="form-group">
    {!! Form::label('sTitle') !!}
        {!! Form::text('sTitle', old('sTitle',$updatedmenus->sTitle), array('class'=>'form-control')) !!}
        <p class="help-block">option</p>
</div><div class="form-group">
    {!! Form::label('sEmail', 'EmailField') !!}

        {!! Form::email('sEmail', old('sEmail',$updatedmenus->sEmail), array('class'=>'form-control')) !!}
        <p class="help-block">option</p>

</div><div class="form-group">
    {!! Form::label('iNumber', 'Number') !!}

        {!! Form::number('iNumber', old('iNumber',$updatedmenus->iNumber), array('class'=>'form-control')) !!}
        <p class="help-block">option</p>
</div><div class="form-group">
    {!! Form::label('sLocation', 'Location') !!}

        {!! Form::text('sLocation', old('sLocation',$updatedmenus->sLocation), array('class'=>'form-control map-input')) !!}
         <input id="sLocation-latitude" name="sLocation_latitude" type="hidden" value="0">
         <input id="sLocation-longitude" name="sLocation_longitude" type="hidden" value="0">
        <p class="help-block">option</p>
         <div id="sLocation-map-container" style="width:100%;height:200px; ">
               <div style="width: 100%; height: 100%" id="sLocation-map"></div>
         </div>

</div><div class="form-group">
    {!! Form::label('sColor', 'Color') !!}
          <div class="input-group colorpicker">
                     {!! Form::text('sColor', old('sColor',$updatedmenus->sColor), array('class'=>'form-control')) !!}

                      <div class="input-group-addon">
                         <i></i>
                      </div>
          </div>
           <p class="help-block">option</p>
</div><div class="form-group">
    {!! Form::label('iTime', 'Time') !!}
          <div class="input-group">

                      {!! Form::text('iTime', old('iTime',$updatedmenus->iTime), array('class'=>'form-control timepicker')) !!}


                      <div class="input-group-addon">
                                           <i class="fa fa-clock-o"></i>
                                          </div>


                </div>
            <p class="help-block">option</p>
</div><div class="form-group">
    {!! Form::label('bToggle', 'Toggle') !!}
        {!! Form::checkbox('bToggle', 1, 1, array('data-toggle'=>'toggle')) !!}
        <p class="help-block">option</p>
</div><div class="form-group">
    {!! Form::label('books_id[]', 'Belongs To Many') !!}
        {!! Form::select('books_id[]', $books, $old_books, array('class'=>'form-control select2', 'width'=>'100', 'multiple'=>'multiple')) !!}
        <p class="help-block">option</p>
</div><div class="form-group">
    {!! Form::label('sMCE', 'MCE') !!}
        {!! Form::textarea('sMCE', old('sMCE',$updatedmenus->sMCE), array('class'=>'form-control mceEditor')) !!}
        <p class="help-block">option</p>
</div><div class="form-group">
    {!! Form::label('sNoMCE', 'NoMCE') !!}
        {!! Form::textarea('sNoMCE', old('sNoMCE',$updatedmenus->sNoMCE), array('class'=>'form-control mceNoEditor')) !!}
        <p class="help-block">option</p>
</div><div class="form-group">
    {!! Form::label('bRadio', 'Radio') !!}
        {!! Form::radio('bRadio', 'Cool?', false) !!}
        <p class="help-block">option</p>
</div><div class="form-group">
    {!! Form::label('bCheckBox', 'CheckBox' ) !!}
        {!! Form::hidden('bCheckBox','') !!}
        {!! Form::checkbox('bCheckBox', 1, $updatedmenus->bCheckBox == 1) !!}
        <p class="help-block">option</p>
</div><div class="form-group">
    {!! Form::label('iDAtePicker', 'Date Picker') !!}

        <div class="input-group date">

             {!! Form::text('iDAtePicker', old('iDAtePicker',$updatedmenus->iDAtePicker), array('class'=>'form-control pull-right datepicker')) !!}
              <div class="input-group-addon">
                         <i class="fa fa-calendar"></i>
                         </div>

        </div>
    <p class="help-block">option</p>
</div>

<div class="form-group">
    {!! Form::label('iDateTime', 'Date TIme') !!}

          <div class="input-group date">

                      {!! Form::text('iDateTime', old('iDateTime',$updatedmenus->iDateTime), array('class'=>'form-control datetimepicker')) !!}
                       <div class="input-group-addon">
                                          <i class="fa fa-calendar"></i>
                                          </div>

                </div>
            <p class="help-block">option</p>

</div><div class="form-group">
    {!! Form::label('user_id', 'Relationship') !!}
        {!! Form::select('user_id', $user, old('user_id',$updatedmenus->user_id), array('class'=>'form-control select2', 'width'=>'100')) !!}
        <p class="help-block">option</p>
</div><div class="form-group">
    {!! Form::label('sFileUpload', 'File Upload') !!}
        {!! Form::file('sFileUpload') !!}
        <p class="help-block">option</p>

</div><div class="form-group">
    {!! Form::label('sPhoto', 'Photo') !!}
        {!! Form::file('sPhoto') !!}
        {!! Form::hidden('sPhoto_w', 4096) !!}
        {!! Form::hidden('sPhoto_h', 4096) !!}
        

</div><div class="form-group">
    {!! Form::label('sPassword', 'Password') !!}
        {!! Form::password('sPassword', array('class'=>'form-control')) !!}
        <p class="help-block">option</p>
</div><div class="form-group">
    {!! Form::label('dMoney', 'Money', array('class'=>'col-sm-2 control-label')) !!}
    <div class="col-sm-10">
        {!! Form::text('dMoney', old('dMoney',$updatedmenus->dMoney), array('class'=>'form-control')) !!}
        <p class="help-block">option</p>
    </div>
</div><div class="form-group">
    {!! Form::label('aEnum', 'Enumeration') !!}
        {!! Form::select('aEnum', $aEnum, old('aEnum',$updatedmenus->aEnum), array('class'=>'form-control select2' , 'width'=>'100')) !!}
        <p class="help-block">option</p>
</div>

        </div>
        <div class="box-footer">
           {!! Form::submit(trans('quickadmin::templates.templates-view_edit-update'), array('class' => 'btn btn-primary')) !!}
                 {!! link_to_route(config('quickadmin.route').'.updatedmenus.index', trans('quickadmin::templates.templates-view_edit-cancel'), null, array('class' => 'btn btn-default')) !!}
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