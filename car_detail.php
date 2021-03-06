<?php 
    $first = $_GET["first"];
    $last = $_GET["last"];
    $city = $_GET['city'];
?>
<html lang="en"><head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <!-- The above 3 meta tags *must* come first in the head; any other head content must come *after* these tags -->
    <meta name="description" content="">
    <meta name="author" content="">
    <link rel="icon" href="../../favicon.ico">

    <title>Car Details| Hotshot</title>

    <!-- Bootstrap core CSS -->
    <link href="bootstrap/css/bootstrap.min.css" rel="stylesheet">

    <!-- Custom styles for this template -->
    <link href="bootstrap/css/signin.css" rel="stylesheet">

    <!-- Just for debugging purposes. Don't actually copy these 2 lines! -->
    <!--[if lt IE 9]><script src="../../assets/js/ie8-responsive-file-warning.js"></script><![endif]-->
    <script src="../../assets/js/ie-emulation-modes-warning.js"></script>

    <!-- HTML5 shim and Respond.js for IE8 support of HTML5 elements and media queries -->
    <!--[if lt IE 9]>
      <script src="https://oss.maxcdn.com/html5shiv/3.7.2/html5shiv.min.js"></script>
      <script src="https://oss.maxcdn.com/respond/1.4.2/respond.min.js"></script>
    <![endif]-->
  <style type="text/css"></style></head>

  <body>

    <div class="container">

      <form class="form-signin">
        <div class="form-logo"><img src="assets/HotShotIcon.png"></div>
        <h5 class="form-signin-heading"> <?php echo $first." " ?> give  us some details on your vehicle</h5>
        <div class="form-group row">
          <div class="col-md-4">
            <input type="text" id="inputMake" class="form-control" placeholder="Make" required="" autofocus="">
          </div>
          <div class="col-md-4">
            <input type="text" id="inputModel" class="form-control" placeholder="Model" required="" autofocus="">
          </div>
          <div class="col-md-4">
            <input type="text" id="inputYear" class="form-control" placeholder="Yr" required="" autofocus="">
          </div>
        </div>
        <label for="inputVin" class="sr-only">VIN #</label>
        <input type="email" id="inputEmail" class="form-control" placeholder="VIN #" required="" autofocus="">

        <button class="btn btn-lg btn-danger btn-block" type="submit">Next</button>
      </form>

    </div> <!-- /container -->
    <!-- IE10 viewport hack for Surface/desktop Windows 8 bug -->
    <script src="../../assets/js/ie10-viewport-bug-workaround.js"></script>
  

</body></html>