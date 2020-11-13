<?php
defined('ISHOME') or die("Can't acess this page, please come back!");
include_once("includes/vt-includes-js.php");
$lstAccount = null;
$objAccSelected = null;
// get list account
$lstAccount = getListAccount(HOST_API, '*');
$lstAccount = json_decode($lstAccount);

// get list group acc
$lstGroupAcc = getListGroupAcc(HOST_API, '*');
$lstGroupAcc = json_decode($lstGroupAcc);

// add new account
if(isset($_POST['cmd_save'])) {
	$cdate = date('Y-m-d H:i:s');
	$cdate = str_replace(' ', 'T', $cdate).'.000+0000';
	$jsonPost = array(
		'name' => $_POST['txt_fullname'],
		'group_id' => $_POST['cbo_group'],
		'department_id' => $_POST['cbo_department'],
		'identify_number' => $_POST['txt_identify'],
		'phone' => $_POST['txt_phone'],
		'email' => $_POST['txt_email'],
		'gender' => $_POST['opt_gender'],
		'created_on' => $cdate,
		'grand_permission' => 'grand permistion',
		'role' => ["user", "admin"],
		'state' => 'enable'
	);

	if (isset($_POST['txt_id'])) {
		updateInfoAccount(HOST_API, $_POST['txt_id'] ,json_encode($jsonPost, JSON_UNESCAPED_UNICODE));
	} else {
		$jsonPost['username'] = $_POST['txt_username'];
		$jsonPost['password'] = md5(sha1($_POST['txt_password']));
		addNewAccount(HOST_API, json_encode($jsonPost, JSON_UNESCAPED_UNICODE));
	}
}

if (isset($_GET['acc_id'])) {
	$accId = $_GET['acc_id'];
	// get info account
	$rsp = getListAccount(HOST_API, $accId);
	$rsp = json_decode($rsp);
	$objAccSelected = $rsp[0];
}

if(isset($_GET['del'])) {
	$accId = $_GET['del'];
	// Call api delete data
	deleteAccount(HOST_API, $accId);
	echo "<script>window.location='".ROOTHOST."account_list';</script>";
}

