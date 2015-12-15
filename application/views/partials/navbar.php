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
          <?php if($this->session->has_userdata('credentials')) { ?>
          <li class="dropdown">
          <a href="#" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-expanded="false"> <span class="glyphicon glyphicon-shopping-cart"></span> 7 - Items<span class="caret"></span></a>
          <ul class="dropdown-menu dropdown-cart" role="menu">
              <li>
                  <span class="item">
                    <span class="item-left">
                        <img src="http://lorempixel.com/50/50/" alt="" />
                        <span class="item-info">
                            <span>Item name</span>
                            <span>23$</span>
                        </span>
                    </span>
                    <span class="item-right">
                        <button class="btn btn-xs btn-danger pull-right">x</button>
                    </span>
                </span>
              </li>
              <li>
                  <span class="item">
                    <span class="item-left">
                        <img src="http://lorempixel.com/50/50/" alt="" />
                        <span class="item-info">
                            <span>Item name</span>
                            <span>23$</span>
                        </span>
                    </span>
                    <span class="item-right">
                        <button class="btn btn-xs btn-danger pull-right">x</button>
                    </span>
                </span>
              </li>
              <li>
                  <span class="item">
                    <span class="item-left">
                        <img src="http://lorempixel.com/50/50/" alt="" />
                        <span class="item-info">
                            <span>Item name</span>
                            <span>23$</span>
                        </span>
                    </span>
                    <span class="item-right">
                        <button class="btn btn-xs btn-danger pull-right">x</button>
                    </span>
                </span>
              </li>
              <li>
                  <span class="item">
                    <span class="item-left">
                        <img src="http://lorempixel.com/50/50/" alt="" />
                        <span class="item-info">
                            <span>Item name</span>
                            <span>23$</span>
                        </span>
                    </span>
                    <span class="item-right">
                        <button class="btn btn-xs btn-danger pull-right">x</button>
                    </span>
                </span>
              </li>
              <li class="divider"></li>
              <li><a class="text-center" href="">View Cart</a></li>
          </ul>
        </li>

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

          
        <?php } else { ?>
         <li><a  href="<?php echo site_url('auth/signupMember') ?>">Sign Up</a></li>
         <li><a class="btn btn-primary" href="<?php echo site_url('auth/login') ?>">Login</a></li>
          <?php } ?>
       </ul>

     </div><!-- /.navbar-collapse -->
          </nav><!-- /navbar -->