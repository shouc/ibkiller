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
    <form action="/contribute/adminAddQuestion" method="post" id="addForSubmit">
        <h5 style="font-weight: 100;">Content</h5>
        <br>
        <div id="question">  
            <textarea id="questionTA" name="question"></textarea>
        </div>
        <br>
        <h5 style="font-weight: 100;">Answer</h5>
        <div id="answer">  
            <textarea id="answerTA" name="answer"></textarea>
        </div>
        <br>
        <div class="alert alert-success">
            Real-time Preview
        </div>
        <div id="show">
            Nothing here!
        </div>

        <br>
        <input hidden name="Content" id="contentForSubmit" />
        <input hidden  name="Answer" id="answerForSubmit" />
        <input hidden  name="Paper" id="paperForSubmit" />
        <input hidden  name="Type" id="typeForSubmit" />
        <input hidden  name="QuestionType" id="questionTypeForSubmit" />

        <buttonNoEffect onclick="submit()" class="col-md-12 btn btn-dark click" style="margin-bottom: 20px">Add</buttonNoEffect>
    </form>
</div>
<script src="/static/js/jquery.min.js"></script>
<script src="/editor/editormd.js"></script>   
<script type="text/javascript">
    type=2
    paper='Trigonometry 1'
    qT='2'
	function update(){
		$("#show").html(question.getMarkdown() + "<br><strong>Answer: </strong>" + answer.getMarkdown())
		renderMathInElement(document.body, {delimiters:[
		          {left: "$", right: "$", display: false},
		        ]});
	}


	function submit(){
			$("#answerForSubmit").val(btoa(answer.getMarkdown()));
			$("#contentForSubmit").val(btoa(question.getMarkdown()));
			$("#paperForSubmit").val(paper);
			$("#typeForSubmit").val(type);
            $("#questionTypeForSubmit").val(qT);
            $('#addForSubmit').submit()

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
        answer = editormd("answer", {
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
@include('foot')
