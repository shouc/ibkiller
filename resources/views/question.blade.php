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
    display: none;
}
.questionContent {
    text-align:center;
    justify-content:center;
}
.choiceButton {
    margin-top:10px;
    background-color:#fff;
    width:50px;
    height:50px;
    border-width:1px;
    border-color:#999;
    font-size:20;
    font-weight:300;
    margin-right:10px;
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
    color:#000;
    font-size:19;
    font-weight:200;
    background-color:#fff;
    color: #000;
}
</style>
<body>
    <div class="questionBody" id="questionBody">
      <div class="alert alert-warning alert-dismissible fade show notlogged" role="alert" id="notlogged">
        <h>You are not logged in! Your workings may not be recorded!!!</h>
        <br>
        <small>You can click button at right corner to dismiss this information or try to register or login</small>
        <button type="button" class="close" data-dismiss="alert" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="questionContent">
        <div><p class="q-c" id="questionContainer"></p></div>
        <div >
            <div class="btn-group">
              <button type="button" id="buttonForAnswerA" class="btn choiceButton">A</button>
            </div>
            <div class="btn-group"></div>
            <div class="btn-group"></div>
            <div class="btn-group">
              <button type="button" id="buttonForAnswerB" class="btn choiceButton">B</button>
            </div>
            <div class="btn-group"></div>
            <div class="btn-group"></div>
            <div class="btn-group">
              <button type="button" id="buttonForAnswerC" class="btn choiceButton">C</button>
            </div>
            <div class="btn-group"></div>
            <div class="btn-group"></div>
            <div class="btn-group">
              <button type="button" id="buttonForAnswerD" class="btn choiceButton">D</button>
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

question = $.parseJSON(window.atob('{{ $data }}'));
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
    questionHTML += "<div id='q" + i + "'>" + window.atob(question[i]["content"]) + "</div>";
}
$("#questionContainer").html(questionHTML);
for (var i = 1; i < question.length; i++) {
    $("#q" + i).hide();
    timelineHTML += '<div class="line" id="l' + i + '"></div> <div class="ball" id="ba' + i + '"><p onclick="goTo(' + i + ')">' + (i + 1) + '</p></div>';
}
$("timeline").html(timelineHTML);
if ($("#questionContainer").height() < height && height >= 700) {
    $("#questionBody").css("margin-top", (-$("#questionBody").height() / 2 + height / 2 - 20) + "px");
}
if (width >= 700) {
    $("#questionBody").css("margin-right", (width / 7.5) + "px");
    $("#questionBody").css("margin-left", (width / 5) + "px");
} else {
    $("timeline").hide();
}

$("#questionBody").show();


function submit() {
    arr = '{"answer" : ['
    for (var i = 0; i < question.length; i++) {
        arr += `["${i}", "${localStorage.getItem("ans" + i)}", "${localStorage.getItem("ans" + i) == convertSymb(window.atob(question[i]["answer"])) ? 1 : 0}"]`
        if (i != question.length - 1) {
            arr += ",";
        }
    }
    answer = arr + "]}";
    paper = window.atob($_GET['Paper']);
    $('#subPaper').val(paper);
    $('#subAnswer').val(answer);
    swal({
        title: 'Done!',
        text: 'We will lead you to review your answers!',
        type: 'success',
        showCancelButton: true,
        confirmButtonColor: '#3085d6',
        cancelButtonColor: '#d33',
        confirmButtonText: 'Check Answers'
    }).then((result) => {
        if (result.value) {
            clearRecord();
            window.onbeforeunload = function(){};
            localStorage.setItem('subject', 'Question');
            localStorage.setItem('already', 0);
            $('#submitAnswer').click();
        }
    });
}

function goTo(i) {
    if (parseInt(localStorage.getItem("ans" + i)) == 10) {
        alert("Why not finish the foregoing part first!");
    } else {
        if (i > 0) {
            $("#goBack").fadeIn();
            $("#q" + localStorage.getItem("qnum")).hide();
            $("#questionBody").hide();
            ans = parseInt(localStorage.getItem(("ans" + i)));
            changeColor("buttonForAnswerA", ans == 0);
            changeColor("buttonForAnswerB", ans == 1);
            changeColor("buttonForAnswerC", ans == 2);
            changeColor("buttonForAnswerD", ans == 3);
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
        } else {
            $("#goBack").hide();
            $("#q" + localStorage.getItem("qnum")).hide();
            $("#questionBody").hide();
            ans = parseInt(localStorage.getItem("ans0"));
            changeColor("buttonForAnswerA", ans == 0);
            changeColor("buttonForAnswerB", ans == 1);
            changeColor("buttonForAnswerC", ans == 2);
            changeColor("buttonForAnswerD", ans == 3);
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
        }
    }
}

