
@include('header', ['css' => '.questionLong.css']);

@include('nav', ['q' => true]);
@include('comment');
<style type="text/css">
body {
  background-color: #fff;
}
.question {
  margin-top: 120px;
  word-wrap:break-word;
}
.bo {
  text-align: center;
  justify-content: center;
}
.btn-local {
  margin-top: 10px;
  background-color: #fff;
  width: 50px;
  height: 50px;
  border-width: 1px;
  border-color: #999;
  font-size: 20;
  font-weight: 300;
  margin-right: 10px;

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
  box-shadow: 1px 1px 30px #1dd1a1;
}
.timeline {
    position: fixed;
    top: 100px;
    left: 20px;

}
.q-c {
    font-size: 18;
}
.btn-back {
    border-width: 1px;
    border-color: #ccc;
    margin-top: 10px;
    color: #000;
    font-size: 19;
    font-weight: 200;
}

.b-joindiscussion {
  border-width: 1px;
  border-color: #000;
}
.b-showanswer {
  border-width: 1px;
  border-color: #000;
}
</style>
<body>

    <div class="question" id="questionBody" style="display: none;">
      <div class="alert alert-warning alert-dismissible fade show notlogged" role="alert" id="notlogged">
        <h>You are not logged in! Your workings may not be recorded!!!</h>
        <br>
        <small>You can click button at right corner to dismiss this information or try to register or login</small>
        <button type="button" class="close" data-dismiss="alert" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>

      </div>
      <div class="bo">
        <div><p  class="q-c" id="questionContainer"></p></div>
        <div>
            <div class="btn-group">
              <button type="button" id="b-joindiscussion" class="btn b-joindiscussion">Join Discussion</button>
            </div>
            <div class="btn-group"></div>
            <div class="btn-group"></div>
            <div class="btn-group" id="showAnswerButton">
              <button type="button" class="btn b-showanswer">Show Answer</button>
            </div>
            <div class="btn-group" id="hideAnswerButton">
              <button type="button" class="btn b-showanswer">Hide Answer</button>
            </div>
        </div>
        <button class="btn btn-back" id="goBack">Back</button>
        &nbsp;
        &nbsp;
        <button class="btn btn-back" id="goNext">Next</button>
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
    history.pushState(null, null, document.URL);
    window.addEventListener('popstate', function () {
        leave();
        history.pushState(null, null, document.URL);
    });
});


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
tHTML = '<div class="ball done"><p onclick="goTo(0)">1</p></div>';
for (var i = 0; i < question.length; i++) {
    questionHTML += "<div id='q" + i + "'>" + BASE64.decode(question[i]["content"]) + "</div>";
}

$("#questionContainer").html(questionHTML);
for (var i = 1; i < question.length; i++) {
    $("#q" + i).hide();
    tHTML += '<div class="line" id="l' + i + '"></div> <div class="ball" id="ba' + i + '"><p onclick="goTo(' + i + ')">' + (i + 1) + '</p></div>';
}
if (question.length > 1) {
    $("timeline").html(tHTML);
}

if ($("#questionContainer").height() < height && height >= 700) {
    $("#questionBody").css("margin-top", (-$("#questionBody").height() / 2 + height / 2 - 20) + "px");
}
if (height < 590) {
    $("#questionBody");
}
if (width < 700) {
    $("timeline").hide();
}
$("#questionBody").show();

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

            if (url) {
                window.location.href = url;
            } else {
                window.location.href = '/';
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
    } else {
        submit();
    }
});

$('#hideAnswerButton').hide();
$("#showAnswerButton").click(function () {
    $('#questionContainer').html(`${$('#questionContainer').html()} <hr> <div style="text-align: left">${BASE64.decode(question[localStorage.getItem("qnum")]['answer'])}</div>`);
    $('#showAnswerButton').hide();
    $('#hideAnswerButton').show();
});
$("#hideAnswerButton").click(function () {
    $('#questionContainer').html(BASE64.decode(question[localStorage.getItem("qnum")]['content']));
    $('#hideAnswerButton').hide();
    $('#showAnswerButton').show();
});
$("#b-joindiscussion").click(function () {
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