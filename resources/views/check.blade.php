@include('header')
@include('nav', ['q' => true])
@include('comment')

<style type="text/css">
body {
  background-color: #fff;
}

.checkContainer {
  margin-top:120px;
  text-align: center;
  justify-content: center;
  display: none;
}
.line{
  background-color: #273c75;
  width: 0.3em;
  height: 1.5em;
  margin-left: 0.725em;
  margin-top: -0.01em;
  margin-bottom: -0.1em;
  z-index: -100;
}
.ball {
  text-align: center;
  background-color: #273c75;
  width: 1.75em;
  height: 1.75em;
  border-radius: 0.875em;
  z-index: 100;
  box-shadow: 1px 1px 30px #bbb;
  color: #fff;
}
.done {
  background-color: #10ac84;
  box-shadow: 1px 1px 30px #1dd1a1
}
.timeline {
  position: fixed;
  top: 100px;
  left: 20px;
}

.changePageButton {
    border-width: 1px;
    border-color: #ccc;
    margin-top: 10px;
    color: #000;
    font-size: 19;
    font-weight: 200;
}
.userAnswerBar {
  height: 55px;
  border-top-right-radius: 10px;
  border-top-left-radius: 10px;
  background-color: #00b894;
}
.correntAnswerBar {
  height: 55px;
  border-bottom-right-radius: 10px;
  border-bottom-left-radius: 10px;
  background-color: #ffeaa7;
}
.userAnswerContent {
  float: left;
  margin-left: 15px;
  margin-top: 4px;
  color: #fff;
  font-size: 18;
}
.wrong {
  background-color:#e17055;
}
.correctAnswerContent {
  float: left;
  margin-left: 15px;
  margin-top: 4px;
  color: #666;
  font-size: 18;
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
<body>
    <div class="checkContainer" id="question">
        <div class="alert alert-warning alert-dismissible fade show notlogged" role="alert" id="notlogged">
            <h>You are not logged in! Your workings may not be recorded!!!</h>
            <br>
            <small>You can click button at right corner to dismiss this information or try to register or login</small>
            <button type="button" class="close" data-dismiss="alert" aria-label="Close">
              <span aria-hidden="true">&times;</span>
            </button>

        </div>
        <div class="questionContainer">
            <p id="questionContainer" class="questionText"></p>
        </div>
        <div class="userAnswerBar" id="userAnswerBar">
          <p class="userAnswerContent">Your Answer: <userAnswer></userAnswer></p>
        </div>
        <div class="correntAnswerBar" id="correctAnswerBar">
          <p class="correctAnswerContent">Correct Answer: <correctAnswer></correctAnswer></p>

        </div>
        <button class="btn changePageButton" id="goBack">Back</button>
        &nbsp;
        &nbsp;
        <button class="btn changePageButton" id="goNext">Next</button>
    </div>
</body>
<timeline class="timeline"></timeline>
<script type="text/javascript">
$("#notlogged").hide();
window.onbeforeunload = function(){ return 'Wrong'; };

question = $.parseJSON(BASE64.decode('{{ $data }}'))["info"];
score = $.parseJSON(BASE64.decode('{{ $data }}'))["score"];
localStorage.setItem("qnum", 0);
$("#goBack").hide();
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

function submit() {
    swal({
        title: 'Done',
        text: `Your score is expected to be ${score}/${question.length}!`,
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
        $("#question").hide();
        $("#q" + i).fadeIn();
        $("#question").fadeIn();
        for (var k = question.length; k != i; k--) {
            $("#ba" + k).removeClass("done");
            $("#l" + k).removeClass("done");
        }
        for (var k = i; k != 0; k--) {
            $("#ba" + k).addClass("done");
            $("#l" + k).addClass("done");
        }
        if (!question[i]["correct"]) {
            $("#userAnswerBar").addClass("wrong");
        } else {
            $("#userAnswerBar").removeClass("wrong");
        }
        $("userAnswer").html(convertNum(question[i]["userAnswer"]));
        $("correctAnswer").html(BASE64.decode(question[i]["answer"]));
        localStorage.setItem("qnum", i);
    } else {
        $("#goBack").hide();
        $("#q" + localStorage.getItem("qnum")).hide();
        $("#q" + i).fadeIn();
        $("#question").fadeIn();
        for (var k = question.length; k != i; k--) {
            $("#ba" + k).removeClass("done");
            $("#l" + k).removeClass("done");
        }
        for (var k = i; k != 0; k--) {
            $("#ba" + k).addClass("done");
            $("#l" + k).addClass("done");
        }
        if (!question[i]["correct"]) {
            $("#userAnswerBar").addClass("wrong");
        } else {
            $("#userAnswerBar").removeClass("wrong");
        }
        $("userAnswer").html(convertNum(question[i]["userAnswer"]));
        $("correctAnswer").html(BASE64.decode(question[i]["answer"]));
        localStorage.setItem("qnum", i);
    }

}
$("#goNext").click(function () {

    if (localStorage.getItem("qnum") != question.length - 1) {
        $("#goBack").fadeIn();
        $("#q" + localStorage.getItem("qnum")).hide();
        $("#question").hide();
        $("#ba" + (parseInt(localStorage.getItem("qnum")) + 1)).addClass("done");
        $("#l" + (parseInt(localStorage.getItem("qnum")) + 1)).addClass("done");
        $("#b4").css("color", "#000");
        $("#q" + (parseInt(localStorage.getItem("qnum")) + 1)).fadeIn();
        $("#question").fadeIn();
        if (!question[parseInt(localStorage.getItem("qnum")) + 1]["correct"]) {
            $("#userAnswerBar").addClass("wrong");
        } else {
            $("#userAnswerBar").removeClass("wrong");
        }
        $("userAnswer").html(convertNum(question[parseInt(localStorage.getItem("qnum")) + 1]["userAnswer"]));
        $("correctAnswer").html(BASE64.decode(question[parseInt(localStorage.getItem("qnum")) + 1]["answer"]));
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
        $("#question").hide();
        $("#q" + (parseInt(localStorage.getItem("qnum")) - 1)).fadeIn();
        $("#question").fadeIn();
        if (!question[parseInt(localStorage.getItem("qnum")) - 1]["correct"]) {
            $("#userAnswerBar").addClass("wrong");
        } else {
            $("#userAnswerBar").removeClass("wrong");
        }
        $("userAnswer").html(convertNum(question[parseInt(localStorage.getItem("qnum")) - 1]["userAnswer"]));
        $("correctAnswer").html(BASE64.decode(question[parseInt(localStorage.getItem("qnum")) - 1]["answer"]));
        $("#ba" + (parseInt(localStorage.getItem("qnum")))).removeClass("done");
        $("#l" + (parseInt(localStorage.getItem("qnum")))).removeClass("done");
        localStorage.setItem("qnum", parseInt(localStorage.getItem("qnum")) - 1);
        closeComment();
    } else {
        $("#goBack").hide();
        $("#q" + localStorage.getItem("qnum")).hide();
        $("#question").hide();
        $("#q" + (parseInt(localStorage.getItem("qnum")) - 1)).fadeIn();
        $("#question").fadeIn();
        $("#ba" + (parseInt(localStorage.getItem("qnum")))).removeClass("done");
        $("#l" + (parseInt(localStorage.getItem("qnum")))).removeClass("done");
        if (!question[parseInt(localStorage.getItem("qnum")) - 1]["correct"]) {
            $("#userAnswerBar").addClass("wrong");
        } else {
            $("#userAnswerBar").removeClass("wrong");
        }
        $("userAnswer").html(convertNum(question[parseInt(localStorage.getItem("qnum")) - 1]["userAnswer"]));
        $("correctAnswer").html(BASE64.decode(question[parseInt(localStorage.getItem("qnum")) - 1]["answer"]));
        localStorage.setItem("qnum", parseInt(localStorage.getItem("qnum")) - 1);
        closeComment();
    }

});

$("#question").css("margin-right", (width / 15) + "px");
$("#question").css("margin-left", (width / 10) + "px");
if (width < 700) {
    $("#question").css("margin-left", (width / 15) + "px");
}
$("#question").css("margin-bottom", (width / 15) + "px");
if (width > 700) {
    $("#userAnswerBar").css("margin-right",  "50px");
    $("#userAnswerBar").css("margin-left",  "50px");
    $("#correctAnswerBar").css("margin-right", "50px");
    $("#correctAnswerBar").css("margin-left", "50px");
} else {
    $("#userAnswerBar").css("margin-right", (width / 10) + "px");
    $("#userAnswerBar").css("margin-left", (width / 10) + "px");
    $("#correctAnswerBar").css("margin-right", (width / 10) + "px");
    $("#correctAnswerBar").css("margin-left", (width / 10) + "px");
}

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
if (width >= 700) {
    $("#question").css("margin-right", (width / 7.5) + "px");
    $("#question").css("margin-left", (width / 5) + "px");
} else {
    $("timeline").hide();
}
$("timeline").html(timelineHTML);
if ($("#questionContainer").height() < height && height >= 600) {
    $("#question").css("margin-top", (-$("#question").height() / 2 + height / 2 - 20) + "px");
}
if (!question[0]["correct"]) {
    $("#userAnswerBar").addClass("wrong");
} else {
    $("#userAnswerBar").removeClass("wrong");
}
$("userAnswer").html(convertNum(question[0]["userAnswer"]));
$("correctAnswer").html(BASE64.decode(question[0]["answer"]));
$("#question").show();
</script>
<script type="text/javascript">
    if(!{{$isLoggedIn ? 1 : 0}}){
      $("#notlogged").fadeIn();
      if ($("#questionContainer").height() < height && height >= 700){
        $("#question").css("margin-top",(- $("#question").height() / 2 + height / 2 - 40) + "px");
      }
    } 
</script>
@include('foot')
