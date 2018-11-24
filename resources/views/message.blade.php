<link href="/app/main.message.css" rel="stylesheet" /> 

<div class="modal fade bd-example-modal-lg" tabindex="-1" role="dialog" aria-hidden="true">
  <div class="modal-dialog modal-lg">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="exampleModalLabel">Message</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <x aria-hidden="true">&times;</x>
        </button>
      </div>
      <button onclick="readAll()" class="btn btn-success read-all-btn">I have read all messages</button>
      <div class="msgBox" id="msg-box">
      </div>
    </div>
  </div>
</div>

<script type="text/javascript">
  
  function genM(page){
    $.get(`/showMessage?Range=${page}`, function(data,status){
      pageNum = data['pageNum'];
      dataMsg = data['info'];
      messageHTML = ''
      for (var i = 0; i < dataMsg.length; i++) {
        messageHTML += `<div class="msgLine">
              <div class="msg-text ${dataMsg[i]['read'] == '1' ? 'read' : ''}">
                ${window.atob(dataMsg[i]['context'])}
              </div>
            </div>`
      }
      pMsgHTML = '';
      if (pageNum > 1){
        if (pageNum < 4){
          for (var j = 1; j <= pageNum; j++) {
            pMsgHTML += `<li class="page-item ${currentMsgPage == j ? 'active': ''}"><a class="page-link" href="javascript:goMsgPage(${j})">${j}</a></li>`
          }
        } else {
          for (var j = 1; j <= pageNum; j++) {
            if (Math.abs(currentMsgPage - j) < 3){
              pMsgHTML += `<li class="page-item ${currentMsgPage == j ? 'active': ''}"><a class="page-link" href="javascript:goMsgPage(${j})">${j}</a></li>`
            }
          }
          if (currentMsgPage == 1){
            pMsgHTML += `<li class="page-item"><a class="page-link" href="javascript:goMsgPage(4)">4</a></li><li class="page-item"><a class="page-link" href="javascript:goMsgPage(5)">5</a></li>`
          }
          if (currentMsgPage == 2){
            pMsgHTML += `<li class="page-item"><a class="page-link" href="javascript:goMsgPage(5)">5</a></li>`
          }
        }
        
        pMsgHTML = `
          <div>
            <ul class="pagination justify-content-center">
              <li class="page-item ${currentMsgPage == 1 ? 'disabled' : ''}"><a class="page-link" href="javascript:previousMsgPage()"><</a></li>
                ${pMsgHTML}
              <li class="page-item ${currentMsgPage == pageNum ? 'disabled' : ''}"><a class="page-link" href="javascript:nextMsgPage();">></a></li>
            </ul>
          </div>`
      }
      
      $('#msg-box').html(messageHTML + pMsgHTML);
    });
  }
  currentMsgPage = 1;
  function goMsgPage(page){
    currentMsgPage = page;
    genM(page);
  }
  function previousMsgPage(){
    currentMsgPage -= 1;
    genM(currentMsgPage);
  }
  function nextMsgPage(){
    currentMsgPage++;
    genM(currentMsgPage);
  }
  function readAll(){
    $.get('/readAllMessage');
    $('msg').html(`Messages`)
    genM(1);
    swal({
        title: 'Success',
        type: 'success',
        text: 'There wont be any annoying badges.',
        showCancelButton: false,
        confirmButtonColor: '#3085d6',
        confirmButtonText: 'Yes'
      });

  }
  genM(1);
  
</script>