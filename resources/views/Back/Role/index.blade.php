@extends('Back.Common.app')
@section('column_url',url('role')){{--栏目链接--}}
@section('column','角色'){{--栏目名称--}}
@section('title','列表')
@section('content')
    <div class="container-fluid">
        <hr>
        <div class="row-fluid">
            <div class="span12">
                <div class="widget-box">
                    <div class="widget-content nopadding">
                        <table class="table table-bordered table-striped with-check">
                            <thead>
                            <tr>
                                <th>ID</th>
                                <th>角色</th>
                                <th>操作</th>
                            </tr>
                            </thead>
                            <tbody>
                            @foreach($list as $value)
                                <tr>
                                    <td>{{$value->id}}</td>
                                    <td>{{$value->name}}</td>
                                    <td>
                                        <a class="edit" href="{{url('role/'.$value->id.'/edit')}}">编辑</a>
                                        <form action="{{ url('role/'.$value->id) }}" method="POST" id="delete">
                                            <input name="_method" value="DELETE" type="hidden">
                                            @csrf
                                            <a class="delete" href="#" name="submit" onclick="$(this).parent().submit();return false" >删除</a>
                                            <a href="{{url('access/?rid='.$value->id)}}">访问授权</a>
                                        </form>
                                    </td>
                                </tr>
                            @endforeach
                            </tbody>
                        </table>
                    </div>
                    <div class="pagination">
                        {{$list->links()}}
                    </div>
                </div>

            </div>
        </div>
    </div>
@endsection
@section('js')
    @parent
    <script src="{{ URL::asset('/back/js/jquery.uniform.js')}}"></script>
    <script src="{{ URL::asset('/back/js/select2.min.js')}}"></script>
    <script src="{{ URL::asset('/back/js/jquery.dataTables.min.js')}}"></script>
    <script src="{{ URL::asset('/back/js/matrix.tables.js')}}"></script>
@endsection