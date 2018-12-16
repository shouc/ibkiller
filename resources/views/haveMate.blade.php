
@include('header', ['css' => '.mateRegister.css'])

@include('nav', ['q' => false])

<body>

<!--
<div class="is-pay">
  <p class="is-pay-title">Paid User</p>
  <p class="is-pay-desc">You could select your mate</p>
  <p class="is-pay-price">$10<a class="is-pay-year"> / year</a></p>

</div>
-->

<form class="container form-local" id="form-1" action="/findMate">
  <h1 class="h1-local">
	  <h class="step-local">2/2</h> Get you a suitable mate
  </h1>
  <div class="alert alert-success" role="alert">
    Gotcha! The following fine human is your study mate now! Take care!
  </div>
  <div class="alert alert-warning" role="alert" id="showDisbander">
    Please ask your study mate to confirm disbanding!
  </div>
  <div class="alert alert-warning" role="alert" id="showDisbandee">
    Your study mate wants to disband with you! If you also want to disband with he/she and find a new study mate, then click <a href="/disband">here</a>. Otherwise, you could report spam; we will take a thorough investigation.
  </div>
  <div class="card">
    <div class="card-body">
      <h5 class="card-title">{{$assignedMateName}}</h5>
      <p><strong>Interest</strong>: {{$assignedMateInterest}}</p>
      <p><strong>Gender</strong>: {{$assignedMateGender ? 'Female' : 'Male'}}</p>
      <p><strong>Contact</strong>: {{$assignedMateContact}}</p>

      <a href="#" class="btn btn-primary" id="disbandButton" onclick="disbandReq()">Disband</a>
      <a href="#" class="btn btn-secondary">Report Spam</a>
    </div>
  </div>
  
</form>


</body>
<script type="text/javascript">
  $("#showDisbander").hide()
  $("#showDisbandee").hide()

  width = window.innerWidth;
  height = $(window).height();
  if (width > 800) {
   $("#form-1").addClass("col-5")
  } else {
    $("#form-1").addClass("col-lg-2")
  }
  if ({{$status}} == 2){
    $("#showDisbander").show();
    $("#disbandButton").hide();
  } else if ({{$status}} == 3) {
    $("#showDisbandee").show();
    $("#disbandButton").hide();
    
  }
  function disbandReq(){
    Swal({
      title: 'Are you sure?',
      html: "<strong>You must wait your study mate to confirm so as to finally disband and find a new study mate.</strong><br>You are losing your study mate!",
      type: 'warning',
      showCancelButton: true,
      confirmButtonColor: '#3085d6',
      cancelButtonColor: '#d33',
      confirmButtonText: 'Confirm'
    }).then((result) => {
      if (result.value) {
        window.location.href="/disband";
      }
    })
  }
</script>