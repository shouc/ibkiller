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
                <button class="btn btn-primary" onclick="sendComment()">Send</button>
                <button class="btn btn-secondary" onclick="endComment()">Cancel</button>
            </div>
        </div>
        
    </div>
    @endif
    <ul class="list" id="comment-content"></ul>
</div>
<script type="text/javascript">
    height = $(window).height();
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

    currentPage = 1;
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
                    for (var i = 1; i <= pageNum; i++) {
                      pHTML += `<li class="page-item ${currentPage == i ? 'active': ''}"><a class="page-link" href="javascript:goCPage(${i})">${i}</a></li>`
                    }
                    $("#comment-content").html(cHTML + `
                        <div class="paging-C">
                            <ul class="pagination justify-content-center">
                              <li class="page-item ${currentPage == 1 ? 'disabled' : ''}"><a class="page-link" href="javascript:previousCPage()">Previous</a></li>
                                ${pHTML}
                              <li class="page-item ${currentPage == pageNum ? 'disabled' : ''}"><a class="page-link" href="javascript:nextCPage();">Next</a></li>
                            </ul>
                          </div>

                    `);
                } else {
                    $("#comment-content").html(`
                        <li class="card-local" style="text-align: center">
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
                commentData[i]["isLiked"] ? $.get(`/unlikeDiscussion?ID=${id}`, function(data,status){ commentMinorErrors(data) }) : $.get(`/likeDiscussion?ID=${id}`, function(data,status){ commentMinorErrors(data) });
                genComments(currentPage);
            }
        }
    }
    function goCPage(p){
        currentPage = p;
        genComments(p);
    }
    function nextCPage(){
        currentPage += 1;
        genComments(currentPage);
    }
    function previousCPage(){
        currentPage -= 1;
        genComments(currentPage);
    }
    function del(id){
        $.get(`/delDiscussion?ID=${id}`, function(data,status){ commentErrors(data); goCPage(1); });
        
    }
    function makeComment(s){
        $("#comment-area").val(s);
        $("#beforeComment").hide();
        $("#afterComment").fadeIn();
        document.getElementById("comment-area").focus();
    }
    function sendComment(){
        $.get(`/addDiscussion?Paper={{$paper}}&Context=${$('#comment-area').val()}&Question=${localStorage.getItem("qnum")}`, function(data,status){ commentErrors(data);goCPage(1); });
    }
    function endComment(){
        $("#comment-area").val('');
        $("#beforeComment").fadeIn();
        $("#afterComment").hide();
    }
    function closeComment(){
        $("#comment-content").html('Loading');
        $("#comment").fadeOut("fast");
    }
    function openComment(){
        $("#comment").fadeIn("fast");
        goCPage(1);
    }

</script>