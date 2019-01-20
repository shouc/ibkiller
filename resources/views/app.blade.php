@include('header')

@include('nav', ['q' => false])
<link rel="stylesheet" type="text/css" href="https://cdn-bucket.ibkiller.com/css/main.css">
 <body class="homeBody"> 
   <header class="intro"> 
    <h1 class="intro__hello">Hello! <span class="emoji wave-hand animated"></span> </h1> 
    <h2 class="intro__tagline"> <span class="name"> <img style="margin-bottom:7px;height:42px;width;border-radius:8px" src="https://cdn-bucket.ibkiller.com/img/icon.png" /> IBKiller </span> here, a free Questionbank for IBDP students. </h2> 
    <a class="status"> 
      <img src="https://cdn-bucket.ibkiller.com/img/appstore.svg" class="btn-app" onclick='alert("Developing")'/>
      &nbsp;
      <button class="btn btn-web" onclick='$("html, body").animate({ scrollTop: $("#main").offset().top - 120}, {duration: 400,easing: "swing"});'>Use Web Version</button>
    </a>
    <h3 class="intro__contact" id="contact"> <span>Get in touch</span> <span class="emoji pointer"></span> <span> <a href="mailto:ib@zwang.tech?subject=Inquiry about IBKiller" target="_blank" class="highlight-link" class="link">ib@zwang.tech</a> </span> </h3> 
   </header> 



   <section class="section background" id="main"> 
    <div style="width: 100%;">
    <div class="alert alert-dismissible fade show" style="margin-top: 50px;margin-left: 5%;margin-right: 5%; background-color: #2c2c54; color: #fff;" id='step1'>
      <button type="button" class="close" data-dismiss="alert" aria-label="Close">
        <span aria-hidden="true">&times;</span>
      </button>
      <h4 class="alert-heading" style="color: #fff"><i class="fas fa-map-pin"></i></h4>
      <h4 class="alert-heading" style="color: #fff">A Note from CEO</h4>

      <p style="color: #fff">In brief, <br><strong style="color: #fff">1. </strong>You can find a study mate here.<br><strong style="color: #fff">2. </strong>Help us enrich our question base at here.</p>
    </div>
    </div>
    <div id="data"></div>

   </section> 



   <section class="section featured-projects"> 
    
   </section> 
   <footer class="footer"> 
    <div class="footer__copyright"> 
     <div class="top"> 
      <span>Developed with ❤ by </span> 
     </div> 
     <div class="bottom"> 
      <span>Zhanwang Tech.</span>
     </div> 
    </div> 
    <div class="sharethis-inline-reaction-buttons"></div> 
    <div class="footer__links"> 
     <a href="http://zwang.tech" target="_blank" style="fill:white" title="company"><img src="https://cdn-bucket.ibkiller.com/img/company.svg" alt="company" /> </a> 
     <a href="https://github.com/IBKillerDev" target="_blank" title="github"><img src="https://cdn-bucket.ibkiller.com/img/github.svg" alt="github" /> </a> 
     <a href="https://cdn-bucket.ibkiller.com/terms.html" target="_blank" title="term"><img src="https://cdn-bucket.ibkiller.com/img/term.svg" alt="term" /> </a> 
    </div> 
   </footer> 
  </div> 
  <script>

$(function() {
  const body = document.querySelector('body');
  const introHeight = document.querySelector('.intro').offsetHeight;
  const hand = document.querySelector('.emoji.wave-hand');
  function waveOnLoad() {
    hand.classList.add('wave');
    setTimeout(function() {
      hand.classList.remove('wave');
    }, 2000);
  }
  setTimeout(function() {
    waveOnLoad();
  }, 1000);
  hand.addEventListener('mouseover', function() {
    hand.classList.add('wave');
  });
  hand.addEventListener('mouseout', function() {
    hand.classList.remove('wave');
  });
});


if (width < 550 && width >= 300){
  $("#contact").hide();
}

if (width < 330){
  $("#contact").html('');
}
function go(name){
  $(location).attr('href', `/category?Cat=${name}`);
}

