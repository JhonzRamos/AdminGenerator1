@extends('admin.layouts.master')

@section('content')

<p>{!! link_to_route(config('quickadmin.route').'.favorite24.create', trans('quickadmin::templates.templates-view_index-add_new') , null, array('class' => 'btn btn-success')) !!}</p>

@if ($favorite24->count())
 <div class="panel panel-default">
   <div class="panel-heading">{{ trans('quickadmin::templates.templates-view_index-list') }}</div>
   <div class="panel-body">
    <table class="table table-striped table-hover table-responsive datatable" id="datatable">
                   <thead>
                       <tr>
                           <th>
                               {!! Form::checkbox('delete_all',1,false,['class' => 'mass']) !!}
                           </th>
                           <th>Title</th>
<th>Photo</th>
<th>Books</th>

                           <th>&nbsp;</th>
                       </tr>
                   </thead>

                   <tbody>
                       @foreach ($favorite24 as $row)
                           <tr>
                               <td>
                                   {!! Form::checkbox('del-'.$row->id,1,false,['class' => 'single','data-id'=> encrypt($row->id)]) !!}
                               </td>
                               <td>{{ $row->sTitle }}</td>
<td>@if($row->sPhoto != '')<img src="{{ asset('uploads/thumb') . '/'.  $row->sPhoto }}">@endif</td>
<td> @forelse($row->books as $key) <span class="label label-primary">{{$key->books->sTitle}}</span> @empty Empty @endforelse </td>

                               <td>
                                   {!! link_to_route(config('quickadmin.route').'.favorite24.edit', trans('quickadmin::templates.templates-view_index-view'), array(encrypt($row->id)), array('class' => 'btn btn-xs btn-default')) !!}
                                   {!! link_to_route(config('quickadmin.route').'.favorite24.edit', trans('quickadmin::templates.templates-view_index-edit'), array(encrypt($row->id)), array('class' => 'btn btn-xs btn-info')) !!}
                                   {!! Form::open(array('style' => 'display: inline-block;', 'method' => 'DELETE', 'onsubmit' => "return confirm('".trans("quickadmin::templates.templates-view_index-are_you_sure")."');",  'route' => array(config('quickadmin.route').'.favorite24.destroy',encrypt($row->id)))) !!}
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
               {!! Form::open(['route' => config('quickadmin.route').'.favorite24.massDelete', 'method' => 'post', 'id' => 'massDelete']) !!}
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