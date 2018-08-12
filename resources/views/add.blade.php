@extends('layouts.app')

@section('content')
<div class="container">
<h3>添加题目</h3>
<br>
<h5 style="font-weight: 100;">试题内容</h5>
<form action="{{route('api.add')}}" method="get">
<textarea class="form-control" id="ta" name="question" rows="10" onkeyup="update()">
This is an example<br><strong>A.</strong> $ {Na}(g) \to {Na}(s) $<br><strong>B.</strong> $ 4{K}(s) + {O_2}(g) \to 2{K_2O}(s) $<br><strong>C.</strong> $ {H_2O}(s) \to {H_2O}(g) $<br><strong>D.</strong> $ {BaCO_3}(s) + 2{HCl}(aq) \to {BaCl_2}(l) + {CO_2}(g) + {H_2O}(aq) $<br>
</textarea>
<br>
<div class="alert alert-success">
	实时预览
</div>
<div id="show">
	This is an example<br><strong>A.</strong> $ {Na}(g) \to {Na}(s) $<br><strong>B.</strong> $ 4{K}(s) + {O_2}(g) \to 2{K_2O}(s) $<br><strong>C.</strong> $ {H_2O}(s) \to {H_2O}(g) $<br><strong>D.</strong> $ {BaCO_3}(s) + 2{HCl}(aq) \to {BaCl_2}(l) + {CO_2}(g) + {H_2O}(aq) $<br>
</div>
<br><br>
<h5 style="font-weight: 100;">答案</h5>
<input class="form-control" name="answer" type="" value="A" name="">
<br>
<h5 style="font-weight: 100;">章节</h5>
<input class="form-control" name="chapter" type="" value="1.1" name="">
<br>
<h5 style="font-weight: 100;">类型</h5>
<input class="form-control" name="type" type="" value="1" name="">
<br>
<h5 style="font-weight: 100;">分数</h5>
<input class="form-control" name="mark" type="" value="1" name="">
<br>
<h5 style="font-weight: 100;">试题分类</h5>
<input class="form-control" name="qtype" type="" value="1" name="">
<br>
<h5 style="font-weight: 100;">试卷名称</h5>
<div class="row" style="margin:0px">
<button class=" col-md-3 btn btn-primary dropdown-toggle" data-toggle="dropdown">选择</button>
<div class="dropdown-menu">
	@foreach ($res as $i)
		<a class="dropdown-item" onclick="change('{{$i->paper}}')" href="#paper">{{$i->paper}}</a>
	@endforeach
    
</div>
<input name="paper" class="form-control col-md-9" id="paper" type="" value="{{$res[0]->paper}}" name="">
</div>
<br>
<button type="submit" class=" col-md-12 btn btn-secondary">添加试题</button>

</div>
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