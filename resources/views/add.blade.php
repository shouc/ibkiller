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
<h5 style="font-weight: 100;">Content</h5>
<form action="{{route('api.add')}}" method="post">
<br>
<div id="question">  
<textarea id="ta" name="question"><img style="width: 30px; height: 30px" src=https://ibkiller.com/storage/2018-08-19-01-56-05.png>
<br>
This is an example<br><strong>A.</strong> $ {Na}(g) \to {Na}(s) $<br><strong>B.</strong> $ 4{K}(s) + {O_2}(g) \to 2{K_2O}(s) $<br><strong>C.</strong> $ {H_2O}(s) \to {H_2O}(g) $<br><strong>D.</strong> $ {BaCO_3}(s) + 2{HCl}(aq) \to {BaCl_2}(l) + {CO_2}(g) + {H_2O}(aq) $<br></textarea>
</div>


<br>
<h5 style="font-weight: 100;">Answer</h5>
<input class="form-control" onkeyup="update()" id="answer" name="answer" type="" value="A" name="">
<br>
<div class="alert alert-success">
	Real-time Preview
</div>
<div id="show">
<img style="width: 30px; height: 30px" src=https://ibkiller.com/storage/2018-08-19-01-56-05.png>
<br>
This is an example<br><strong>A.</strong> $ {Na}(g) \to {Na}(s) $<br><strong>B.</strong> $ 4{K}(s) + {O_2}(g) \to 2{K_2O}(s) $<br><strong>C.</strong> $ {H_2O}(s) \to {H_2O}(g) $<br><strong>D.</strong> $ {BaCO_3}(s) + 2{HCl}(aq) \to {BaCl_2}(l) + {CO_2}(g) + {H_2O}(aq) $
<br>
<br><strong>Answer: </strong>A
</div>
<br>

<h5 style="font-weight: 100;">Chapter</h5>
<input class="form-control" name="chapter" type="" value="1.1" name="">
<br>
<h5 style="font-weight: 100;">Type</h5>
<input class="form-control" name="type" type="" value="1" name="">
<br>


<br>
<button type="submit" class=" col-md-12 btn btn-secondary">Add</button>

</div>
<script type="text/javascript">
	function update() {
		
	}
	function change(res) {
		document.getElementById("paper").value = res;
		
	}
</script>
<script src="/static/js/jquery.min.js"></script>
<script src="/editor/editormd.js"></script>   
<script type="text/javascript">
	function update(){
		$("#show").html(document.getElementById("ta").value + "<br><strong>Answer: </strong>" + document.getElementById("answer").value)
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
