  <body>

  	<nav class="navbar navbar-inverse navbar-embossed" role="navigation">
      <div class="navbar-header">
        <button type="button" class="navbar-toggle" data-toggle="collapse" data-target="#navbar-collapse-01">
          <span class="sr-only">Toggle navigation</span>
        </button>
        <a class="navbar-brand" href="<?php echo site_url('/') ?>">ANYBABA | <?php echo $this->session->userdata('credentials')  ?> </a>
      </div>
      <div class="collapse navbar-collapse" id="navbar-collapse-01">
        <ul class="nav navbar-nav navbar-left">


          <li class="dropdown">
            <a href="#" class="dropdown-toggle" data-toggle="dropdown">Products <b class="caret"></b></a>
            <span class="dropdown-arrow"></span>
            <ul class="dropdown-menu">
             <li><a href="#">Add New</a></li>
             <li><a href="#">Member</a></li>
           </ul>
         </li>
         <li class="dropdown">
          <a href="#" class="dropdown-toggle" data-toggle="dropdown">Order <b class="caret"></b></a>
          <span class="dropdown-arrow"></span>
          <ul class="dropdown-menu">
           <li><a href="#">Add New</a></li>
           <li><a href="#">Member</a></li>
         </ul>
       </li>
       <li class="dropdown">
        <a href="#" class="dropdown-toggle" data-toggle="dropdown">Report <b class="caret"></b></a>
        <span class="dropdown-arrow"></span>
        <ul class="dropdown-menu">
         <li><a href="#">Add New</a></li>
         <li><a href="#">Member</a></li>
       </ul>
     </li>
     <li class="dropdown">
      <a href="#" class="dropdown-toggle" data-toggle="dropdown">Pages <b class="caret"></b></a>
      <span class="dropdown-arrow"></span>
      <ul class="dropdown-menu">
        <li><a href="#">Home</a></li>
        <li><a href="#">About us</a></li>
      </ul>
    </li>
    <li class="dropdown">
      <a href="#" class="dropdown-toggle" data-toggle="dropdown">Members <b class="caret"></b></a>
      <span class="dropdown-arrow"></span>
      <ul class="dropdown-menu">
        <li><a href="<?php echo site_url('/members') ?>">Members</a></li>
        <li><a href="<?php echo site_url('/members/add') ?>">Add New</a></li>
        

      </ul>
    </li>
    <?php if($this->session->userdata('credentials') == 'manager') { ?>
    <li class="dropdown">
      <a href="#" class="dropdown-toggle" data-toggle="dropdown">Employees <b class="caret"></b></a>
      <span class="dropdown-arrow"></span>
      <ul class="dropdown-menu">
         <li><a href="#">Employees</a></li>
        <li><a href="#">Add New</a></li>
       
      </ul>
    </li>
  </li>
  <?php } ?>

</ul>

<ul class="nav navbar-nav navbar-right">
  <?php if($this->session->has_userdata('credentials')) { ?>


  <li class="dropdown">
    <a href="#" class="dropdown-toggle" data-toggle="dropdown">Hello, <?php echo $this->session->userdata('name')?> <b class="caret"></b></a>
    <span class="dropdown-arrow"></span>
    <ul class="dropdown-menu">
      <li><a href="#">Carts</a></li>
      <li><a href="#">Wishlist</a></li>
      <li><a href="#">Settings</a></li>
      <li class="divider"></li>
      <li><a class="btn btn-success" href="<?php echo site_url('auth/logout') ?>">Logout</a></li>
    </ul>
  </li>


  <?php } ?>

</ul>

</div><!-- /.navbar-collapse -->
          </nav><!-- /navbar -->