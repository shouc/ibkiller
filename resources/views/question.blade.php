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
    font-size: 20;
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
    font-size: inherit !important;
    font-size: 16px;
    margin-top: 15px;
    margin-left: 20px;
    margin-right: 20px;
}
.questionHelps{
    margin-bottom: 15px;
    margin-left: 20px;
}
.questionHelpButton{
    margin-right: 8px;
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
        <div class="questionContainer">
            <p id="questionContainer" class="questionText"></p>
            <div class="questionHelps">
                <keyboard class="questionHelpButton" onclick="openDataBooklet()">D</keyboard>
                <keyboard class="questionHelpButton" onclick="openResBooklet()">R</keyboard>
                <keyboard class="questionHelpButton" onclick="alertHelp(false)">H</keyboard>

            </div>
        </div>
        <div class="buttonForSelection">
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
        arr += `["${i}", "${localStorage.getItem("ans" + i)}", "${localStorage.getItem("ans" + i) == convertSymb(BASE64.decode(question[i]["answer"])) ? 1 : 0}"]`
        if (i != question.length - 1) {
            arr += ",";
        }
    }
    answer = arr + "]}";
    paper = BASE64.decode($_GET['Paper']);
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
if(!{{$isLoggedIn ? 1 : 0}}){
  $("#notlogged").fadeIn();
  if ($("#questionContainer").height() < height && height >= 700){
    $("#questionBody").css("margin-top",(- $("#questionBody").height() / 2 + height / 2 - 40) + "px");
  }
}
$(document).keydown(function(event){
    if(event.keyCode == 78){
        $("#goNext").click();
    }
    if(event.keyCode == 66){
        $("#goBack").click();
    }
    if(event.keyCode == 49){
        $("#buttonForAnswerA").click();
    }
    if(event.keyCode == 50){
        $("#buttonForAnswerB").click();
    }
    if(event.keyCode == 51){
        $("#buttonForAnswerC").click();
    }
    if(event.keyCode == 52){
        $("#buttonForAnswerD").click();
    }
    if(event.keyCode == 67){
        openComment();
    }
    if(event.keyCode == 88){
        closeComment();
    }
    if(event.keyCode == 68){
        openDataBooklet();
    }
    if(event.keyCode == 82){
        openResBooklet();
    }
    if(event.keyCode == 72){
        alertHelp();
    }
});
function alertHelp(isNeverShow){
    swal({
        title: "About Hotkeys",
        html: "<br><div><keyboard>N</keyboard>&nbsp;&nbsp;Next Question</div><br>" +
            "<div><keyboard>B</keyboard>&nbsp;&nbsp;Last Question</div><br>" +
            "<div><keyboard>D</keyboard>&nbsp;&nbsp;Data Booklet</div><br>" +
            "<div><keyboard>R</keyboard>&nbsp;&nbsp;Resource Booklet</div><br>" +
            "<div><keyboard>C</keyboard>&nbsp;&nbsp;Open Comment</div><br>" +
            "<div><keyboard>X</keyboard>&nbsp;&nbsp;Close Comment</div>",
        timer: 10000,
        showConfirmButton: isNeverShow,
        confirmButtonText: "Never Show Again",
        showCancelButton: true,

    }).then(function(isConfirm){
        if (isConfirm.value) {
            localStorage.setItem("hotkey2", 1)
        }
    });
}
const questionBankURL = "https://ib-questionbank-attachments.s3.amazonaws.com/uploads/supplemental_material/file_attachment/";
localStorage.getItem('hotkey2') ? console.log('No hotkey needed') : alertHelp(true);
function openDataBooklet() {
    swal({
        title: "Data booklet",
        html: `<p>Math HL/FM Formula Booklet: <a target="_blank" href="${questionBankURL}`+
              `9/d_5_mathl_inf_1206_3_e.pdf">Here</a></p>`+
              `<p>Math SL Formula Booklet: <a target="_blank" href="${questionBankURL}`+
              `8/d_5_matsl_inf_1203_1_e.pdf">Here</a></p>`+
              `<p>Physics Data Booklet: <a target="_blank" href="${questionBankURL}`+
              `46/Physics_data_booklet.pdf">Here</a></p>`+
              `<p>Chemistry Data Booklet: <a target="_blank" href="`+
              `https://www.ibchem.com/root_pdf/data_booklet_2016.pdf">Here</a></p>`
    })
}
function openResBooklet() {
    swal('Oops', 'No resource booklet for this question!', 'warning')
}
</script>
@include('foot')
