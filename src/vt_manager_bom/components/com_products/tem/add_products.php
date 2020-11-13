<?php
defined('ISHOME') or die("Can't acess this page, please come back!");
$objProduct = null;
$state = 'Preliminary';
// event post data
if(isset($_POST['cmd_save'])) {
	$proName = $_POST['txt_product_name'];
	$proCode = $_POST['txt_product_number'];
	$proDes = $_POST['txt_description'];
	$state = $_POST['cbo_state'];
	$projectId = $_POST['cbo_project'];
	$proLockOrUnLock = $_POST['txt_lock'];
	$cdate = date('Y-m-d H:i:s');
	$cdate = str_replace(' ', 'T', $cdate).'.000+0000';

	$jsonPost = array(
		"name" => $proName,
		"item_number" => $proCode,
		"description" => $proDes,
		"state" => $state,
		"lock" => $proLockOrUnLock,
		"projectId" => $projectId
	);

	if (isset($_POST['txt_pro_id'])) {
		// call api update info product
		$jsonPost['modified_by_id'] = $GLOBALS['USERID'];
		$jsonPost['modified_on'] = $cdate;
		$jsonPost['pro_id'] = $_POST['txt_pro_id'];
		updateProduct(HOST_API, $_POST['txt_pro_id'], json_encode($jsonPost, JSON_UNESCAPED_UNICODE));
	} else {
		// call api add new product info common
		$jsonPost['created_by_id'] = $GLOBALS['USERID'];
		$jsonPost['created_on'] = $cdate;
		$jsonPost['modified_by_id'] = $GLOBALS['USERID'];
		$jsonPost['modified_on'] = $cdate;
		addNewProduct(HOST_API, json_encode($jsonPost, JSON_UNESCAPED_UNICODE));
	}
}
if (isset($_GET['pro_id'])) {
	$proId = $_GET['pro_id'];
	$resp = getListProduct(HOST_API, $proId);
	$resp = json_decode($resp, true);
	$objProduct = $resp[0];
	$state = $objProduct['state'];
}
?>
<section class="" id="widget-grid">
	<div class="row">
		<article class="col-sm-12 col-md-12 col-lg-12">
			<div class="jarviswidget" data-widget-editbutton="false" data-widget-colorbutton="false" data-widget-deletebutton="false" data-widget-togglebutton="false">
				<header>
					<span class="widget-icon"> <i class="fa fa-table"></i> </span>
					<?php if ($objProduct == null) : ?>
						<h2>Thêm Mới Sản Phẩm</h2>
					<?php else:?>
						<h2>Chỉnh Sửa Thông Tin Sản Phẩm</h2>
					<?php endif;?>
				</header>
				<!-- widget div-->
				<div role="content">
					<!-- widget content -->
					<div class="widget-body no-padding">
						
						<form class="smart-form" id="form_add_product" method="POST" novalidate="novalidate" enctype="multipart/form-data" action="">
							<input type="hidden" name="state_selected" id="state_selected" value="<?php echo $state?>">
							<fieldset>
								<div class="description description-tabs">
									<ul id="myTab2" class="nav nav-tabs">
										<li class="active">
											<a href="#information_common_product" data-toggle="tab" class="no-margin" aria-expanded="true" style="color: #333 !important;">Thông tin chung </a>
										</li>
									</ul>
									<div id="myTabContent" class="tab-content">
										<div class="tab-pane active fade in" id="information_common_product">
											<div class="row">
												<section class="col col-3">
													<label class="label">Mã sản phẩm&nbsp;<span style="color: red">(*)</span></label>
													<label class="input">
														<i class="icon-append fa fa-credit-card"></i>
														<input type="text" name="txt_product_number" id="txt_product_number" value="<?php echo $objProduct != null ? $objProduct['item_number'] : ''?>">
													</label>
												</section>
												<section class="col col-3">
													<label class="label">Tên sản phẩm&nbsp;<span style="color: red">(*)</span></label>
													<label class="input">
														<i class="icon-append fa fa-gears"></i>
														<input type="text" name="txt_product_name" id="txt_product_name" value="<?php echo $objProduct != null ? $objProduct['name'] : ''?>">
													</label>
												</section>
												<section class="col col-3">
													<label class="label">Trạng thái&nbsp;<span style="color: red">(*)</span></label>
													<label class="select">
														<select name="cbo_state" id="cbo_state">
															<option value="Preliminary">Preliminary</option>
															<option value="Released">Released</option>
														</select>
													</label>		
												</section>
												<section class="col col-3">
													<label class="label">Chọn dự án&nbsp;<span style="color: red">(*)</span></label>
													<label class="select">
														<select name="cbo_project" id="cbo_project">
															<option value="0">VMTS</option>
															<option value="1">eNodeB</option>
														</select>
													</label>		
												</section>
											</div>
											<section>
												<label class="label"> <i class="icon-append fa fa-lock"></i>
						                            <b class="tooltip tooltip-bottom-right">&nbsp;Mô tả</b>
						                        </label>
						                        <label class="textarea"> <i class="icon-append fa fa-edit"></i><textarea rows="4" name="txt_description" id="txt_description" placeholder="Mô tả"><?php echo $objProduct != null ? $objProduct['description'] : 'Lorem ipsum dolor sit amet consectetur adipisicing elit'?></textarea>
						                        </label>
											</section>
										</div>
									</div>
								</div>
								
							</fieldset>
							
							<footer>
								<input type="hidden" name="cmd_save"/>
								<input type="hidden" name="txt_lock" id="txt_lock" value="0">
								<?php if(isset($_GET['pro_id'])) :?>
									<input type="hidden" name="txt_pro_id" value="<?php echo $_GET['pro_id'];?>" />
								<?php endif;?>								
								<button type="reset" name="reset" id="btn_reset" class="btn btn-success">
									<i class="fa fa-refresh "></i>&nbsp;Reset
								</button>
								<!-- <button type="submit" onclick="submitFormAndLock()" name="i_submit" id="btn_save_lock" class="btn btn-primary" disabled="true">
									<i class="fa fa-check "></i>&nbsp;Lưu & Look
								</button>
								<button type="button" name="i_submit" id="btn_unlock" class="btn">
									<i class="fa fa-unlock "></i>&nbsp;UnLock
								</button>
								<button type="button" name="i_submit" id="btn_lock" class="btn btn-success">
									<i class="fa fa-lock"></i>&nbsp;Lock
								</button> -->
								<button type="submit" name="i_submit" id="btn_save" class="btn btn-primary">
									<i class="fa fa-save "></i>&nbsp;Lưu
								</button>
								<?php if(isset($_GET['pro_id'])) :?>
									<a href="<?php echo ROOTHOST?>mgmt_products"><button type="button" class="btn btn-success">
										<i class="fa fa-arrow-left "></i>&nbsp;Quay Lại
									</button></a>
								<?php endif;?>		
							
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
	$(document).ready(function() {
		$('#txt_product_number').focusout(function() {
			$.post("<?php echo ROOTHOST;?>	ajaxs/checkProductNumber.php",{pro_number : $(this).val()},function($rep) {
	            if($rep=='true') {
	            	$("#txt_product_number").val('');
	            	smartErrorMsg('Thông báo', 'Mã sản phẩm đã tồn tại', 5000);
	            }
	        })
		})

		var state = $("#state_selected").val();
		$("#cbo_state").select2().select2('val', state);

	})
	pageSetUp();
	
	// PAGE RELATED SCRIPTS
	// pagefunction
	$("#btn_unlock").click(function(){
		// $(this).addClass('btn-success');
		// $("#btn_lock").removeClass('btn-success');
		// $("#btn_save").removeAttr('disabled');
		// $("#btn_save_lock").removeAttr('disabled');
	})
	$("#btn_lock").click(function(){
		// $(this).addClass('btn-success');
		// $("#btn_unlock").removeClass('btn-success');
		// $("#btn_save").prop('disabled', true);
		// $("#btn_save_lock").prop('disabled', true);
	})

	function submitFormAndLock() {
		$("#txt_lock").val(1);
	}
	
	var pagefunction = function() {
		var $updateDocumentForm = $("#form_add_product").validate({
			
			// Rules for form validation
			rules : {
				txt_product_number : {
					required : true
				},
				txt_product_name : {
					required : true
				},
				cbo_project : {
					required : true
				},
			},

			// Messages for form validation
		
			messages : {
				txt_product_number : {
					required : "Nhập mã sản phẩm"
				},
				txt_product_name : {
					required : "Nhập tên sản phẩm"
				},
				cbo_project : {
					required : "Chọn dự án"
				},
			},
		
			submitHandler : function(form) {
				$(form).ajaxSubmit({
					success : function() {												
						smartInfoMsg('Thông báo', 'Thành công!', 3000);	
						setTimeout(function() {
							window.location = '<?php echo ROOTHOST;?>mgmt_products';
						}, 1000)
					}
				});
			},

			// Do not change code below
			errorPlacement : function(error, element) {
				error.insertAfter(element.parent());
			}
		});

	};
	
	// end pagefunction

	loadScript("<?php echo ROOTHOST.THIS_TEM_PATH; ?>js/plugin/datatables/jquery.dataTables.min.js", function(){
		loadScript("<?php echo ROOTHOST.THIS_TEM_PATH; ?>js/plugin/datatables/dataTables.colVis.min.js", function(){
			loadScript("<?php echo ROOTHOST.THIS_TEM_PATH; ?>js/plugin/datatables/dataTables.tableTools.min.js", function(){
				loadScript("<?php echo ROOTHOST.THIS_TEM_PATH; ?>js/plugin/datatables/dataTables.bootstrap.min.js", function(){
					loadScript("<?php echo ROOTHOST.THIS_TEM_PATH; ?>js/plugin/datatable-responsive/datatables.responsive.min.js", function(){
						loadScript("<?php echo ROOTHOST.THIS_TEM_PATH; ?>js/plugin/jquery-form/jquery-form.min.js", function() {
							loadScript("<?php echo ROOTHOST.THIS_TEM_PATH; ?>js/plugin/bootstraptree/bootstrap-tree.min.js", function() {
								loadScript("<?php echo ROOTHOST.THIS_TEM_PATH; ?>js/plugin/bootstraptree/bootstrap-tree.min.js", pagefunction)
							})
						})
					})
				});
			});
		});
	});
</script>

<style type="text/css">
	#s2id_cbo_state {
		width: 100%;
	}
	#myTabContent {
		padding: 15px;
	}
	.dataTables_filter label {
		height: 40px;
	}
	.dataTables_filter .input-group-addon {
		height: 16px;
		width: 16px;
	}
	#txt_models {
		position: absolute;
	    top: 79px;
	    z-index: 1;
	    height: 30px;
	    left: 260px;
	    border: 1px solid #ccc;
	}
</style>

