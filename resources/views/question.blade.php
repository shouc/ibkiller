
@include('header', ['css' => '.question.css'])

@include('nav', ['q' => true])


<body class="bo">
    <div class="question" id="question">
        <div><p  class="q-c" id="q-container"></p></div>
        <div>
            <div class="btn-group">
              <button type="button" id="b1" class="btn btn-local">A</button>
            </div>
            <div class="btn-group"></div>
            <div class="btn-group"></div>
            <div class="btn-group">
              <button type="button" id="b2" class="btn btn-local">B</button>
            </div>
            <div class="btn-group"></div>
            <div class="btn-group"></div>
            <div class="btn-group">
              <button type="button" id="b3" class="btn btn-local">C</button>
            </div>
            <div class="btn-group"></div>
            <div class="btn-group"></div>
            <div class="btn-group">
              <button type="button" id="b4" class="btn btn-local">D</button>
            </div>
        </div>
        <button class="btn btn-back" id="goBack">Back</button>
        <button class="btn btn-back" id="goNext">Next</button>

    </div>
</body>
<timeline class="timeline">


</timeline>
<script type="text/javascript">
    question = [{"questionNum":3,"content":"V2hpY2ggcmVhY3Rpb24gcmVwcmVzZW50cyBjb25kZW5zYXRpb24\/PGJyPjxzdHJvbmc+QS48L3N0cm9uZz4gJCB7S09IfShhcSkgKyB7SENsfShhcSkgXHRvIHtLQ2x9KGFxKSArIHtIXzJPfShsKSQ8YnI+PHN0cm9uZz5CLjwvc3Ryb25nPiAkIHtIXzJPfShnKSBcdG8ge0hfMk99KGwpICQ8YnI+PHN0cm9uZz5DLjwvc3Ryb25nPiAkIHtJXzJ9KGcpIFx0byB7SV8yfShzKSAkPGJyPjxzdHJvbmc+RC48L3N0cm9uZz4gJCAye0hnfShzKSArIHtPXzJ9KGcpIFx0byAye0hnT30ocykgJDxicj4=","answer":"Qw==","type":"1"},{"questionNum":4,"content":"JHtOXzJIXzR9ICsge0N1KE9IKV8yfVx0byB7Tl8yfSArIHtIXzJPfSArIHtDdV8yT30gJCA8YnI+IFdoYXQgaXMgdGhlIHN1bSBvZiBhbGwgY29lZmZpY2llbnRzIGlmIHRoaXMgcmVhY3Rpb25zIGlzIGJhbGFuY2VkPzxicj48c3Ryb25nPkEuPC9zdHJvbmc+IDk8YnI+PHN0cm9uZz5CLjwvc3Ryb25nPiAxMTxicj48c3Ryb25nPkMuPC9zdHJvbmc+IDEzPGJyPjxzdHJvbmc+RC48L3N0cm9uZz4gMTU8YnI+","answer":"Qw==","type":"1"},{"questionNum":5,"content":"JHtOSF8zfSArIHtDdU99IFx0byB7Tl8yfSArIHtDdX0gKyB7SF8yT30kIDxicj4gV2hhdCBpcyB0aGUgc3VtIG9mIGFsbCBjb2VmZmljaWVudHMgZm9yIHRoaXMgcmVhY3Rpb24gaWYgaXQgaXMgYmFsYW5jZWQ\/PGJyPjxzdHJvbmc+QS48L3N0cm9uZz4gODxicj48c3Ryb25nPkIuPC9zdHJvbmc+IDEwPGJyPjxzdHJvbmc+Qy48L3N0cm9uZz4gMTI8YnI+PHN0cm9uZz5ELjwvc3Ryb25nPiAxNDxicj4=","answer":"Qg==","type":"1"},{"questionNum":6,"content":"Tm8gbW9yZSBjYWxjaXVtIGNobG9yaWRlIGNhbiBkaXNzb2x2ZSBpbiB3YXRlciwgaG93IGlzIHRoaXMgc3RhdGUgb2Ygd2F0ZXIgY2FsbGVkPzxicj48c3Ryb25nPkEuPC9zdHJvbmc+IFNvbHV0aW9uLjxicj48c3Ryb25nPkIuPC9zdHJvbmc+IE5vdCBzYXR1cmF0ZWQuPGJyPjxzdHJvbmc+Qy48L3N0cm9uZz4gTmVhcmx5IHNhdHVyYXRlZC48YnI+PHN0cm9uZz5ELjwvc3Ryb25nPiBTYXR1cmF0ZWQuPGJyPg==","answer":"RA==","type":"1"},{"questionNum":7,"content":"JHtDXzYgSF97MTJ9IH0gKyB7T18yfSBcdG8ge0NPXzJ9ICsge0hfMk99JCA8YnI+IFdoYXQgaXMgdGhlIHN1bSBvZiBhbGwgY29lZmZpY2llbnRzIGZvciB0aGlzIHJlYWN0aW9uIGlmIGl0IGlzIGJhbGFuY2VkPzxicj48c3Ryb25nPkEuPC9zdHJvbmc+IDIwPGJyPjxzdHJvbmc+Qi48L3N0cm9uZz4gMjI8YnI+PHN0cm9uZz5DLjwvc3Ryb25nPiAyNDxicj48c3Ryb25nPkQuPC9zdHJvbmc+IDI2PGJyPg==","answer":"Qg==","type":"1"},{"questionNum":8,"content":"V2hpY2ggc3RhdGVtZW50IGFib3V0IG1peHR1cmUgaXMgY29ycmVjdD88YnI+PHN0cm9uZz5BLjwvc3Ryb25nPiBUaGUgY29tcG91bmRzIGFyZSBvbmx5IHNpbmdsZSBlbGVtZW50cy48YnI+PHN0cm9uZz5CLjwvc3Ryb25nPiBUaGUgY29tcG91bmRzIGFyZSBpbiB0aGUgc2FtZSBwaGFzZS48YnI+PHN0cm9uZz5DLjwvc3Ryb25nPiBUaGUgY29tcG91bmRzIHdpbGwgY2hhbmdlIHRoZWlyIGluZGl2aWR1YWwgcHJvcGVydGllcy48YnI+PHN0cm9uZz5ELjwvc3Ryb25nPiBOb25lIG9mIGFib3ZlIGlzIGNvcnJlY3QuPGJyPg==","answer":"RA==","type":"1"},{"questionNum":9,"content":"QW1tb25pdW0gbml0cmF0ZSAoICR7TkhfNE5PXzN9JCApIGNhbiBkZWNvbXBvc2UgaW4gdG8gbml0cm9nZW4gZ2FzLCBveHlnZW4gZ2FzIGFuZCB3YXRlci4gSG93IG1hbnkgbW9sZXMgb2Ygd2F0ZXIgY2FuIGJlIGdlbmVyYXRlZCBmcm9tIHRoZSBleHBsb3Npb24gb2Ygb25lIG1vbGUgb2YgYW1tb25pdW0gbml0cmF0ZT8gIDxicj48c3Ryb25nPkEuPC9zdHJvbmc+IDE8YnI+PHN0cm9uZz5CLjwvc3Ryb25nPiAyPGJyPjxzdHJvbmc+Qy48L3N0cm9uZz4gMzxicj48c3Ryb25nPkQuPC9zdHJvbmc+IDQ8YnI+","answer":"Qg==","type":"1"}];
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
    function submit(){
        arr = "["
        for (var i = 0; i < question.length; i++) {
            arr += `["${i}", "${localStorage.getItem("ans" + i)}", "${localStorage.getItem("ans" + i) == convertSymb(window.atob(question[i]["answer"])) ? 1 : 0}"]`
            if (i != question.length - 1){
                arr += ","
            }
        }
        alert((arr + "]"))
        clearRecord()
    }

    clearRecord()
    function goTo(i){
        if (parseInt(localStorage.getItem("ans" + i)) == 10){
            alert("Why not finish the foregoing part first!")
        } else {
            if (i > 0){
                $("#goBack").fadeIn();
                $("#q" + localStorage.getItem("qnum")).hide()
                $("#question").hide()
                ans = parseInt(localStorage.getItem(("ans" + i)))
                $("#b1").css("background-color", ans == 0 ? "#273c75" : "#fff")
                $("#b1").css("border-width", ans == 0 ? "0px" : "1px")
                $("#b1").css("color", ans == 0 ? "#fff" : "#000")
                $("#b2").css("background-color",  ans == 1 ? "#273c75" : "#fff")
                $("#b2").css("border-width", ans == 1 ? "0px" : "1px")
                $("#b2").css("color", ans == 1 ? "#fff" : "#000")
                $("#b3").css("background-color", ans == 2 ? "#273c75" : "#fff")
                $("#b3").css("border-width", ans == 2 ? "0px" : "1px")
                $("#b3").css("color", ans == 2 ? "#fff" : "#000")
                $("#b4").css("background-color", ans == 3 ? "#273c75" : "#fff")
                $("#b4").css("border-width", ans == 3 ? "0px" : "1px")
                $("#b4").css("color", ans == 3 ? "#fff" : "#000")
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
                localStorage.setItem("qnum", i)
            } else {
                $("#goBack").hide();
                $("#q" + localStorage.getItem("qnum")).hide()
                $("#question").hide()
                ans = parseInt(localStorage.getItem("ans0"))
                $("#b1").css("background-color", ans == 0 ? "#273c75" : "#fff")
                $("#b1").css("border-width", ans == 0 ? "0px" : "1px")
                $("#b1").css("color", ans == 0 ? "#fff" : "#000")
                $("#b2").css("background-color",  ans == 1 ? "#273c75" : "#fff")
                $("#b2").css("border-width", ans == 1 ? "0px" : "1px")
                $("#b2").css("color", ans == 1 ? "#fff" : "#000")
                $("#b3").css("background-color", ans == 2 ? "#273c75" : "#fff")
                $("#b3").css("border-width", ans == 2 ? "0px" : "1px")
                $("#b3").css("color", ans == 2 ? "#fff" : "#000")
                $("#b4").css("background-color", ans == 3 ? "#273c75" : "#fff")
                $("#b4").css("border-width", ans == 3 ? "0px" : "1px")
                $("#b4").css("color", ans == 3 ? "#fff" : "#000")
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
                localStorage.setItem("qnum", i)
            }
        }
    }
    function goNext(){
        if (localStorage.getItem("qnum") != question.length -1){
            $("#goBack").fadeIn();
            $("#q" + localStorage.getItem("qnum")).hide()
            $("#question").hide()
            ans = parseInt(localStorage.getItem(("ans" + (parseInt(localStorage.getItem("qnum"))+1))))
            $("#b1").css("background-color", ans == 0 ? "#273c75" : "#fff")
            $("#b1").css("border-width", ans == 0 ? "0px" : "1px")
            $("#b1").css("color", ans == 0 ? "#fff" : "#000")
            $("#b2").css("background-color",  ans == 1 ? "#273c75" : "#fff")
            $("#b2").css("border-width", ans == 1 ? "0px" : "1px")
            $("#b2").css("color", ans == 1 ? "#fff" : "#000")
            $("#b3").css("background-color", ans == 2 ? "#273c75" : "#fff")
            $("#b3").css("border-width", ans == 2 ? "0px" : "1px")
            $("#b3").css("color", ans == 2 ? "#fff" : "#000")
            $("#b4").css("background-color", ans == 3 ? "#273c75" : "#fff")
            $("#b4").css("border-width", ans == 3 ? "0px" : "1px")
            $("#b4").css("color", ans == 3 ? "#fff" : "#000")
            $("#ba" + (parseInt(localStorage.getItem("qnum")) + 1)).addClass("done")
            $("#l" + (parseInt(localStorage.getItem("qnum")) + 1)).addClass("done")
            $("#b4").css("color", "#000")
            $("#q" + (parseInt(localStorage.getItem("qnum")) + 1)).fadeIn()
            $("#question").fadeIn()
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
            ans = parseInt(localStorage.getItem(("ans" + (parseInt(localStorage.getItem("qnum")) - 1))))
            $("#b1").css("background-color", ans == 0 ? "#273c75" : "#fff")
            $("#b1").css("border-width", ans == 0 ? "0px" : "1px")
            $("#b1").css("color", ans == 0 ? "#fff" : "#000")
            $("#b2").css("background-color",  ans == 1 ? "#273c75" : "#fff")
            $("#b2").css("border-width", ans == 1 ? "0px" : "1px")
            $("#b2").css("color", ans == 1 ? "#fff" : "#000")
            $("#b3").css("background-color", ans == 2 ? "#273c75" : "#fff")
            $("#b3").css("border-width", ans == 2 ? "0px" : "1px")
            $("#b3").css("color", ans == 2 ? "#fff" : "#000")
            $("#b4").css("background-color", ans == 3 ? "#273c75" : "#fff")
            $("#b4").css("border-width", ans == 3 ? "0px" : "1px")
            $("#b4").css("color", ans == 3 ? "#fff" : "#000")
            $("#q" + (parseInt(localStorage.getItem("qnum")) - 1)).fadeIn()
            $("#question").fadeIn()
            $("#ba" + (parseInt(localStorage.getItem("qnum")))).removeClass("done")
            $("#l" + (parseInt(localStorage.getItem("qnum")))).removeClass("done")
            localStorage.setItem("qnum", parseInt(localStorage.getItem("qnum")) - 1)
        } else {
            $("#goBack").hide();
            $("#q" + localStorage.getItem("qnum")).hide()
            $("#question").hide()
            ans = parseInt(localStorage.getItem("ans0"))
            $("#b1").css("background-color", ans == 0 ? "#273c75" : "#fff")
            $("#b1").css("border-width", ans == 0 ? "0px" : "1px")
            $("#b1").css("color", ans == 0 ? "#fff" : "#000")
            $("#b2").css("background-color",  ans == 1 ? "#273c75" : "#fff")
            $("#b2").css("border-width", ans == 1 ? "0px" : "1px")
            $("#b2").css("color", ans == 1 ? "#fff" : "#000")
            $("#b3").css("background-color", ans == 2 ? "#273c75" : "#fff")
            $("#b3").css("border-width", ans == 2 ? "0px" : "1px")
            $("#b3").css("color", ans == 2 ? "#fff" : "#000")
            $("#b4").css("background-color", ans == 3 ? "#273c75" : "#fff")
            $("#b4").css("border-width", ans == 3 ? "0px" : "1px")
            $("#b4").css("color", ans == 3 ? "#fff" : "#000")
            $("#q" + (parseInt(localStorage.getItem("qnum")) - 1)).fadeIn()
            $("#question").fadeIn()
            $("#ba" + (parseInt(localStorage.getItem("qnum")))).removeClass("done")
            $("#l" + (parseInt(localStorage.getItem("qnum")))).removeClass("done")
            localStorage.setItem("qnum", parseInt(localStorage.getItem("qnum")) - 1)
        }
        
    })
    $("#question").css("margin-right", (width / 15) + "px")
    $("#question").css("margin-left", (width / 15) + "px")
    $("#question").css("margin-bottom", (width / 15) + "px")
    $("#b1").click(function(){
      $("#b1").css("background-color", "#273c75")
      $("#b1").css("border-width", "0px")
      $("#b1").css("color", "#fff")
      $("#b2").css("background-color", "#fff")
      $("#b2").css("border-width", "1px")
      $("#b2").css("color", "#000")
      $("#b2").css("color", "#000")
      $("#b3").css("background-color", "#fff")
      $("#b3").css("border-width", "1px")
      $("#b3").css("color", "#000")
      $("#b4").css("background-color", "#fff")
      $("#b4").css("border-width", "1px")
      $("#b4").css("color", "#000")
      localStorage.setItem("ans" + localStorage.getItem("qnum"), parseInt(0))
    });
    $("#b2").click(function(){
      $("#b2").css("background-color", "#273c75")
      $("#b2").css("border-width", "0px")
      $("#b2").css("color", "#fff")
      $("#b1").css("background-color", "#fff")
      $("#b1").css("border-width", "1px")
      $("#b1").css("color", "#000")
      $("#b3").css("background-color", "#fff")
      $("#b3").css("border-width", "1px")
      $("#b3").css("color", "#000")
      $("#b4").css("background-color", "#fff")
      $("#b4").css("border-width", "1px")
      $("#b4").css("color", "#000")
      localStorage.setItem("ans" + localStorage.getItem("qnum"), parseInt(1))
    });
    $("#b3").click(function(){
      $("#b3").css("background-color", "#273c75")
      $("#b3").css("border-width", "0px")
      $("#b3").css("color", "#fff")
      $("#b2").css("background-color", "#fff")
      $("#b2").css("border-width", "1px")
      $("#b2").css("color", "#000")
      $("#b1").css("background-color", "#fff")
      $("#b1").css("border-width", "1px")
      $("#b1").css("color", "#000")
      $("#b4").css("background-color", "#fff")
      $("#b4").css("border-width", "1px")
      $("#b4").css("color", "#000")
      localStorage.setItem("ans" + localStorage.getItem("qnum"), parseInt(2))
    });
    $("#b4").click(function(){
      $("#b4").css("background-color", "#273c75")
      $("#b4").css("border-width", "0px")
      $("#b4").css("color", "#fff")
      $("#b2").css("background-color", "#fff")
      $("#b2").css("border-width", "1px")
      $("#b2").css("color", "#000")
      $("#b3").css("background-color", "#fff")
      $("#b3").css("border-width", "1px")
      $("#b3").css("color", "#000")
      $("#b1").css("background-color", "#fff")
      $("#b1").css("border-width", "1px")
      $("#b1").css("color", "#000")
      localStorage.setItem("ans" + localStorage.getItem("qnum"), parseInt(3))
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
    if ($("#q-container").height() < height){
        $("#question").css("margin-top",(- $("#question").height() / 2 + height / 2 -20) + "px");
    }
    if (width < 700){
        $("timeline").hide();
    }
</script>