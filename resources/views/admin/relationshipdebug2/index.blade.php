@extends('admin.layouts.master')

@section('content')


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

                           <th>
                            <div class="btn-group tools">
                                                           <button action="form" type="button" onclick="location.href ='{{ route(config('quickadmin.route').'.relationshipdebug2.create') }}'" class="btn btn-default btn-sm fa">+</button>
                                                           <div class="btn-group">
                                                               <button class="btn dropdown-toggle btn-default btn-sm fa fa-bars"
                                                                       data-toggle="dropdown" aria-expanded="false"></button>
                                                               <ul class="dropdown-menu pull-right ColumnToggle" role="menu">
                                                                   <li action="form" data-column="0" class="toggle-vis Checked">
                                                                       <a href="javascript:void(0)"><i class="fa fa-check"></i>ID</a>
                                                                   </li>
                                                                   <li action="form" data-column="1" class="toggle-vis Checked">
                                                                       <a href="javascript:void(0)"><i class="fa fa-check"></i>Category Name</a>
                                                                   </li>
                                                                   <li action="form" data-column="2" class="toggle-vis Checked">
                                                                       <a href="javascript:void(0)"><i class="fa fa-check"></i>Category Description</a>
                                                                   </li>
                                                                   <li action="form" data-column="3" class="toggle-vis Checked">
                                                                       <a href="javascript:void(0)"><i class="fa fa-check"></i>Photo</a>
                                                                   </li>

                                    </ul>
                               </div>
                            </div>

                           </th>
                       </tr>
                   </thead>

                   <tbody>
                       @foreach ($relationshipdebug2 as $row)
                           <tr>
                               <td>
                                   {!! Form::checkbox('del-'.$row->id,1,false,['class' => 'single','data-id'=> encrypt($row->id)]) !!}
                               </td>
                               <td>{{ isset($row->user->name) ? $row->user->name : '' }}</td>

                                <td>

                                                                <div class="btn-group tools">

                                                                    <button action="view" type="button"
                                                                            class="btn btn-default btn-sm fa fa-search"
                                                                            onclick="location.href ='#'"></button>
                                                                    <div class="btn-group">
                                                                        <button class="btn dropdown-toggle btn-default btn-sm fa fa-bars"
                                                                                data-toggle="dropdown"></button>
                                                                        <ul class="dropdown-menu pull-right" role="menu">
                                                                            <li><a href="#"><i
                                                                                            class="fa fa-pencil-square-o"></i>Edit</a></li>
                                                                            <li><a href="javascript:void(0)"><i class="fa fa-minus"></i>Delete</a>
                                                                            </li>


                                                                        </ul>
                                                                    </div>
                                                                </div>
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
               {!! Form::open(['route' => config('quickadmin.route').'.relationshipdebug2.massDelete', 'method' => 'post', 'id' => 'massDelete']) !!}
                   <input type="hidden" id="send" name="toDelete">
               {!! Form::close() !!}
   </div>
 </div>


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