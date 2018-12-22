
@include('header', ['css' => '.history.css'])

@include('nav', ['q' => false])
<style type="text/css">
body {
  background-color: #fff;
}
.c {
    position: absolute;
    background-color: #fff;
    text-align: center;
    margin-top: 150px;
    margin-bottom: 30px;
}
.line {
  height: 0.5px;
  background-color: #ccc;
  margin-top: 30px;
  margin-left: 30px;
  margin-right: 30px;
}
  .jb-local {
    margin-top: 30px;
    background-color: #fff;
    box-shadow: 1px 1px 50px #ccc;
    border-radius: 10px;
  }
  .container-local {
    margin-left: 5%;
    margin-right: 5%;
  }
  .bar-local {
    margin-top: 60px;
    width: 100%;
  }

  .font-local {
    color:#ccc;
    font-size: 35px;
  }
  .blc {
    margin-top: 20px;
    display: flex;
    flex-direction: row;
  }
  .three-block-1 {
    width: 28%;
    height: 100px;
    box-shadow: 1px 1px 30px #aaa;
    margin-left: 5%;
    background-color: #fff;
    border-radius: 10px;
  }
  .three-block-2 {
    width: 28%;
    height: 100px;
    box-shadow: 1px 1px 30px #aaa;
    background-color: #fff;
    margin-left: 3%;
    border-radius: 10px;
  }
  .three-block-3 {
    width: 28%;
    height: 100px;
    box-shadow: 1px 1px 30px #aaa;
    float:right;
    background-color: #fff;
    margin-left: 3%;
    border-radius: 10px;
  }
  .two-block-1 {
    width: 43%;
    height: 100px;
    box-shadow: 1px 1px 30px #aaa;
    background-color: #fff;
    margin-left: 5%;
    border-radius: 10px;
  }
  .two-block-2 {
    width: 43%;
    height: 100px;
    box-shadow: 1px 1px 30px #aaa;
    background-color: #fff;
    margin-left: 4%;
    border-radius: 10px;
  }
  .one-block-1 {
    width: 90%;
    height: 100px;
    box-shadow: 1px 1px 30px #aaa;
    background-color: #fff;
    margin-left: 5%;
    border-radius: 10px;
  }
  
  .name-local{
    margin-top: 36px;
    font-size:20px;
    font-weight: lighter;
    color:#111;
    width:200px;
  }
  .block-local{
    font-size: 18px;
    display:flex;
    flex-direction: row;
  }
  .picture-local{
    margin-left: 7px;
    margin-top: 22.5px;
    height: 55px;
    width: 55px;
  }
  .score {
    margin-left: 5px;
  }
  .score-text {
    font-size: 65px;
    font-weight: 200;
    
  }
  .ttq {
    font-size: 15px;
    margin-left: 0px;
    font-weight: 300;
  }
  .info-local {
    flex-direction: column;
  }
  .his-b {
    margin-bottom: 20px;
  }