?>
<section class="" id="widget-grid">
	<div class="row">
		<article class="col-sm-12 col-md-6 col-lg-5">
			<div class="jarviswidget" data-widget-editbutton="false" data-widget-colorbutton="false" data-widget-deletebutton="false" data-widget-togglebutton="false">
				<header>
					<span class="widget-icon"> <i class="fa fa-table"></i> </span>
					<h2>Thêm Mới Tài Khoản</h2>
				</header>

				<!-- widget div-->
				<div role="content">
					<!-- widget content -->
					<div class="widget-body no-padding">
						
						<form class="smart-form" id="form-register" method="POST" novalidate="novalidate" enctype="multipart/form-data" action="">
							<input type="hidden" name="cbo_selected_group" id="cbo_selected_group" value="<?php if ($objAccSelected != null) echo $objAccSelected->group_id;?>">
							<input type="hidden" name="cbo_selected_department" id="cbo_selected_department" value="<?php if ($objAccSelected != null) echo $objAccSelected->department_id;?>">
							<fieldset>
								<div class="row">
									<section class="col col-6">
										<label class="label">Tên đăng nhập&nbsp;<span style="color: red">(*)</span></label>
										<label class="input">
											<i class="icon-append fa fa-user"></i>
											<input type="text" name="txt_username" autocomplete="off" id="txt_username" <?php if (isset($_GET['acc_id']))  echo "disabled=\"true\"";?>
											value="<?php if ($objAccSelected != null) echo $objAccSelected->username;?>">
										</label>
										<span style="color:red" id="checkUser" ></span>
									</section>	

									<section class="col col-6">
										<label class="label">Mật khẩu&nbsp;<span style="color: red">(*)</span></label>
										<label class="input">
											<i class="icon-append fa fa-key"></i>
											<input type="password" name="txt_password" autocomplete="off" id="txt_password" <?php if (isset($_GET['acc_id']))  echo "disabled=\"true\"";?>
											value="<?php if ($objAccSelected != null) echo $objAccSelected->password;?>">
										</label>
									</section>	
								</div>
								<div class="row">
									<section class="col col-6">
										<label class="label">Nhóm người dùng&nbsp;<span style="color: red">(*)</span></label>
										<label class="select">
											<select name="cbo_group" id="cbo_group">
												<option value="">---Chọn nhóm---</option>
												<?php
													foreach ($lstGroupAcc as $k => $val) {
														$optText = $val->name;
														$id = $val->id;
														echo "<option value='".$id."'>".$optText."</option>";
													}
												?>
											</select>
										</label>
									</section>
									<section class="col col-6">
										<label class="label">Họ tên&nbsp;<span style="color: red">(*)</span></label>
										<label class="input">
											<i class="icon-append fa fa-user"></i>
											<input type="text" name="txt_fullname"  autocomplete="off" id="txt_fullname" value="<?php if ($objAccSelected != null) echo $objAccSelected->name;?>">
										</label>										
									</section>
								</div>

								<div class="row">
									<section class="col col-6">
										<label class="label">Mã nhân viên&nbsp;<span style="color: red">(*)</span></label>
										<label class="input">
											<i class="icon-append fa fa-credit-card"></i>
											<input type="number" name="txt_identify" autocomplete="off" onkeydown="return event.keyCode !== 69" id="txt_identify" minlength="6" maxlength="6" value="<?php if ($objAccSelected != null && $objAccSelected->identify_number != 0) echo $objAccSelected->identify_number;?>">
										</label>
									</section>	

									<section class="col col-6">
										<label class="label">Điện thoại&nbsp;<span style="color: red">(*)</span></label>
										<label class="input">
											<i class="icon-append fa fa-phone"></i>
											<input type="number" name="txt_phone" id="txt_phone" autocomplete="off" value="<?php if ($objAccSelected != null) echo $objAccSelected->phone;?>">
										</label>
									</section>		
								</div>

								<div class="row">
									<section class="col col-6">
										<label class="label">Email&nbsp;<span style="color: red">(*)</span></label>
										<label class="input">
											<i class="icon-append fa fa-envelope-o"></i>
											<input type="text" name="txt_email" id="txt_email" autocomplete="off" value="<?php if ($objAccSelected != null) echo $objAccSelected->email;?>">
										</label>
									</section>	
									<section class="col col-4">
										<label class="label">Giới tính</label>
										<div class="inline-group">
											<label class="radio">
												<input type="radio" name="opt_gender" value="Nam" <?php if($objAccSelected != null && $objAccSelected->gender == 'Nam') echo "checked=\"true\""?> checked="true">
												<i></i>Nam</label>
											<label class="radio">
												<input type="radio" name="opt_gender" value="Nữ" <?php if($objAccSelected != null && $objAccSelected->gender == 'Nữ') echo "checked=\"true\""?>>
												<i></i>Nữ</label>
										</div>
									</section>	
								</div>
								<section>
									<label class="label">Thuộc phòng ban&nbsp;<span style="color: red">(*)</span></label>
									<label class="select">						
										<input type="text" id="inputBoxDepartment" placeholder="Chọn phòng ban" autocomplete="off"/>
									</label>
								</section>	
							</fieldset>
							<footer>
								<input type="hidden" name="cmd_save"/>
								<input type="hidden" class="input_department" value="" name="cbo_department"/>
								<?php if(isset($_GET['acc_id'])) :?>
									<input type="hidden" name="txt_id" id="txt_id" value="<?php echo $_GET['acc_id'];?>" />
									<a href="<?php echo ROOTHOST?>account_list">
										<button type="button" name="back" id="back" class="btn btn-success">
											<i class="fa fa-arrow-left "></i>&nbsp;Quay lại
										</button>
									</a>
								<?php else:?>
									<button type="reset" name="reset" id="reset" class="btn btn-success">
										<i class="fa fa-refresh "></i>&nbsp;Reset
									</button>
								<?php endif;?>
								<button type="submit" name="i_submit" id="i_submit" class="btn btn-primary">
									<i class="fa fa-save "></i>&nbsp;Lưu
								</button>
							</footer>
						</form>						
					</div>
					<!-- end widget content -->
					
				</div>
				<!-- end widget div -->
				
			</div>
			<!-- end widget -->								


		</article>

		<article class="col-sm-12 col-md-6 col-lg-7">
			<!-- Widget ID (each widget will need unique ID)-->
			<div class="jarviswidget " data-widget-editbutton="false" data-widget-colorbutton="false" data-widget-deletebutton="false" data-widget-togglebutton="false">

				<header>
					<span class="widget-icon"> <i class="fa fa-table"></i> </span>
					<h2>Danh Sách Tài Khoản</h2>
				</header>

				<!-- widget div-->
				<div role="content">
					<!-- widget content -->
					<div class="widget-body no-padding">
						<table id="dt_basic" class="table table-striped table-bordered table-hover" width="100%">
							<thead>			                
								<tr>
									<th width="3%">No.</th>
									<th width="20%">
										Tên đăng nhập
									</th>
									<th width="20%">
										Họ tên
									</th>
									<th width="20%">
										Phòng ban
									</th>
									<th width="17%">
										Điện thoại
									</th>
									<th width="20%">
										Hành động
									</th>
								</tr>
							</thead>
							<tbody>
								<?php
									$stt = 1;
									if (is_array($lstAccount)) {
										foreach ($lstAccount as $key => $item) { ?>
											<tr>
												<td align="center"><?php echo $stt;?></td>
												<td align="left">
													<?php echo $item->username?>
												</td>
												<td>
													<?php echo $item->name?>
												</td>
												<td>
													<?php echo getDepNameById(HOST_API, $item->department_id)?>
												</td>
												<td align="center">
													<?php echo isset($item->phone) ? $item->phone : ''?>
												</td>
												<td align="center">
													<a title="Sửa" href="<?php echo ROOTHOST?>update_account/<?php echo $item->id?>" href="#" class="btn btn-primary approve-schedule">
														<i class="fa fa-edit"></i>
													</a>
													<a title="Xóa" onclick="deleteAccount('<?php echo $item->id?>')" href="#" class="btn btn-danger">
														<i class="fa fa-trash-o "></i>
													</a>
												</td>
											</tr>
										<?php $stt++; }
									}
								?>
							</tbody>
						</table>
					</div>
					<!-- end widget content -->
					
				</div>
				<!-- end widget div -->
				
			</div>
			<!-- end widget -->								


		</article>

	</div>

