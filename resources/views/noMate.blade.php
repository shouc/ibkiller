
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
  <div class="alert alert-danger" role="alert">
    Sorry! There has no study mate suitable for you. However, we have put your request into our database. We will notify you by Email whenever we find you a study mate : )
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