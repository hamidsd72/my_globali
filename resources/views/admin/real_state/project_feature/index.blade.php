@extends('layouts.admin',['tbl'=>true])

    @section('content')
        <div class="row mt-5">
            <div class="col-xl-12 col-md-12 col-lg-12">
                <div class="card">
                    <div class="card-header  border-0">
                        <h4 class="w-100">
                            {{$title}}
                            <a href="{{route('admin.project-feature.create')}}" class="btn btn-primary float-left"> create </a>
                        </h4>
                    </div>

                    <div class="card-body">
                        <div class="table-responsive">
                            <table class="table table-vcenter text-nowrap table-bordered border-bottom " id="tbl_1">
                                <thead>
                                <tr>
                                    <th class="border-bottom-0">row</th>
                                    <th class="border-bottom-0">title</th>
                                    <th class="border-bottom-0">status</th>
                                    <th class="border-bottom-0">type</th>
                                    <th class="border-bottom-0">action</th>
                                </tr>
                                </thead>
                                <tbody>
                                @foreach($items as $row)
                                    <tr>
                                        <td>{{$row->id}}</td>
                                        <td>
                                            @if ($row->langs()->count())
                                                @foreach ($row->langs as $lang)
                                                    {{$lang->lang.' : '.$lang->text}}
                                                    <br>
                                                @endforeach
                                            @else
                                                __________
                                            @endif
                                        </td>
                                        <td class="text-center">
                                            @if($row->status == 'active')
                                                <span class="badge badge-success">active</span>
                                            @elseif($row->status == 'pending')
                                                <span class="badge badge-danger">deactive</span>
                                            @else

                                            @endif
                                        </td>
                                        <td class="text-center">
                                            @if($row->type == 'select')
                                                yes / no
                                            @elseif($row->type == 'number')
                                                numbers
                                            @elseif($row->type == 'text')
                                                text
                                            @else
                                                {{$row->type}}
                                            @endif
                                        </td>
                                        <td>
                                            <div class="d-flex">
                                                <a href="{{route('admin.project-feature.edit',$row->id)}}" class="action-btns1">
                                                    <i class="feather feather-edit-2  text-success" data-toggle="tooltip" data-placement="top" title="edit"></i>
                                                </a>
                                                {!! Form::open(['method' => 'DELETE', 'route' => ['admin.project-feature.destroy', $row->id] ]) !!}
                                                <button class="action-btns1" data-toggle="tooltip" data-placement="top" title="delete" onclick="return confirm('Are you sure to delete')">
                                                    <i class="feather feather-trash-2 text-danger"></i>
                                                </button>
                                                {!! Form::close() !!}
                                            </div>
                                        </td>
                                    </tr>
                                @endforeach
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
            </div>
        </div>


    @endsection