<div class="comment-ball" onclick="openComment()">
    <i class="far fa-comment comment-icon click"></i>
</div>

<div class="comment" id="comment">
    <div>
        <i class="fas fa-times cross click" onclick="closeComment()"></i>
    </div>
    <br>
    @if($isLoggedIn)
    <div class="list">
        <div id="beforeComment" onclick="makeComment('')">
            <button class="btn btn-primary btn-start-comment">Make your comment!</button>
        </div>
        <div id="afterComment">
            <div class="input-group">
                <textarea class="form-control comment-input" id="comment-area" focus></textarea>
            </div>
            <div class="send-btn">
                <button class="btn btn-primary">Send</button>
                <button class="btn btn-secondary" onclick="endComment()">Cancel</button>
            </div>
        </div>
        
    </div>
    @endif
    <ul class="list" id="comment-content"></ul>
</div>
<script type="text/javascript">
    commentData = [{"id":7,"name":"Sir Unknown","context":"1","time":"1540787334","like":0,"paper":"1","question":"1","isMine":true,"isLiked":false},{"id":8,"name":"Sir Unknown","context":"1","time":"1540787336","like":0,"paper":"1","question":"1","isMine":false,"isLiked":false},{"id":9,"name":"Sir Unknown","context":"1","time":"1540787336","like":0,"paper":"1","question":"1","isMine":false,"isLiked":true},{"id":10,"name":"Sir Unknown","context":"1","time":"1540787336","like":0,"paper":"1","question":"1","isMine":false,"isLiked":false},{"id":11,"name":"Sir Unknown","context":"1","time":"1540787336","like":0,"paper":"1","question":"1","isMine":true,"isLiked":false},{"id":12,"name":"Sir Unknown","context":"1","time":"1540787336","like":0,"paper":"1","question":"1","isMine":true,"isLiked":false},{"id":13,"name":"Sir Unknown","context":"1","time":"1540787336","like":0,"paper":"1","question":"1","isMine":true,"isLiked":false},{"id":14,"name":"Sir Unknown","context":"1","time":"1540787336","like":0,"paper":"1","question":"1","isMine":true,"isLiked":false}]
    height = document.body.scrollHeight;
    width = document.body.scrollWidth;

    if ($("#q-container").height() < height && height >= 600){
        height = $(document).height();
    }
    function showTime(t){
        timestamp = new Date(parseInt(t + "000"));
        return timestamp.toLocaleDateString().replace(/\//g, ".");
    }
    $("#comment").height(height);
    if (width > 1000){
        $("#comment").width('30%');
    } else if (width > 800) {
        $("#comment").width('45%');

    } else if (width > 500) {
        $("#comment").width('60%');
    } else {
        $("#comment").width('100%');
    }

    $("#dark-background").height(height);

    
    $("#afterComment").hide();
    $("#comment").hide();

    function genComments(){
        cHTML = "";

        for (var i = 0; i < commentData.length; i++) {
            cHTML += `<li class="media card card-local">
                <div class="media-body card-body">
                  <h5 class="mt-0 mb-1">${ commentData[i]["name"] }</h5>
                  ${ commentData[i]["context"] }
                  <p class="card-text">${ commentData[i]["isMine"] ? 
                    `<i class="fas fa-heart"></i> / ${ commentData[i]["like"] } likes / 
                    <i class="click far fa-trash-alt" onclick="del('${ commentData[i]["id"] }')"></i> /` : 
                    `<i class="click fa${ commentData[i]["isLiked"] ? "s" : "r" } fa-heart" onclick="like('${ commentData[i]["id"] }')">
                    </i> 
                    / ${ commentData[i]["like"] } likes /
                    <i class="fas fa-at click" onclick="makeComment('@${ commentData[i]["name"] } ')"></i> /` }
                    ${ showTime(commentData[i]["time"]) }</p>
                </div>
              </li>`
        }
        $("#comment-content").html(cHTML);
    }

    function like(id){
        for (var i = 0; i < commentData.length; i++) {
            if (commentData[i]["id"] == id){
                commentData[i]["isLiked"] ? commentData[i]["like"] -= 1 : commentData[i]["like"] += 1;
                commentData[i]["isLiked"] = !commentData[i]["isLiked"];
                genComments();
            }
        }
    }
    function del(id){
        for (var i = 0; i < commentData.length; i++) {
            if (commentData[i]["id"] == id){
                commentData.splice(i, 1);
                genComments();
            }
        }
    }
    function makeComment(s){
        $("#comment-area").val(s);
        $("#beforeComment").hide();
        $("#afterComment").fadeIn();
        document.getElementById("comment-area").focus();
    }
    function endComment(){
        $("#comment-area").val('');
        $("#beforeComment").fadeIn();
        $("#afterComment").hide();
    }
    function closeComment(){
        $("#comment").fadeOut("fast");
    }
    function openComment(){

        $("#comment").fadeIn("fast");
        genComments();
    }
</script>