
@include('header')

@include('nav', ['q' => false])
<style type="text/css">
body {
  background-color:#fff;
}
.historyContainer {
  position:absolute;
  background-color:#fff;
  text-align:center;
  margin-top:150px;
  margin-bottom:30px;
  display:none;
}
.line {
  height:0.5px;
  background-color:#ccc;
  margin-top:30px;
  margin-left:30px;
  margin-right:30px;
}
.dateBar {
  margin-top:60px;
  width:100%;
}
.dateBarName {
  color:#ccc;
  font-size:35px;
}
.blockContainer {
  margin-top:20px;
  display:flex;
  flex-direction:row;
}
.threeBlocks {
  width:28%;
  height:100px;
  box-shadow:1px 1px 30px #aaa;
  background-color:#fff;
  border-radius:10px;
  margin-bottom:20px;
}
.threeBlocksFirst {
  margin-left:5%;
}
.threeBlocksSecond {
  margin-left:3%;
}
.threeBlocksThird {
  margin-left:3%;
}
.twoBlocks {
  width:43%;
  height:100px;
  box-shadow:1px 1px 30px #aaa;
  background-color:#fff;
  border-radius:10px;
  margin-bottom:20px;
}
.twoBlocksFirst {
  margin-left:5%;
}
.twoBlocksSecond {
  margin-left:4%;
}
.oneBlock {
  width:90%;
  height:100px;
  box-shadow:1px 1px 30px #aaa;
  background-color:#fff;
  margin-left:5%;
  border-radius:10px;
  margin-bottom:20px;
}
.paperName {
  margin-top:36px;
  font-size:20px;
  font-weight:lighter;
  color:#111;
  width:200px;
}
.blockOfData {
  font-size:18px;
  display:flex;
  flex-direction:row;
}
.score {
  margin-left:5px;
}
.scoreContent {
  font-size:65px;
}
.totalQuestionNumContent {
  font-size:15px;
  margin-left:0px;
}
</style>

<body>
  <k class="historyContainer" id="historyContainer">
    <h1>History</h1>
    <div class="line"></div>
    <div class="content" id="data"></div>
  </k>
</body>

<script type="text/javascript">
historyData = $.parseJSON(window.atob('{{ $data }}'));
arr = [];
historyHTML = [];
historyTempHTML = [];

for (var i = 0; i < historyData.length; i++) {
  if (!find(arr, timestampToTime(parseInt(historyData[i]["time"])))) {
    arr = arr.concat(timestampToTime(parseInt(historyData[i]["time"])));
  }

}

for (var i = 0; i < arr.length; i++) {
  for (var j = 0; j < historyData.length; j++) {
    if (timestampToTime(parseInt(historyData[j]["time"])) == arr[i]){
      historyTempHTML = historyTempHTML.concat(historyData[j]);
    }
  }
  historyHTML = historyHTML.concat({"data" : historyTempHTML, "name": arr[i]});
  historyTempHTML = [];
}

