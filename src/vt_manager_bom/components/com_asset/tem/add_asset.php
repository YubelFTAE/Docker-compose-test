<?php
include_once("includes/vt-includes-js.php");
defined('ISHOME') or die("Can't acess this page, please come back!");
?>
<section class="" id="widget-grid">
	<div class="row">
		<article class="col-sm-12 col-md-12 col-lg-12">
			<div class="jarviswidget" data-widget-editbutton="false" data-widget-colorbutton="false" data-widget-deletebutton="false" data-widget-togglebutton="false">
				<header>
					<span class="widget-icon"> <i class="fa fa-table"></i> </span>
					<h2>Thêm Mới Linh Kiện</h2>
				</header>
				<!-- widget div-->
				<div role="content">
					<!-- widget content -->
					<div class="widget-body no-padding">
						
						<form class="smart-form" id="form-add-asset" method="POST" novalidate="novalidate" enctype="multipart/form-data" action="">
							<fieldset>
								<div class="row">
									<section class="col col-4">
										<label class="label">Mã linh kiện&nbsp;<span style="color: red">(*)</span></label>
										<label class="input">
											<i class="icon-append fa fa-user"></i>
											<input type="text" name="txt_code" id="txt_code" value="">
										</label>
										<span style="color:red" id="code-exist" ></span>
									</section>	

									<section class="col col-4">
										<label class="label">Tên linh kiện&nbsp;<span style="color: red">(*)</span></label>
										<label class="input">
											<i class="icon-append fa fa-key"></i>
											<input type="text" name="txt_name" id="txt_name" value="">
										</label>
									</section>	

									<section class="col col-4">
										<label class="label">Giá&nbsp;</label>
										<label class="input">
											<i class="icon-append fa fa-dollar"></i>
											<input type="number" name="txt_price" id="txt_price" value="">
										</label>
									</section>	
								</div>

								<div class="row">
									<section class="col col-4">
										<label class="label">Series&nbsp;</label>
										<label class="input">
											<i class="icon-append fa fa-code"></i>
											<input type="text" name="txt_series" id="txt_series" value="">
										</label>										
									</section>	

									<section class="col col-4">
										<label class="label">Trạng thái&nbsp;<span style="color: red">(*)</span></label>
											<label class="select">
												<select name="cbo_status" id="cbo_status">
													<option value="1">Đi mua</option>
													<option value="2">Đi mượn</option>
												</select><i></i>
											</label>
									</section>	

									<section class="col col-4">
										<label class="label">Loại&nbsp;<span style="color: red">(*)</span></label>
										<label class="input">
											<i class="icon-append fa fa-phone"></i>
											<input type="text" name="txt_phone" id="txt_phone" value="">
										</label>
									</section>	
								</div>

								<div class="row">
									<section class="col col-4">
										<label class="label">Function</label>
										<label class="input">
											<i class="icon-append fa fa-envelope-o"></i>
											<input type="text" name="txt_email" id="txt_email" value="">
										</label>
									</section>	

									<section class="col col-4">
										<label class="label">Embedded</label>
										<label class="input">
											<i class="icon-append fa fa-home"></i>
											<input type="text" name="txt_department" id="txt_department" value="">
										</label>
									</section>

									<section class="col col-4">
										<label class="label">Hình ảnh</label>
									</section>	

								</div>

							</fieldset>
							
							<footer>
								<input type="hidden" name="cmd_save"/>
								<button type="reset" name="reset" id="reset" class="btn btn-success">
									<i class="fa fa-refresh "></i>&nbsp;Reset
								</button>
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

	</div>

</section>

<!-- SCRIPTS ON PAGE EVENT -->
<script type="text/javascript">	
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
		var $updateDocumentForm = $("#form-add-asset").validate({
			
			// Rules for form validation
			rules : {
				txt_code : {
					required : true
				},
				txt_pass : {
					required : true
				},
				txt_fullname: {
					required : true				
				},
				cbo_group_user : {
					required : true
				},
				txt_identify : {
					required : true
				},
				txt_phone : {
					required : true
				}
			},

			// Messages for form validation
		
			messages : {
				txt_username : {
					required : "Nhập mã linh kiện"
				},
				txt_pass : {
					required : "Nhập mật khẩu"
				},
				txt_fullname: {
					required : "Nhận họ tên"	
				},
				cbo_group_user : {
					required : "Chọn nhóm người dùng"
				},
				cbo_gro : {
					required : "Chọn quyền thao tác"
				},
				txt_identify : {
					required : "Nhập mã nhân viên"
				},
				txt_phone : {
					required : "Nhập số điện thoại"
				}	
			},
		
			submitHandler : function(form) {
				$(form).ajaxSubmit({
					success : function() {												
						smartInfoMsg('Thông báo', 'Thêm mới thành viên thành công!', 5000);	
						//location.reload(true);
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


<script type="text/javascript">
	$('#txt_username').focusout(function(){
		checkUserExist();
	})
	
	function checkCodeAsset() {
		var code = $('#txt_username').val();
		$.post("<?php echo ROOTHOST;?>ajaxs/checkUserExist.php",{username:username},function($rep){	
			var obj = jQuery.parseJSON($rep);		
			if(obj[0]['rep']=='yes') {	
				// user exist 
				$('#checkUser').html('Tên đăng nhập đã tồn tại!');
				return false;
			} else {
				return true;
			}
		})
	}
</script>

<style type="text/css">
	#dt_basic thead th {
		text-align: center;
	}
	header h2 {
		font-weight: bold;
	}
</style>

