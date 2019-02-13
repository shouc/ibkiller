@extends('auth.layout')

@section('content')

<div class="container">
    <h3>更新题目</h3>
    <br>
    <form action="{{route('api.modify')}}" method="post">
        <h5 style="font-weight: 100;">试题内容</h5>

        <div id="question" >
<textarea id="ta" name="question">
{!!$res[1][0]->question!!}
</textarea>
        </div>
        <br>
        <h5 style="font-weight: 100;">答案</h5>
        <input type="hidden" value="{{request()->ref}}" name="ref">
        <input class="form-control" id="answer" onkeyup="update()" name="answer" type="" value="{!!$res[1][0]->answer!!}" name="">
        <br>
        <div class="alert alert-success">
            实时预览
        </div>
        <div id="show">
            {!!$res[1][0]->question!!}<br><strong>Answer: </strong>{!!$res[1][0]->answer!!}
        </div>
        <br>

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
        <h5 style="font-weight: 100;" hidden>试卷名称</h5>
        <div class="row" style="margin:0px" hidden>
            <button hidden class=" col-md-3 btn btn-primary dropdown-toggle" data-toggle="dropdown">选择</button>
            <div hidden class="dropdown-menu">
                @foreach ($res[0] as $i)
                <a class="dropdown-item" onclick="change('{{$i->paper}}')" href="#paper">{{$i->paper}}</a>
                @endforeach

            </div>
            <input hidden class="form-control col-md-9" name="paper" type="" value="{!!$res[1][0]->paper!!}" name="">
        </div>
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
<script src="/static/js/jquery.min.js"></script>
<script src="/editor/editormd.js"></script>
<script type="text/javascript">
    function update(){
        document.getElementById("show").innerHTML = document.getElementById("ta").value + "<br><strong>Answer: </strong>" + document.getElementById("answer").value;
        renderMathInElement(document.body, {delimiters:[
                {left: "$", right: "$", display: false},
            ]});
    }
    var question;

    $(function() {
        question = editormd("question", {
            width: '97%',
            height: 340,
            path : '/editor/lib/',
            theme : "day",
            watch            : true,
            codeFold         : true,
            searchReplace    : true,
            imageUpload    : true,
            imageFormats   : ["jpg", "jpeg", "gif", "png", "bmp", "webp"],
            imageUploadURL : "{{route('api.upload')}}",
            onchange : function() {
                update();
            }
        });

    });

</script>
    @endsection