if ($(window).width() > 800){
    $("#historyContainer").width($(window).width());
}
else {
    $("#historyContainer").width($(window).width());
}
function go(id){
  localStorage.setItem('subject', `{{ $server }}${window.document.location.pathname}`)
  window.location.href = `/check?PID=${id}`;
}
function pageGeneration(){
  code = "";
  for (id in historyHTML){
    dataRow = historyHTML[id];
    code += `<h3 class="dateBar"> <a class="dateBarName">${dataRow["name"]}</a></h3>`;
    if (width > 840){
      for (var i = 0; i <= Math.ceil(dataRow["data"].length/3) - 1; i++) {
        if (dataRow["data"].length - (i + 1)* 3 >= 0) {
          code += `
          <div class="blockContainer">
            <div class="threeBlocksFirst threeBlocks" onclick="go('${dataRow["data"][i * 3]['pid']}')">
              <div class="container">
                <div class="blockOfData"> 
                  <div class="score"><a class="scoreContent">${dataRow["data"][i * 3]["score"]}<a><a class="totalQuestionNumContent">/${dataRow["data"][i * 3]["totalQuestionNum"]}</a></div> 
                    <div class="paperName">${dataRow["data"][i * 3]["paperName"]}</div>
                </div>
              </div>
            </div>
            <div class="threeBlocksSecond threeBlocks" onclick="go('${dataRow["data"][i * 3 + 1]['pid']}')">
              <div class="container">
                <div class="blockOfData"> 
                  <div class="score"><a class="scoreContent">${dataRow["data"][i * 3 + 1]["score"]}<a><a class="totalQuestionNumContent">/${dataRow["data"][i * 3 + 1]["totalQuestionNum"]}</a></div> 
                    <div class="paperName">${dataRow["data"][i * 3 + 1]["paperName"]}</div>
                </div>
              </div>
            </div>
            <div class="threeBlocksThird threeBlocks" onclick="go('${dataRow["data"][i * 3 + 2]['pid']}')">
              <div class="container">
                <div class="blockOfData"> 
                  <div class="score"><a class="scoreContent">${dataRow["data"][i * 3 + 2]["score"]}<a><a class="totalQuestionNumContent">/${dataRow["data"][i * 3 + 2]["totalQuestionNum"]}</a></div> 
                    <div class="paperName">${dataRow["data"][i * 3 + 2]["paperName"]}</div>
                </div>
              </div>
            </div>
          </div>`;
        } 
        if (dataRow["data"].length - (i + 1)* 3 == -1) {
          code += `
          <div class="blockContainer">
            <div class="threeBlocksFirst threeBlocks" onclick="go('${dataRow["data"][i * 3]['pid']}')">
              <div class="container">
                <div class="blockOfData"> 
                  <div class="score"><a class="scoreContent">${dataRow["data"][i * 3]["score"]}<a><a class="totalQuestionNumContent">/${dataRow["data"][i * 3 + 1]["totalQuestionNum"]}</a></div> 
                    <div class="paperName">${dataRow["data"][i * 3]["paperName"]}</div>
                </div>
              </div>
            </div>
            <div class="threeBlocksSecond threeBlocks" onclick="go('${dataRow["data"][i * 3 + 1]['pid']}')">
              <div class="container">
                <div class="blockOfData"> 
                  <div class="score"><a class="scoreContent">${dataRow["data"][i * 3 + 1]["score"]}<a><a class="totalQuestionNumContent">/${dataRow["data"][i * 3 + 1]["totalQuestionNum"]}</a></div> 
                    <div class="paperName">${dataRow["data"][i * 3 + 1]["paperName"]}</div>
                </div>
              </div>
            </div>
          </div>`;
        } 
        if (dataRow["data"].length - (i + 1)* 3 == -2) {
          code += `
          <div class="blockContainer">
            <div class="threeBlocksFirst threeBlocks" onclick="go('${dataRow["data"][i * 3]['pid']}')">
              <div class="container">  
                <div class="blockOfData"> 
                  <div class="score"><a class="scoreContent">${dataRow["data"][i * 3]["score"]}<a><a class="totalQuestionNumContent">/${dataRow["data"][i * 3]["totalQuestionNum"]}</a></div> 
                    <div class="paperName">${dataRow["data"][i * 3]["paperName"]}</div>
                </div>
              </div>
            </div>
          </div>`;
        }
      }
    }
    if (width <= 840 && width > 580){
      for (var i = 0; i <= Math.ceil(dataRow["data"].length/2) - 1; i++) {
        if (dataRow["data"].length - (i + 1)* 2 >= 0) {
          code += `
          <div class="blockContainer">
            <div class="twoBlocksFirst twoBlocks" onclick="go('${dataRow["data"][i * 2]['pid']}')">
              <div class="container">
                <div class="blockOfData"> 
                  <div class="score"><a class="scoreContent">${dataRow["data"][i * 2]["score"]}<a><a class="totalQuestionNumContent">/${dataRow["data"][i * 2]["totalQuestionNum"]}</a></div> 
                    <div class="paperName">${dataRow["data"][i * 2]["paperName"]}</div>
                </div>
              </div>
            </div>
            <div class="twoBlocksSecond twoBlocks" onclick="go('${dataRow["data"][i * 2 + 1]['pid']}')">
              <div class="container">
                <div class="blockOfData"> 
                  <div class="score"><a class="scoreContent">${dataRow["data"][i * 2 + 1]["score"]}<a><a class="totalQuestionNumContent">/${dataRow["data"][i * 2 + 1]["totalQuestionNum"]}</a></div> 
                    <div class="paperName">${dataRow["data"][i * 2 + 1]["paperName"]}</div>
                </div>
              </div>
            </div>
          </div>`;
        } 
        if (dataRow["data"].length - (i + 1)* 2 < 0) {
          code += `
          <div class="blockContainer">
            <div class="twoBlocksFirst twoBlocks" onclick="go('${dataRow["data"][i * 2]['pid']}')">
              <div class="container">
                <div class="blockOfData"> 
                  <div class="score"><a class="scoreContent">${dataRow["data"][i * 2]["score"]}<a><a class="totalQuestionNumContent">/${dataRow["data"][i * 2]["totalQuestionNum"]}</a></div> 
                    <div class="paperName">${dataRow["data"][i * 2]["paperName"]}</div>
                </div>
              </div>
            </div>
          </div>
          </div>`;
        } 
      }
    }
    if (width < 580){
      for (var i = 0; i <= Math.ceil(dataRow["data"].length) - 1; i++) {
        code += `
        <div class="blockContainer">
          <div class="oneBlock" onclick="go('${dataRow["data"][i]['pid']}')">
            <div class="container">
              <div class="blockOfData"> 
                  <div class="score"><a class="scoreContent">${dataRow["data"][i]["score"]}<a><a class="totalQuestionNumContent">/${dataRow["data"][i]["totalQuestionNum"]}</a></div> 
                    <div class="paperName">${dataRow["data"][i]["paperName"]}</div>
                </div>
            </div>
          </div>
        </div>`;
      }
    }
    historyPaginationHTML = ''
    historyCurrentPage = $_GET['Page'] ? $_GET['Page'] : 1;
    historyPageNum = {{$pageNum}};
    if (historyPageNum < 4){
      for (var j = 1; j <= historyPageNum; j++) {
        historyPaginationHTML += `<li class="page-item ${historyCurrentPage == j ? 'active': ''}"><a class="page-link" href="?Page=${j}">${j}</a></li>`
      }
    } else {
      for (var j = 1; j <= historyPageNum; j++) {
        if (Math.abs(historyCurrentPage - j) < 3){
          historyPaginationHTML += `<li class="page-item ${historyCurrentPage == j ? 'active': ''}"><a class="page-link" href="?Page=${j}">${j}</a></li>`
        }
      }
      if (historyCurrentPage == 1){
        historyPaginationHTML += `<li class="page-item"><a class="page-link" href="?Page=4">4</a></li><li class="page-item"><a class="page-link" href="?Page=5">5</a></li>`
      }
      if (historyCurrentPage == 2){
        historyPaginationHTML += `<li class="page-item"><a class="page-link" href="?Page=5">5</a></li>`
      }
    }
    
    $('#data').html(code + `
      <div class="paging">
        <ul class="pagination justify-content-center">
          <li class="page-item ${historyCurrentPage == 1 ? 'disabled' : ''}"><a class="page-link" href="?Page=${parseInt(historyCurrentPage) - 1}"><</a></li>
            ${historyPaginationHTML}
          <li class="page-item ${historyCurrentPage == historyPageNum ? 'disabled' : ''}"><a class="page-link" href="?Page=${parseInt(historyCurrentPage) + 1}">></a></li>
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
  pageGeneration();
@endif
$("#historyContainer").show();
</script>

