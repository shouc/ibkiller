
@include('header', ['css' => '.check.css'])

@include('nav', ['q' => true])

<body class="bo">
    <div class="question" id="question">
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
    question = [{"questionNum":"0","content":"PHA+RGlzY3VzcyB0aGUgdmlldyB0aGF0IGEgZnJlZSBtYXJrZXQgYXQgY29tcGV0aXRpdmUgbWFya2V0IGVxdWlsaWJyaXVtIGxlYWRzIHRvIHRoZSBtb3N0IGVmZmljaWVudCBhbGxvY2F0aW9uIG9mIHJlc291cmNlcyBmcm9tIHNvY2lldHkmcnNxdW87cyBwb2ludCBvZiB2aWV3LjwvcD4=","answer":"PHA+PGVtPkFuc3dlcnMgPHN0cm9uZz5tYXk8L3N0cm9uZz4gaW5jbHVkZTo8L2VtPjwvcD48dWw+PGxpPmRlZmluaXRpb25zIG9mIGNvbXBldGl0aXZlIG1hcmtldCBlcXVpbGlicml1bSwgY29tbXVuaXR5L3NvY2lhbCBzdXJwbHVzLCBhbGxvY2F0aXZlIGVmZmljaWVuY3k8L2xpPjxsaT50aGVvcnkgdG8gZXhwbGFpbiB0aGF0IHRoZSBkZW1hbmQgY3VydmUgcmVwcmVzZW50cyBiZW5lZml0cyB0byBzb2NpZXR5IGhlbmNlIG1hcmdpbmFsIHNvY2lhbCBiZW5lZml0IGFuZCB0aGUgc3VwcGx5IGN1cnZlIGNvc3RzIHRvIHNvY2lldHkgaGVuY2UgbWFyZ2luYWwgc29jaWFsIGNvc3QuIEF0IGVxdWlsaWJyaXVtIE1TQiA9IE1TQyBzbyBpdCBpcyB0aGUgb3B0aW11bSBhbGxvY2F0aW9uIG9mIHJlc291cmNlcyBmcm9tIHNvY2lldHkmcnNxdW87cyBwb2ludCBvZiB2aWV3PC9saT48bGk+ZGlhZ3JhbSB0byBzaG93IGNvbW11bml0eS9zb2NpYWwgc3VycGx1cyBpbiBhIG1hcmtldCBhdCBlcXVpbGlicml1bTwvbGk+PGxpPmV4YW1wbGVzIG9mIG1hcmtldHMgaW4gYWxsb2NhdGl2ZSBlZmZpY2llbmN5PC9saT48bGk+c3ludGhlc2lzIGFuZCBldmFsdWF0aW9uIChkaXNjdXNzKS48L2xpPjwvdWw+PHA+Q2FuZGlkYXRlcyA8c3Ryb25nPm1heTwvc3Ryb25nPiBhcmd1ZSB0aGF0IGEgbWFya2V0IGZvciBhIGRlbWVyaXQgZ29vZCBvciBpbiBhbiB1bnN1c3RhaW5hYmxlIGFjdGl2aXR5LCBldmVuIGlmIGluIGVxdWlsaWJyaXVtLCBtaWdodCBub3QgaW1wbHkgdGhlIG1vc3QgZWZmaWNpZW50IGFsbG9jYXRpb24gb2YgcmVzb3VyY2VzIGZvciBzb2NpZXR5LiBDYW5kaWRhdGVzIHdobyBjaGFsbGVuZ2UgdGhlIHF1b3RhdGlvbiBieSBwcmVzZW50aW5nIGEgY29udmluY2luZyBhcmd1bWVudCB3aXRoIGV4YW1wbGVzIHRoYXQgbWFya2V0IGZhaWx1cmUgdW5kZXJtaW5lcyBhbGxvY2F0aXZlIGVmZmljaWVuY3kgc2hvdWxkIGJlIGZ1bGx5IHJld2FyZGVkLiBNYXJrZXQgZmFpbHVyZSBjb3VsZCBiZSBpbGx1c3RyYXRlZCB1c2luZyBleHRlcm5hbGl0aWVzIChwcm9kdWN0aW9uIGFuZCBjb25zdW1wdGlvbiksIGxhY2sgb2YgcHVibGljIGdvb2RzIG9yIGRlcGxldGlvbiBvZiBjb21tb24gYWNjZXNzIHJlc291cmNlcy90aHJlYXQgdG8gc3VzdGFpbmFiaWxpdHkuPC9wPg==","type":"2","correct":"0","userAnswer":"0"},{"questionNum":"1","content":"PHA+RXhwbGFpbiB0aGUgY29uY2VwdHMgb2YgY29uc3VtZXIgc3VycGx1cyBhbmQgcHJvZHVjZXIgc3VycGx1cyBpbiB0aGUgbWFya2V0IGZvciBhaXIgdHJhdmVsLjwvcD4=","answer":"PHA+PGVtPkFuc3dlcnMgPHN0cm9uZz5tYXk8L3N0cm9uZz4gaW5jbHVkZTo8L2VtPjwvcD48dWw+PGxpPmRlZmluaXRpb25zIG9mIGNvbnN1bWVyIHN1cnBsdXMgYW5kIHByb2R1Y2VyIHN1cnBsdXM8L2xpPjxsaT50aGVvcnkgdG8gZXhwbGFpbiB0aGF0IGNvbnN1bWVyIHN1cnBsdXMgaXMgdG8gYmUgZm91bmQgYWJvdmUgZXF1aWxpYnJpdW0gcHJpY2UgYW5kIGJlbG93IHRoZSBkZW1hbmQgY3VydmUsIGFuZCB0aGF0IHByb2R1Y2VyIHN1cnBsdXMgaXMgYmVsb3cgZXF1aWxpYnJpdW0gcHJpY2UgYnV0IGFib3ZlIHRoZSBzdXBwbHkgY3VydmU8L2xpPjxsaT5kaWFncmFtIHRvIHNob3cgY29uc3VtZXIgc3VycGx1cyBhbmQgcHJvZHVjZXIgc3VycGx1cyBpbiB0aGUgbWFya2V0IGZvciBhaXIgdHJhdmVsPC9saT48bGk+ZXhhbXBsZXMgb2YgY29uc3VtZXIgc3VycGx1cyBhbmQgcHJvZHVjZXIgc3VycGx1cyBpbiBhaXJsaW5lIHRpY2tldCBwcmljaW5nLjwvbGk+PC91bD4=","type":"2","correct":"1","userAnswer":"0"},{"questionNum":"2","content":"PHA+RXhwbGFpbiB0aGUgbWVhbmluZyBvZiB0aGUgdGVybSAmbGRxdW87YWxsb2NhdGl2ZSBlZmZpY2llbmN5JnJkcXVvOyBhbmQgaXRzIGltcGxpY2F0aW9uIGZvciBzb2NpYWwgKGNvbW11bml0eSkgc3VycGx1cy48L3A+","answer":"PHA+TGV2ZWw8L3A+PHA+MCA8ZW0+VGhlIHdvcmsgZG9lcyBub3QgcmVhY2ggYSBzdGFuZGFyZCBkZXNjcmliZWQgYnkgdGhlIGRlc2NyaXB0b3JzIGJlbG93LiA8L2VtPjxzdHJvbmc+WzBdPC9zdHJvbmc+PGVtPjxiciAvPjwvZW0+PC9wPjxwPiZuYnNwOzwvcD48cD4xIDxlbT5UaGUgd3JpdHRlbiByZXNwb25zZSBpcyBsaW1pdGVkLiA8L2VtPjxzdHJvbmc+WzEtMl08L3N0cm9uZz48ZW0+PGJyIC8+PC9lbT48L3A+PHA+Rm9yIGV4cGxhaW5pbmcgdGhhdCBhbGxvY2F0aXZlIGVmZmljaWVuY3kgcmVmZXJzIHRvIHRoZSBhbGxvY2F0aW9uIG9mIHJlc291cmNlcyBpbiBhbiBlY29ub215IGFuZCB0aGF0IHJlc291cmNlcyBhcmUgYWxsb2NhdGVkIGluIHRoZSBiZXN0IHBvc3NpYmxlIHdheSA8c3Ryb25nPm9yPC9zdHJvbmc+IHRoYXQgc29jaWFsL2NvbW11bml0eSBzdXJwbHVzIGlzIG1heGltaXplZC48L3A+PHA+Jm5ic3A7PC9wPjxwPjIgPGVtPlRoZSB3cml0dGVuIHJlc3BvbnNlIGlzIGFjY3VyYXRlLjwvZW0+PHN0cm9uZz4gWzMtNF08L3N0cm9uZz48ZW0+PGJyIC8+PC9lbT48L3A+PHA+Rm9yIGV4cGxhaW5pbmcgdGhhdCBhbGxvY2F0aXZlIGVmZmljaWVuY3kgbWVhbnMgdGhhdCByZXNvdXJjZXMgYXJlIGFsbG9jYXRlZCBpbiB0aGUgYmVzdCBwb3NzaWJsZSB3YXkgPHN0cm9uZz5hbmQ8L3N0cm9uZz4gYXMgYSByZXN1bHQganVzdCB0aGUgcmlnaHQgYW1vdW50IG9mIHRoZSBnb29kIGlzIHByb2R1Y2VkIGZyb20gc29jaWV0eSZyc3F1bztzIHBvaW50IG9mIHZpZXcgc28gdGhhdCBzb2NpYWwvY29tbXVuaXR5IHN1cnBsdXMgKHRoZSBzdW0gb2YgY29uc3VtZXIgYW5kIHByb2R1Y2VyIHN1cnBsdXMpIGlzIG1heGltaXplZC48L3A+PHA+Rm9yIHRoZSA0IG1hcmtzIHRvIGJlIGF3YXJkZWQgdGhlIGZvbGxvd2luZyBwb2ludHMgbXVzdCBiZSBwcm92aWRlZDo8L3A+PHVsPjxsaT5leHBsaWNpdCByZWZlcmVuY2UgdG8gdGhlIHVzZSBvZiByZXNvdXJjZXM8L2xpPjxsaT50aGF0IHJlc291cmNlcyBhcmUgdXNlIGluIHRoZSBiZXN0IHBvc3NpYmxlIHdheTwvbGk+PGxpPnRoYXQganVzdCB0aGUgcmlnaHQgYW1vdW50IG9mIHRoZSBnb29kIGlzIHByb2R1Y2VkIGZyb20gc29jaWV0eSZyc3F1bztzIHBvaW50IG9mIHZpZXcgKG9yIHJlZmVyZW5jZSB0byBzdGFrZWhvbGRlcnMgPGVtPmVnPC9lbT4gY29uc3VtZXIgYW5kIHByb2R1Y2VyIHN1cnBsdXMpPC9saT48bGk+dGhhdCBzb2NpYWwvY29tbXVuaXR5IHN1cnBsdXMgaXMgbWF4aW1pemVkLjwvbGk+PC91bD4=","type":"2","correct":"0","userAnswer":"0"},{"questionNum":"3","content":"PHA+RGVmaW5lIHRoZSB0ZXJtIDxlbT5wcm9kdWNlciBzdXJwbHVzPC9lbT4uPC9wPg==","answer":"PHA+TGV2ZWw8YnIgLz4wIDxlbT5UaGUgd29yayBkb2VzIG5vdCBtZWV0IGEgc3RhbmRhcmQgZGVzY3JpYmVkIGJ5IHRoZSBkZXNjcmlwdG9ycyBiZWxvdzwvZW0+LiA8c3Ryb25nPlswXTwvc3Ryb25nPjwvcD48cD48YnIgLz4xIDxlbT5WYWd1ZSBkZWZpbml0aW9uPC9lbT4uIDxzdHJvbmc+WzFdPC9zdHJvbmc+PC9wPjxwPlRoZSBpZGVhIHRoYXQgYSBmaXJtIGVhcm5zIG1vcmUgdGhhbiBpdCByZXF1aXJlcy48L3A+PHA+Jm5ic3A7PC9wPjxwPjIgPGVtPkFjY3VyYXRlIGRlZmluaXRpb248L2VtPi4gPHN0cm9uZz5bMl08L3N0cm9uZz48L3A+PHA+QW4gZXhwbGFuYXRpb24gdGhhdCBpdCBpcyB0aGUgYW1vdW50IG9mIGFjdHVhbCBlYXJuaW5ncyB3aGljaCBhIHByb2R1Y2VyIG1ha2VzIG92ZXIgYW5kIGFib3ZlIHRoZSBhbW91bnQgdGhlIHByb2R1Y2VyIHdvdWxkIGJlIHByZXBhcmVkIHRvIGFjY2VwdCBmb3IgdGhhdCBvdXRwdXQgPHN0cm9uZz5vcjwvc3Ryb25nPiB0aGUgcHJpY2UgcmVjZWl2ZWQgYnkgYSBwcm9kdWNlciBpbiBleGNlc3Mgb2YgdGhlIHByaWNlIGF0IHdoaWNoIHRoZSBwcm9kdWNlciB3b3VsZCBiZSB3aWxsaW5nIGFuZCBhYmxlIHRvIG9mZmVyIGZvciBzYWxlLjwvcD4=","type":"2","correct":"0","userAnswer":"0"},{"questionNum":"4","content":"PHA+RXhwbGFpbiBob3cgY2hhbmdlcyBpbiBwcmljZSB3b3JrIHRvIHJlYWxsb2NhdGUgcmVzb3VyY2VzIGluIGEgbWFya2V0LjwvcD4=","answer":"PHA+PGVtPkFuc3dlcnMgPHN0cm9uZz5tYXk8L3N0cm9uZz4gaW5jbHVkZTo8L2VtPjwvcD48dWw+PGxpPmRlZmluaXRpb24gb2YgcmVhbGxvY2F0aW9uIG9mIHJlc291cmNlczwvbGk+PGxpPmRpYWdyYW1zIHRvIHNob3cgaG93IGNoYW5nZXMgaW4gcHJpY2UgYWx0ZXIgdGhlIGVxdWlsaWJyaXVtIHF1YW50aXR5IGFuZCB0aGVyZWZvcmUgcmVhbGxvY2F0ZSByZXNvdXJjZXM8L2xpPjxsaT50aGVvcnkgdG8gZXhwbGFpbiB0aGUgc2lnbmFsbGluZyBhbmQgaW5jZW50aXZlIGZ1bmN0aW9ucyBvZiB0aGUgcHJpY2UgbWVjaGFuaXNtPC9saT48bGk+ZXhhbXBsZXMgb2YgbWFya2V0cyB3aGVyZSBwcmljZSBjaGFuZ2UgaGFzIGxlZCB0byBhIHJlYWxsb2NhdGlvbiBvZiByZXNvdXJjZXMsIHN1Y2ggYXMgdGhyb3VnaCBnb3Zlcm5tZW50IGludGVydmVudGlvbi48L2xpPjwvdWw+","type":"2","correct":"0","userAnswer":"0"},{"questionNum":"5","content":"PHA+RXhwbGFpbiBob3cgY2hhbmdlcyBpbiBwcmljZSB3b3JrIHRvIHJlYWxsb2NhdGUgcmVzb3VyY2VzIGluIGEgbWFya2V0LjwvcD4=","answer":"PHA+PGVtPkFuc3dlcnM8c3Ryb25nPiBtYXk8L3N0cm9uZz4gaW5jbHVkZTo8L2VtPjwvcD48dWw+PGxpPmRlZmluaXRpb24gb2YgcmVhbGxvY2F0aW9uIG9mIHJlc291cmNlczwvbGk+PGxpPmRpYWdyYW1zIHRvIHNob3cgaG93IGNoYW5nZXMgaW4gcHJpY2UgYWx0ZXIgdGhlIGVxdWlsaWJyaXVtIHF1YW50aXR5IGFuZCB0aGVyZWZvcmUgcmVhbGxvY2F0ZSByZXNvdXJjZXM8L2xpPjxsaT50aGVvcnkgdG8gZXhwbGFpbiB0aGUgc2lnbmFsbGluZyBhbmQgaW5jZW50aXZlIGZ1bmN0aW9ucyBvZiB0aGUgcHJpY2UgbWVjaGFuaXNtPC9saT48bGk+ZXhhbXBsZXMgb2YgbWFya2V0cyB3aGVyZSBwcmljZSBjaGFuZ2UgaGFzIGxlZCB0byBhIHJlYWxsb2NhdGlvbiBvZiByZXNvdXJjZXMsIHN1Y2ggYXMgdGhyb3VnaCBnb3Zlcm5tZW50IGludGVydmVudGlvbi48L2xpPjwvdWw+","type":"2","correct":"0","userAnswer":"0"},{"questionNum":"6","content":"PHA+RXhwbGFpbiB0aGUgbGlrZWx5IGVmZmVjdHMgb2YgZmFsbGluZyBjb3N0cyBvZiBmYWN0b3JzIG9mIHByb2R1Y3Rpb24gb24gcHJpY2UgYW5kIG91dHB1dCBpbiBhZ3JpY3VsdHVyYWwgbWFya2V0cy48L3A+","answer":"PHA+PGVtPkFuc3dlcnMgPHN0cm9uZz5tYXk8L3N0cm9uZz4gaW5jbHVkZTo8L2VtPjwvcD48dWw+PGxpPmRlZmluaXRpb25zIG9mIGNvc3QsIGZhY3RvcnMgb2YgcHJvZHVjdGlvbiBhbmQgc3VwcGx5PC9saT48bGk+ZGlhZ3JhbSB0byBzaG93IGluY3JlYXNpbmcgc3VwcGx5IG9mIGFncmljdWx0dXJhbCBnb29kcywgYSBmYWxsaW5nIHByaWNlIGFuZCBpbmNyZWFzaW5nIG91dHB1dDwvbGk+PGxpPnRoZW9yeSB0byBleHBsYWluIHRoYXQgZmFsbGluZyBjb3N0cyBvZiBmYWN0b3JzIG9mIHByb2R1Y3Rpb24gaW5jcmVhc2UgdGhlIHN1cHBseSBvZiBhZ3JpY3VsdHVyYWwgZ29vZHMsIHJlZHVjZSBwcmljZSBhbmQgaW5jcmVhc2Ugb3V0cHV0PC9saT48bGk+ZXhhbXBsZXMgb2YgYWdyaWN1bHR1cmFsIG1hcmtldHMgd2hlcmUgY29zdHMgZmFsbCBkdWUgdG8gdmFyaW91cyBmYWN0b3JzLCBzdWNoIGFzIGltcHJvdmVtZW50IG9mIHRlY2hub2xvZ3kuPC9saT48L3VsPg==","type":"2","correct":"1","userAnswer":"0"}];
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