
@include('header', ['css' => '.questionLong.css']);

@include('nav', ['q' => true]);
@include('comment');

<body>

    <div class="question" id="question" style="display: none;">
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
        <div>
            <div class="btn-group">
              <button type="button" id="b-joindiscussion" class="btn b-joindiscussion">Join Discussion</button>
            </div>
            <div class="btn-group"></div>
            <div class="btn-group"></div>
            <div class="btn-group" id="b-showanswer">
              <button type="button" class="btn b-showanswer">Show Answer</button>
            </div>
            <div class="btn-group" id="b-hideanswer">
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
    

    question = $.parseJSON(BASE64.decode('{{ $data }}'));
    width = window.innerWidth;
    height = $(window).height();

    localStorage.setItem("qnum", 0);
    $("#goBack").hide();

    function clearRecord(){
        for (var i = 0; i < question.length; i++) {
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
            if (url){
              window.location.href = url;
            } else {
              window.location.href = '/';
            }
            
          }
        })
    }
    
    function submit(){
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

            if (url){
              window.location.href = url;
            } else {
              window.location.href = '/';
            }
          }
        });
    }

    clearRecord();
    function goTo(i){
      
          if (i > 0){
              $("#goBack").fadeIn();
              $("#q" + localStorage.getItem("qnum")).hide();
              $("#question").hide();
              ans = parseInt(localStorage.getItem(("ans" + i)));
              $("#q" + i).fadeIn();
              $("#question").fadeIn();
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
              $("#question").hide();
              ans = parseInt(localStorage.getItem("ans0"));
              $("#q" + i).fadeIn();
              $("#question").fadeIn();
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
    
    function goNext(){
        if (localStorage.getItem("qnum") != question.length -1){
            $("#goBack").fadeIn();
            $("#q" + localStorage.getItem("qnum")).hide();
            $("#question").hide();
            ans = parseInt(localStorage.getItem(("ans" + (parseInt(localStorage.getItem("qnum"))+1))));
            $("#ba" + (parseInt(localStorage.getItem("qnum")) + 1)).addClass("done");
            $("#l" + (parseInt(localStorage.getItem("qnum")) + 1)).addClass("done");
            $("#b4").css("color", "#000");
            $("#q" + (parseInt(localStorage.getItem("qnum")) + 1)).fadeIn();
            $("#question").fadeIn();
            localStorage.setItem("qnum", parseInt(localStorage.getItem("qnum")) + 1);
            $("#b-hideanswer").click();
            closeComment();
        } else {
            submit();
        }
    }
    $("#goNext").click(function(){
        goNext();
    });
    $('#b-hideanswer').hide();
    $("#b-showanswer").click(function(){
        $('#q-container').html(`${$('#q-container').html()} <hr> <div style="text-align: left">${BASE64.decode(question[localStorage.getItem("qnum")]['answer'])}</div>`);
        $('#b-showanswer').hide();
        $('#b-hideanswer').show();
    });
    $("#b-hideanswer").click(function(){
        $('#q-container').html(BASE64.decode(question[localStorage.getItem("qnum")]['content']));
        $('#b-hideanswer').hide();
        $('#b-showanswer').show();
    });
    $("#b-joindiscussion").click(function(){
        openComment();
    });
    $("#goBack").click(function(){
        if (localStorage.getItem("qnum") > 1){
            $("#goBack").fadeIn();
            $("#q" + localStorage.getItem("qnum")).hide();
            $("#question").hide();
            ans = parseInt(localStorage.getItem(("ans" + (parseInt(localStorage.getItem("qnum")) - 1))));
            $("#q" + (parseInt(localStorage.getItem("qnum")) - 1)).fadeIn();
            $("#question").fadeIn();
            $("#ba" + (parseInt(localStorage.getItem("qnum")))).removeClass("done");
            $("#l" + (parseInt(localStorage.getItem("qnum")))).removeClass("done");
            localStorage.setItem("qnum", parseInt(localStorage.getItem("qnum")) - 1);
            $("#b-hideanswer").click();
            closeComment();
        } else {
            $("#goBack").hide();
            $("#q" + localStorage.getItem("qnum")).hide();
            $("#question").hide();
            ans = parseInt(localStorage.getItem("ans0"));
            $("#q" + (parseInt(localStorage.getItem("qnum")) - 1)).fadeIn();
            $("#question").fadeIn();
            $("#ba" + (parseInt(localStorage.getItem("qnum")))).removeClass("done");
            $("#l" + (parseInt(localStorage.getItem("qnum")))).removeClass("done");
            localStorage.setItem("qnum", parseInt(localStorage.getItem("qnum")) - 1);
            $("#b-hideanswer").click();
            closeComment();
        }
    });
    $("#question").css("margin-right", (width / 15) + "px");
    $("#question").css("margin-left", (width / 10) + "px");
    if (width < 700){
        $("#question").css("margin-left", (width / 15) + "px");
    } 
    $("#question").css("margin-bottom", (width / 15) + "px");
    
    questionHTML = "";
    tHTML = '<div class="ball done"><p onclick="goTo(0)">1</p></div>';
    for (var i = 0; i < question.length; i++) {
        questionHTML += "<div id='q" + i + "'>" + BASE64.decode(question[i]["content"]) + "</div>";
    }

    $("#q-container").html(questionHTML);
    for (var i = 1; i < question.length; i++) {
        $("#q" + i).hide();
        tHTML += '<div class="line" id="l'+ i +'"></div> <div class="ball" id="ba'+ i +'"><p onclick="goTo(' + i + ')">' + (i+1) + '</p></div>';
    }
    if (question.length > 1){
      $("timeline").html(tHTML);
    }
    
    if ($("#q-container").height() < height && height >= 700){
        $("#question").css("margin-top",(- $("#question").height() / 2 + height / 2 -20) + "px");
    }
    if (height < 590){
      $("#question");
    }
    if (width < 700){
        $("timeline").hide();
    } 
    $("#question").show();
</script>
<script>
    if(!{{$isLoggedIn ? 1 : 0}}){
      $("#notlogged").fadeIn();
      if ($("#q-container").height() < height && height >= 700){
        $("#question").css("margin-top",(- $("#question").height() / 2 + height / 2 - 40) + "px");
      }
    } 
</script>