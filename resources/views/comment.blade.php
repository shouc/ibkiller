@include('header', ['css' => '.comment.css'])

<div class="comment-ball" onclick="openComment()">
    <i class="far fa-comment comment-icon click"></i>
</div>

<div class="comment" id="comment">
    <div>
        <i class="fas fa-times cross click" onclick="closeComment()"></i>
    </div>
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
    <ul class="list" id="comment-content"></ul>
</div>
<script type="text/javascript">
    data = [{"id":7,"name":"Sir Unknown","context":"1","time":"1540787334","like":0,"paper":"1","question":"1","isMine":true,"isLiked":false},{"id":8,"name":"Sir Unknown","context":"1","time":"1540787336","like":0,"paper":"1","question":"1","isMine":false,"isLiked":false},{"id":9,"name":"Sir Unknown","context":"1","time":"1540787336","like":0,"paper":"1","question":"1","isMine":false,"isLiked":true},{"id":10,"name":"Sir Unknown","context":"1","time":"1540787336","like":0,"paper":"1","question":"1","isMine":false,"isLiked":false},{"id":11,"name":"Sir Unknown","context":"1","time":"1540787336","like":0,"paper":"1","question":"1","isMine":true,"isLiked":false},{"id":12,"name":"Sir Unknown","context":"1","time":"1540787336","like":0,"paper":"1","question":"1","isMine":true,"isLiked":false},{"id":13,"name":"Sir Unknown","context":"1","time":"1540787336","like":0,"paper":"1","question":"1","isMine":true,"isLiked":false},{"id":14,"name":"Sir Unknown","context":"1","time":"1540787336","like":0,"paper":"1","question":"1","isMine":true,"isLiked":false}]
    height = document.body.scrollHeight;
    if ($("#q-container").height() < height && height >= 600){
        height = $(document).height();
    }
    function showTime(t){
        timestamp = new Date(parseInt(t + "000"));
        return timestamp.toLocaleDateString().replace(/\//g, ".");
    }
    $("#comment").height(height);
    $("#dark-background").height(height);

    
    $("#afterComment").hide();
    $("#comment").hide();

    function genComments(){
        cHTML = "";

        for (var i = 0; i < data.length; i++) {
            cHTML += `<li class="media card card-local">
                <div class="media-body card-body">
                  <h5 class="mt-0 mb-1">${ data[i]["name"] }</h5>
                  ${ data[i]["context"] }
                  <p class="card-text">${ data[i]["isMine"] ? 
                    `<i class="fas fa-heart"></i> / ${ data[i]["like"] } likes / 
                    <i class="click far fa-trash-alt" onclick="del('${ data[i]["id"] }')"></i> /` : 
                    `<i class="click fa${ data[i]["isLiked"] ? "s" : "r" } fa-heart" onclick="like('${ data[i]["id"] }')">
                    </i> 
                    / ${ data[i]["like"] } likes /
                    <i class="fas fa-at click" onclick="makeComment('@${ data[i]["name"] } ')"></i> /` }
                    ${ showTime(data[i]["time"]) }</p>
                </div>
              </li>`
        }
        $("#comment-content").html(cHTML);
    }

    function like(id){
        for (var i = 0; i < data.length; i++) {
            if (data[i]["id"] == id){
                data[i]["isLiked"] ? data[i]["like"] -= 1 : data[i]["like"] += 1;
                data[i]["isLiked"] = !data[i]["isLiked"];
                genComments();
            }
        }
    }
    function del(id){
        for (var i = 0; i < data.length; i++) {
            if (data[i]["id"] == id){
                data.splice(i, 1);
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