@extends('layouts.app')

@section('content')
<body>
<div class="container" style="margin-bottom:50px">
  <div class="jumbotron">
    <h1 style="font-weight:400">题目管理</h1>
    <h3 style="font-weight:200">Admin Pannel</h3>
    <a href="add">
    <button type="button" class="btn btn-primary" style="margin-top:20px">添加题目<span class="badge">New</span></button>
    </a>
    <a href="help">
    <button type="button" class="btn btn-secondary" style="margin-top:20px">帮助<span class="badge">Help</span></button>
  </a>
  </div>
  <div class="alert alert-success">
    <strong>化学题目信息</strong> Chemistry Questions
    <br>
    化学共有
        {{$res[0]}}
    道题
    <br>
    化学共有
        {{$res[1]}}
    份试卷
    <br>
    <a href="bulk?page=1">
    <button type="button" class="btn btn-primary" style="margin-top:10px">批量审核<span class="badge">Bulk Validation</span></button>
    </a>
  </div>

  <table data-toggle="table" 
  data-page-list="[10, 25, 50, 100, ALL]"
  data-pagination="true"
  data-search="true" data-url="{{route('api.questions')}}" />
    <thead>
      <tr>
          <th data-field="ok_by" data-sortable="true">负责人</th>
          <th data-field="ref" data-sortable="true">定位码</th>
          <th data-field="paper" data-sortable="true">试卷</th>
          <th data-field="chapter" data-sortable="true">章节</th>
          <th data-field="type" data-sortable="true">种类</th>
          <th data-field="answer" data-sortable="true">答案</th>
          <th data-field="mod" data-sortable="true">修改</th>
      </tr>
    </thead>
  </table>
</div>

</body>
@endsection
