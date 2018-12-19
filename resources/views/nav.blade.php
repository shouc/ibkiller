@include('message')
@if ($q)
  <link rel="stylesheet" type="text/css" href="{{ $server }}/app/main.comment.css">
  <div id="navbg" class="nav-local-h">
   <nav class="navbar navbar-expand-sm navbar-light " class="nav-local">
    <ul class="navbar-nav mr-auto mt-lg-0">

      <li class="nav-item">
        <a class="nav-link" href="javascript:leave()">Leave</a>
      </li>
    </ul>
    @if(!$isLoggedIn)
    <form class="form-inline" id="notLoginButtons">
      <button type="button" class="btn btn-success my-sm-0" data-toggle="modal" data-target="#registerModal">
        Register
      </button>
      &nbsp;&nbsp;
      <button type="button" class="btn btn-outline-success my-sm-0" data-toggle="modal" data-target="#loginModal">
        Login
      </button>
    </form>
    @endif
    @if($isLoggedIn)
    <button data-toggle="modal" data-target=".bd-example-modal-lg" class="btn btn-outline-success">
      <msg>Message</msg> 
    </button>
    &nbsp;&nbsp;
    <form class="form-inline" id="loginButtons" action="/userLogout" method="get">
      @csrf
      <button type="submit" class="btn btn-success">
        Logout
      </button>
    </form>
    @endif
  </nav>
  </div>

@else
  <div id="navbg" class="nav-local-h">
   <nav class="navbar navbar-expand-sm navbar-light " class="nav-local">
    <ul class="navbar-nav mr-auto mt-lg-0" id='navbarBadges'>
      <li class="nav-item">
        <a class="nav-link" href="/">Home</a>
      </li>
      <li class="nav-item">
        <a class="nav-link" href="/help">Help</a>
      </li>
      @if($isLoggedIn)
        <li class="nav-item">
          <a class="nav-link" href="/history">History</a>
        </li>
      @endif
    </ul>
    @if(!$isLoggedIn)
    <form class="form-inline" id="notLoginButtons">
      <button type="button" class="btn btn-success" data-toggle="modal" data-target="#registerModal">
        Register
      </button>
      &nbsp;&nbsp;
      <button type="button" class="btn btn-outline-success" data-toggle="modal" data-target="#loginModal">
        Login
      </button>
    </form>
    @endif
    @if($isLoggedIn)
    <button data-toggle="modal" data-target=".bd-example-modal-lg" class="btn btn-outline-success">
      <msg>Message</msg> 
    </button>
    &nbsp;&nbsp;
    <form class="form-inline" id="loginButtons" action="/userLogout" method="get">
      @csrf
      <button type="submit" class="btn btn-success">
        Logout
      </button>
    </form>
    @endif
    
  </nav>
  </div>
  

@endif


<div class="modal fade" id="loginModal" tabindex="-1" role="dialog" aria-hidden="true">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title">Login</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">
        <form action="/userLogin" method="get">
          @csrf
          <div class="alert alert-warning alert-dismissible fade show" role="alert" id="errorLog">
            <h>Error!!!</h>
            <br>
            <small id="errorLogInfo"></small>
            <button type="button" class="close" data-dismiss="alert" aria-label="Close">
              <span aria-hidden="true">&times;</span>
            </button>

          </div>
          <div class="form-group">
            <label>Email address</label>
            <input  id="logEmail" type="email" name="Email" class="form-control" aria-describedby="emailHelp" placeholder="Enter email">
          </div>
          <div class="form-group">
            <label>Password</label>
            <input  id="logPassword" type="password" name="Password" class="form-control" placeholder="Password">
          </div>
          <div class="center-local">
            <button id="submitLog" type="submit" class="btn btn-primary">Go!</button>
          </div>
        </form>
      </div>
    </div>
  </div>
</div>

<div class="modal fade" id="registerModal" tabindex="-1" role="dialog" aria-hidden="true">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="exampleModalLongTitle">Register</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">
        <form action="/userRegister" method="get">
          @csrf
          <div class="alert alert-warning alert-dismissible fade show" role="alert" id="errorReg">
            <h>Error!!!</h>
            <br>
            <small id="errorRegInfo"></small>
            <button type="button" class="close" data-dismiss="alert" aria-label="Close">
              <span aria-hidden="true">&times;</span>
            </button>

          </div>
          <div class="form-group">
            <label>Username</label>
            <input type="name" name="Name" class="form-control" aria-describedby="emailHelp" placeholder="Enter your username">
            <small id="emailHelp" class="form-text text-muted">This may be shown to other users. Make it pretty!</small>
          </div>
          <div class="form-group">
            <label>Email address</label>
            <input type="email" name="Email" class="form-control" aria-describedby="emailHelp" placeholder="Enter email">
            
          </div>
          <div class="form-group">
            <label>Password</label>
            <input type="password" name="Password" class="form-control" placeholder="Password">
            <small id="emailHelp" class="form-text text-muted">We'll never share your information with anyone else.</small>
          </div>
          
          <div class="center-local">
            <button id="submitReg" type="submit" class="btn btn-primary">Go!</button>
          </div>
        </form>
      </div>
    </div>
  </div>
</div>

<style type="text/css">
.center-local {
  text-align: center;
}

</style>
<script>
  $("#errorLog").hide();
  $("#errorReg").hide();
  

  @if (count($errors)>0)
  if('{{ $errors->first() }}' == 'login'){
    $("#errorLog").fadeIn();
    $('#loginModal').modal('toggle');
    $('#errorLogInfo').html('{{ $errors->all()[1] }}');
  } else {
    $("#errorReg").fadeIn();
    $('#registerModal').modal('toggle');
    $('#errorRegInfo').html('{{ $errors->all()[1] }}');
  }
  @endif
  if (width < 575){
    $("#navbarBadges").html(`
      <li class="nav-item">
        <a class="nav-link" href="/">Home</a>
      </li>
      <li class="nav-item">
        <a class="nav-link" href="/help">Help</a>
      </li>`
    );
  }
</script>

<script type="text/javascript">
  $.get('/countUnreadMessage', function(data,status){
    if (data['info'] > 0){
      $('msg').html(`Messages <span class="badge badge-success">${data['info']}</span>`)
    }
  })
</script>