function cancelBubble(e) {
  try{
    var evt = e ? e : window.event;
    if(evt.stopPropagation) { //W3C 
      evt.stopPropagation();
    } else { //IE      
      evt.cancelBubble = true;
    }
  } catch (err) {
    return err;
  }
  
}
function startIntro(){
  var intro = introJs();
  intro.setOptions({
    steps: [
      {
        element: document.getElementById('step1'),
        intro: "Each block like this represents a paper. By clicking the button get started, you could do the paper. Note that if we do not state that it is HL, then it is for both SL/HL.",
      },
      {
        element: document.getElementById('step2'),
        intro: "By clicking this block, we could lead you to the category of this subject.",
      },
      @if($isLoggedIn)
      {
        element: document.getElementById('star-Chemistry'),
        intro: "By clicking the star, you could add this subject to your 'favorite'",
      },
      @endif
    ]
  });

  intro.setOption('showProgress', true).start();
}

function getImg(id){
  for (var i = 0; i < _data.length; i++) {
    for (var j = 0; j < _data[i]['data'].length; j++) {
      if (_data[i]['data'][j]['name'] == id){
        _data[i]['data'][j]['favorite'] = 1;
        return _data[i]['data'][j]
      }
    }
  }
}
function deletFavorite(id){
  for (var i = 0; i < _data.length; i++) {
    for (var j = 0; j < _data[i]['data'].length; j++) {
      if (_data[i]['data'][j]['name'] == id){
        _data[i]['data'][j]['favorite'] = 0;
        return _data[i]['data'][j]
      }
    }
  }
}
function star(id){
  id = window.atob(id);
  cancelBubble();
  if ($(`#star-${window.btoa(id).replace('==', "").replace('=', "")}`).hasClass('far')){
    //not starred
    exist = false;
    for (var i = 0; i < _data.length; i++) {
      if(_data[i]['name'] == 'Your Favorite'){
        exist = i;
      }
    }
    if (!exist){
      _data = _data.concat({'name': 'Your Favorite', 'css': '', 'data': [getImg(id)]});
      gen();
      $(`#star-${window.btoa(id).replace('==', "").replace('=', "")}`).addClass('fas');
      $(`#star-${window.btoa(id).replace('==', "").replace('=', "")}`).removeClass('far');
    } else {
      _data[exist]['data'] = _data[exist]['data'].concat(getImg(id));
      gen();
      for (var m = 0; m < _data[exist]['data'].length; m++) {
        $(`#star-${window.btoa(_data[exist]['data'][m]['name']).replace('==', "").replace('=', "")}`).addClass('fas');
        $(`#star-${window.btoa(_data[exist]['data'][m]['name']).replace('==', "").replace('=', "")}`).removeClass('far');
      }
    }
    $.get(`/userAddFavorite?Name=${id}`);
  } else {
    exist = false;
    for (var i = 0; i < _data.length; i++) {
      if(_data[i]['name'] == 'Your Favorite'){
        exist = i;
      }
    }
    if (exist){
      for (var i = 0; i < _data[exist]['data'].length; i++) {
        if (_data[exist]['data'][i]['name'] == id){
          _data[exist]['data'].splice(i, 1);
        }
      }
      deletFavorite(id);
      if (_data[exist]['data'].length == 0){
        _data.splice(exist, 1);
        gen();
      } else {
        gen();
        for (var m = 0; m < _data[exist]['data'].length; m++) {
          $(`#star-${window.btoa(_data[exist]['data'][m]['name']).replace('==', "").replace('=', "")}`).addClass('fas');
          $(`#star-${window.btoa(_data[exist]['data'][m]['name']).replace('==', "").replace('=', "")}`).removeClass('far');
        }
      }
      $(`#star-${window.btoa(id).replace('==', "").replace('=', "")}`).addClass('far');
      $(`#star-${window.btoa(id).replace('==', "").replace('=', "")}`).removeClass('fas');
    } else {
      return 'error'
    }
    $.get(`/userDelFavorite?Name=${id}`);
  }
  console.log(_data);
}
  </script>  

