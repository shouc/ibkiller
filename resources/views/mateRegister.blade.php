
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

<form class="container form-local" id="form-1">
  <h1 class="h1-local">
	  <h class="step-local">1/2</h> Complete Your Information
  </h1>
  <div class="form-group">
    <label for="exampleInputEmail1">Interest</label>
    <input class="form-control" id="interest" placeholder="Enter what you are interested in.">
  </div>
  <div class="form-group">
    <label for="exampleInputPassword1">Location</label>
    <input type="password" class="form-control" id="exampleInputPassword1" placeholder="Password">
  </div>
  <div class="form-group">
    <label for="exampleInputPassword1">Year</label>
    <input type="password" class="form-control" id="exampleInputPassword1" placeholder="Password">
  </div>
  <div class="form-group">
    <label for="exampleInputPassword1">Gender</label>
    <input type="password" class="form-control" id="exampleInputPassword1" placeholder="Password">
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
</script>