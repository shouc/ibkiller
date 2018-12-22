
<!DOCTYPE html>
<head> 
    <meta charset="UTF-8" /> 
    <meta content="IE=edge,chrome=1" http-equiv="X-UA-Compatible" /> 
    <meta name="viewport" content="width=device-width, initial-scale=1.0, maximum-scale=1.0, user-scalable=no" /> 
    <title>IBKiller | Questionbank for IB Students</title> 
    <link rel="icon" type="image/png" href="{{ $server }}/img/icon.png" hreflang="en-us" /> 
    <meta property="og:title" content="IBKiller | Questionbank for IB Students" /> 
    <meta property="og:description" content="IBKiller is a free Questionbank for IBDP students." /> 
    <meta property="og:type" content="website" /> 
    <meta property="og:url" content="{{ $server }}" /> 
    <meta property="og:site_name" content="IBKiller" /> 
    <meta property="og:image" content="{{ $server }}/og.png" /> 
    <meta property="og:image:width" content="1280" /> 
    <meta property="og:image:height" content="800" /> 
    <meta property="og:image:type" content="image/png" /> 
    <meta property="og:locale" content="en_US" /> 
    <meta name="description" content="IBKiller is a free Questionbank for IBDP students." /> 
    <meta name="keywords" content="ibdp, ibdp past papers, ib prep app, testprep, ib students" /> 
    <meta itemprop="name" content="IBKiller | Questionbank for IB Students" /> 
    <meta itemprop="description" content="IBKiller is a free Questionbank for IBDP students." /> 
    <meta itemprop="image" content="{{ $server }}/og.png" /> 
    <meta name="theme-color" content="#242433" /> 
    <link rel="canonical" href="{{ $server }}" /> 
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.1.3/css/bootstrap.min.css">
    <script src="/js/jquery.min.js"></script> 
    <style type="text/css">
        /* cyrillic-ext */
        @font-face {
          font-family: 'Source Sans Pro';
          font-style: normal;
          font-weight: 400;
          src: local('Source Sans Pro Regular'), local('SourceSansPro-Regular'), url(/fonts/6xK3dSBYKcSV-LCoeQqfX1RYOo3qNa7lujVj9_mf.woff2) format('woff2');
          unicode-range: U+0460-052F, U+1C80-1C88, U+20B4, U+2DE0-2DFF, U+A640-A69F, U+FE2E-FE2F;
        }
        /* cyrillic */
        @font-face {
          font-family: 'Source Sans Pro';
          font-style: normal;
          font-weight: 400;
          src: local('Source Sans Pro Regular'), local('SourceSansPro-Regular'), url(/fonts/6xK3dSBYKcSV-LCoeQqfX1RYOo3qPK7lujVj9_mf.woff2) format('woff2');
          unicode-range: U+0400-045F, U+0490-0491, U+04B0-04B1, U+2116;
        }
        /* greek-ext */
        @font-face {
          font-family: 'Source Sans Pro';
          font-style: normal;
          font-weight: 400;
          src: local('Source Sans Pro Regular'), local('SourceSansPro-Regular'), url(/fonts/6xK3dSBYKcSV-LCoeQqfX1RYOo3qNK7lujVj9_mf.woff2) format('woff2');
          unicode-range: U+1F00-1FFF;
        }
        /* greek */
        @font-face {
          font-family: 'Source Sans Pro';
          font-style: normal;
          font-weight: 400;
          src: local('Source Sans Pro Regular'), local('SourceSansPro-Regular'), url(/fonts/6xK3dSBYKcSV-LCoeQqfX1RYOo3qO67lujVj9_mf.woff2) format('woff2');
          unicode-range: U+0370-03FF;
        }
        /* vietnamese */
        @font-face {
          font-family: 'Source Sans Pro';
          font-style: normal;
          font-weight: 400;
          src: local('Source Sans Pro Regular'), local('SourceSansPro-Regular'), url(/fonts/6xK3dSBYKcSV-LCoeQqfX1RYOo3qN67lujVj9_mf.woff2) format('woff2');
          unicode-range: U+0102-0103, U+0110-0111, U+1EA0-1EF9, U+20AB;
        }
        /* latin-ext */
        @font-face {
          font-family: 'Source Sans Pro';
          font-style: normal;
          font-weight: 400;
          src: local('Source Sans Pro Regular'), local('SourceSansPro-Regular'), url(/fonts/6xK3dSBYKcSV-LCoeQqfX1RYOo3qNq7lujVj9_mf.woff2) format('woff2');
          unicode-range: U+0100-024F, U+0259, U+1E00-1EFF, U+2020, U+20A0-20AB, U+20AD-20CF, U+2113, U+2C60-2C7F, U+A720-A7FF;
        }
        /* latin */
        @font-face {
          font-family: 'Source Sans Pro';
          font-style: normal;
          font-weight: 400;
          src: local('Source Sans Pro Regular'), local('SourceSansPro-Regular'), url(/fonts/6xK3dSBYKcSV-LCoeQqfX1RYOo3qOK7lujVj9w.woff2) format('woff2');
          unicode-range: U+0000-00FF, U+0131, U+0152-0153, U+02BB-02BC, U+02C6, U+02DA, U+02DC, U+2000-206F, U+2074, U+20AC, U+2122, U+2191, U+2193, U+2212, U+2215, U+FEFF, U+FFFD;
        }
    </style>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.3/umd/popper.min.js"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.1.3/js/bootstrap.min.js"></script>
    <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.4.2/css/all.css" integrity="sha384-/rXc/GQVaYpyDdyxK+ecHPVYJSN9bmVFBvjA/9eOB+pb3F2w2N6fc5qB9Ew5yIns" crossorigin="anonymous">
    <script src="{{ $server }}/alert/sweetalert2.all.min.js"></script>
    <link rel="stylesheet" href="{{ $server }}/alert/sweetalert2.min.css">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/katex@0.10.0/dist/katex.min.css">
    <script defer src="https://cdn.jsdelivr.net/npm/katex@0.10.0/dist/katex.min.js"></script>
    <script defer src="https://cdn.jsdelivr.net/npm/katex@0.10.0/dist/contrib/auto-render.min.js"></script>

