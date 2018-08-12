@extends('layouts.app')

@section('content')
<div class="container">
<h3>更新题目</h3>
<br>
<form action="{{route('api.modify')}}" method="get">
<h5 style="font-weight: 100;">试题内容</h5>
<textarea class="form-control" name="question" id="ta" rows="10" onkeyup="update()">
{!!$res[1][0]->question!!}
</textarea>
<br>
<div class="alert alert-success">
	实时预览
</div>
<div id="show">
	{!!$res[1][0]->question!!}
</div>
<br><br>
<h5 style="font-weight: 100;">答案</h5>
<input type="hidden" value="{{request()->ref}}" name="ref">
<input class="form-control" name="answer" type="" value="{!!$res[1][0]->answer!!}" name="">
<br>
<h5 style="font-weight: 100;">章节</h5>
<input class="form-control" name="chapter" type="" value="{!!$res[1][0]->chapter!!}" name="">
<br>
<h5 style="font-weight: 100;">类型</h5>
<input class="form-control" name="type" type="" value="{!!$res[1][0]->type!!}" name="">
<br>
<h5 style="font-weight: 100;">分数</h5>
<input class="form-control" name="mark"  type="" value="{!!$res[1][0]->mark!!}" name="">
<br>
<h5 style="font-weight: 100;">试卷名称</h5>
<div class="row" style="margin:0px">
<button class=" col-md-3 btn btn-primary dropdown-toggle" data-toggle="dropdown">选择</button>
<div class="dropdown-menu">
	@foreach ($res[0] as $i)
		<a class="dropdown-item" onclick="change('{{$i->paper}}')" href="#paper">{{$i->paper}}</a>
	@endforeach
    
</div>
<input  class="form-control col-md-9" name="paper" type="" value="{!!$res[1][0]->paper!!}" name="">
</div>
<br>
<button class=" col-md-12 btn btn-secondary" type="submit">更新试题</button>
</div>
</form>
<script type="text/javascript">
	function update() {
		document.getElementById("show").innerHTML = document.getElementById("ta").value;
		renderMathInElement(document.body, {delimiters:[
          {left: "$", right: "$", display: false},
        ]});
	}
	function change(res) {
		document.getElementById("paper").value = res;
	}

	
</script>
@endsection