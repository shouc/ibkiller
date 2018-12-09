
@include('header', ['css' => '.cat.css'])

@include('nav', ['q' => false])


<body id="row">
<k class="c" id="bo2">
  <div class="poop">
    <div class="icon-local">
        <img class="pic-local" src="{{ $server }}/app/icon/{{ $img }}"/>
    </div>
  </div>
  <h1 class="h1-local">
      {{ $subject }}
  </h1>

  <div class="line" id="line"></div>
    <div class="content" style="text-align: left;" id="content">
  </div>
</k>
<ma class="ma">
  <ul id="menu">
    
  </ul>
    
</ma>

<bkg class="bkg" id="bk"></bkg>
</body>
<script type="text/javascript">
_data = $.parseJSON(window.atob('{{ $data }}'));
function move(m){
  $("html,body").animate({scrollTop: $('#'+m).offset().top - 100}, 700);
}
function size(){
    mHTML = "";
    tHTML = "";
    for (var i = 0; i < _data.length; i++) {
      mHTML += `
      <li>
        <a href='#cat${i}' class="title" onclick=move('cat${i}')>
          ${_data[i]["catName"]}
        </a>
      </li>`;
      tHTML += `
      <div id='cat${i}'>
        <h4>${_data[i]["catName"]}</h4>
      </div>
      <div class="row">`;

      for (var k = 0; k < _data[i]['paper'].length; k++) {
        tHTML += `
        <div class="col-sm-6">
          <div class="card card-local">
            <div class="card-body"> 
              <h5 class="card-title">
                ${_data[i]['paper'][k][0]}
                ${_data[i]['paper'][k][4] == 2 ? '<span class="badge badge-success">New</span>': _data[i]['paper'][k][3] ? '<span class="badge badge-success">Done</span>' : '<span class="badge badge-warning">Not Done</span>'} 
              </h5>
              <p class="card-text">
                Total Question Number: <strong>${_data[i]['paper'][k][1]}</strong>
                <br>
                Paper Type: <em>${_data[i]['paper'][k][4] == 1 ? 'Multiple Choice' : 'Short Answer'}</em>
              </p>
              <a class="btn btn-primary" href="/question?Paper=${window.btoa(window.encodeURIComponent(_data[i]['paper'][k][0]))}">
                Get Started
              </a>
            </div>
          </div>
        </div>`;
      }
      tHTML += '</div>';
    }
    $('#menu').html(mHTML);
    $('#content').html(tHTML);
    localStorage.setItem('subject', window.location.href);
    if ($(window).width() > 800){
        $("k").width($(window).width()/4*3);
        $("k").height($(document).height()+10);
        $("ma").width($(window).width()/4);
        $("bkg").width($(window).width());
        $("bkg").height($(document).height());
        $("ma").show();
        $('#bo2').addClass("c-local");
    }
    else {
        $("ma").width(0);
        $("k").width($(window).width());
        $("ma").hide();
    }
}
size();
$(window).resize(function() {
    size();
})
</script>