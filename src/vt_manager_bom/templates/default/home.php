<!DOCTYPE html>
<html lang="en-us">	
	<head>
		<meta name="google" content="notranslate" />
		<meta http-equiv="Content-Type" content="text/html; charset=utf-8">		
		<meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1">
		<title>Quản Lý Bom</title>
		<?php 
			include_once("includes/vt-includes-css.php");
		?>
		<style>
			.treegrid-indent {
				width: 0px;
				height: 16px;
				display: inline-block;
				position: relative;
			}
			.treegrid-expander {
				width: 0px;
				height: 16px;
				display: inline-block;
				position: relative;
				left:-17px;
				cursor: pointer;
			}
		</style>
	</head>
	<body>
		<?php
			if (!isset($_SESSION['IS_LOGGED']) || !$_SESSION['IS_LOGGED']) {
				include_once("components/com_members/tem/login.php");
			} else  {
				$GLOBALS['USERID'] = $_SESSION['USER_INFO']->id;
				$GLOBALS['FULLNAME'] = $_SESSION['USER_INFO']->fullname;
		?>
		<header id="header">
			<div id="logo-group">
				<span id="logo"> 
					<a href="#"><img data-hide="phone" src="<?php echo ROOTHOST ?>assets/images/logo.png" alt="Logo"></a>
				</span>
			</div>
			<!-- #TOGGLE LAYOUT BUTTONS -->
			<!-- pulled right: nav area -->
			<div class="pull-right">
				<!-- collapse menu button -->
				<div id="hide-menus" class="btn-header pull-right">
					<span> <a href="javascript:void(0);" data-action="toggleMenu" title="Collapse Menu"><i class="fa fa-reorder"></i></a> </span>
				</div>
				<!-- end collapse menu -->
				
				<!-- logout button -->
				<div id="logout" class="btn-header transparent pull-right">
					<span> <a href="<?php echo ROOTHOST;?>logout" title="Thoát" data-action="userLogout" data-logout-msg=""><i class="fa fa-sign-out"></i></a> </span>
				</div>
				<!-- end logout button -->

				<!-- search mobile button (this is hidden till mobile view port) -->
				<div id="search-mobile" class="btn-header transparent pull-right">
					<span> <a href="javascript:void(0)" title="Search"><i class="fa fa-search"></i></a> </span>
				</div>
				<!-- end search mobile button -->
				
				<!-- #SEARCH -->
				<!-- input: search field -->
				<form action="#ajax/search.html" class="header-search pull-right">
					<input id="search-fld" type="text" name="param" placeholder="Tìm kiếm">
					<button type="submit">
						<i class="fa fa-search"></i>
					</button>
					<a href="javascript:void(0);" id="cancel-search-js" title="Cancel Search"><i class="fa fa-times"></i></a>
				</form>
				<!-- end input: search field -->

				<!-- fullscreen button -->
				<div id="fullscreen" class="btn-header transparent pull-right">
					<span> <a href="javascript:void(0);" data-action="launchFullscreen" title="Full Screen"><i class="fa fa-arrows-alt"></i></a> </span>
				</div>
				<!-- end fullscreen button -->

			</div>
			<!-- end pulled right: nav area -->

		</header>
		<!-- END HEADER -->
		
		<!-- #NAVIGATION -->
		<!-- Left panel : Navigation area -->
		<!-- Note: This width of the aside area can be adjusted through LESS/SASS variables -->
		<aside id="left-panel">
			<!-- User info -->
			<div class="login-info">
				<span> <!-- User image size is adjusted inside CSS, it should stay as is --> 
					
					<a href="javascript:void(0);" id="show-shortcut" data-action="toggleShortcut">
						<img src="<?php echo ROOTHOST.THIS_TEM_PATH?>img/avatars/male.png" alt="me" class="online" /> 
						<span>
							<?php echo $GLOBALS['FULLNAME'];?> 
						</span>
						<i class="fa fa-angle-down" id="click_changepass"></i>						
					</a> 
					
				</span>
			</div>
			<div class="bl_changepass" style="display:none">
				<ul>
					<li>
						<a href="#" onclick="ShowDialogChangePass()" class="cls_changepass">Đổi mật khẩu?</a>
					</li>
					<li>
						<a href="#" onclick="ShowDialogChangeAvatar()" class="cls_change_avatar">Thay ảnh đại diện</a>
					</li>
					<li>
						<a href="<?php echo ROOTHOST;?>logout" title="Thoát" data-action="userLogout" data-logout-msg="" class="cls_changepass">Thoát</a> </span>
					</li>
				</ul>
				
			</div>
			<!-- end user info -->
			<nav>
				<?php include('components/com_common/menu.php')?>
			</nav>
			<span class="minifyme" data-action="minifyMenu"> <i class="fa fa-arrow-circle-left hit"></i> </span>
		</aside>
		<!-- END NAVIGATION -->
		
		<!-- #MAIN PANEL -->
		<div id="main" role="main">
			<!-- RIBBON -->
			<div id="ribbon">
				<!-- breadcrumb -->
				<?php include('components/com_common/breadcrumb.php')?>
				<!-- end breadcrumb -->
			</div>
			<!-- END RIBBON -->

			<!-- #MAIN CONTENT -->
			<div id="content">
				<?php 
					$this->loadComponent();
				?>
				<?php include('components/com_common/overlay.php')?>
			</div>
			
			<!-- END #MAIN CONTENT -->

		</div>
		<!-- END #MAIN PANEL -->

		<!--=========================Modal Alert========================= -->
		<div aria-hidden="true" aria-labelledby="remoteModalLabel" data-backdrop="static" data-keyboard="false"  role="dialog" tabindex="-1" id="modal_alert" class="modal fade" style="display: none;">
		    <div class="modal-dialog">
		        <div class="modal-content">
		            <div class="modal-header">
		                <button aria-hidden="true" data-dismiss="modal" class="close" type="button">
		                    ×
		                </button>
		                <h4 id="myModalLabel" class="modal-title">
		                  <span id="modal_alert_icon"><i class="fa fa-warning"></i> </span>
		                  <span id="modal_alert_title"></span>
		                </h4>
		            </div>
		            <div class="modal-body">
		              <p id="modal_alert_msg"></p>
		            </div>
		            <div class="modal-footer">
		                  <button type="button" class="btn btn-primary" id="alert_ok_btn"><i class="fa fa-check lhtml" langcode="cfr_yes">Đồng ý </i></button>
		                  <button type="button" class="btn btn-default" id="alert_cancel_btn"><i class="fa fa-times lhtml" langcode="cfr_no">Hủy bỏ</i></button>
		            </div>
		          </div>
		        </div>
		    </div>
		</div>
		<?php  } ?>
		<!-- The end modal -->
	</body>
</html>