$("#goNext").click(function () {
    if (localStorage.getItem("qnum") != question.length - 1) {
        $("#goBack").fadeIn();
        $("#q" + localStorage.getItem("qnum")).hide();
        $("#questionBody").hide();
        ans = parseInt(localStorage.getItem(("ans" + (parseInt(localStorage.getItem("qnum")) + 1))));
        changeColor("buttonForAnswerA", ans == 0);
        changeColor("buttonForAnswerB", ans == 1);
        changeColor("buttonForAnswerC", ans == 2);
        changeColor("buttonForAnswerD", ans == 3);
        $("#ba" + (parseInt(localStorage.getItem("qnum")) + 1)).addClass("done");
        $("#l" + (parseInt(localStorage.getItem("qnum")) + 1)).addClass("done");
        $("#buttonForAnswerD").css("color", "#000");
        $("#q" + (parseInt(localStorage.getItem("qnum")) + 1)).fadeIn();
        $("#questionBody").fadeIn();
        localStorage.setItem("qnum", parseInt(localStorage.getItem("qnum")) + 1);
        closeComment();
    } else {
        submit();
    }
});


$("#goBack").click(function () {
    if (localStorage.getItem("qnum") > 1) {
        $("#goBack").fadeIn();
        $("#q" + localStorage.getItem("qnum")).hide();
        $("#questionBody").hide();
        ans = parseInt(localStorage.getItem(("ans" + (parseInt(localStorage.getItem("qnum")) - 1))));
        changeColor("buttonForAnswerA", ans == 0);
        changeColor("buttonForAnswerB", ans == 1);
        changeColor("buttonForAnswerC", ans == 2);
        changeColor("buttonForAnswerD", ans == 3);
        $("#q" + (parseInt(localStorage.getItem("qnum")) - 1)).fadeIn();
        $("#questionBody").fadeIn();
        $("#ba" + (parseInt(localStorage.getItem("qnum")))).removeClass("done");
        $("#l" + (parseInt(localStorage.getItem("qnum")))).removeClass("done");
        localStorage.setItem("qnum", parseInt(localStorage.getItem("qnum")) - 1);
        closeComment();
    } else {
        $("#goBack").hide();
        $("#q" + localStorage.getItem("qnum")).hide();
        $("#questionBody").hide();
        ans = parseInt(localStorage.getItem("ans0"));
        changeColor("buttonForAnswerA", ans == 0);
        changeColor("buttonForAnswerB", ans == 1);
        changeColor("buttonForAnswerC", ans == 2);
        changeColor("buttonForAnswerD", ans == 3);
        $("#q" + (parseInt(localStorage.getItem("qnum")) - 1)).fadeIn();
        $("#questionBody").fadeIn();
        $("#ba" + (parseInt(localStorage.getItem("qnum")))).removeClass("done");
        $("#l" + (parseInt(localStorage.getItem("qnum")))).removeClass("done");
        localStorage.setItem("qnum", parseInt(localStorage.getItem("qnum")) - 1);
        closeComment();
    }
});

$("#buttonForAnswerA").click(function () {
    changeColor('buttonForAnswerA', 1);
    changeColor('buttonForAnswerB', 0);
    changeColor('buttonForAnswerC', 0);
    changeColor('buttonForAnswerD', 0);
    localStorage.setItem("ans" + localStorage.getItem("qnum"), parseInt(0));
});
$("#buttonForAnswerB").click(function () {
    changeColor('buttonForAnswerA', 0);
    changeColor('buttonForAnswerB', 1);
    changeColor('buttonForAnswerC', 0);
    changeColor('buttonForAnswerD', 0);
    localStorage.setItem("ans" + localStorage.getItem("qnum"), parseInt(1));
});
$("#buttonForAnswerC").click(function () {
    changeColor('buttonForAnswerA', 0);
    changeColor('buttonForAnswerB', 0);
    changeColor('buttonForAnswerC', 1);
    changeColor('buttonForAnswerD', 0);
    localStorage.setItem("ans" + localStorage.getItem("qnum"), parseInt(2));
});
$("#buttonForAnswerD").click(function () {
    changeColor('buttonForAnswerA', 0);
    changeColor('buttonForAnswerB', 0);
    changeColor('buttonForAnswerC', 0);
    changeColor('buttonForAnswerD', 1);
    localStorage.setItem("ans" + localStorage.getItem("qnum"), parseInt(3));
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
