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

         <li><a href="<?php echo site_url().'/pages/categories/clothes' ?>">Clothes</a></li>
         <li><a href="<?php echo site_url().'/pages/categories/watches' ?>">Watches</a></li>
         <li><a href="<?php echo site_url().'/pages/categories/bags' ?>">Bags</a></li>
         <li><a href="<?php echo site_url().'/pages/categories/accessories' ?>">Accessories</a></li>
       </ul>

       <ul class="nav navbar-nav navbar-right">
        <?php if($this->session->has_userdata('credentials')) { ?>
        <li class="dropdown">
          <a href="#" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-expanded="false"> <span class="glyphicon glyphicon-shopping-cart"></span> <?php echo $numcarts ?> - Items<span class="caret"></span></a>
          <?php echo $carts; ?>
          
        </li>

        <li class="dropdown">
          <a href="#" class="dropdown-toggle" data-toggle="dropdown">Hello, <?php echo $this->session->userdata('name')?> <b class="caret"></b></a>
          <span class="dropdown-arrow"></span>
          <ul class="dropdown-menu">
            <li><a href="<?php echo site_url().'/pages/history' ?>">Order History</a></li>           
            <li class="divider"></li>
            <li><a class="btn btn-success" href="<?php echo site_url('auth/logout') ?>">Logout</a></li>
          </ul>
        </li>

        
        <?php } else { ?>
        <li><a  href="<?php echo site_url('auth/signupMember') ?>">Sign Up</a></li>
        <li><a class="btn btn-primary" href="<?php echo site_url('auth/login') ?>">Login</a></li>
        <?php } ?>
      </ul>

    </div><!-- /.navbar-collapse -->
          </nav><!-- /navbar -->