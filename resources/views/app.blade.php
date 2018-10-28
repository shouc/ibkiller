@include('header', ['css' => '.css'])

@include('nav', ['q' => false])

 <body> 
   <header class="intro"> 
    <h1 class="intro__hello">Hello! <span class="emoji wave-hand animated"></span> </h1> 
    <h2 class="intro__tagline"> <span class="name"> <img style="margin-bottom:7px;height:42px;width;border-radius:8px" src="{{ $server }}/img/icon.png" /> IBKiller </span> here, a free Questionbank for IBDP students. </h2> 
    <a class="status" href=""> <img src="{{ $server }}/img/appstore.svg" /> </a> 
    <h3 class="intro__contact"> <span>Get in touch</span> <span class="emoji pointer"></span> <span> <a href="mailto:ib@zwang.tech?subject=Inquiry about IBKiller" target="_blank" class="highlight-link">ib@zwang.tech</a> </span> </h3> 
   </header> 



   <section class="section background"> 
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
      <a href=""> <span>Shou Chaofan</span></a> 
     </div> 
    </div> 
    <div class="sharethis-inline-reaction-buttons"></div> 
    <div class="footer__links"> 
     <a href="http://zwang.tech" target="_blank" style="fill:white" title="company"><img src="{{ $server }}/img/social/company.svg" alt="company" /> </a> 
     <a href="https://github.com/IBKillerDev" target="_blank" title="github"><img src="{{ $server }}/img/social/github.svg" alt="github" /> </a> 
     <a href="http:{{ $server }}/terms.html" target="_blank" title="term"><img src="{{ $server }}/img/social/term.svg" alt="term" /> </a> 
    </div> 
   </footer> 
  </div> 
  <script src="{{ $server }}/js/jquery.min.js" type="text/javascript" charset="utf-8"></script> 
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
function go(name){
  $(location).attr('href', `/category?Cat=${name}`);
}
$(document).ready(function(){
    var topH = 90;
    var navbg = $("#navbg");
    $(window).scroll(function () {
        if($(window).scrollTop() > topH){
          navbg.fadeIn();
        }else if ($(window).scrollTop() < topH + 20){
          navbg.fadeOut(70);
        }
    });
});
function cancelBubble(e) {
  var evt = e ? e : window.event;
  if(evt.stopPropagation) { //W3C 
    evt.stopPropagation();
  } else { //IE      
    evt.cancelBubble = true;
  }
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
  cancelBubble();
  if ($(`#star-${id}`).hasClass('far')){
    //not starred
    exist = false;
    for (var i = 0; i < _data.length; i++) {
      if(_data[i]['name'] == 'Your Favorite'){
        exist = i;
      }
    }
    if (!exist){
      _data = _data.concat({'name': 'Your Favorite', 'css': 'g9', 'data': [getImg(id)]});
      gen();
      $(`#star-${id}`).addClass('fas');
      $(`#star-${id}`).removeClass('far');
    } else {
      _data[exist]['data'] = _data[exist]['data'].concat(getImg(id));
      gen();
      for (var m = 0; m < _data[exist]['data'].length; m++) {
        $(`#star-${_data[exist]['data'][m]['name']}`).addClass('fas');
        $(`#star-${_data[exist]['data'][m]['name']}`).removeClass('far');
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
          $(`#star-${_data[exist]['data'][m]['name']}`).addClass('fas');
          $(`#star-${_data[exist]['data'][m]['name']}`).removeClass('far');
        }
      }
      $(`#star-${id}`).addClass('far');
      $(`#star-${id}`).removeClass('fas');
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
    //code += `<div class="bar-local"> <a class="groupname-local font-local"><span class="tit-icon g2-l tit-icon-l"></span>${gname["name"]} -</a> </div>`;
    if (width > 840){
      for (var i = 0; i <= Math.ceil(gname["data"].length/3) - 1; i++) {
        //alert(gname["data"].length - (i + 1)* 3 )
        if (gname["data"].length - (i + 1)* 3 >= 0) {
          code += `
          <div class="blc">
            <div class="three-block-1" onclick=go('${gname["data"][i * 3]["name"]}')>
              <div class="container"> 
                <div class="block-local"> 
                  <img class="picture-local" src="${gname["data"][i * 3]["picture"]}" /> 
                  <p class="name-local">${gname["data"][i * 3]["name"]}</p>
                </div>
                ${ isLoggedIn && gname['name'] != 'Your Favorite'? `
                  <div class="heart-big" onclick=star('${gname["data"][i * 3]["name"]}')>
                    <i class="${gname["data"][i * 3]["favorite"] ? 'fas' : 'far'} fa-star heart-local" id='star-${gname["data"][i * 3]["name"]}'></i>
                  </div>`: ``}
              </div>
            </div>
            <div class="three-block-2" onclick=go('${gname["data"][i * 3 + 1]["name"]}')>
              <div class="container"> 
                <div class="block-local"> 
                  <img class="picture-local" src="${gname["data"][i * 3 + 1]["picture"]}" />
                  <p class="name-local">${gname["data"][i * 3 + 1]["name"]}</p> 
                </div>
                ${ isLoggedIn && gname['name'] != 'Your Favorite'? `
                  <div class="heart-big" onclick=star('${gname["data"][i * 3 + 1]["name"]}')>
                    <i class="${gname["data"][i * 3 + 1]["favorite"] ? 'fas' : 'far'} fa-star heart-local" id='star-${gname["data"][i * 3 + 1]["name"]}'></i>
                  </div>`: ``}
              </div>
            </div> 
            <div class="three-block-3" onclick=go('${gname["data"][i * 3 + 2]["name"]}')>
              <div class="container">
                <div class="block-local"> 
                  <img class="picture-local" src="${gname["data"][i * 3 + 2]["picture"]}" />
                  <p class="name-local">${gname["data"][i * 3 + 2]["name"]}</p>
                </div>
                ${ isLoggedIn && gname['name'] != 'Your Favorite'? `
                  <div class="heart-big" onclick=star('${gname["data"][i * 3 + 2]["name"]}')>
                    <i class="${gname["data"][i * 3 + 2]["favorite"] ? 'fas' : 'far'} fa-star heart-local" id='star-${gname["data"][i * 3 + 2]["name"]}'></i>
                  </div>`: ``}
              </div>
            </div>
          </div>`;
        } 
        if (gname["data"].length - (i + 1)* 3 == -1) {
          code += `
          <div class="blc">
            <div class="three-block-1" onclick=go('${gname["data"][i * 3]["name"]}')>
              <div class="container"> 
                <div class="block-local"> 
                  <img class="picture-local" src="${gname["data"][i * 3]["picture"]}" /> 
                  <p class="name-local">${gname["data"][i * 3]["name"]}</p>
                </div>
                ${ isLoggedIn && gname['name'] != 'Your Favorite'? `
                  <div class="heart-big" onclick=star('${gname["data"][i * 3]["name"]}')>
                    <i class="${gname["data"][i * 3]["favorite"] ? 'fas' : 'far'} fa-star heart-local" id='star-${gname["data"][i * 3]["name"]}'></i>
                  </div>`: ``}
              </div>
            </div>
            <div class="three-block-2" onclick=go('${gname["data"][i * 3 + 1]["name"]}')>
              <div class="container">
                <div class="block-local">
                  <img class="picture-local" src="${gname["data"][i * 3 + 1]["picture"]}" />
                  <p class="name-local">${gname["data"][i * 3 + 1]["name"]}</p>
                </div>
                ${ isLoggedIn && gname['name'] != 'Your Favorite'? `
                  <div class="heart-big" onclick=star('${gname["data"][i * 3 + 1]["name"]}')>
                    <i class="${gname["data"][i * 3 + 1]["favorite"] ? 'fas' : 'far'} fa-star heart-local" id='star-${gname["data"][i * 3 + 1]["name"]}'></i>
                  </div>`: ``}
              </div>
            </div>
          </div>`;
        } 
        if (gname["data"].length - (i + 1)* 3 == -2) {
          code += `
          <div class="blc">
            <div class="three-block-1" onclick=go('${gname["data"][i * 3]["name"]}')>
              <div class="container">
                <div class="block-local">
                  <img class="picture-local" src="${gname["data"][i * 3]["picture"]}" />
                  <p class="name-local">${gname["data"][i * 3]["name"]}</p>
                </div>
                ${ isLoggedIn && gname['name'] != 'Your Favorite'? `
                  <div class="heart-big" onclick=star('${gname["data"][i * 3]["name"]}')>
                    <i class="${gname["data"][i * 3]["favorite"] ? 'fas' : 'far'} fa-star heart-local" id='star-${gname["data"][i * 3]["name"]}'></i>
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
            <div class="two-block-1" onclick=go('${gname["data"][i * 2]["name"]}')>
              <div class="container">
                <div class="block-local">
                  <img class="picture-local" src="${gname["data"][i * 2]["picture"]}" />
                  <p class="name-local">${gname["data"][i * 2]["name"]}</p>
                </div>
                ${ isLoggedIn && gname['name'] != 'Your Favorite'? `
                  <div class="heart-big" onclick=star('${gname["data"][i * 2]["name"]}')>
                    <i class="${gname["data"][i * 2]["favorite"] ? 'fas' : 'far'} fa-star heart-local" id='star-${gname["data"][i * 2]["name"]}'></i>
                  </div>`: ``}
              </div>
            </div>
            <div class="two-block-2" onclick=go('${gname["data"][i * 2 + 1]["name"]}')>
              <div class="container">
                <div class="block-local">
                  <img class="picture-local" src="${gname["data"][i * 2 + 1]["picture"]}" />
                  <p class="name-local">${gname["data"][i * 2 + 1]["name"]}</p>
                </div>
                ${ isLoggedIn && gname['name'] != 'Your Favorite'? `
                  <div class="heart-big" onclick=star('${gname["data"][i * 2 + 1]["name"]}')>
                    <i class="${gname["data"][i * 2 + 1]["favorite"] ? 'fas' : 'far'} fa-star heart-local" id='star-${gname["data"][i * 2 + 1]["name"]}'></i>
                  </div>`: ``}
              </div>
            </div>
          </div>`;
        } 
        if (gname["data"].length - (i + 1)* 2 < 0) {
          code += `
          <div class="blc">
            <div class="two-block-1" onclick=go('${gname["data"][i * 2]["name"]}')>
              <div class="container">
                <div class="block-local">
                  <img class="picture-local" src="${gname["data"][i * 2]["picture"]}" />
                  <p class="name-local">${gname["data"][i * 2]["name"]}</p>
                </div>
                ${ isLoggedIn && gname['name'] != 'Your Favorite'? `
                  <div class="heart-big" onclick=star('${gname["data"][i * 2]["name"]}')>
                    <i class="${gname["data"][i * 2]["favorite"] ? 'fas' : 'far'} fa-star heart-local" id='star-${gname["data"][i * 2]["name"]}'></i>
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
          <div class="one-block-1" onclick=go('${gname["data"][i]["name"]}')>
            <div class="container">
              <div class="block-local">
                <img class="picture-local" src="${gname["data"][i]["picture"]}" />
                <p class="name-local">${gname["data"][i]["name"]}</p>
              </div>
              ${ isLoggedIn && gname['name'] != 'Your Favorite'? `
                  <div class="heart-big" onclick=star('${gname["data"][i]["name"]}')>
                    <i class="${gname["data"][i]["favorite"] ? 'fas' : 'far'} fa-star heart-local" id='star-${gname["data"][i]["name"]}'></i>
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
</html>