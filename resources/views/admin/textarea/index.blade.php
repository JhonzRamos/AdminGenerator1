@extends('admin.layouts.master')

@section('content')

<p>{!! link_to_route(config('quickadmin.route').'.textarea.create', trans('quickadmin::templates.templates-view_index-add_new') , null, array('class' => 'btn btn-success')) !!}</p>

@if ($textarea->count())
 <div class="panel panel-default">
   <div class="panel-heading">{{ trans('quickadmin::templates.templates-view_index-list') }}</div>
   <div class="panel-body">
    <table class="table table-striped table-hover table-responsive datatable" id="datatable">
                   <thead>
                       <tr>
                           <th>
                               {!! Form::checkbox('delete_all',1,false,['class' => 'mass']) !!}
                           </th>
                           <th>User</th>

                           <th>&nbsp;</th>
                       </tr>
                   </thead>

                   <tbody>
                       @foreach ($textarea as $row)
                           <tr>
                               <td>
                                   {!! Form::checkbox('del-'.$row->id,1,false,['class' => 'single','data-id'=> $row->id]) !!}
                               </td>
                               <td>{{ isset($row->user->name) ? $row->user->name : '' }}</td>


                               <td>
                                   {!! link_to_route(config('quickadmin.route').'.textarea.edit', trans('quickadmin::templates.templates-view_index-view'), array($row->id), array('class' => 'btn btn-xs btn-default')) !!}
                                   {!! link_to_route(config('quickadmin.route').'.textarea.edit', trans('quickadmin::templates.templates-view_index-edit'), array($row->id), array('class' => 'btn btn-xs btn-info')) !!}
                                   {!! Form::open(array('style' => 'display: inline-block;', 'method' => 'DELETE', 'onsubmit' => "return confirm('".trans("quickadmin::templates.templates-view_index-are_you_sure")."');",  'route' => array(config('quickadmin.route').'.textarea.destroy', $row->id))) !!}
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
               {!! Form::open(['route' => config('quickadmin.route').'.textarea.massDelete', 'method' => 'post', 'id' => 'massDelete']) !!}
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
        (function (i, s, o, g, r, a, m) {
            i['GoogleAnalyticsObject'] = r;
            i[r] = i[r] || function () {
                        (i[r].q = i[r].q || []).push(arguments)
                    }, i[r].l = 1 * new Date();
            a = s.createElement(o),
                    m = s.getElementsByTagName(o)[0];
            a.async = 1;
            a.src = g;
            m.parentNode.insertBefore(a, m)
        })(window, document, 'script', 'https://www.google-analytics.com/analytics.js', 'ga');

        ga('create', 'UA-79616612-1', 'auto');
        ga('send', 'pageview');

    </script>
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