<style type="text/css">
.cardBody {
  margin-bottom: 20px;
  margin-left: 10%;
  margin-right: 10%;
}
.commentBody {
  z-index: 1000;
  overflow: auto;
  position: fixed;
  right: 0;
  top: 0;
  box-shadow: -10px 0px 20px 0px #eee;
  background-color: #fff;
  border-top-left-radius: 10px;
  border-bottom-left-radius: 10px;
  display: hidden;
}
.cross {
  margin-top: 20px;
  margin-left: 20px;
}
.startCommentButton {
  margin-top: 20px;
  width: 80%;
  margin-left: 10%;
  margin-right: 10%;
  margin-bottom: 20px;
}
.commentInputBox {
  margin-top: 20px;
  width: 80%;
  margin-left: 10%;
  margin-right: 10%;
}
.sendCommentButton {
  margin-top: 10px;
  margin-bottom: 20px;
  margin-left: 10%;
}
.openCommentBall {
  height: 70px;
  width: 70px;
  border-radius: 35px;
  text-align: center;
  background: linear-gradient(#55edc4, #00b894);
  position: fixed;
  bottom: 10px;
  right: 10px;
  z-index: 1;
}
.openCommentBallIcon {
  margin-top: 17.5px;
  font-size: 35px;
  color: #fff;
  cursor: hand;
}
.commentPagination {
  margin-bottom: 20px;
}
</style>

<div class="openCommentBall" onclick="openComment()">
    <i class="far fa-comment openCommentBallIcon click"></i>
</div>
<div class="commentBody" id="comment">
    <div>
        <i class="fas fa-times cross click" onclick="closeComment()"></i>
    </div>
    <br>
    @if($isLoggedIn)
    <div class="list">
        <div id="beforeComment" onclick="makeComment('')">
            <button class="btn btn-primary startCommentButton">Make your comment!</button>
        </div>
        <div id="afterComment">
            <div class="input-group">
                <textarea class="form-control commentInputBox" id="commentInputBox" focus></textarea>
            </div>
            <div class="sendCommentButton">
                <button class="btn btn-primary" onclick="sendComment()">Send</button>
                <button class="btn btn-secondary" onclick="endComment()">Cancel</button>
            </div>
        </div>
    </div>
    @endif
    <ul class="list" id="commentContent"></ul>
</div>

<script type="text/javascript">
    
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
    $("#afterComment").hide();
    $("#comment").hide();

    commentCurrentPage = 1;
    function commentErrors(data){
        if (data['success']){
            swal({
              title: 'Success',
              type: 'success',
              showCancelButton: false,
              confirmButtonColor: '#3085d6',
              confirmButtonText: 'Yes'
            });
        } else {
            swal({
              title: 'Error',
              type: 'warning',
              text: data['info'],
              showCancelButton: false,
              confirmButtonColor: '#3085d6',
              confirmButtonText: 'Yes'
            });
        }
    }
    function commentMinorErrors(data){
        if (data['success']){
            //pass
        } else {
            swal({
              title: 'Error',
              type: 'warning',
              text: data['info'],
              showCancelButton: false,
              confirmButtonColor: '#3085d6',
              confirmButtonText: 'Yes'
            });
        }
    }
    function genComments(range){
        $.get(`/showDiscussion?Paper={{$paper}}&Range=${range}&Question=${localStorage.getItem("qnum")}`,
            function(data,status){
                commentData = data['info'];
                isDiscussed = data['isDiscussed'];
                pageNum = data['pageNum'];
                cHTML = "";
                pHTML = "";
                
                if (isDiscussed){
                    for (var i = 0; i < commentData.length; i++) {
                        cHTML += `<li class="media card cardBody">
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
                                ${ timestampToTime(commentData[i]["time"]) }</p>
                            </div>
                          </li>`
                    }
                    if (pageNum < 4){
                      for (var j = 1; j <= pageNum; j++) {
                        pHTML += `<li class="page-item ${commentCurrentPage == j ? 'active': ''}"><a class="page-link" href="javascript:goCPage(${j})">${j}</a></li>`
                      }
                    } else {
                      for (var j = 1; j <= pageNum; j++) {
                        if (Math.abs(commentCurrentPage - j) < 3){
                          pHTML += `<li class="page-item ${commentCurrentPage == j ? 'active': ''}"><a class="page-link" href="javascript:goCPage(${j})">${j}</a></li>`
                        }
                      }
                      if (commentCurrentPage == 1){
                        pHTML += `<li class="page-item"><a class="page-link" href="javascript:goCPage(4)">4</a></li><li class="page-item"><a class="page-link" href="javascript:goCPage(5)">5</a></li>`
                      }
                      if (commentCurrentPage == 2){
                        pHTML += `<li class="page-item"><a class="page-link" href="javascript:goCPage(5)">5</a></li>`
                      }
                    }
                    $("#commentContent").html(cHTML + `
                        <div class="commentPagination">
                            <ul class="pagination justify-content-center">
                              <li class="page-item ${commentCurrentPage == 1 ? 'disabled' : ''}"><a class="page-link" href="javascript:previousCPage()"><</a></li>
                                ${pHTML}
                              <li class="page-item ${commentCurrentPage == pageNum ? 'disabled' : ''}"><a class="page-link" href="javascript:nextCPage();">></a></li>
                            </ul>
                          </div>

                    `);
                } else {
                    $("#commentContent").html(`
                        <li class="cardBody" style="text-align: center">
                            Nothing Here<br>Be the first one to <strong class="click" onclick="makeComment()">comment</strong><br>🎉🎉
                        </li>
                        `);
                }
                commentMinorErrors(data);
            }
        );
    }

    function like(id){
        for (var i = 0; i < commentData.length; i++) {
            if (commentData[i]["id"] == id){
                commentData[i]["isLiked"] ? $.get(`/unlikeDiscussion?ID=${id}`, function(data,status){ commentMinorErrors(data);genComments(commentCurrentPage) }) : $.get(`/likeDiscussion?ID=${id}`, function(data,status){ commentMinorErrors(data);genComments(commentCurrentPage) });
            }
        }
    }
    function goCPage(p){
        commentCurrentPage = p;
        genComments(p);
    }
    function nextCPage(){
        commentCurrentPage += 1;
        genComments(commentCurrentPage);
    }
    function previousCPage(){
        commentCurrentPage -= 1;
        genComments(commentCurrentPage);
    }
    function del(id){
        $.get(`/delDiscussion?ID=${id}`, function(data,status){ commentErrors(data); goCPage(1); });
    }
    function makeComment(s){
        $("#commentInputBox").val(s);
        $("#beforeComment").hide();
        $("#afterComment").fadeIn();
        document.getElementById("commentInputBox").focus();
    }
    function sendComment(){
        $.get(`/addDiscussion?Paper={{$paper}}&Context=${$('#commentInputBox').val()}&Question=${localStorage.getItem("qnum")}`, function(data,status){ commentErrors(data);goCPage(1); });
    }
    function endComment(){
        $("#commentInputBox").val('');
        $("#beforeComment").fadeIn();
        $("#afterComment").hide();
    }
    function closeComment(){
        $("#comment").fadeOut("fast");
        $("#commentContent").html('');
    }
    function openComment(){
        $("#comment").fadeIn("fast");
        $("#commentContent").html('<p class="cardBody">Loading.....</p>');
        goCPage(1);
    }

</script>