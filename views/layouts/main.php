<?php

/* @var $this \yii\web\View */
/* @var $content string */

// use app\widgets\Alert;
use yii\helpers\Html;
// use yii\bootstrap\Nav;
// use yii\bootstrap\NavBar;
// use yii\widgets\Breadcrumbs;
// use app\assets\AppAsset;

// AppAsset::register($this);
?>
<?php $this->beginPage() ?>
<!DOCTYPE html>
<html lang="<?= Yii::$app->language ?>">
<head>
    <meta http-equiv="Content-Type" content="text/html; charset=utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1">
	<title>Ademola's Assessment</title>
    <meta name="keywords" content="Ademola's Assessment"> 
    <meta name="description" content="Ademola's Assessment"> 
    <meta name="author" content="Ademola Raimi">
    <meta name="revisit-after" content="7 days">
    <meta charset="<?= Yii::$app->charset ?>">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link rel="stylesheet" type="text/css" href="/css/bootstrap.min.css">
	<link rel="stylesheet" type="text/css" href="/css/font-awesome.css">
    <link rel="stylesheet" type="text/css" href="/css/style.css">
    <link rel="stylesheet" href="https://unpkg.com/leaflet@1.6.0/dist/leaflet.css"
  integrity="sha512-xwE/Az9zrjBIphAcBb3F6JVqxf46+CDLwfLMHloNu6KEQCAWi6HcDUbeOfBIptF7tcCzusKFjFw2yuvEpDL9wQ=="
  crossorigin=""/>
  <link rel="stylesheet" href="https://cdn.datatables.net/1.10.20/css/jquery.dataTables.min.css"/>
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-datepicker/1.9.0/css/bootstrap-datepicker.min.css"/>
	<?php $this->registerCsrfMetaTags() ?>
    <?php $this->head() ?>
</head>
<body class="bg-light">
<?php $this->beginBody() ?>

    <nav class="navbar navbar-expand-lg sticky-top navbar-dark bg-new-purple">
		<div class="container">
		  <a class="navbar-brand mr-auto mr-lg-0" href="/order/index">Cigo Interview</a>
		  <button class="navbar-toggler p-0 border-0" type="button" data-toggle="offcanvas">
		    <span class="navbar-toggler-icon"></span>
		  </button>

		  <div class="navbar-collapse offcanvas-collapse float-right" id="navbarsExampleDefault">
		    <ul class="navbar-nav mr-auto">
		      <li class="nav-item active">
		        <a class="nav-link" href="/order/index">Home <span class="sr-only">(current)</span></a>
		      </li>
		      <li class="nav-item">
		        <a class="nav-link" href="#">About</a>
		      </li>
		      <li class="nav-item">
		        <a class="nav-link" href="#">Contact</a>
		      </li>
		      <li class="nav-item">
		        <a class="nav-link" href="#">Login</a>
		      </li>
		    </ul>
		  </div>
		</div>
	</nav>

    <div class="container">
        <?= $content ?>
    </div>


    <!-- Footer -->
    <footer class="footer mt-auto py-3">
	  <div class="container">
	  	<div class="row">
	  		<div class="col-12 col-sm-6 col-md-6 col-lg-6 footer-text1">
	    		<small>&copy; Ademola Raimi 2020</small>
	    	</div>
	    	<div class="col-12 col-sm-6 col-md-6 col-lg-6 footer-text2">
			    <small>Powered by Yii Framework</small>
			</div>
	  	</div>
	  </div>
	</footer>
</div>
<?php $this->endBody() ?>
	<script src="/js/jquery.min.js"></script>
	<script src="/js/popper.js"></script>
	<script src="/js/bootstrap.min.js"></script>
	<script src="/js/main.js"></script>
    <script src="/js/form-validation.js"></script>
    <script src="https://unpkg.com/leaflet@1.6.0/dist/leaflet.js"
  integrity="sha512-gZwIG9x3wUXg2hdXF6+rVkLF/0Vi9U8D2Ntg4Ga5I5BZpVkVxlJWbSQtXPSiUTtC0TjtGOmxa1AJPuV0CPthew=="
  crossorigin=""></script>
  <script src="https://cdn.jsdelivr.net/npm/sweetalert2@9"></script>
  <script src="https://cdn.datatables.net/1.10.20/js/jquery.dataTables.min.js"></script>
  <script src="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-datepicker/1.9.0/js/bootstrap-datepicker.min.js" integrity="sha256-bqVeqGdJ7h/lYPq6xrPv/YGzMEb6dNxlfiTUHSgRCp8=" crossorigin="anonymous"></script>
  <script src="//cdn.jsdelivr.net/jquery.scrollto/2.1.2/jquery.scrollTo.min.js"></script>
<div id="lightContent"></div>  
</body>
</html>
<?php $this->endPage() ?>
