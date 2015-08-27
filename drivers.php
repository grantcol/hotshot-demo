<?php 
  $part = $_GET["part"];
  $toaddr = $_GET["toaddr"];
  $toaddr = str_replace(' ', '_', $toaddr);
?>
<!DOCTYPE html>
<html lang="en">
  <head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <!-- The above 3 meta tags *must* come first in the head; any other head content must come *after* these tags -->
    <title>Bootstrap 101 Template</title>

    <!-- Bootstrap -->
    <link href="bootstrap/css/bootstrap.min.css" rel="stylesheet">

    <!-- HTML5 shim and Respond.js for IE8 support of HTML5 elements and media queries -->
    <!-- WARNING: Respond.js doesn't work if you view the page via file:// -->
    <!--[if lt IE 9]>
      <script src="https://oss.maxcdn.com/html5shiv/3.7.2/html5shiv.min.js"></script>
      <script src="https://oss.maxcdn.com/respond/1.4.2/respond.min.js"></script>
    <![endif]-->
  </head>
  <body>
        <nav class="navbar navbar-default" style="margin-bottom: 0px;">
  <div class="container-fluid">
    <!-- Brand and toggle get grouped for better mobile display -->
    <div class="navbar-header">
      <button type="button" class="navbar-toggle collapsed" data-toggle="collapse" data-target="#bs-example-navbar-collapse-1" aria-expanded="false">
        <span class="sr-only">Toggle navigation</span>
        <span class="icon-bar"></span>
        <span class="icon-bar"></span>
        <span class="icon-bar"></span>
      </button>
      <a class="navbar-brand" href="index.php"><img src="assets/HotShotIcon.png" height="100%"></a><p class="navbar-text">Signed in as Dealer Member</p>
    </div>

    <!-- Collect the nav links, forms, and other content for toggling -->
    <!--<div class="collapse navbar-collapse" id="bs-example-navbar-collapse-1">
      <ul class="nav navbar-nav">
        <li class="active"><a href="#">Link <span class="sr-only">(current)</span></a></li>
        <li><a href="#">Link</a></li>
        <li class="dropdown">
          <a href="#" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-haspopup="true" aria-expanded="false">Dropdown <span class="caret"></span></a>
          <ul class="dropdown-menu">
            <li><a href="#">Action</a></li>
            <li><a href="#">Another action</a></li>
            <li><a href="#">Something else here</a></li>
            <li role="separator" class="divider"></li>
            <li><a href="#">Separated link</a></li>
            <li role="separator" class="divider"></li>
            <li><a href="#">One more separated link</a></li>
          </ul>
        </li>
      </ul>
        </li>
      </ul>-->
    </div><!-- /.navbar-collapse -->
  </div><!-- /.container-fluid -->
</nav>
    <div class="container" style="padding-top: 50px; padding-right: 100px; padding-left: 100px;">
      <div class="page-header">
        <h1>Available Drivers</h1>
      </div>
      <div class="row">
        <div class="col-sm-4 col-md-4">
          <div class="thumbnail">
            <img src="http://img08.deviantart.net/9d6c/i/2012/253/4/d/2012_id_by_density_stock-d5e8sph.jpg" alt="...">
            <div class="caption">
              <h3>Dylan Lucas</h3>
              <p>
                  <span class="label label-warning"><span class="glyphicon glyphicon-star">1</span></span>
                  <span class="label label-success">Available</span>
                </p>
              <p><a href=<?php echo 'route.php?part='. $part .'&driver="dylan_lucas&toaddr='.$toaddr.'"' ?> class="btn btn-success" role="button" style="width: 100%;">Dispatch</a></p>
            </div>
          </div>
        </div>
        <div class="col-sm-4 col-md-4">
          <div class="thumbnail">
            <img src="http://img08.deviantart.net/9d6c/i/2012/253/4/d/2012_id_by_density_stock-d5e8sph.jpg" alt="...">
            <div class="caption">
              <h3>Michael Lucas</h3>
              <p>
                  <span class="label label-warning"><span class="glyphicon glyphicon-star">5</span></span>
                  <span class="label label-success">Available</span>
                </p>
              <p><a href=<?php echo 'route.php?part='. $part .'&driver="michael_lucas&toaddr='.$toaddr.'"' ?> class="btn btn-success" role="button" style="width: 100%;">Dispatch</a></p>
            </div>
          </div>
        </div>
        <div class="col-sm-4 col-md-4">
          <div class="thumbnail">
            <img src="http://img08.deviantart.net/9d6c/i/2012/253/4/d/2012_id_by_density_stock-d5e8sph.jpg" alt="...">
            <div class="caption">
              <h3>Shawn Lucas</h3>
              <p>
                  <span class="label label-warning"><span class="glyphicon glyphicon-star">3</span></span>
                  <span class="label label-success">Available</span>
                </p>
              <p><a href=<?php echo 'route.php?part='. $part .'&driver="shawn_lucas&toaddr='.$toaddr.'"' ?> class="btn btn-success" role="button" style="width: 100%;">Dispatch</a></p>
            </div>
          </div>
        </div>
      </div>
      <!--<form>
        <div class="form-group">
          <label for="exampleInputEmail1">Email address</label>
          <input type="email" class="form-control" id="exampleInputEmail1" placeholder="Email">
        </div>
        <div class="form-group">
          <label for="exampleInputPassword1">Password</label>
          <input type="password" class="form-control" id="exampleInputPassword1" placeholder="Password">
        </div>
        <div class="form-group">
          <label for="exampleInputFile">File input</label>
          <input type="file" id="exampleInputFile">
          <p class="help-block">Example block-level help text here.</p>
        </div>
        <div class="checkbox">
          <label>
            <input type="checkbox"> Check me out
          </label>
        </div>
        <button type="submit" class="btn btn-default">Submit</button>
      </form>
    </div>-->

    <!-- jQuery (necessary for Bootstrap's JavaScript plugins) -->
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/1.11.3/jquery.min.js"></script>
    <!-- Include all compiled plugins (below), or include individual files as needed -->
    <script src="bopotatrap/js/bootstrap.min.js"></script>
  </body>
</html>