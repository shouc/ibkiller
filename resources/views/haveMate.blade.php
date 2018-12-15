
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
  <div class="no-mate-notice">
    <br>
    <p class="no-mate">Sorry! No mate found</p>
    <small>Please wait a few days.</small>
  </div>
  
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


</script>