<script type="text/javascript">
_data =  $.parseJSON(window.atob('{{ $data }}'));
function gen(){
  width = window.innerWidth;
  isLoggedIn = {{ $isLoggedIn ? 1 : 0 }};
  code = "";
  _temp = _data.slice(0);
  _temp.reverse();
  for (gname in _temp){
    gname = _temp[gname];
    code += `<h3 class="bar-local">
              <span class="tit-icon ${gname["css"]}-l tit-icon-l"></span>
              <a class="font-local"><font color="#eee">${gname["name"]}</font></a>
              <span class="tit-icon ${gname["css"]}-r tit-icon-r"></span> 
            </h3>`;
    if (width > 840){
      for (var i = 0; i <= Math.ceil(gname["data"].length/3) - 1; i++) {
        if (gname["data"].length - (i + 1)* 3 >= 0) {
          code += `
          <div class="blc">
            <div class="three-block-1" onclick=go('${window.btoa(gname["data"][i * 3]["name"])}') id=${i == 0 ? `'step2'` : 'useLess'}>
              <div class="container"> 
                <div class="block-local"> 
                  <img class="picture-local" src="${gname["data"][i * 3]["picture"]}" /> 
                  <p class="name-local">${gname["data"][i * 3]["name"]}</p>
                </div>
                ${ isLoggedIn && gname['name'] != 'Your Favorite'? `
                  <div class="heart-big" onclick=star('${window.btoa(gname["data"][i * 3]["name"])}')>
                    <i class="${gname["data"][i * 3]["favorite"] ? 'fas' : 'far'} fa-star heart-local" id='star-${window.btoa(gname["data"][i * 3]["name"]).replace('==', "").replace('=', "")}'></i>
                  </div>`: ``}
              </div>
            </div>
            <div class="three-block-2" onclick=go('${window.btoa(gname["data"][i * 3 + 1]["name"])}')>
              <div class="container"> 
                <div class="block-local"> 
                  <img class="picture-local" src="${gname["data"][i * 3 + 1]["picture"]}" />
                  <p class="name-local">${gname["data"][i * 3 + 1]["name"]}</p> 
                </div>
                ${ isLoggedIn && gname['name'] != 'Your Favorite'? `
                  <div class="heart-big" onclick=star('${window.btoa(gname["data"][i * 3 + 1]["name"])}')>
                    <i class="${gname["data"][i * 3 + 1]["favorite"] ? 'fas' : 'far'} fa-star heart-local" id='star-${window.btoa(gname["data"][i * 3 + 1]["name"]).replace('==', "").replace('=', "")}'></i>
                  </div>`: ``}
              </div>
            </div> 
            <div class="three-block-3" onclick=go('${window.btoa(gname["data"][i * 3 + 2]["name"])}')>
              <div class="container">
                <div class="block-local"> 
                  <img class="picture-local" src="${gname["data"][i * 3 + 2]["picture"]}" />
                  <p class="name-local">${gname["data"][i * 3 + 2]["name"]}</p>
                </div>
                ${ isLoggedIn && gname['name'] != 'Your Favorite'? `
                  <div class="heart-big" onclick=star('${window.btoa(gname["data"][i * 3 + 2]["name"])}')>
                    <i class="${gname["data"][i * 3 + 2]["favorite"] ? 'fas' : 'far'} fa-star heart-local" id='star-${window.btoa(gname["data"][i * 3 + 2]["name"]).replace('==', "").replace('=', "")}'></i>
                  </div>`: ``}
              </div>
            </div>
          </div>`;
        } 
        if (gname["data"].length - (i + 1)* 3 == -1) {
          code += `
          <div class="blc">
            <div class="three-block-1" onclick=go('${window.btoa(gname["data"][i * 3]["name"])}')>
              <div class="container"> 
                <div class="block-local"> 
                  <img class="picture-local" src="${gname["data"][i * 3]["picture"]}" /> 
                  <p class="name-local">${gname["data"][i * 3]["name"]}</p>
                </div>
                ${ isLoggedIn && gname['name'] != 'Your Favorite'? `
                  <div class="heart-big" onclick=star('${window.btoa(gname["data"][i * 3]["name"])}')>
                    <i class="${gname["data"][i * 3]["favorite"] ? 'fas' : 'far'} fa-star heart-local" id='star-${window.btoa(gname["data"][i * 3]["name"]).replace('==', "").replace('=', "")}'></i>
                  </div>`: ``}
              </div>
            </div>
            <div class="three-block-2" onclick=go('${window.btoa(gname["data"][i * 3 + 1]["name"])}')>
              <div class="container">
                <div class="block-local">
                  <img class="picture-local" src="${gname["data"][i * 3 + 1]["picture"]}" />
                  <p class="name-local">${gname["data"][i * 3 + 1]["name"]}</p>
                </div>
                ${ isLoggedIn && gname['name'] != 'Your Favorite'? `
                  <div class="heart-big" onclick=star('${window.btoa(gname["data"][i * 3 + 1]["name"])}')>
                    <i class="${gname["data"][i * 3 + 1]["favorite"] ? 'fas' : 'far'} fa-star heart-local" id='star-${window.btoa(gname["data"][i * 3 + 1]["name"]).replace('==', "").replace('=', "")}'></i>
                  </div>`: ``}
              </div>
            </div>
          </div>`;
        } 
        if (gname["data"].length - (i + 1)* 3 == -2) {
          code += `
          <div class="blc">
            <div class="three-block-1" onclick=go('${window.btoa(gname["data"][i * 3]["name"])}')>
              <div class="container">
                <div class="block-local">
                  <img class="picture-local" src="${gname["data"][i * 3]["picture"]}" />
                  <p class="name-local">${gname["data"][i * 3]["name"]}</p>
                </div>
                ${ isLoggedIn && gname['name'] != 'Your Favorite'? `
                  <div class="heart-big" onclick=star('${window.btoa(gname["data"][i * 3]["name"])}')>
                    <i class="${gname["data"][i * 3]["favorite"] ? 'fas' : 'far'} fa-star heart-local" id='star-${window.btoa(gname["data"][i * 3]["name"]).replace('==', "").replace('=', "")}'></i>
                  </div>`: ``}
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
            <div class="two-block-1" onclick=go('${window.btoa(gname["data"][i * 2]["name"])}')>
              <div class="container">
                <div class="block-local">
                  <img class="picture-local" src="${gname["data"][i * 2]["picture"]}" />
                  <p class="name-local">${gname["data"][i * 2]["name"]}</p>
                </div>
                ${ isLoggedIn && gname['name'] != 'Your Favorite'? `
                  <div class="heart-big" onclick=star('${window.btoa(gname["data"][i * 2]["name"])}')>
                    <i class="${gname["data"][i * 2]["favorite"] ? 'fas' : 'far'} fa-star heart-local" id='star-${window.btoa(gname["data"][i * 2]["name"]).replace('==', "").replace('=', "")}'></i>
                  </div>`: ``}
              </div>
            </div>
            <div class="two-block-2" onclick=go('${window.btoa(gname["data"][i * 2 + 1]["name"]).replace('==', "").replace('=', "")}')>
              <div class="container">
                <div class="block-local">
                  <img class="picture-local" src="${gname["data"][i * 2 + 1]["picture"]}" />
                  <p class="name-local">${gname["data"][i * 2 + 1]["name"]}</p>
                </div>
                ${ isLoggedIn && gname['name'] != 'Your Favorite'? `
                  <div class="heart-big" onclick=star('${window.btoa(gname["data"][i * 2 + 1]["name"])}')>
                    <i class="${gname["data"][i * 2 + 1]["favorite"] ? 'fas' : 'far'} fa-star heart-local" id='star-${window.btoa(gname["data"][i * 2 + 1]["name"]).replace('==', "").replace('=', "")}'></i>
                  </div>`: ``}
              </div>
            </div>
          </div>`;
        } 
        if (gname["data"].length - (i + 1)* 2 < 0) {
          code += `
          <div class="blc">
            <div class="two-block-1" onclick=go('${window.btoa(gname["data"][i * 2]["name"])}')>
              <div class="container">
                <div class="block-local">
                  <img class="picture-local" src="${gname["data"][i * 2]["picture"]}" />
                  <p class="name-local">${gname["data"][i * 2]["name"]}</p>
                </div>
                ${ isLoggedIn && gname['name'] != 'Your Favorite'? `
                  <div class="heart-big" onclick=star('${window.btoa(gname["data"][i * 2]["name"])}')>
                    <i class="${gname["data"][i * 2]["favorite"] ? 'fas' : 'far'} fa-star heart-local" id='star-${window.btoa(gname["data"][i * 2]["name"]).replace('==', "").replace('=', "")}'></i>
                  </div>`: ``}
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
          <div class="one-block-1" onclick=go('${window.btoa(gname["data"][i]["name"])}')>
            <div class="container">
              <div class="block-local">
                <img class="picture-local" src="${gname["data"][i]["picture"]}" />
                <p class="name-local">${gname["data"][i]["name"]}</p>
              </div>
              ${ isLoggedIn && gname['name'] != 'Your Favorite'? `
                  <div class="heart-big" onclick=star('${window.btoa(gname["data"][i]["name"])}')>
                    <i class="${gname["data"][i]["favorite"] ? 'fas' : 'far'} fa-star heart-local" id='star-${window.btoa(gname["data"][i]["name"]).replace('==', "").replace('=', "")}'></i>
                  </div>`: ``}
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
};
</script> 
 </body>

@include('foot')

