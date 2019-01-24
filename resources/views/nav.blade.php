@include('message')
<style type="text/css">
  .navLocal {
    z-index: 100;
  }
</style>

<div class="navLocal" id="navLocal">
 <nav class="navbar navbar-expand-sm navbar-light " class="nav-local" id="navBar">

</nav>
</div>



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
        <div>
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
            <button id="submitLog" onclick="login()" class="btn btn-primary">Go!</button>
          </div>
        </div>
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
          <input type="name" name="Name" class="form-control" id="regName" aria-describedby="emailHelp" placeholder="Enter your username">
          <small id="emailHelp" class="form-text text-muted">This may be shown to other users. Make it pretty!</small>
        </div>
        <div class="form-group">
          <label>Email address</label>
          <input type="email" name="Email" class="form-control" id="regEmail" aria-describedby="emailHelp" placeholder="Enter email">

        </div>
        <div class="form-group">
          <label>Password</label>
          <input type="password" name="Password" id="regPassword" class="form-control" placeholder="Password">
          <small id="emailHelp" class="form-text text-muted">We'll never share your information with anyone else.</small>
        </div>

        <div class="center-local">
          <button id="submitReg" onclick="register()" class="btn btn-primary">Go!</button>
        </div>
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
  @if($isLoggedIn)
    localStorage.removeItem('already');
    localStorage.removeItem('subject');
    isLoggedIn = true;
  @else
    isLoggedIn = false;
  @endif
  function renderNav(isLoggedIn) {
    @if ($q)
    navBarHTML = `
      <link rel="stylesheet" type="text/css" href="/app/main.comment.css">
      <ul class="navbar-nav mr-auto mt-lg-0">
        <li class="nav-item">
          <a class="nav-link" href="javascript:leave()">Leave</a>
        </li>
      </ul>
      ${isLoggedIn ? `` : `<form class="form-inline" id="notLoginButtons">
        <button type="button" class="btn btn-success my-sm-0" data-toggle="modal" data-target="#registerModal">
          Register
        </button>
        &nbsp;&nbsp;
        <button type="button" class="btn btn-outline-success my-sm-0" data-toggle="modal" data-target="#loginModal">
          Login
        </button>
      </form>`}
    `
    @else
    if (localStorage.getItem('needReload') == 1){
      localStorage.setItem('needReload', 0);
      window.location.reload();
    }
    navBarHTML = `
      <ul class="navbar-nav mr-auto mt-lg-0" id='navbarBadges'>
        <li class="nav-item">
          <a class="nav-link" href="/">Home</a>
        </li>
        ${isLoggedIn ? `<div class="btn-group" id="moreButton">
            <li class="nav-item" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
              <a class="nav-link" href="javascript:;">More</a>
            </li>
            <div class="dropdown-menu dropdown-menu-left">
              <a class="dropdown-item" href="/history">History</a>
              <a class="dropdown-item" href="/mate">Study Mate</a>
              <a class="dropdown-item" href="/contribute">Contribute Questions</a>
              <a class="dropdown-item" onclick="startIntro()">Helps</a>
            </div>
          </div>` : `<li class="nav-item" id="helpButton">
            <a class="nav-link" href="javascript:startIntro()">Help</a>
          </li>`}
        </ul>
        ${isLoggedIn ? `` : `<form class="form-inline" id="notLoginButtons">
          <button type="button" class="btn btn-success" data-toggle="modal" data-target="#registerModal">
            Register
          </button>
          &nbsp;&nbsp;
          <button type="button" class="btn btn-outline-success" data-toggle="modal" data-target="#loginModal">
            Login
          </button>
        </form>`}
        ${isLoggedIn ? `<button data-toggle="modal" data-target=".bd-example-modal-lg" class="btn btn-outline-success" id="messageButton">
          <msg>Message</msg>
        </button>
        &nbsp;&nbsp;
        <form class="form-inline" id="loginButtons" action="/userLogout" method="get">
          <button type="submit" class="btn btn-success" id="logoutButton">
            Logout
          </button>
        </form>`:``}`
    @endif
    $("#navBar").html(navBarHTML);
  }
  renderNav(isLoggedIn);

  if (width < 575){
    $("#navbarBadges").html(`
      <li class="nav-item">
        <a class="nav-link" href="/">Home</a>
      </li>
      <li class="nav-item">
        <a class="nav-link" onclick="startIntro()">Help</a>
      </li>`
    );
  }
</script>

<script type="text/javascript">
  $.get('/countUnreadMessage', function(data,status){
    if (data['info'] > 0){
      $('msg').html(`Messages <span class="badge badge-success">${data['info']}</span>`);
    }
  })
  function login(){
    email = $('#logEmail').val();
    password = $('#logPassword').val();
    $.get(`/userLogin?Email=${email}&Password=${password}`, function(data,status){
      if (data[0] == 0){
        $("#errorLog").fadeIn();
        $('#errorLogInfo').html(data[1]);
      } else {
        $('#loginModal').modal('hide');
        @if ($q)
          renderNav(true);
          $("#notlogged").fadeOut(100);
        @else
          location.reload();
        @endif
      }
    });
  }
  function register(){
    uName = $('#regName').val();
    email = $('#regEmail').val();
    password = $('#regPassword').val();
    $.get(`/userRegister?Email=${email}&Password=${password}&Name=${uName}`, function(data,status){
      if (data[0] == 0){
        $("#errorReg").fadeIn();
        $('#errorRegInfo').html(data[1]);
      } else {
        $('#registerModal').modal('hide');
        @if ($q)
        renderNav(true);
        $("#notlogged").fadeOut(100);
        @else
        location.reload();
        @endif
      }
    });
  }
</script>