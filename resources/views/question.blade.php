
@include('header', ['css' => '.question.css']);

@include('nav', ['q' => true]);
@include('comment');

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
        <div><p  class="q-c" id="q-container"></p></div>
        <div >
            <div class="btn-group">
              <button type="button" id="buttonForAnswerA" class="btn btn-local">A</button>
            </div>
            <div class="btn-group"></div>
            <div class="btn-group"></div>
            <div class="btn-group">
              <button type="button" id="buttonForAnswerB" class="btn btn-local">B</button>
            </div>
            <div class="btn-group"></div>
            <div class="btn-group"></div>
            <div class="btn-group">
              <button type="button" id="buttonForAnswerC" class="btn btn-local">C</button>
            </div>
            <div class="btn-group"></div>
            <div class="btn-group"></div>
            <div class="btn-group">
              <button type="button" id="buttonForAnswerD" class="btn btn-local">D</button>
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

      var $_GET = (function(){
        var url = window.document.location.href.toString();
        var u = url.split("?");
        if(typeof(u[1]) == "string"){
            u = u[1].split("&");
            var get = {};
            for(var i in u){
                var j = u[i].split("=");
                get[j[0]] = j[1];
            }
            return get;
        } else {
            return {};
        }
    })();
    $(function () {
        //prevent getback
        history.pushState(null, null, document.URL);
        window.addEventListener('popstate', function () {
          leave();
          history.pushState(null, null, document.URL);
        });
    });
    

    question = $.parseJSON(window.atob('{{ $data }}'));
    width = window.innerWidth;
    height = $(window).height();

    localStorage.setItem("qnum", 0);
    $("#goBack").hide();

    function clearRecord(){
        for (var i = 0; i < 30; i++) {
            localStorage.setItem("ans" + i, 10);
        }
    }
    function leave(){
        swal({
          title: 'You Are Leaving',
          text: `Your workings may not be saved! Click Yes to indicate that you confirm your action!`,
          type: 'warning',
          showCancelButton: true,
          confirmButtonColor: '#3085d6',
          cancelButtonColor: '#d33',
          confirmButtonText: 'Yes'
        }).then((result) => {
          if (result.value) {
            url = localStorage.getItem('subject');
            clearRecord();
            if (url){
              window.location.href = url;
            } else {
              window.location.href = '/';
            }
            
          }
        })
    }
    function convertSymb(str){
        return str == "A" ? 0 : str == "B" ? 1 : str == "C" ? 2 : str == "D" ? 3 : 100;
    }
    function submit(){
        arr = '{"answer" : ['
        for (var i = 0; i < question.length; i++) {
            arr += `["${i}", "${localStorage.getItem("ans" + i)}", "${localStorage.getItem("ans" + i) == convertSymb(window.atob(question[i]["answer"])) ? 1 : 0}"]`
            if (i != question.length - 1){
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
            $('#submitAnswer').click();
          }
        })
      
        
        
    }

    clearRecord();
    function changeColor(button, color){
      $(`#${button}`).css("background-color", color ? "#273c75" : "#fff");
      $(`#${button}`).css("border-width", color ? "0px" : "1px");
      $(`#${button}`).css("color", color ? "#fff" : "#000");
    }
    function goTo(i){
        if (parseInt(localStorage.getItem("ans" + i)) == 10){
            alert("Why not finish the foregoing part first!");
        } else {
            if (i > 0){
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
                for (var k = question.length; k != i; k--){
                    $("#ba" + k).removeClass("done");
                    $("#l" + k).removeClass("done");
                }
                for (var k = i; k != 0; k--){
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
                for (var k = question.length; k != i; k--){
                    $("#ba" + k).removeClass("done");
                    $("#l" + k).removeClass("done");
                }
                for (var k = i; k != 0; k--){
                    $("#ba" + k).addClass("done");
                    $("#l" + k).addClass("done");
                }
                localStorage.setItem("qnum", i);
            }
        }
    }
    function goNext(){
        if (localStorage.getItem("qnum") != question.length -1){
            $("#goBack").fadeIn();
            $("#q" + localStorage.getItem("qnum")).hide();
            $("#questionBody").hide();
            ans = parseInt(localStorage.getItem(("ans" + (parseInt(localStorage.getItem("qnum"))+1))));
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
    }
    $("#goNext").click(function(){
        goNext();
    });
    $("#goBack").click(function(){
        if (localStorage.getItem("qnum") > 1){
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
    $("#questionBody").css("margin-right", (width / 15) + "px");
    $("#questionBody").css("margin-left", (width / 10) + "px");
    if (width < 700){
        $("#questionBody").css("margin-left", (width / 15) + "px");
    } 
    $("#questionBody").css("margin-bottom", (width / 15) + "px");
    $("#buttonForAnswerA").click(function(){
      changeColor('buttonForAnswerA', 1);
      changeColor('buttonForAnswerB', 0);
      changeColor('buttonForAnswerC', 0);
      changeColor('buttonForAnswerD', 0);
      localStorage.setItem("ans" + localStorage.getItem("qnum"), parseInt(0));
    });
    $("#buttonForAnswerB").click(function(){
      changeColor('buttonForAnswerA', 0);
      changeColor('buttonForAnswerB', 1);
      changeColor('buttonForAnswerC', 0);
      changeColor('buttonForAnswerD', 0);
      localStorage.setItem("ans" + localStorage.getItem("qnum"), parseInt(1));
    });
    $("#buttonForAnswerC").click(function(){
      changeColor('buttonForAnswerA', 0);
      changeColor('buttonForAnswerB', 0);
      changeColor('buttonForAnswerC', 1);
      changeColor('buttonForAnswerD', 0);
      localStorage.setItem("ans" + localStorage.getItem("qnum"), parseInt(2));
    });
    $("#buttonForAnswerD").click(function(){
      changeColor('buttonForAnswerA', 0);
      changeColor('buttonForAnswerB', 0);
      changeColor('buttonForAnswerC', 0);
      changeColor('buttonForAnswerD', 1);
      localStorage.setItem("ans" + localStorage.getItem("qnum"), parseInt(3));
    });
    questionHTML = "";
    tHTML = '<div class="ball done"><p onclick="goTo(0)">1</p></div>';
    for (var i = 0; i < question.length; i++) {
        questionHTML += "<div id='q" + i + "'>" + window.atob(question[i]["content"]) + "</div>";
    }

    $("#q-container").html(questionHTML);
    for (var i = 1; i < question.length; i++) {
        $("#q" + i).hide();
        tHTML += '<div class="line" id="l'+ i +'"></div> <div class="ball" id="ba'+ i +'"><p onclick="goTo(' + i + ')">' + (i+1) + '</p></div>';
    }
    $("timeline").html(tHTML);
    if ($("#q-container").height() < height && height >= 700){
        $("#questionBody").css("margin-top",(- $("#questionBody").height() / 2 + height / 2 -20) + "px");
    }
    if (height < 590){
      $("#questionBody");
    }
    if (width < 700){
        $("timeline").hide();
    }
    $("#questionBody").show();
    
    
</script>
<script>
    if(!{{$isLoggedIn ? 1 : 0}}){
      $("#notlogged").fadeIn();
      if ($("#q-container").height() < height && height >= 700){
        $("#questionBody").css("margin-top",(- $("#questionBody").height() / 2 + height / 2 - 40) + "px");
      }
    } 
</script>