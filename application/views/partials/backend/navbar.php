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
             <li><a href="<?php echo site_url('/products/add') ?>">Add New</a></li>
             <li><a href="<?php echo site_url('/products') ?>">Products</a></li>

           </ul>
         </li>
         <li> <a href="<?php echo site_url('/orders/manage/ordering') ?>" >Orders </a></li>
        
       <li class="dropdown">
        <a href="#" class="dropdown-toggle" data-toggle="dropdown">Report <b class="caret"></b></a>
        <span class="dropdown-arrow"></span>
        <ul class="dropdown-menu">
         <li><a href="<?php echo  site_url().'/orders/reportOrder/ordering' ?>">Orders</a></li>
         <li><a href="<?php echo  site_url().'/members/reportMember' ?>">Member</a></li>
      
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
   

</ul>

<ul class="nav navbar-nav navbar-right">
  <?php if($this->session->has_userdata('credentials')) { ?>


  <li class="dropdown">
    <a href="#" class="dropdown-toggle" data-toggle="dropdown">Hello, <?php echo $this->session->userdata('name')?> <b class="caret"></b></a>
    <span class="dropdown-arrow"></span>
    <ul class="dropdown-menu">
     
      <li><a class="btn btn-success" href="<?php echo site_url('auth/logout') ?>">Logout</a></li>
    </ul>
  </li>


  <?php } ?>

</ul>

</div><!-- /.navbar-collapse -->
          </nav><!-- /navbar -->