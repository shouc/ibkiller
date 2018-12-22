
@include('header', ['css' => '.mateRegister.css'])

@include('nav', ['q' => false])
<style type="text/css">

body {
  background-color: #fff;
}
.matingForm {
  margin-top: 120px;
}

.matingStep {
  color: #aaa;
  font-size: 20px;
}
</style>
<body>
<!--
<div class="is-pay">
  <p class="is-pay-title">Paid User</p>
  <p class="is-pay-desc">You could select your mate</p>
  <p class="is-pay-price">$10<a class="is-pay-year"> / year</a></p>

</div>
-->

<form class="container matingForm" id="form-1" action="/findMate" style="display: none;">
  <h1 class="h1-local">
	  <h class="matingStep">1/2</h> Complete Your Information
  </h1>
  <div class="alert alert-danger" role="alert" id="confirmationNotice">
    Confirmation of email is required! Click <a href="javascript:resendAuth();">here</a> to resend the request.
  </div>
  <div class="form-group">
    <label>Interest</label>
    <input name="Interest" class="form-control" id="interest" placeholder="Enter what you are interested in.">
  </div>
  <div class="form-group">
    <label for="">Location</label>
    <div class="input-group">
      
      <input class="form-control" id="location" placeholder="Enter your street address.">
      <div class="input-group-append">
        <b class="btn btn-outline-secondary" onclick="searchLocation()">Search</b>
      </div>
    </div>
    <small id="location-notice">Make sure you click the search button</small>
    <input hidden name="Location" id="r-location" value="">
  </div>
  <div class="form-group">
    <label for="">Year</label>
    <select class="custom-select" name="Grade" id="grade">
      <option value="100" selected>Choose...</option>
      <option value="1">Grade 9</option>
      <option value="2">Grade 10</option>
      <option value="3">Grade 11</option>
      <option value="4">Grade 12</option>
    </select>
  </div>
  <div class="form-group">
    <label for="">Gender</label>
    <select class="custom-select" name="Gender" id="gender">
      <option value="100" selected>Choose...</option>
      <option value="0">Male</option>
      <option value="1">Female</option>
    </select>
    <small>Other gender options will be supported by our algorithm soon!</small>
  </div>
  <b class="btn btn-secondary" onclick="getBack()">Back</b>
  <b class="btn btn-primary" onclick="submitMateReq()">Next</b>
  
</form>


</body>
<script type="text/javascript">
  width = window.innerWidth;
  height = $(window).height();
  if (width > 800) {
   $("#form-1").addClass("col-5")
  } else {
    $("#form-1").addClass("col-lg-2")
  }

  if ({{$isAuthed}}){
    $("#confirmationNotice").hide();
  }
  function resendAuth(){
    $.get('/resendAuth');
  }
  function convertLocForm(loc){
    return `${loc["y"]/100000}!!${loc["x"]/100000}`;
  }
  function searchLocation(){
    $("#location-notice").html('Searching.....')
    $.get(`https://api.opencagedata.com/geocode/v1/json?q=${$("#location").val()}&key=6d7fb3808e2b4391bc30070a6bdc3ab2`, 
      function(data,status){
        if(data["results"].length > 0){
          $("#r-location").val(convertLocForm(data["results"][0]["annotations"]["Mercator"]));
          $("#location-notice").html(`Your place is <a target="_blank" href='${data["results"][0]["annotations"]["OSM"]["url"]}'>here</a>, right?`);
        } else {
          $("#location-notice").html("Nothing found.")
        }
      });
  }
  function submitMateReq(){
    if ($("#interest").val() == ""){
      alert("No interest provided");
      return 0;
    }
    if ($("#r-location").val() == ""){
      alert("No location provided");
      return 0;
    }
    if ($("#gender").val() == 100){
      alert("No gender provided");
      return 0;
    }
    if ($("#grade").val() == 100){
      alert("No year provided");
      return 0;
    }
    $("#form-1").submit();
  }
  $("#form-1").show();


</script>