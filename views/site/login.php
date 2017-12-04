<?php

/* @var $this yii\web\View */
/* @var $form yii\bootstrap\ActiveForm */
/* @var $model app\models\LoginForm */

use yii\helpers\Html;
use yii\bootstrap\ActiveForm;

$this->title = 'Iniciar Sesión';
?>
<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.2.1/jquery.min.js"></script>
<!-- Latest compiled and minified CSS -->
<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css" integrity="sha384-BVYiiSIFeK1dGmJRAkycuHAHRg32OmUcww7on3RYdg4Va+PmSTsz/K68vbdEjh4u" crossorigin="anonymous">
<!-- Latest compiled and minified JavaScript -->
<script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js" integrity="sha384-Tc5IQib027qvyjSMfHjOMaLkfuWVxZxUPnCJA7l2mCWNIpG9mGCD8wGNIcPD7Txa" crossorigin="anonymous"></script>

<link href="http://fonts.googleapis.com/css?family=Open+Sans:400,300,700" rel="stylesheet" type="text/css">
<link rel="stylesheet" href="css/bootstrap.min.css">
<link rel="stylesheet" href="css/style.css">
<link rel="stylesheet" href="css/icomoon/style.css">
<link rel="stylesheet" href="css/blue.css" class="colors">
<!-- Add icon library -->
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">

<style>
    .content:before {
        content: "";
        position: fixed;
        left: 0;
        right: 0;
        z-index: -1;

        display: block;
        background-image: url('images/fondobici.jpg');
        background-size: 100%;
        width: 100%;
        height: 100%;

        -webkit-filter: blur(5px);
        -moz-filter: blur(5px);
        -o-filter: blur(5px);
        -ms-filter: blur(5px);
        filter: blur(5px);
    }
    .vertical-align {
        position: absolute;
        top: 50%;
        left:50%;
        transform: translate(-50%,-50%);
        border: 1px dashed deeppink;
    }
    .fa {
        padding: 20px;
        font-size: 30px;
        width: 55px;
        text-align: center;
        text-decoration: none;
    }
    .fa-facebook {
        background: #3B5998;
        color: white;
    }
    .fa-twitter {
        background: #55ACEE;
        color: white;
    }
    .fa-youtube {
        background: #f72525;
        color: white;
    }
</style>

<style>
			body{
				margin-top:20px;
				background:#eee;
			}	

			.profile .panel-profile {
				border: none;
				margin-bottom: 0;
				box-shadow: none;
			}

			.profile .panel-heading {
				color: #585f69;
				background: #fff;
				padding: 7px 15px;
				border-bottom: solid 3px #f7f7f7;
			}

			.overflow-h {
				overflow: hidden;
			}

			.panel-heading {
				color: #fff;
				padding: 5px 15px;
			}

			.profile .panel-title {
				font-size: 16px;
			}

			.profile .profile-blog {
				padding: 20px;
				background: #fff;
			}

			.profile .blog-border {
				border: 1px solid #f0f0f0;
			}

			.profile .profile-blog img {
				float: left;
				width: 50px;
				height: 50px;
				margin-right: 20px;
			}

			.rounded-x {
				border-radius: 50% !important;
			}

			.profile .name-location {
				overflow: hidden;
			}

			.profile .name-location strong {
				color: #555;
				display: block;
				font-size: 16px;
			}

			.profile .name-location span a {
				color: #555;
			}

			.margin-bottom-20 {
				margin-bottom: 20px;
			}

			.share-list {
				margin-bottom: 0;
			}


			.list-inline {
				padding-left: 0;
				margin-left: -5px;
				list-style: none;
			}

			.list-inline li {
				display: inline-block;
				padding-right: 5px;
				padding-left: 5px;
				font-size:11px;
			}

			.share-list li i {
				color: #72c02c;
				margin-right: 5px;
			}   
