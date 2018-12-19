
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
    <link href="https://fonts.proxy.ustclug.org/css?family=Inconsolata:400,700" rel="stylesheet" /> 
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.1.3/css/bootstrap.min.css">
    <script src="/js/jquery.min.js"></script> 
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.3/umd/popper.min.js"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.1.3/js/bootstrap.min.js"></script>
    <link rel="stylesheet" href="{{ $server }}/app/main{{ $css }}">
    <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.4.2/css/all.css" integrity="sha384-/rXc/GQVaYpyDdyxK+ecHPVYJSN9bmVFBvjA/9eOB+pb3F2w2N6fc5qB9Ew5yIns" crossorigin="anonymous">
    <script src="{{ $server }}/alert/sweetalert2.all.min.js"></script>
    <link rel="stylesheet" href="{{ $server }}/alert/sweetalert2.min.css">
    <link href="https://fonts.proxy.ustclug.org/css?family=Source+Sans+Pro" rel="stylesheet" />
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/katex@0.10.0/dist/katex.min.css">
    <script defer src="https://cdn.jsdelivr.net/npm/katex@0.10.0/dist/katex.min.js"></script>
    <script defer src="https://cdn.jsdelivr.net/npm/katex@0.10.0/dist/contrib/auto-render.min.js"></script>

</head> 
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
</script>