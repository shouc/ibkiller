@if ($q)
  <div id="navbg" class="nav-local-h">
   <nav class="navbar navbar-expand-sm navbar-light " class="nav-local">
    <ul class="navbar-nav mr-auto mt-lg-0">
      <button class="btn my-2 my-sm-0" type="submit">Leave</button>
      &nbsp;&nbsp;
    </ul>
    <form class="form-inline my-2 my-lg-0">

      <button class="btn btn-success my-2 my-sm-0" type="submit">Register</button>
      &nbsp;&nbsp;
      <button class="btn btn-outline-success my-2 my-sm-0" type="submit">Login</button>
    </form>
  </nav>
  </div>

@else
  <div id="navbg" class="nav-local-h">
   <nav class="navbar navbar-expand-sm navbar-light " class="nav-local">
    <ul class="navbar-nav mr-auto mt-lg-0">
    <li class="nav-item">
      <a class="nav-link" href="#">Home</a>
    </li>
    <li class="nav-item">
      <a class="nav-link" href="#">Help</a>
    </li>
    </ul>
    <form class="form-inline my-2 my-lg-0">
      <button class="btn btn-success my-2 my-sm-0" type="submit">Register</button>
      &nbsp;&nbsp;
      <button class="btn btn-outline-success my-2 my-sm-0" type="submit">Login</button>
    </form>
  </nav>
  </div>
@endif