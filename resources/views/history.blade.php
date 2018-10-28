
@include('header', ['css' => '.history.css'])

@include('nav', ['q' => false])

<body id="row">
<k class="c" id="bo2">
  <h1 class="h1-local">
      History
  </h1>


  <div class="line" id="line"></div>
  <div class="content" id="data">
</div>
</k>


<bkg class="bkg" id="bk"></bkg>

</body>

<script type="text/javascript">
res = $.parseJSON(window.atob('{{ $data }}'));
arr = [];
tHTML = [];
tempHTML = [];
function find(arr, str){
  for (v=0;v<arr.length;v++) {
    if ( str == arr[v] ){
      return true;
    } 
  }
  return false;
}
for (var i = 0; i < res.length; i++) {
  if (!find(arr, timestampToTime(parseInt(res[i]["time"])))) {
    arr = arr.concat(timestampToTime(parseInt(res[i]["time"])));
  }

}

for (var i = 0; i < arr.length; i++) {
  for (var j = 0; j < res.length; j++) {
    if (timestampToTime(parseInt(res[j]["time"])) == arr[i]){
      tempHTML = tempHTML.concat(res[j]);
    }
  }
  tHTML = tHTML.concat({"data" : tempHTML, "name": arr[i]});
  tempHTML = [];
}
console.log(tHTML)
function timestampToTime(timestamp) {
  var date = new Date(timestamp * 1000);
  var Y = date.getFullYear() + '-';
  var M = (date.getMonth()+1 < 10 ? '0'+(date.getMonth()+1) : date.getMonth()+1) + '-';
  var D = date.getDate() < 10 ? '0'+(date.getDate()) : date.getDate();
  return Y+M+D;
}


