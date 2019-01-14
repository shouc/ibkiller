@include('header')

@include('nav', ['q' => false])

<!--
	editor styles and files
-->
<link rel="stylesheet" href="/editor/css/editormd.css" />
<script href="/editor/editormd.js"></script>

<style type="text/css">
	.addContainer {
		margin-top: 120px;
	}
</style>
<div class="container addContainer">
    <h3>Add Question</h3>
    <br>
    <form action="/contribute/userAddQuestion" method="post" id="addForSubmit">
        <h5 style="font-weight: 100;">Content</h5>
        <br>
        <div id="question">  
            <textarea id="questionTA" name="question"></textarea>
        </div>
        <br>
        <h5 style="font-weight: 100;">Answer</h5>
        <input class="form-control" onkeyup="update()" id="questionAnswer" type="" value="" name="">
        <br>
        <div class="alert alert-success">
            Real-time Preview
        </div>
        <div id="show">
            Nothing here!
        </div>
        <br>
        <h5 style="font-weight: 100;">Chapter</h5>
        <div class="input-group">
            <select class="custom-select" id="chapterOfQuestion">
                <option selected value="0">Choose...</option>
                @foreach ($data as $i)
                <option value="{{$i->group_name}}">{{$i->group_name}}</option>
                @endforeach
            </select>
        </div>
        <br>
        <h5 style="font-weight: 100;">Type</h5>
        <div class="input-group">
            <select class="custom-select" id="typeOfQuestion">
                <option selected value="0">Choose...</option>
                <option value="1">Multiple Choice</option>
                <option value="2">Short Answer/Essay</option>
            </select>
        </div>
        <br>
        <input hidden name="Content" id="contentForSubmit" />
        <input hidden  name="Answer" id="answerForSubmit" />
        <input hidden  name="Chapter" id="chapterForSubmit" />
        <input hidden  name="Type" id="typeForSubmit" />
        <input hidden  name="Subject" id="subjectForSubmit" />

        <buttonNoEffect onclick="submit()" class="col-md-12 btn btn-dark click" style="margin-bottom: 20px">Add</buttonNoEffect>
    </form>
</div>
<script src="/static/js/jquery.min.js"></script>
<script src="/editor/editormd.js"></script>   
<script type="text/javascript">
	function update(){
		$("#show").html(document.getElementById("questionTA").value + "<br><strong>Answer: </strong>" + document.getElementById("questionAnswer").value)
		renderMathInElement(document.body, {delimiters:[
		          {left: "$", right: "$", display: false},
		        ]});
	}

	function checkVal(){
		if (question.getMarkdown() == ""){
			alert('No question content provided!');
			return 0;
		}
		if ($("#questionAnswer").val() == ""){
			alert('No question answer provided!');
			return 0;
		}
		if ($("#chapterOfQuestion").val() == 0){
			alert('No chapter provided!');
			return 0;
		}
		if ($("#typeOfQuestion").val() == 0){
			alert('No question type provided!');
			return 0;
		}
		if ($("#typeOfQuestion").val() == 1 && $("#questionAnswer").val().length != 1){
			alert('Multiple can only select from A-E.');
			return 0;
		}
		return $("#typeOfQuestion").val();
	}

	function submit(){
		success = checkVal();
		if (success != 0){
			if (success == 1){
				$("#answerForSubmit").val(btoa($("#questionAnswer").val().toUpperCase()));
			} else {
				$("#answerForSubmit").val(btoa($("#questionAnswer").val()));
			}
			$("#contentForSubmit").val(btoa(question.getMarkdown()));
			$("#chapterForSubmit").val($("#chapterOfQuestion").val());
			$("#typeForSubmit").val($("#typeOfQuestion").val());
			$("#subjectForSubmit").val($_GET['Subject']);
			$("#addForSubmit").submit();
		}
	}

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
		    imageUploadURL : "/contribute/upload",
            onchange : function() {
            	update();
            }
        });
        
    });

</script>