</style>

    <div id ="myModal" class="modal">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
                    <h4 class="modal-title text-primary"></h4>
                </div>
                <div class="modal-body">
                    <h1 class="text-center text-primary"><?= Html::encode($this->title) ?></h1>

                    <p class="text-center text-primary">Ingrese los siguientes datos para iniciar sesión</p>

                    <?php $form = ActiveForm::begin([
                        'method' => 'post',
                        'id' => 'login-form',
                        'options' => ['class' => 'form-vertical'],
                    ]); ?>

                    <div class="form-group text-primary">
                        <?= $form->field($model, 'username')->input("text") ?>
                    </div>

                    <div class="form-group text-primary">
                        <?= $form->field($model, 'password')->input("password") ?>
                    </div>

                    <div class="form-group text-primary">
                        <?= $form->field($model, 'rememberMe')->checkbox() ?>
                    </div>
                </div>

                <div class="modal-footer">
                    <div class="form-group">
                        <div class="btn-group pull-right">
                            <?= Html::submitButton('Ingresar', ['class' => 'btn btn-primary', 'name' => 'login-button']) ?>
                        </div>
                    </div>

                    <?php ActiveForm::end(); ?>

                    <!---
                    <div class="col-md-12">
                        <br><hr><br>
                        <p>¿No tienes una cuenta? <strong><a href="index.php?r=site%2Fregister">Registrate Acá</a></strong></p>
                    </div> -->
                </div>
            </div>
        </div>
    </div>

        <div class="content" id="header" style="width: 100%; height: 100%;">
		<div class="">
            <div class="" >
                    <!-- Trigger the modal with a button -->
                    <div class="col-xs-12 hidden-xs"><button type="button" class="btn btn-info btn-lg pull-right" data-toggle="modal" data-target="#myModal">Ingresar</button></div>

                    <div class="text-center"><img class="img-fluid" src="images/logoHorti.png" style="display:inline; vertical-align: top; height:384px;"></div>

                    <br>

                    <div class="col-xs-12 visible-xs text-center"><button type="button" class="btn btn-info btn-lg" data-toggle="modal" data-target="#myModal">Ingresar</button></div>
                    
            </div>
			
			<div class="countdown" id="countdown">
				<div class="container">
					  <div class="row">
						<div class="countdown-item col-sm-3 col-xs-3">
							<div class="countdown-number" id="countdown-days">0</div>
							<div class="countdown-label">Dias</div>
						</div>

						<div class="countdown-item col-sm-3 col-xs-3">
							<div class="countdown-number" id="countdown-hours">0</div>
							<div class="countdown-label">Horas</div>
						</div>

						<div class="countdown-item col-sm-3 col-xs-3">
							<div class="countdown-number" id="countdown-minutes"></div>
							<div class="countdown-label">Minutos</div>
						</div>

						<div class="countdown-item col-sm-3 col-xs-3">
							<div class="countdown-number" id="countdown-seconds"></div>
							<div class="countdown-label">segundos</div>
						</div>
					</div>
				<div class="row"> <!--
					<form id="newsletter-form" action="send.php" method="POST" class="col-md-6 col-md-offset-3 col-sm-6 col-sm-offset-3 myform" novalidate>
						<div class="input-group">
							<input id="newsletter-mail" name="email" placeholder="Enter your email" class="form-control input-lg requiredField" type="email" data-error-empty="Please enter your email" data-error-invalid="Invalid email address">
							<span class="input-group-btn">
								<button name="submit" type="submit" class="btn" data-error-message="Error!" data-sending-message="Sending..." data-ok-message="Message Sent">Subscribe!</button>
							</span>
						</div>
						<input type="hidden" name="submitted" id="submitted2" value="true">
					</form> -->
				</div>	
				</div>
			</div>
			<div class="container">
				<div class="row">
					<div class="text-center">
                        <a href="https://twitter.com/hortifrut" class="fa fa-twitter"></a>
                        <a href="https://www.facebook.com/hortifrut.berries/" class="fa fa-facebook"></a>
                        <a href="https://www.youtube.com/channel/UCOlWjsIdLW7VzJbzRquMk1A" class="fa fa-youtube"></a>
					</div>
				</div>
			</div>
			<footer>
				<p class="text-center copyright">&copy; Hortifrut 2017. Diseñado por <a href="http://www.agroid.cl" target="_blank">Agroid</a>.<br>
				</p>
			</footer>
		</div>
		</div>
			
		<script type="text/javascript" src="js/jquery.countdown.min.js"></script>
		<script type="text/javascript" src="js/custom.js"></script>
		<script type="text/javascript" src="js/ga.js"></script>

