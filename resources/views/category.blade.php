
@include('header')

@include('nav', ['q' => false])

<style type="text/css">
body {
  background-color: #fff;
}
@keyframes iconDance {
  from, 49% { transform-origin: -50% 100%; }
  50%, 75%, to { transform-origin: 150% 100%; }
  25% { transform: rotate(-10deg); }
  50% { transform: rotate(0deg); }
  75% { transform: rotate(10deg); }
}
.movingIcon {
  animation: iconDance .8s infinite alternate ease-in-out;
  display: inline-block;
  height: 100px;
  width: 100px;
  background-color: #F0F4F8;
  border-radius: 50px;
  box-shadow: 0px 0px 30px #F0F4F8;
  margin-top: 180px;
}
.iconPicture {
  height: 90px;
  width: 90px;
  margin-top: -5px;
  margin-bottom: -5px;
}
.pageBody {
  position: absolute;
  background-color: #fff;
  text-align: center;
}
.subjectTitle {
  font-size: 32px;
  font-weight: 400;
  color: #666;
  margin-top: 10px;
}
.line {
  height: 0.5px;
  background-color: #ccc;
  margin-top: 30px;
  box-shadow: 1px 3px 3px #eee;
  margin-left: 30px;
  margin-right: 30px;
}
.pageBodyFix {
  bottom: 0;
  top: 80px;
  right:0;
  bottom: 0;
  box-shadow: 1px 1px 30px #ccc;
  border-top-left-radius: 20px;
}
.menuBody {
  position: fixed;
  top: 80px;
  margin-left: 20px;
}
.menuTitle {
  color: #0c2461;
}
.content {
  margin-right: 40px;
  margin-top: 20px;
  margin-left: 40px;
  text-align: left;
}
.cardBody {
  margin-bottom: 20px;
}
</style>

<body>
  <div class="pageBody" id="pageBody">
    <div class="movingIcon">
      <div class="icon-local">
        <img class="iconPicture" src="{{ $server }}/app/icon/{{ $img }}" /></div>
    </div>
    <h1 class="subjectTitle">{{ $subject }}</h1>
    <div class="line" id="line"></div>
    <div class="content" id="content"></div>
  </div>
  <div class="menuBody">
    <ul id="menu"></ul>
  </div>
</body>

<script type="text/javascript">
categoryData = $.parseJSON(window.atob('{{ $data }}'));
categoryPageHTML = "";
categoryMenuHTML = "";
for (var i = 0; i < categoryData.length; i++) {
  categoryPageHTML += `
  <li>
    <a href='#cat${i}' class="menuTitle" onclick=move('cat${i}')>
      ${categoryData[i]["catName"]}
    </a>
  </li>`;
  categoryMenuHTML += `
  <div id='cat${i}'>
    <h4>${categoryData[i]["catName"]}</h4>
  </div>
  <div class="row">`;

  for (var k = 0; k < categoryData[i]['paper'].length; k++) {
    categoryMenuHTML += `
    <div class="col-sm-6">
      <div class="card cardBody">
        <div class="card-body"> 
          <h5 class="card-title">
            ${categoryData[i]['paper'][k][0]}
            ${categoryData[i]['paper'][k][4] == 2 ? '<span class="badge badge-success">New</span>': categoryData[i]['paper'][k][3] ? '<span class="badge badge-success">Done</span>' : '<span class="badge badge-warning">Not Done</span>'} 
          </h5>
          <p class="card-text">
            Total Question Number: <strong>${categoryData[i]['paper'][k][1]}</strong>
            <br>
            Paper Type: <em>${categoryData[i]['paper'][k][4] == 1 ? 'Multiple Choice' : categoryData[i]['paper'][k][4] == 2 ? 'Short Answer' : 'Essay'}</em>
          </p>
          <a class="btn btn-primary" href="/question?Paper=${window.btoa(window.encodeURIComponent(categoryData[i]['paper'][k][0]))}">
            Get Started
          </a>
        </div>
      </div>
    </div>`;
  }
  categoryMenuHTML += '</div>';
}
$('#menu').html(categoryPageHTML);
$('#content').html(categoryMenuHTML);
localStorage.setItem('subject', window.location.href);
if ($(window).width() > 800){
    $("#pageBody").width($(window).width()/4*3);
    $("#pageBody").height($(document).height()+10);
    $("#menu").width($(window).width()/4);
    $('#pageBody').addClass("pageBodyFix");
}
else {
    $("#menu").width(0);
    $("k").width($(window).width());
    $("#menu").hide();
}
</script>