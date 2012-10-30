<!DOCTYPE html>
<html>
    <head>
        <meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
        <title>bitMVC Starter Page</title>
        <link href="<?php print $this->base_url ?>/libraries/bootstrap/css/bootstrap.css" media="screen" rel="stylesheet" type="text/css"/>
        <link href="<?php print $this->base_url ?>/libraries/bootstrap/css/bootstrap-responsive.css" media="screen" rel="stylesheet" type="text/css"/>
        <link href="<?php print $this->base_url ?>/public/css/style.css" media="screen" rel="stylesheet" type="text/css"/>
    </head>
    <body>
       <div class="navbar navbar-fixed-top">
          <div class="navbar-inner">
            <div class="container">
              <a class="btn btn-navbar" data-toggle="collapse" data-target=".nav-collapse">
                <span class="icon-bar"></span>
                <span class="icon-bar"></span>
                <span class="icon-bar"></span>
              </a>
              <a class="brand" href="#">bitMVC</a>
              <div class="nav-collapse">
                <ul class="nav">
                  <li class="active"><a href="/">Home</a></li>
                  <li><a href="https://github.com/SirDrupal/Chorrobot/wiki" target="_blank">Wiki</a></li>
                </ul>
              </div><!--/.nav-collapse -->
            </div>
          </div>
        </div>
        <div class='container'>
        <h2>Hello World!</h2>    
        </div>
    <script src="<?php print $this->base_url ?>/libraries/jquery/jquery.min.js"></script>
    <script src="<?php print $this->base_url ?>/libraries/bootstrap/js/bootstrap.min.js"></script>
    </body>
</html>