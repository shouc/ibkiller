@include('header')
@include('nav', ['q' => true])
@include('comment')
<style type="text/css">
body {
  background-color:#fff;
}
.questionBody {
  margin-top:120px;
  word-wrap:break-word;
}
.questionContent {
  text-align:center;
  justify-content:center;
}
.line {
  background-color:#273c75;
  width:0.3em;
  height:1.5em;
  margin-left:0.725em;
  margin-top:-0.01em;
  margin-bottom:-0.1em;
  z-index:-100;
}
.ball {
  text-align:center;
  background-color:#273c75;
  width:1.75em;
  height:1.75em;
  border-radius:0.875em;
  z-index:100;
  box-shadow:1px 1px 30px #bbb;
  color:#fff;
}
.done {
  background-color:#10ac84;
  box-shadow:1px 1px 30px #1dd1a1;
}
.timeline {
  position:fixed;
  top:100px;
  left:20px;
}
.changePageButton {
  border-width:1px;
  border-color:#ccc;
  margin-top:10px;
  background-color:#fff;
  color: #000;
  font-size:19;
  font-weight:200;
}
.joinDiscussionButton {
  background-color:#fff;
  border-width:1px;
  border-color:#000;
}
.showAnswerButton {
  background-color:#fff;
  border-width:1px;
  border-color:#000;
}
.questionContainer{
    text-align: left;
    border-style: solid;
    border-width: 1px;
    border-color: #aaa;
    border-radius: 5px 0px 0px 5px;
    margin-bottom: 20px;
    border-right-width: 15px;

}
.questionText{
    margin-top: 15px;
    margin-left: 20px;
    margin-right: 20px;
}
</style>
<!--
IBO section start
-->
<style>
.question {
    margin-left: 2em
}

.blocks>.block.question .answer_space {
    border: 1px solid black;
    padding: 5px 20px;
    margin-left: 2em
}

.blocks>.block.question .markscheme {
    background-color: #EAFFF1;
    margin-left: 2em;
    padding: 1em
}

.blocks>.block.question .examiners_report {
    background-color: #EFF8FF;
    margin-left: 2em;
    padding: 1em
}

.blocks>.block.question .specification {
    margin-left: 2em
}

.blocks>.block.text_content {
    background: #fff
}

.blocks>.block>.inner {
    margin: 20px
}

.blocks>.block>.inner .edit-controls {
    position: absolute;
    top: 20px;
    right: 20px
}

.blocks>.block:hover {
    border: 1px dashed #e8e8e8
}

.blocks>.block:hover .inner .edit-controls {
    visibility: visible
}

table.block_black_border td {
    padding: 5px;
    border: 1px solid #000
}

table tr.block_header td,table td.block_header {
    font-weight: bold
}

.comment {
    *zoom: 1
}

.comment:before,.comment:after {
    display: table;
    content: "";
    line-height: 0
}

.comment:after {
    clear: both
}

.comment .meta {
    float: left;
    float: left;
    margin-left: 20px;
    width: 180px
}

.comment .meta .inner {
    margin: 0 20px 20px 0
}

.comment .body {
    float: left;
    float: left;
    margin-left: 20px;
    width: 620px
}

#filterrific_filter,#manual_filterrific_filter {
    padding: 10px
}

#filterrific_filter .control-group,#manual_filterrific_filter .control-group {
    margin-bottom: 0
}

.js-hidden_related_questions {
    display: none
}

table.meta_info {
    width: 100%
}

table.meta_info td.info_label {
    text-align: right;
    padding-right: 0.5em;
    color: #979797;
    white-space: nowrap;
    vertical-align: top
}

#question_associator.js-drag-active {
    background-color: orange
}

#question_associator.js-hover.js-drag-active {
    background-color: #59B159
}

#question_associator input.btn {
    font-size: 12px
}

.question_finder_filter {
    padding: 5px 10px;
    margin-top: -10px;
    margin-bottom: 10px
}

.question_finder_filter .control-group label.control-label {
    margin-bottom: 0;
    font-size: 12px
}

.question_finder_filter .control-group .controls input,.question_finder_filter .control-group .controls select {
    margin-bottom: 2px;
    font-size: 12px
}