</section>

<!-- SCRIPTS ON PAGE EVENT -->
<script type="text/javascript">
	$(document).ready(function() {
		$.post("<?php echo ROOTHOST;?>ajaxs/getTreeDepartment.php",{},function($rep) {
			var comboTree2 = $('#inputBoxDepartment').comboTree({
				source : jQuery.parseJSON($rep),
				isMultiple: false
			});
		})
		// group acc select2
		var groupId = $("#cbo_selected_group").val();
		$("#cbo_group").select2().select2('val', groupId);

		// event focusout username
		$('#txt_username').focusout(function() {
			if (!$('#elemId').length) {
				checkUserExist();
			}
		})
		// event focusout email
		$('#txt_email').focusout(function() {
			if (!validateEmail($(this).val())) {
				$('#txt_email').val('');
				smartErrorMsg('Lỗi', 'Email sai định dạng', 5000);	
			}
		})
		// event focusout phone
		$('#txt_phone').focusout(function() {
			if (!validatePhone($(this).val())) {
				$('#txt_phone').val('');
				smartErrorMsg('Lỗi', 'Số điện thoại sai định dạng', 5000);	
			}
		})
	})
	function checkUserExist() {
		var username = $('#txt_username').val();
		$.post("<?php echo ROOTHOST;?>ajaxs/checkExistAccount.php",{username: username},function($rep) {
			if($rep == 'true') {
				$("#txt_username").val('');
				smartErrorMsg("Thông báo", "Tài khoản đã tồn tại", 5000);
				return false;
			}
		})
	}

	function deleteAccount(id) {
		smartConfirm('Thông báo', 'Bạn có muốn xóa tài khoản này không?', function() {
			window.location="<?php echo ROOTHOST?>del_account/" + id;
		})
	}

	function validateEmail(email) {
	    var re = /^(([^<>()\[\]\\.,;:\s@"]+(\.[^<>()\[\]\\.,;:\s@"]+)*)|(".+"))@((\[[0-9]{1,3}\.[0-9]{1,3}\.[0-9]{1,3}\.[0-9]{1,3}\])|(([a-zA-Z\-0-9]+\.)+[a-zA-Z]{2,}))$/;
	    return re.test(String(email).toLowerCase());
	}

	function validatePhone(a) {
		var filter = /^((\+[1-9]{1,4}[ \-]*)|(\([0-9]{2,3}\)[ \-]*)|([0-9]{2,4})[ \-]*)*?[0-9]{3,4}?[ \-]*[0-9]{3,4}?$/;
		if (filter.test(a)) {
			return true;
		}
		else {
			return false;
		}
	}
	
	
	pageSetUp();
	
	// PAGE RELATED SCRIPTS

	// pagefunction
	
	var pagefunction = function() {
		var responsiveHelper_dt_basic = undefined;
			var responsiveHelper_datatable_fixed_column = undefined;
			var responsiveHelper_datatable_col_reorder = undefined;
			var responsiveHelper_datatable_tabletools = undefined;
			
			var breakpointDefinition = {
				tablet : 1024,
				phone : 480
			};

			$('#dt_basic').dataTable({
				"sDom": "<'dt-toolbar'<'col-xs-12 col-sm-6'f><'col-sm-6 col-xs-12 hidden-xs'l>r>"+
					"t"+
					"<'dt-toolbar-footer'<'col-sm-6 col-xs-12 hidden-xs'i><'col-xs-12 col-sm-6'p>>",
				"autoWidth" : true,
				"preDrawCallback" : function() {
					// Initialize the responsive datatables helper once.
					if (!responsiveHelper_dt_basic) {
						responsiveHelper_dt_basic = new ResponsiveDatatablesHelper($('#dt_basic'), breakpointDefinition);
					}
				},
				"rowCallback" : function(nRow) {
					responsiveHelper_dt_basic.createExpandIcon(nRow);
				},
				"drawCallback" : function(oSettings) {
					responsiveHelper_dt_basic.respond();
				}
			});

		/* END BASIC */
		var $updateDocumentForm = $("#form-register").validate({
			
			// Rules for form validation
			rules : {
				txt_username : {
					required : true
				},
				txt_password : {
					required : true
				},
				txt_fullname: {
					required : true				
				},
				cbo_group : {
					required : true
				},
				txt_identify : {
					required : true
				},
				txt_phone : {
					required : true
				},
				txt_email : {
					required : true
				}
			},

			// Messages for form validation
		
			messages : {
				txt_username : {
					required : "Nhập tên đăng nhập"
				},
				txt_password : {
					required : "Nhập mật khẩu"
				},
				txt_fullname: {
					required : "Nhận họ tên"	
				},
				cbo_group : {
					required : "Chọn nhóm người dùng"
				},
				txt_identify : {
					required : "Nhập mã nhân viên"
				},
				txt_phone : {
					required : "Nhập số điện thoại"
				},
				txt_email : {
					required : "Nhập email"
				}	
			},
		
			submitHandler : function(form) {
				$(form).ajaxSubmit({
					success : function() {																	
						if( $('#txt_id').length ) {
							smartInfoMsg('Thông báo', 'Cập nhật tài khoản mới thành công!', 5000);
						} else {
							smartInfoMsg('Thông báo', 'Thêm mới tài khoản thành công!', 5000);
						}
						setTimeout(() => {
							window.location = '<?php echo ROOTHOST?>account_list';							
						}, 2000);
					}
				});
			},

			// Do not change code below
			errorPlacement : function(error, element) {
				error.insertAfter(element.parent());
			}
		});
		
	};
	
	function resetForm(){

	}
	// end pagefunction

	loadScript("<?php echo ROOTHOST.THIS_TEM_PATH; ?>js/plugin/datatables/jquery.dataTables.min.js", function(){
		loadScript("<?php echo ROOTHOST.THIS_TEM_PATH; ?>js/plugin/datatables/dataTables.colVis.min.js", function(){
			loadScript("<?php echo ROOTHOST.THIS_TEM_PATH; ?>js/plugin/datatables/dataTables.tableTools.min.js", function(){
				loadScript("<?php echo ROOTHOST.THIS_TEM_PATH; ?>js/plugin/datatables/dataTables.bootstrap.min.js", function(){
					loadScript("<?php echo ROOTHOST.THIS_TEM_PATH; ?>js/plugin/datatable-responsive/datatables.responsive.min.js", function(){
						loadScript("<?php echo ROOTHOST.THIS_TEM_PATH; ?>js/plugin/jquery-form/jquery-form.min.js", function() {
							loadScript("<?php echo ROOTHOST.THIS_TEM_PATH; ?>js/plugin/bootstraptree/bootstrap-tree.min.js", pagefunction)
						})
					})
				});
			});
		});
	});
</script>
<style type="text/css">
	#s2id_cbo_group {
		width: 100%;
	}
	#dt_basic thead th {
		text-align: center;
	}
	header h2 {
		font-weight: bold;
	}
</style>

