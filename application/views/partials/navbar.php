  <body>

  	<nav class="navbar navbar-inverse navbar-embossed" role="navigation">
  <div class="navbar-header">
    <button type="button" class="navbar-toggle" data-toggle="collapse" data-target="#navbar-collapse-01">
      <span class="sr-only">Toggle navigation</span>
    </button>
    <a class="navbar-brand" href="<?php echo site_url('/') ?>">ANYBABA</a>
  </div>
  <div class="collapse navbar-collapse" id="navbar-collapse-01">
    <ul class="nav navbar-nav navbar-left">
    
      <li class="dropdown">
        <a href="#" class="dropdown-toggle" data-toggle="dropdown">Categories <b class="caret"></b></a>
        <span class="dropdown-arrow"></span>
        <ul class="dropdown-menu">
          <li><a href="#">Cloth</a></li>
          <li><a href="#">T-shirt</a></li>
          <li><a href="#">Jeans</a></li>
          <li class="divider"></li>
          <li><a href="#">Separated link</a></li>
        </ul>
      </li>
      <li><a href="#fakelink">About Us</a></li>
    </ul>

    <ul class="nav navbar-nav navbar-right">

       <li><a  href="<?php echo site_url('auth/signup') ?>">Sign Up</a></li>
      <li><a class="btn btn-primary" href="<?php echo site_url('auth/login') ?>">Login</a></li>
    </ul>

  </div><!-- /.navbar-collapse -->
          </nav><!-- /navbar -->