@include('header', ['css' => '.css'])

<div id="navbg" class="nav-local-h">
 <nav class="navbar navbar-expand-sm navbar-light " class="nav-local">
  <ul class="navbar-nav mr-auto mt-lg-0">
  <li class="nav-item">
    <a class="nav-link" href="#">Home</a>
  </li>
  <li class="nav-item">
    <a class="nav-link" href="#">Help</a>
  </li>
  </ul>
  <form class="form-inline my-2 my-lg-0">
    <button class="btn btn-success my-2 my-sm-0" type="submit">Register</button>
    &nbsp;&nbsp;
    <button class="btn btn-outline-success my-2 my-sm-0" type="submit">Login</button>
  </form>
</nav>
</div>
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
      <span>Designed with ❤ by </span> 
     </div> 
     <div class="bottom"> 
      <a href=""> <span>Kelvin Kamau &amp; Shou Chaofan</span></a> 
     </div> 
    </div> 
    <div class="sharethis-inline-reaction-buttons"></div> 
    <div class="footer__links"> 
     <a href="http://zwang.tech" target="_blank" title="company"><img src="{{ $server }}/img/social/company.svg" alt="company" /> </a> 
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


  </script>  

<script type="text/javascript">
_data = [{"name" : "Your Favorite",
    "css" : "g1", 
    "data" : [{
      "name": "ESS",
      "picture": "{{ $server }}/app/icon/home_Biology.png"
    },
    {
      "name": "Chemistry",
      "picture": "{{ $server }}/app/icon/home_Chemistry.png"
    },
    {
      "name": "Biology",
      "picture": "{{ $server }}/app/icon/home_Geography.png"
    },
    {
      "name": "Biology",
      "picture": "{{ $server }}/app/icon/home_L.png"
    },
    {
      "name": "Biology",
      "picture": "{{ $server }}/app/icon/home_L2.png"
    }
  ]
}, 

{"name" : "Group 1", 
    "css" : "g2", 
    "data" : [{
      "name": "ESS",
      "picture": "c.png"
    },
    {
      "name": "Chemistry",
      "picture": "c.png"
    },
    {
      "name": "Biology",
      "picture": "c.png"
    }
  ]
}];


function gen(){
  width = window.innerWidth;
  code = "";
  for (gname in _data){
    gname = _data[gname]
    code += `<h3 class="bar-local">
              <span class="tit-icon ${gname["css"]}-l tit-icon-l"></span>
              <a class="font-local"><font color="#eee">${gname["name"]}</font></a>
              <span class="tit-icon ${gname["css"]}-r tit-icon-r"></span> 
            </h3>`
    //code += `<div class="bar-local"> <a class="groupname-local font-local"><span class="tit-icon g2-l tit-icon-l"></span>${gname["name"]} -</a> </div>`;
    if (width > 840){
      for (var i = 0; i <= Math.ceil(gname["data"].length/3) - 1; i++) {
        //alert(gname["data"].length - (i + 1)* 3 )
        if (gname["data"].length - (i + 1)* 3 >= 0) {
          code += `
          <div class="blc">
            <div class="three-block-1">
              <div class="container"> 
                <div class="block-local"> 
                  <img class="picture-local" src="${gname["data"][i * 3]["picture"]}" /> 
                  <p class="name-local">${gname["data"][i * 3]["name"]}</p>
                </div> 
              </div>
            </div>
            <div class="three-block-2">
              <div class="container"> 
                <div class="block-local"> 
                  <img class="picture-local" src="${gname["data"][i * 3 + 1]["picture"]}" />
                  <p class="name-local">${gname["data"][i * 3 + 1]["name"]}</p> 
                </div>
              </div>
            </div> 
            <div class="three-block-3">
              <div class="container">
                <div class="block-local"> 
                  <img class="picture-local" src="${gname["data"][i * 3 + 2]["picture"]}" />
                  <p class="name-local">${gname["data"][i * 3 + 2]["name"]}</p>
                </div>
              </div>
            </div>
          </div>`;
        } 
        if (gname["data"].length - (i + 1)* 3 == -1) {
          code += `
          <div class="blc">
            <div class="three-block-1">
              <div class="container"> 
                <div class="block-local"> 
                  <img class="picture-local" src="${gname["data"][i * 3]["picture"]}" /> 
                  <p class="name-local">${gname["data"][i * 3]["name"]}</p>
                </div>
              </div>
            </div>
            <div class="three-block-2">
              <div class="container">
                <div class="block-local">
                  <img class="picture-local" src="${gname["data"][i * 3 + 1]["picture"]}" />
                  <p class="name-local">${gname["data"][i * 3 + 1]["name"]}</p>
                </div>
              </div>
            </div>
          </div>`;
        } 
        if (gname["data"].length - (i + 1)* 3 == -2) {
          code += `
          <div class="blc">
            <div class="three-block-1">
              <div class="container">
                <div class="block-local">
                  <img class="picture-local" src="${gname["data"][i * 3]["picture"]}" />
                  <p>${gname["data"][i * 3]["name"]}</p>
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
            <div class="two-block-1">
              <div class="container">
                <div class="block-local">
                  <img class="picture-local" src="${gname["data"][i * 2]["picture"]}" />
                  <p class="name-local">${gname["data"][i * 2]["name"]}</p>
                </div>
              </div>
            </div>
            <div class="two-block-2">
              <div class="container">
                <div class="block-local">
                  <img class="picture-local" src="${gname["data"][i * 2 + 1]["picture"]}" />
                  <p class="name-local">${gname["data"][i * 2 + 1]["name"]}</p>
                </div>
              </div>
            </div>
          </div>`;
        } 
        if (gname["data"].length - (i + 1)* 2 < 0) {
          code += `
          <div class="blc">
            <div class="two-block-1">
              <div class="container">
                <div class="block-local">
                  <img class="picture-local" src="${gname["data"][i * 2]["picture"]}" />
                  <p class="name-local">${gname["data"][i * 2]["name"]}</p>
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
          <div class="one-block-1">
            <div class="container">
              <div class="block-local">
                <img class="picture-local" src="${gname["data"][i]["picture"]}" />
                <p class="name-local">${gname["data"][i]["name"]}</p>
              </div>
            </div>
          </div>
        </div>`;
      }
    }
    $('#data').html(code)
  }
}
gen();
window.onresize = function(){
  gen();
}



</script> 
 </body>
</html>
