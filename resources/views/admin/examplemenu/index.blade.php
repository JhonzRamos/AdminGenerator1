@extends('admin.layouts.master')

@section('content')

<p>{!! link_to_route(config('quickadmin.route').'.examplemenu.create', trans('quickadmin::templates.templates-view_index-add_new') , null, array('class' => 'btn btn-success')) !!}</p>

@if ($examplemenu->count())
 <div class="panel panel-default">
   <div class="panel-heading">{{ trans('quickadmin::templates.templates-view_index-list') }}</div>
   <div class="panel-body">
    <table class="table table-striped table-hover table-responsive datatable" id="datatable">
                   <thead>
                       <tr>
                           <th>
                               {!! Form::checkbox('delete_all',1,false,['class' => 'mass']) !!}
                           </th>
                           <th>Photo</th>
<th>Location</th>
<th>Toggle</th>
<th>File Upload</th>
<th>Enumeration</th>

                           <th>&nbsp;</th>
                       </tr>
                   </thead>

                   <tbody>
                       @foreach ($examplemenu as $row)
                           <tr>
                               <td>
                                   {!! Form::checkbox('del-'.$row->id,1,false,['class' => 'single','data-id'=> encrypt($row->id)]) !!}
                               </td>
                               <td>@if($row->sPhoto != '')<img src="{{ asset('uploads/thumb') . '/'.  $row->sPhoto }}">@endif</td>
<td>{{ $row->sLocation }}</td>
<td>{{ $row->bToggle }}</td>
<td>{{ HTML::link( '/uploads/'.$row->sFile, $row->sFile ) }}</td>
<td>{{ $row->oEnum }}</td>


                               <td>
                                   {!! link_to_route(config('quickadmin.route').'.examplemenu.edit', trans('quickadmin::templates.templates-view_index-view'), array(encrypt($row->id)), array('class' => 'btn btn-xs btn-default')) !!}
                                   {!! link_to_route(config('quickadmin.route').'.examplemenu.edit', trans('quickadmin::templates.templates-view_index-edit'), array(encrypt($row->id)), array('class' => 'btn btn-xs btn-info')) !!}
                                   {!! Form::open(array('style' => 'display: inline-block;', 'method' => 'DELETE', 'onsubmit' => "return confirm('".trans("quickadmin::templates.templates-view_index-are_you_sure")."');",  'route' => array(config('quickadmin.route').'.examplemenu.destroy',encrypt($row->id)))) !!}
                                   {!! Form::submit(trans('quickadmin::templates.templates-view_index-delete'), array('class' => 'btn btn-xs btn-danger')) !!}
                                   {!! Form::close() !!}
                               </td>
                           </tr>
                       @endforeach
                   </tbody>
               </table>
               <div class="row">
                   <div class="col-xs-12">
                       <button class="btn btn-danger" id="delete">
                           {{ trans('quickadmin::templates.templates-view_index-delete_checked') }}
                       </button>
                   </div>
               </div>
               {!! Form::open(['route' => config('quickadmin.route').'.examplemenu.massDelete', 'method' => 'post', 'id' => 'massDelete']) !!}
                   <input type="hidden" id="send" name="toDelete">
               {!! Form::close() !!}
   </div>
 </div>
@else
    {{ trans('quickadmin::templates.templates-view_index-no_entries_found') }}
@endif

@endsection

@section('javascript')
    <script>
        $(document).ready(function () {
            $('#delete').click(function () {
                if (window.confirm('{{ trans('quickadmin::templates.templates-view_index-are_you_sure') }}')) {
                    var send = $('#send');
                    var mass = $('.mass').is(":checked");
                    if (mass == true) {
                        send.val('mass');
                    } else {
                        var toDelete = [];
                        $('.single').each(function () {
                            if ($(this).is(":checked")) {
                                toDelete.push($(this).data('id'));
                            }
                        });
                        send.val(JSON.stringify(toDelete));
                    }
                    $('#massDelete').submit();
                }
            });
        });
    </script>
@stop