.question_finder_filter .form-actions {
    margin-top: 5px;
    padding-top: 5px
}

.question_finder_filter .btn-small {
    font-size: 12px
}

.question_finder_filter #results_count {
    font-size: 12px
}

table.questions_list th {
    font-weight: bold;
    text-align: left
}

table.questions_list .specification {
    margin: 0
}

table.questions_list tr.question_group {
    border-top: 1px solid #ccc
}

table.questions_list tr.question_group td.content {
    cursor: pointer;
    position: relative;
    padding: 5px 0px 5px 20px
}

table.questions_list tr.question_group td.content .add-to-test-select {
    position: absolute;
    left: 0;
    top: 3px;
    width: 20px;
    height: 35px;
    line-height: 35px
}

table.questions_list tr.question_group td.content.collapsed .question p:first-child,table.questions_list tr.question_group td.content.collapsed .specification p:first-child {
    overflow: hidden;
    text-overflow: clip;
    white-space: nowrap;
    margin-bottom: 0 !important
}

table.questions_list tr.question_group td.content.collapsed .question p:not(:first-child),table.questions_list tr.question_group td.content.collapsed .specification p:not(:first-child) {
    display: none
}

table.questions_list tr.question_group td.content.collapsed .question img,table.questions_list tr.question_group td.content.collapsed .question table,table.questions_list tr.question_group td.content.collapsed .specification img,table.questions_list tr.question_group td.content.collapsed .specification table {
    display: none !important
}

table.questions_list tr.question_group td.content.collapsed .faded_line_end_parent {
    position: relative
}

