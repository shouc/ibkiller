@extends('auth.layout')

@section('content')
<body>
<div class="container" style="margin-bottom:50px;margin-top:80px;">
    <div class="jumbotron">
        <h1 style="font-weight:400">题目管理</h1>
        <h3 style="font-weight:200">Admin Pannel</h3>
        <a href="/admin/bulk?page=1&subject={{request()->subject ? request()->subject : 'Chemistry'}}">
            <button type="button" class="btn btn-primary" style="margin-top:20px">批量审核<span class="badge">Bulk Validation</span></button>
        </a>
    </div>
    <div class="alert alert-primary">
        你正在看的科目: {{request()->subject ? request()->subject : 'Chemistry'}}
        <br>
        <button type="button" class="btn btn-primary dropdown-toggle" style="margin-top:10px" data-toggle="dropdown">更换科目<span class="badge">Change Subject</span></button>
        <div class="dropdown-menu" id="dropdown">
            @foreach ($data as $m)
                <a class="dropdown-item" href="/admin/?subject={{$m->cat}}">{{$m->cat}}</a>
            @endforeach
        </div>
    </div>
    <div class="alert alert-success">
        <strong>试卷信息</strong> Papers
        <br>
        共有
        {{$res[0]}}
        道试题,
        {{$res[1]}}
        份试卷
        <br>


        <button type="button" class="btn btn-secondary" style="margin-top:10px" data-toggle="modal" data-target="#modal2">添加试卷<span class="badge">Add Papers</span></button>&nbsp;
        <a href="/admin/add">
            <button type="button" class="btn btn-primary" style="margin-top:10px">添加题目<span class="badge">New</span></button>
        </a>
        </a>
    </div>

    <table data-toggle="table"
           data-page-list="[10, 25, 50, 100, ALL]"
           data-pagination="true"
           data-search="true" data-url="{{route('api.papers')}}?cat={{request()->subject ? request()->subject : 'Chemistry'}}" />
    <thead>
    <tr>
        <th data-field="paper" data-sortable="true">试卷</th>
        <th data-field="_type" data-sortable="true">种类</th>
        <th data-field="subject" data-sortable="true">章节</th>
        <th data-field="subject_ref" data-sortable="true">章节id</th>
        <th data-field="totalQuestionNum" data-sortable="true">题目数量</th>
        <th data-field="condition" data-sortable="true">试卷状态</th>
        <th data-field="mod" data-sortable="true">修改</th>
    </tr>
    </thead>
    </table>
    <br>

</div>
<div class="modal fade" id="modal1" tabindex="-1" role="dialog" aria-labelledby="basicModal" aria-hidden="true">
    <div class="modal-dialog modal-lg">
        <div class="modal-content">
            <div class="modal-header">
                <h4 class="modal-title" id="mtitle"></h4>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body" id="mbody">

            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-primary" data-dismiss="modal">Close</button>
            </div>
        </div>
    </div>
</div>

<div class="modal fade" id="modal2" tabindex="-1" role="dialog" aria-labelledby="basicModal" aria-hidden="true">
    <div class="modal-dialog modal-lg">
        <div class="modal-content">
            <div class="modal-header">
                <h4 class="modal-title" id="mtitle">添加试卷</h4>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body" id="mbody">
                <h5 style="font-weight: 100;">试卷名称</h5>
                <input class="form-control" name="chapter" type="" name="">
                <br>
                <h5 style="font-weight: 100;">试卷种类(参照帮助文档)</h5>
                <input class="form-control" name="chapter" type="" name="">
                <br>
                <h5 style="font-weight: 100;">章节(输入框中为章节ID)</h5>
                <div class="row" style="margin:0px">
                    <button class="col-md-3 btn btn-primary dropdown-toggle" data-toggle="dropdown">选择</button>
                    <div class="dropdown-menu">
                        @foreach ($types as $i)
                            <a class="dropdown-item" href="#" onclick="change('{{$i->group_id}}')">{{$i->group_name}}</a>
                        @endforeach
                    </div>
                    <input name="paper" class="form-control col-md-9" id="types" type="" value="" name="">
                </div>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-primary">Add</button>
                <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
            </div>

        </div>
    </div>
</div>
</body>
<script type="text/javascript">

    function modal1(data){
        $.get('{{route("api.pm")}}?ref=' + data, function(res){
            document.getElementById("mtitle").innerHTML = window.atob((res[0]));
            document.getElementById("mbody").innerHTML = (res[1]);
            renderMathInElement(document.body, {delimiters:[
                    {left: "$", right: "$", display: false},
                ]});
        });
    }
    function del(data,sub){
        $.get('{{route("api.del")}}?ref=' + data + '&paper=' + sub, function(res){
            modal1(sub);
        });
    }
    function change(data){
        document.getElementById('types').value = data;
    }
</script>
    @endsection