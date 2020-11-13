<?php
defined('ISHOME') or die("Can't acess this page, please come back!");
include_once("includes/vt-includes-js.php");
$_SESSION['IS_LOGGED'] = false;
$error = null;
if (isset($_POST['txt_username'])) {
	$jsonBody = array(
		"usernameOrEmail" => addslashes($_POST['txt_username']),
		"password" => addslashes(md5(sha1($_POST['txt_password'])))
	);
	$resp = login(HOST_API, json_encode($jsonBody, JSON_UNESCAPED_UNICODE));
	$resp = json_decode($resp);
	if ($resp->status) {
		$_SESSION['IS_LOGGED'] = true;
		$_SESSION['USER_INFO'] = $resp;
	} else {
		if ($resp->error == 'PASSWORD_INCORRECT') {
			$error = "Mật khẩu không chính xác";
		} else  {
			$error = "Tên đăng nhập không chính xác";
		}
	}
}
if (!$_SESSION['IS_LOGGED']) { ?>
<html lang="en-us" id="extr-page">
	<body class="animated fadeInDown">
		<div id="main" role="main" class="main-login">
			<!-- MAIN CONTENT -->
			<div id="content" class="container">
				<div class="row">
					<div class="col-xs-12 col-sm-12 col-md-7 col-lg-4 hidden-xs hidden-sm"></div>
					<div class="col-xs-12 col-sm-12 col-md-12 col-lg-4">
						<div class="well no-padding">
							<form action="" id="login-form" class="smart-form client-form" method='POST' id="frmlogin" name="frmlogin" action='' autocomplete='off'>
								<header>
									<i class="fa fa-sign-in "></i> Đăng nhập
								</header>
								<fieldset>
									<?php if ($error !== null) :?>
										<section>
											<span style="color: red;"><?php echo $error;?></span>
										</section>
									<?php endif;?>
									<section>
										<label class="label">Tên đăng nhập</label>
										<label class="input"> <i class="icon-append fa fa-user"></i>
											<input type="text" name="txt_username" value="admin">
											<b class="tooltip tooltip-top-right"><i class="fa fa-user txt-color-teal"></i> Làm ơn nhập tên đăng nhập !</b></label>
									</section>
									<section>
										<label class="label">Mật khẩu</label>
										<label class="input"> <i class="icon-append fa fa-lock"></i>
											<input type="password" name="txt_password" value="123456a@">
											<b class="tooltip tooltip-top-right"><i class="fa fa-lock txt-color-teal"></i>Nhập mật khẩu</b> </label>
									</section>
								</fieldset>
								<footer>
									<button type="submit" class="btn btn-primary">
										Đăng nhập
								    </button>
								</footer>
							</form>
						</div>
					</div>
					<div class="col-xs-12 col-sm-12 col-md-7 col-lg-4 hidden-xs hidden-sm"></div>
				</div>
			</div>
		</div>
	</body>
</html>

<?php } else { ?>	
	<script>window.location.href='<?php echo ROOTHOST;?>';</script>
<?php } ?>
<script type="text/javascript">
	runAllForms();
	$(function() {
		// Validation
		$("#login-form").validate({
			// Rules for form validation
			rules : {
				txt_username : {
					required : true
				},
				txt_password : {
					required : true,
					minlength : 6,
					maxlength : 20
				}
			},
			// Messages for form validation
			messages : {
				txt_username : {
					required : 'Nhập tên đăng nhập'
				},
				txt_password : {
					required : ' Nhập mật khẩu'
				}
			},
			// Do not change code below
			errorPlacement : function(error, element) {
				error.insertAfter(element.parent());
			}
		});
	});
	var height = $(window).height();
	$(".main-login").css("min-height",height);
</script>
<style type="text/css">
	.main-login {
		background: url('images/bg1.png') !important;
		background-size: cover !important;
		background-repeat: no-repeat !important;
		background-position: center center !important;
		height: 100%;
		width: 100%;
		padding: 5% 0 !important;
	}
</style>