</head>
<style type="text/css">
    html {
      -webkit-box-sizing: border-box;
      box-sizing: border-box
    }

    * {
      -webkit-box-sizing: inherit;
      box-sizing: inherit
    }
    body,html {
      margin: 0;
      padding: 0;
      color: #444452;
      -webkit-font-smoothing: antialiased;
      -moz-osx-font-smoothing: grayscale;
      font-family: 'Source Sans Pro',sans-serif;
      line-height: 1.5;
      width: 100%
    }
    body {
        background-color: #242433;
    }
    ul {
      list-style: none;
      padding: 0;
      margin: 0
    }
    a {
      -webkit-transition: all .2s ease-in-out;
      transition: all .2s ease-in-out;
      text-decoration: none;
      font-weight: 200;
    }
    .notlogged {
      margin-left: 2.5em;
      text-align: left;
      display: none;
    }
    @media screen and (max-width:700px) {
      .notlogged {
        margin-left: 1em;
        margin-right: 1em;
        text-align: left;
        display: none;
      }
    }
    .nav-local-h {
      background-color:#FFFFFF;
      position: fixed;
      left:0;
      right:0;
      top:-100px;
      z-index: 10;
      box-shadow: 1px 1px 7px #ccc;
      background-color:#FFFFFF;
      margin-top:100px;

    }
</style>
<script type="text/javascript">
    window.onload=function(){ 
      renderMathInElement(document.getElementById('questionContainer'), {
        delimiters: [
            {left: "$$", right: "$$", display: true},
            {left: "\\[", right: "\\]", display: true},
            {left: "$", right: "$", display: false},
        ]
      });
    }