table.questions_list tr.question_group td.content.collapsed .faded_line_end_parent .faded_line_end {
    position: absolute;
    z-index: 100;
    right: 0;
    top: 0;
    bottom: 0;
    text-align: right;
    width: 10em;
    pointer-events: none;
    background: -moz-linear-gradient(left, rgba(255,255,255,0) 0%, #fff 73%, #fff 100%);
    background: -webkit-gradient(linear, left top, right top, color-stop(0%, rgba(255,255,255,0)), color-stop(73%, #fff), color-stop(100%, #fff));
    background: -webkit-linear-gradient(left, rgba(255,255,255,0) 0%, #fff 73%, #fff 100%);
    background: -o-linear-gradient(left, rgba(255,255,255,0) 0%, #fff 73%, #fff 100%);
    background: -ms-linear-gradient(left, rgba(255,255,255,0) 0%, #fff 73%, #fff 100%);
    background: linear-gradient(to right, rgba(255,255,255,0) 0%, #fff 73%, #fff 100%);
    filter: progid:DXImageTransform.Microsoft.gradient( startColorstr='#00ffffff', endColorstr='#ffffff',GradientType=1 )
}

table.questions_list tr.meta-info {
    color: #aaa
}

table.questions_list tr.meta-info td {
    padding-bottom: 10px
}

em.search_highlight {
    background-color: yellow
}

.question_group_modal.modal {
    margin: 0 0 0 -490px;
    top: 140px;
    width: 980px
}

.question_group_modal.modal .modal-body {
    max-height: 70vh
}

.question_group_modal.modal .modal-body .marks,body.teacher.questions-show .question .marks {
    position: absolute;
    top: 0;
    right: 0;
    width: 20px;
    text-align: right;
    height: 35px;
    line-height: 35px
}

.question,.specification {
    position: relative
}

.question p:first-child,.specification p:first-child {
    min-height: 35px;
    line-height: 35px !important;
    font-size: inherit !important
}

.question .question_part_label,.specification .question_part_label {
    position: absolute;
    left: 0;
    top: 0;
    height: 35px;
    line-height: 35px
}

.question .marks,.specification .marks {
    color: #aaa
}

.lookup_value_collection {
    margin-left: 0
}

.lookup_value_collection .lookup_value_item {
    margin-bottom: 0.3em
}

.lookup_value_collection .lookup_value_item .controls {
    display: none;
    margin-left: 1em
}

.lookup_value_collection .lookup_value_item:hover {
    background-color: #fffed3
}

.lookup_value_collection .lookup_value_item:hover .controls {
    display: inline
}

.specification {
    margin-bottom: 2em
}

.inspire-tree .title-wrap a.icon {
    background: none
}

.teacher_test_action_box {
    padding: 3px 19px;
    margin-bottom: 1em
}

.teacher_test_action_box .add_content ul li {
    margin-bottom: 10px
}

.teacher_test_action_box .view_options ul li label {
    margin-bottom: 0
}

.blocks>.block.block-outline-top-level {
    margin-bottom: 3px;
    min-height: 0;
    cursor: move;
    border: 2px solid transparent
}

.blocks>.block.block-outline-top-level:hover {
    border: 2px dashed #004a8c
}

.blocks>.block.block-outline-top-level>.inner {
    margin: 2px;
    margin-right: 4px;
    margin-left: 40px;
    padding-left: 5px
}

.blocks>.block.block-outline-top-level>.inner .number_and_part {
    float: left;
    padding-right: 5px;
    line-height: 20px
}

.blocks>.block.block-outline-top-level>.inner>.question_parts .question_part {
    border: 2px solid transparent;
    border-radius: 5px
}

.blocks>.block.block-outline-top-level>.inner>.question_parts .question_part:hover {
    border: 2px dashed #128ae6
}

.blocks>.block.block-outline-top-level>.inner>.question_parts .question_part>.inner {
    margin: 2px;
    padding-left: 5px
}

.blocks>.block.block-outline-top-level>.inner>.question_parts .question_part>.inner .question {
    margin-left: 2em;
    margin-right: 2em
}

.blocks>.block.block-outline-top-level.question_group_for_outline>.inner {
    margin-left: 32px;
    margin-right: 2px
}

</style>
<body>

    <div class="questionBody" id="questionBody" style="display: none;">
      <div class="alert alert-warning alert-dismissible fade show notlogged" role="alert" id="notlogged">
        <h>You are not logged in! Your workings may not be recorded!!!</h>
        <br>
        <small>You can click button at right corner to dismiss this information or try to register or login</small>
        <button type="button" class="close" data-dismiss="alert" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>

      </div>
      <div class="questionContent">
          <div class="questionContainer">
              <p id="questionContainer" class="questionText"></p>
          </div>
        <div>
            <div class="btn-group">
              <button type="button" id="joinDiscussionButton" class="btn joinDiscussionButton">Join Discussion</button>
            </div>
            <div class="btn-group"></div>
            <div class="btn-group"></div>
            <div class="btn-group" id="showAnswerButton">
              <button type="button" class="btn showAnswerButton">Show Answer</button>
            </div>
            <div class="btn-group" id="hideAnswerButton">
              <button type="button" class="btn showAnswerButton">Hide Answer</button>
            </div>
        </div>
        <button class="btn changePageButton" id="goBack">Back</button>
        &nbsp;
        &nbsp;
        <button class="btn changePageButton" id="goNext">Next</button>
      </div>
    </div>
</body>
<form style="display: none;" action='/userCommitAnswer' method="get">
  <input name='Paper' id="subPaper" value=''>
  <input name='Answer' id="subAnswer" value=''>
  <input type='submit' id='submitAnswer'>
</form>

<timeline class="timeline"></timeline>
<script type="text/javascript">
$(function () {
    //prevent getback
    if (localStorage.getItem('already') == 0 || !localStorage.getItem('already')){
        history.pushState(null, null, document.URL);
        localStorage.setItem('already', 1);
    }
    window.addEventListener('popstate', function () {
        leave();
        history.pushState(null, null, document.URL);
    });
});
window.onbeforeunload = function(){ return 'Wrong'; };

question = $.parseJSON(BASE64.decode('{{ $data }}'));
localStorage.setItem("qnum", 0);
$("#goBack").hide();
clearRecord();
$("#questionBody").css("margin-right", (width / 15) + "px");
$("#questionBody").css("margin-left", (width / 10) + "px");
if (width < 700) {
    $("#questionBody").css("margin-left", (width / 15) + "px");
}
$("#questionBody").css("margin-bottom", (width / 15) + "px");

questionHTML = "";
timelineHTML = '<div class="ball done"><p onclick="goTo(0)">1</p></div>';
for (var i = 0; i < question.length; i++) {
    questionHTML += "<div id='q" + i + "'>" + BASE64.decode(question[i]["content"]) + "</div>";
}

$("#questionContainer").html(questionHTML);
for (var i = 1; i < question.length; i++) {
    $("#q" + i).hide();
    timelineHTML += '<div class="line" id="l' + i + '"></div> <div class="ball" id="ba' + i + '"><p onclick="goTo(' + i + ')">' + (i + 1) + '</p></div>';
}
if (question.length > 1) {
    $("timeline").html(timelineHTML);
}

if (width >= 700) {
    $("#questionBody").css("margin-right", (width / 7.5) + "px");
    $("#questionBody").css("margin-left", (width / 5) + "px");
} else {
    $("timeline").hide();
}
$("#questionBody").show();
if ($("#questionContainer").height() < height && height >= 700) {
    $("#questionBody").css("margin-top", (-$("#questionBody").height() / 2 + height / 2 - 20) + "px");
}

function submit() {
    swal({
        title: 'Done',
        text: `You could always revisit this paper at the place you find it.`,
        type: 'success',
        showCancelButton: true,
        confirmButtonColor: '#3085d6',
        cancelButtonColor: '#d33',
        confirmButtonText: 'Get Back'
    }).then((result) => {
        if (result.value) {
            url = localStorage.getItem('subject');
            clearRecord();
            window.onbeforeunload = function(){};
            if (url == 'Question'){
              localStorage.setItem('subject', '');
                localStorage.setItem('already', 0);

                window.history.go(-4);
            } else {
                localStorage.setItem('already', 0);
              
                window.history.go(-2);
            }
        }
    });
}

function goTo(i) {
    if (i > 0) {
        $("#goBack").fadeIn();
        $("#q" + localStorage.getItem("qnum")).hide();
        $("#questionBody").hide();
        ans = parseInt(localStorage.getItem(("ans" + i)));
        $("#q" + i).fadeIn();
        $("#questionBody").fadeIn();
        for (var k = question.length; k != i; k--) {
            $("#ba" + k).removeClass("done");
            $("#l" + k).removeClass("done");
        }
        for (var k = i; k != 0; k--) {
            $("#ba" + k).addClass("done");
            $("#l" + k).addClass("done");
        }
        localStorage.setItem("qnum", i);
        renderMathInElement(document.getElementById('questionContainer'), {
          delimiters: [
              {left: "$$", right: "$$", display: true},
              {left: "\\[", right: "\\]", display: true},
              {left: "$", right: "$", display: false},
              {left: "\\(", right: "\\)", display: false},

          ]
        });
    } else {
        $("#goBack").hide();
        $("#q" + localStorage.getItem("qnum")).hide();
        $("#questionBody").hide();
        ans = parseInt(localStorage.getItem("ans0"));
        $("#q" + i).fadeIn();
        $("#questionBody").fadeIn();
        for (var k = question.length; k != i; k--) {
            $("#ba" + k).removeClass("done");
            $("#l" + k).removeClass("done");
        }
        for (var k = i; k != 0; k--) {
            $("#ba" + k).addClass("done");
            $("#l" + k).addClass("done");
        }
        localStorage.setItem("qnum", i);
        renderMathInElement(document.getElementById('questionContainer'), {
          delimiters: [
              {left: "$$", right: "$$", display: true},
              {left: "\\[", right: "\\]", display: true},
              {left: "$", right: "$", display: false},
              {left: "\\(", right: "\\)", display: false},

          ]
        });
    }
}

$("#goNext").click(function () {
    if (localStorage.getItem("qnum") != question.length - 1) {
        $("#goBack").fadeIn();
        $("#q" + localStorage.getItem("qnum")).hide();
        $("#questionBody").hide();
        ans = parseInt(localStorage.getItem(("ans" + (parseInt(localStorage.getItem("qnum")) + 1))));
        $("#ba" + (parseInt(localStorage.getItem("qnum")) + 1)).addClass("done");
        $("#l" + (parseInt(localStorage.getItem("qnum")) + 1)).addClass("done");
        $("#q" + (parseInt(localStorage.getItem("qnum")) + 1)).fadeIn();
        $("#questionBody").fadeIn();
        localStorage.setItem("qnum", parseInt(localStorage.getItem("qnum")) + 1);
        $("#hideAnswerButton").click();
        closeComment();
        renderMathInElement(document.getElementById('questionContainer'), {
          delimiters: [
              {left: "$$", right: "$$", display: true},
              {left: "\\[", right: "\\]", display: true},
              {left: "$", right: "$", display: false},
              {left: "\\(", right: "\\)", display: false},

          ]
        });
    } else {
        submit();
    }
});

$('#hideAnswerButton').hide();
$("#showAnswerButton").click(function () {
    $('#questionContainer').html(`${$('#questionContainer').html()} <hr> <div style="text-align: left">${BASE64.decode(question[localStorage.getItem("qnum")]['answer'])}</div>`);
    $('#showAnswerButton').hide();
    $('#hideAnswerButton').show();
    renderMathInElement(document.getElementById('questionContainer'), {
        delimiters: [
            {left: "$$", right: "$$", display: true},
            {left: "\\[", right: "\\]", display: true},
            {left: "$", right: "$", display: false},
            {left: "\\(", right: "\\)", display: false},

        ]
      });
});
$("#hideAnswerButton").click(function () {
    $('#questionContainer').html(BASE64.decode(question[localStorage.getItem("qnum")]['content']));
    $('#hideAnswerButton').hide();
    $('#showAnswerButton').show();
    renderMathInElement(document.getElementById('questionContainer'), {
        delimiters: [
            {left: "$$", right: "$$", display: true},
            {left: "\\[", right: "\\]", display: true},
            {left: "$", right: "$", display: false},
            {left: "\\(", right: "\\)", display: false},

        ]
      });
});
$("#joinDiscussionButton").click(function () {
    openComment();
});

$("#goBack").click(function () {
    if (localStorage.getItem("qnum") > 1) {
        $("#goBack").fadeIn();
        $("#q" + localStorage.getItem("qnum")).hide();
        $("#questionBody").hide();
        ans = parseInt(localStorage.getItem(("ans" + (parseInt(localStorage.getItem("qnum")) - 1))));
        $("#q" + (parseInt(localStorage.getItem("qnum")) - 1)).fadeIn();
        $("#questionBody").fadeIn();
        $("#ba" + (parseInt(localStorage.getItem("qnum")))).removeClass("done");
        $("#l" + (parseInt(localStorage.getItem("qnum")))).removeClass("done");
        localStorage.setItem("qnum", parseInt(localStorage.getItem("qnum")) - 1);
        $("#hideAnswerButton").click();
        closeComment();
        renderMathInElement(document.getElementById('questionContainer'), {
          delimiters: [
              {left: "$$", right: "$$", display: true},
              {left: "\\[", right: "\\]", display: true},
              {left: "$", right: "$", display: false},
              {left: "\\(", right: "\\)", display: false},

          ]
        });
    } else {
        $("#goBack").hide();
        $("#q" + localStorage.getItem("qnum")).hide();
        $("#questionBody").hide();
        ans = parseInt(localStorage.getItem("ans0"));
        $("#q" + (parseInt(localStorage.getItem("qnum")) - 1)).fadeIn();
        $("#questionBody").fadeIn();
        $("#ba" + (parseInt(localStorage.getItem("qnum")))).removeClass("done");
        $("#l" + (parseInt(localStorage.getItem("qnum")))).removeClass("done");
        localStorage.setItem("qnum", parseInt(localStorage.getItem("qnum")) - 1);
        $("#hideAnswerButton").click();
        closeComment();
        renderMathInElement(document.getElementById('questionContainer'), {
          delimiters: [
              {left: "$$", right: "$$", display: true},
              {left: "\\[", right: "\\]", display: true},
              {left: "$", right: "$", display: false},
              {left: "\\(", right: "\\)", display: false},

          ]
        });
    }
});

</script>
<script>
    if(!{{$isLoggedIn ? 1 : 0}}){
      $("#notlogged").fadeIn();
      if ($("#questionContainer").height() < height && height >= 700){
        $("#questionBody").css("margin-top",(- $("#questionBody").height() / 2 + height / 2 - 40) + "px");
      }
    } 
</script>
@include('foot')
