    <div id="bg"></div>
<!--
    <div class="navbar navbar-inverse navbar-fixed-top">
      <ul class="nav navbar-nav">
        <li class="active"><a href="#">Home</a></li>
        <li><a href="#">Link</a></li>
        <li><a href="#">Link</a></li>
      </ul>
    </div>
-->    
    <div class="container">
      <ul class="nav nav-pills pull-right">
        <li><a href="#">Notices</a></li>
        <li><a href="#">Report an issue</a></li>
      </ul>
      <!-- Jumbotron -->
      <div class="invite-box" align="center">
        <h1><img src="<?php echo base_url('assets/img/logo.png'); ?>" /></h1>
        <p class="lead">A <strong>secured database interface</strong> for the 505 ABW.</p>
<!--        <a class="btn btn-small btn-primary" href="<?php echo base_url('signin'); ?>">Sign In</a> -->
        <form class="form-horizontal" action="login" method="post">
        <div class="form-group">
          <label for="username" class="col-lg-3 control-label">Username</label>
          <div class="col-lg-8">
            <input type="text" class="form-control" id="username" name="username" placeholder="Username">
          </div>
        </div>
        <div class="form-group">
          <label for="password" class="col-lg-3 control-label">Password</label>
          <div class="col-lg-8">
            <input type="password" class="form-control" id="password" name="password" placeholder="Password">
          </div>
        </div>
        <br />
        <div class="form-group">
          <div class="col-lg-offset-0 col-lg-12">
            <button type="submit" class="btn btn-lg btn-block btn-success">Log in!</button>
          </div>
        </div>
      </form>
      </div>

    </div> <!-- /container -->
<div id="phone"></div>