var BASE64 = {
    table : [
            'A', 'B', 'C', 'D', 'E', 'F', 'G', 'H',
            'I', 'J', 'K', 'L', 'M', 'N', 'O' ,'P',
            'Q', 'R', 'S', 'T', 'U', 'V', 'W', 'X',
            'Y', 'Z', 'a', 'b', 'c', 'd', 'e', 'f',
            'g', 'h', 'i', 'j', 'k', 'l', 'm', 'n',
            'o', 'p', 'q', 'r', 's', 't', 'u', 'v',
            'w', 'x', 'y', 'z', '0', '1', '2', '3',
            '4', '5', '6', '7', '8', '9', '+', '/'
    ],
    UTF16ToUTF8 : function(str) {
        var res = [], len = str.length;
        for (var i = 0; i < len; i++) {
            var code = str.charCodeAt(i);
            if (code > 0x0000 && code <= 0x007F) {
                res.push(str.charAt(i));
            } else if (code >= 0x0080 && code <= 0x07FF) {
                var byte1 = 0xC0 | ((code >> 6) & 0x1F);
                var byte2 = 0x80 | (code & 0x3F);
                res.push(
                    String.fromCharCode(byte1), 
                    String.fromCharCode(byte2)
                );
            } else if (code >= 0x0800 && code <= 0xFFFF) {
                var byte1 = 0xE0 | ((code >> 12) & 0x0F);
                var byte2 = 0x80 | ((code >> 6) & 0x3F);
                var byte3 = 0x80 | (code & 0x3F);
                res.push(
                    String.fromCharCode(byte1), 
                    String.fromCharCode(byte2), 
                    String.fromCharCode(byte3)
                );
            } else if (code >= 0x00010000 && code <= 0x001FFFFF) {
            } else if (code >= 0x00200000 && code <= 0x03FFFFFF) {
            } else {
            }
        }
 
        return res.join('');
    },
    UTF8ToUTF16 : function(str) {
        var res = [], len = str.length;
        var i = 0;
        for (var i = 0; i < len; i++) {
            var code = str.charCodeAt(i);
            if (((code >> 7) & 0xFF) == 0x0) {
                res.push(str.charAt(i));
            } else if (((code >> 5) & 0xFF) == 0x6) {
                var code2 = str.charCodeAt(++i);
                var byte1 = (code & 0x1F) << 6;
                var byte2 = code2 & 0x3F;
                var utf16 = byte1 | byte2;
                res.push(String.fromCharCode(utf16));
            } else if (((code >> 4) & 0xFF) == 0xE) {
                var code2 = str.charCodeAt(++i);
                var code3 = str.charCodeAt(++i);
                var byte1 = (code << 4) | ((code2 >> 2) & 0x0F);
                var byte2 = ((code2 & 0x03) << 6) | (code3 & 0x3F);
                var utf16 = ((byte1 & 0x00FF) << 8) | byte2
                res.push(String.fromCharCode(utf16));
            } else if (((code >> 3) & 0xFF) == 0x1E) { } 
            else if (((code >> 2) & 0xFF) == 0x3E) { } 
            else { }
        }
 
        return res.join('');
    },
    encode : function(str) {
        if (!str) {
            return '';
        }
        var utf8    = this.UTF16ToUTF8(str); 
        var i = 0; 
        var len = utf8.length;
        var res = [];
        while (i < len) {
            var c1 = utf8.charCodeAt(i++) & 0xFF;
            res.push(this.table[c1 >> 2]);
            if (i == len) {
                res.push(this.table[(c1 & 0x3) << 4]);
                res.push('==');
                break;
            }
            var c2 = utf8.charCodeAt(i++);
            if (i == len) {
                res.push(this.table[((c1 & 0x3) << 4) | ((c2 >> 4) & 0x0F)]);
                res.push(this.table[(c2 & 0x0F) << 2]);
                res.push('=');
                break;
            }
            var c3 = utf8.charCodeAt(i++);
            res.push(this.table[((c1 & 0x3) << 4) | ((c2 >> 4) & 0x0F)]);
            res.push(this.table[((c2 & 0x0F) << 2) | ((c3 & 0xC0) >> 6)]);
            res.push(this.table[c3 & 0x3F]);
        }
        return res.join('');
    },
    decode : function(str) {
        if (!str) {
            return '';
        }
        var len = str.length;
        var i   = 0;
        var res = [];
        while (i < len) {
            code1 = this.table.indexOf(str.charAt(i++));
            code2 = this.table.indexOf(str.charAt(i++));
            code3 = this.table.indexOf(str.charAt(i++));
            code4 = this.table.indexOf(str.charAt(i++));
            c1 = (code1 << 2) | (code2 >> 4);
            c2 = ((code2 & 0xF) << 4) | (code3 >> 2);
            c3 = ((code3 & 0x3) << 6) | code4;
            res.push(String.fromCharCode(c1));
            if (code3 != 64) {
                res.push(String.fromCharCode(c2));
            }
            if (code4 != 64) {
                res.push(String.fromCharCode(c3));
            }
        }
        return this.UTF8ToUTF16(res.join(''));
    }
};
function clearRecord(){
    for (var i = 0; i < 30; i++) {
        localStorage.setItem("ans" + i, 10);
    }
}

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
width = window.innerWidth;
height = $(window).height();
function leave(){
    swal({
        title: 'You Are Leaving',
        text: `Your workings may not be saved! Click Yes to indicate that you confirm your action!`,
        type: 'warning',
        showCancelButton: true,
        confirmButtonColor: '#3085d6',
        cancelButtonColor: '#d33',
        confirmButtonText: 'Yes'
    }).then((result) => {
        if (result.value) {
            url = localStorage.getItem('subject');
            clearRecord();
            if (url){
                window.location.href = url;
            } else {
                window.location.href = '/';
            }
        }
    })
}
function convertSymb(str){
    return str == "A" ? 0 : str == "B" ? 1 : str == "C" ? 2 : str == "D" ? 3 : 100;
}
function convertNum(str){
    return str == "0" ? "A" : str == "1" ? "B" : str == "2" ? "C" : str == "3" ? "D" : "Not Answered";
}
function changeColor(button, color) {
    $(`#${button}`).css("background-color", color ? "#273c75" : "#fff");
    $(`#${button}`).css("border-width", color ? "0px" : "1px");
    $(`#${button}`).css("color", color ? "#fff" : "#000");
}
function move(m){
  $("html,body").animate({scrollTop: $('#'+m).offset().top - 100}, 700);
}
</script>