</style>
<body id="row">
<k class="c" id="bo2" style="display: none;">
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
    code += `<h3 class="bar-local"> <a class="font-local">${gname["name"]}</a></h3>`;
    if (width > 840){
      for (var i = 0; i <= Math.ceil(gname["data"].length/3) - 1; i++) {
        if (gname["data"].length - (i + 1)* 3 >= 0) {
          code += `
          <div class="blc">
            <div class="three-block-1" onclick="go('${gname["data"][i * 3]['pid']}')">
              <div class="container">
                <div class="block-local"> 
                  <div class="score"><a class="score-text">${gname["data"][i * 3]["score"]}<a><a class="ttq">/${gname["data"][i * 3]["totalQuestionNum"]}</a></div> 
                    <div class="name-local">${gname["data"][i * 3]["paperName"]}</div>
                </div>
              </div>
            </div>
            <div class="three-block-2" onclick="go('${gname["data"][i * 3 + 1]['pid']}')">
              <div class="container">
                <div class="block-local"> 
                  <div class="score"><a class="score-text">${gname["data"][i * 3 + 1]["score"]}<a><a class="ttq">/${gname["data"][i * 3 + 1]["totalQuestionNum"]}</a></div> 
                    <div class="name-local">${gname["data"][i * 3 + 1]["paperName"]}</div>
                </div>
              </div>
            </div>
            <div class="three-block-3" onclick="go('${gname["data"][i * 3 + 2]['pid']}')">
              <div class="container">
                <div class="block-local"> 
                  <div class="score"><a class="score-text">${gname["data"][i * 3 + 2]["score"]}<a><a class="ttq">/${gname["data"][i * 3 + 2]["totalQuestionNum"]}</a></div> 
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
                  <div class="score"><a class="score-text">${gname["data"][i * 3]["score"]}<a><a class="ttq">/${gname["data"][i * 3 + 1]["totalQuestionNum"]}</a></div> 
                    <div class="name-local">${gname["data"][i * 3]["paperName"]}</div>
                </div>
              </div>
            </div>
            <div class="three-block-2" onclick="go('${gname["data"][i * 3 + 1]['pid']}')">
              <div class="container">
                <div class="block-local"> 
                  <div class="score"><a class="score-text">${gname["data"][i * 3 + 1]["score"]}<a><a class="ttq">/${gname["data"][i * 3 + 1]["totalQuestionNum"]}</a></div> 
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
                  <div class="score"><a class="score-text">${gname["data"][i * 3]["score"]}<a><a class="ttq">/${gname["data"][i * 3]["totalQuestionNum"]}</a></div> 
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
                  <div class="score"><a class="score-text">${gname["data"][i * 2]["score"]}<a><a class="ttq">/${gname["data"][i * 2]["totalQuestionNum"]}</a></div> 
                    <div class="name-local">${gname["data"][i * 2]["paperName"]}</div>
                </div>
              </div>
            </div>
            <div class="two-block-2" onclick="go('${gname["data"][i * 2 + 1]['pid']}')">
              <div class="container">
                <div class="block-local"> 
                  <div class="score"><a class="score-text">${gname["data"][i * 2 + 1]["score"]}<a><a class="ttq">/${gname["data"][i * 2 + 1]["totalQuestionNum"]}</a></div> 
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
                  <div class="score"><a class="score-text">${gname["data"][i * 2]["score"]}<a><a class="ttq">/${gname["data"][i * 2]["totalQuestionNum"]}</a></div> 
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
                  <div class="score"><a class="score-text">${gname["data"][i]["score"]}<a><a class="ttq">/${gname["data"][i]["totalQuestionNum"]}</a></div> 
                    <div class="name-local">${gname["data"][i]["paperName"]}</div>
                </div>
            </div>
          </div>
        </div>`;
      }
    }
    pHTMLHis = ''
    currentPageHis = $_GET['Page'] ? $_GET['Page'] : 1;
    pageNumHis = {{$pageNum}};
    if (pageNumHis < 4){
      for (var j = 1; j <= pageNumHis; j++) {
        pHTMLHis += `<li class="page-item ${currentPageHis == j ? 'active': ''}"><a class="page-link" href="?Page=${j}">${j}</a></li>`
      }
    } else {
      for (var j = 1; j <= pageNumHis; j++) {
        if (Math.abs(currentPageHis - j) < 3){
          pHTMLHis += `<li class="page-item ${currentPageHis == j ? 'active': ''}"><a class="page-link" href="?Page=${j}">${j}</a></li>`
        }
      }
      if (currentPageHis == 1){
        pHTMLHis += `<li class="page-item"><a class="page-link" href="?Page=4">4</a></li><li class="page-item"><a class="page-link" href="?Page=5">5</a></li>`
      }
      if (currentPageHis == 2){
        pHTMLHis += `<li class="page-item"><a class="page-link" href="?Page=5">5</a></li>`
      }
    }
    
    $('#data').html(code + `
      <div class="paging">
        <ul class="pagination justify-content-center">
          <li class="page-item ${currentPageHis == 1 ? 'disabled' : ''}"><a class="page-link" href="?Page=${parseInt(currentPageHis) - 1}"><</a></li>
            ${pHTMLHis}
          <li class="page-item ${currentPageHis == pageNumHis ? 'disabled' : ''}"><a class="page-link" href="?Page=${parseInt(currentPageHis) + 1}">></a></li>
        </ul>
      </div>
      `);

  }
  

}
$('#data').html(`
  Nothing here!<br>
  Get something done and come back!<br>
  😒😒😒
  `);
@if($isExist)
  gen();
  window.onresize = function(){
    gen();
  }
@endif
$("#bo2").show();
</script>