function size(){
    if ($(window).width() > 800){
        $("k").width($(window).width());
    }
    else {
        $("ma").width(0);
        $("k").width($(window).width());
        $("ma").hide();
    }
    
}
size();
$(window).resize(function() {
    size()
});
function go(id){
  localStorage.setItem('subject', `{{ $server }}${window.document.location.pathname}`)
  window.location.href = `/check?PID=${id}`;
}
_data = tHTML;
function gen(){
  width = window.innerWidth;
  code = "";
  for (gname in _data){
    gname = _data[gname];
    code += `<h3 class="bar-local"> <a class="font-local"><font color="#333">${gname["name"]}</font></a></h3>`;
    //code += `<div class="bar-local"> <a class="groupname-local font-local"><span class="tit-icon g2-l tit-icon-l"></span>${gname["name"]} -</a> </div>`;
    if (width > 840){
      for (var i = 0; i <= Math.ceil(gname["data"].length/3) - 1; i++) {
        //alert(gname["data"].length - (i + 1)* 3 )
        if (gname["data"].length - (i + 1)* 3 >= 0) {
          code += `
          <div class="blc">
            <div class="three-block-1" onclick="go('${gname["data"][i * 3]['pid']}')">
              <div class="container">
                <div class="block-local"> 
                  <div class="score">${gname["data"][i * 3]["score"]}<a class="ttq">/${gname["data"][i * 3]["totalQuestionNum"]}</a></div> 
                    <div class="name-local">${gname["data"][i * 3]["paperName"]}</div>
                </div>
              </div>
            </div>
            <div class="three-block-2" onclick="go('${gname["data"][i * 3 + 1]['pid']}')">
              <div class="container">
                <div class="block-local"> 
                  <div class="score">${gname["data"][i * 3 + 1]["score"]}<a class="ttq">/${gname["data"][i * 3 + 1]["totalQuestionNum"]}</a></div> 
                    <div class="name-local">${gname["data"][i * 3 + 1]["paperName"]}</div>
                </div>
              </div>
            </div>
            <div class="three-block-3" onclick="go('${gname["data"][i * 3 + 2]['pid']}')">
              <div class="container">
                <div class="block-local"> 
                  <div class="score">${gname["data"][i * 3 + 2]["score"]}<a class="ttq">/${gname["data"][i * 3 + 2]["totalQuestionNum"]}</a></div> 
                    <div class="name-local">${gname["data"][i * 3 + 2]["paperName"]}</div>
                </div>
              </div>
            </div>
          </div>`;
        } 
        if (gname["data"].length - (i + 1)* 3 == -1) {
          code += `
          <div class="blc">
            <div class="three-block-1" onclick="go('${gname["data"][i * 3]['pid']}')">
              <div class="container">
                <div class="block-local"> 
                  <div class="score">${gname["data"][i * 3]["score"]}<a class="ttq">/${gname["data"][i * 3 + 1]["totalQuestionNum"]}</a></div> 
                    <div class="name-local">${gname["data"][i * 3]["paperName"]}</div>
                </div>
              </div>
            </div>
            <div class="three-block-2" onclick="go('${gname["data"][i * 3 + 1]['pid']}')">
              <div class="container">
                <div class="block-local"> 
                  <div class="score">${gname["data"][i * 3 + 1]["score"]}<a class="ttq">/${gname["data"][i * 3 + 1]["totalQuestionNum"]}</a></div> 
                    <div class="name-local">${gname["data"][i * 3 + 1]["paperName"]}</div>
                </div>
              </div>
            </div>
          </div>`;
        } 
        if (gname["data"].length - (i + 1)* 3 == -2) {
          code += `
          <div class="blc">
            <div class="three-block-1" onclick="go('${gname["data"][i * 3]['pid']}')">
              <div class="container">  
                <div class="block-local"> 
                  <div class="score">${gname["data"][i * 3]["score"]}<a class="ttq">/${gname["data"][i * 3]["totalQuestionNum"]}</a></div> 
                    <div class="name-local">${gname["data"][i * 3]["paperName"]}</div>
                </div>
              </div>
            </div>
          </div>`;
        }
      }
    }
    if (width <= 840 && width > 580){
      for (var i = 0; i <= Math.ceil(gname["data"].length/2) - 1; i++) {
        if (gname["data"].length - (i + 1)* 2 >= 0) {
          code += `
          <div class="blc">
            <div class="two-block-1" onclick="go('${gname["data"][i * 2]['pid']}')">
              <div class="container">
                <div class="block-local"> 
                  <div class="score">${gname["data"][i * 2]["score"]}<a class="ttq">/${gname["data"][i * 2]["totalQuestionNum"]}</a></div> 
                    <div class="name-local">${gname["data"][i * 2]["paperName"]}</div>
                </div>
              </div>
            </div>
            <div class="two-block-2" onclick="go('${gname["data"][i * 2 + 1]['pid']}')">
              <div class="container">
                <div class="block-local"> 
                  <div class="score">${gname["data"][i * 2 + 1]["score"]}<a class="ttq">/${gname["data"][i * 2 + 1]["totalQuestionNum"]}</a></div> 
                    <div class="name-local">${gname["data"][i * 2 + 1]["paperName"]}</div>
                </div>
              </div>
            </div>
          </div>`;
        } 
        if (gname["data"].length - (i + 1)* 2 < 0) {
          code += `
          <div class="blc">
            <div class="two-block-1" onclick="go('${gname["data"][i * 2]['pid']}')">
              <div class="container">
                <div class="block-local"> 
                  <div class="score">${gname["data"][i * 2]["score"]}<a class="ttq">/${gname["data"][i * 2]["totalQuestionNum"]}</a></div> 
                    <div class="name-local">${gname["data"][i * 2]["paperName"]}</div>
                </div>
              </div>
            </div>
          </div>
          </div>`;
        } 
      }
    }
    if (width < 580){
      for (var i = 0; i <= Math.ceil(gname["data"].length) - 1; i++) {
        code += `
        <div class="blc">
          <div class="one-block-1" onclick="go('${gname["data"][i]['pid']}')">
            <div class="container">
              <div class="block-local"> 
                  <div class="score">${gname["data"][i]["score"]}<a class="ttq">/${gname["data"][i]["totalQuestionNum"]}</a></div> 
                    <div class="name-local">${gname["data"][i]["paperName"]}</div>
                </div>
            </div>
          </div>
        </div>`;
      }
    }
    $('#data').html(code);
  }
}
gen();
window.onresize = function(){
  gen();
}
</script>

