
@include('header', ['css' => '.check.css'])

@include('nav', ['q' => false])

<body>
    <div class="question bo" id="question">
        <div><p  class="q-c" id="q-container"></p></div>
        <div class="bbar-local" id="bbar">
          <p class="bbar-txt">Your Answer: <ua></ua></p>
        </div>
        <div class="bbar2-local" id="bbar2">
          <p class="bbar2-txt">Correct Answer: <ca></ca></p>

        </div>
        <button class="btn btn-back" id="goBack">Back</button>
        <button class="btn btn-back" id="goNext">Next</button>
    </div>
</body>
<timeline class="timeline">


</timeline>
<script type="text/javascript">
    question = $.parseJSON(window.atob('{{ $data }}'))["info"];
    width = window.innerWidth;
    height = window.innerHeight;
    localStorage.setItem("qnum", 0)
    $("#goBack").hide();

    function clearRecord(){
        for (var i = 0; i < question.length; i++) {
            localStorage.setItem("ans" + i, 10)
        }
    }
    function convertSymb(str){
        return str == "A" ? 0 : str == "B" ? 1 : str == "C" ? 2 : str == "D" ? 3 : 100
    }
    function convertNum(str){
        return str == "0" ? "A" : str == "1" ? "B" : str == "2" ? "C" : str == "3" ? "D" : "UNK"
    }
    function submit(){
        alert("done")
    }

    clearRecord()
    function goTo(i){
        
            if (i > 0){
                $("#goBack").fadeIn();
                $("#q" + localStorage.getItem("qnum")).hide()
                $("#question").hide()
                $("#q" + i).fadeIn()
                $("#question").fadeIn()
                for (var k = question.length; k != i; k--){
                    $("#ba" + k).removeClass("done")
                    $("#l" + k).removeClass("done")
                }
                for (var k = i; k != 0; k--){
                    $("#ba" + k).addClass("done")
                    $("#l" + k).addClass("done")
                }
                if (question[i]["correct"] != question[i]["userAnswer"]){
                  $("#bbar").addClass("wrong");
                } else {
                  $("#bbar").removeClass("wrong");
                }
                $("ua").html(convertNum(question[i]["userAnswer"]))
                $("ca").html(convertNum(question[i]["correct"]))
                localStorage.setItem("qnum", i)
            } else {
                $("#goBack").hide();
                $("#q" + localStorage.getItem("qnum")).hide()
                $("#q" + i).fadeIn()
                $("#question").fadeIn()
                for (var k = question.length; k != i; k--){
                    $("#ba" + k).removeClass("done")
                    $("#l" + k).removeClass("done")
                }
                for (var k = i; k != 0; k--){
                    $("#ba" + k).addClass("done")
                    $("#l" + k).addClass("done")
                }
                if (question[i]["correct"] != question[i]["userAnswer"]){
                  $("#bbar").addClass("wrong");
                } else {
                  $("#bbar").removeClass("wrong");
                }
                $("ua").html(convertNum(question[i]["userAnswer"]))
                $("ca").html(convertNum(question[i]["correct"]))
                localStorage.setItem("qnum", i)
            }
        
    }
    function goNext(){
        if (localStorage.getItem("qnum") != question.length -1){
            $("#goBack").fadeIn();
            $("#q" + localStorage.getItem("qnum")).hide()
            $("#question").hide()
            $("#ba" + (parseInt(localStorage.getItem("qnum")) + 1)).addClass("done")
            $("#l" + (parseInt(localStorage.getItem("qnum")) + 1)).addClass("done")
            $("#b4").css("color", "#000")
            $("#q" + (parseInt(localStorage.getItem("qnum")) + 1)).fadeIn()
            $("#question").fadeIn()
            if (question[parseInt(localStorage.getItem("qnum")) + 1]["correct"] != question[parseInt(localStorage.getItem("qnum")) + 1]["userAnswer"]){
              $("#bbar").addClass("wrong");
            } else {
              $("#bbar").removeClass("wrong");
            }
            $("ua").html(convertNum(question[parseInt(localStorage.getItem("qnum")) + 1]["userAnswer"]))
            $("ca").html(convertNum(question[parseInt(localStorage.getItem("qnum")) + 1]["correct"]))
            localStorage.setItem("qnum", parseInt(localStorage.getItem("qnum")) + 1)
        } else {
            submit()
        }
    }
    $("#goNext").click(function(){
        goNext()
    })
    $("#goBack").click(function(){
        if (localStorage.getItem("qnum") > 1){
            $("#goBack").fadeIn();
            $("#q" + localStorage.getItem("qnum")).hide()
            $("#question").hide()
            $("#q" + (parseInt(localStorage.getItem("qnum")) - 1)).fadeIn()
            $("#question").fadeIn()
            if (question[parseInt(localStorage.getItem("qnum")) - 1]["correct"] != question[parseInt(localStorage.getItem("qnum")) - 1]["userAnswer"]){
              $("#bbar").addClass("wrong");
            } else {
              $("#bbar").removeClass("wrong");
            }
            $("ua").html(convertNum(question[parseInt(localStorage.getItem("qnum")) - 1]["userAnswer"]))
            $("ca").html(convertNum(question[parseInt(localStorage.getItem("qnum")) - 1]["correct"]))
            $("#ba" + (parseInt(localStorage.getItem("qnum")))).removeClass("done")
            $("#l" + (parseInt(localStorage.getItem("qnum")))).removeClass("done")
            localStorage.setItem("qnum", parseInt(localStorage.getItem("qnum")) - 1)
        } else {
            $("#goBack").hide();
            $("#q" + localStorage.getItem("qnum")).hide()
            $("#question").hide()
            $("#q" + (parseInt(localStorage.getItem("qnum")) - 1)).fadeIn()
            $("#question").fadeIn()
            $("#ba" + (parseInt(localStorage.getItem("qnum")))).removeClass("done")
            $("#l" + (parseInt(localStorage.getItem("qnum")))).removeClass("done")
            if (question[parseInt(localStorage.getItem("qnum")) - 1]["correct"] != question[parseInt(localStorage.getItem("qnum")) - 1]["userAnswer"]){
              $("#bbar").addClass("wrong");
            } else {
              $("#bbar").removeClass("wrong");
            }
            $("ua").html(convertNum(question[parseInt(localStorage.getItem("qnum")) - 1]["userAnswer"]))
            $("ca").html(convertNum(question[parseInt(localStorage.getItem("qnum")) - 1]["correct"]))
            localStorage.setItem("qnum", parseInt(localStorage.getItem("qnum")) - 1)
        }
        
    })
    $("#question").css("margin-right", (width / 15) + "px")
    $("#question").css("margin-left", (width / 15) + "px")
    $("#question").css("margin-bottom", (width / 15) + "px")
    if (width > 700){
      $("#bbar").css("margin-right", (width / 3.8) + "px")
      $("#bbar").css("margin-left", (width / 3.8) + "px")
      $("#bbar2").css("margin-right", (width / 3.8) + "px")
      $("#bbar2").css("margin-left", (width / 3.8) + "px")
    } else {
      $("#bbar").css("margin-right", (width / 10) + "px")
      $("#bbar").css("margin-left", (width / 10) + "px")
      $("#bbar2").css("margin-right", (width / 10) + "px")
      $("#bbar2").css("margin-left", (width / 10) + "px")
    }
    
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
    if ($("#q-container").height() < height){
        $("#question").css("margin-top",(- $("#question").height() / 2 + height / 2 -20) + "px");
    }
    if (width < 700){
        $("timeline").hide();
    }
    if (question[0]["correct"] != question[0]["userAnswer"]){
      $("#bbar").addClass("wrong");
    } else {
      $("#bbar").removeClass("wrong");
    }
    $("ua").html(convertNum(question[0]["userAnswer"]))
    $("ca").html(convertNum(question[0]["correct"]))
    renderMathInElement(document.body);

</script>
