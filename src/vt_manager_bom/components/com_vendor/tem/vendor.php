<?php
defined('ISHOME') or die("Can't acess this page, please come back!");
include_once("includes/vt-includes-js.php");
$lstVendor = null;
$vendorId = null;
$respData = null;
class objVendor {
	public $id = null;
	public $name = null;
	public $phone = null;
	public $contactName = 'Lorem ipsum dolor sit amet consectetur adipisicing';
	public $createdById = null;
	public $createdOn = null;
}
$objVendor = new objVendor();
// ================================
// get list 
$lstVendor = getListVendor(HOST_API, '*');
$lstVendor = json_decode($lstVendor);
if (is_array($lstVendor) && count($lstVendor) > 0) {
	$vendorId = $lstVendor[0]->id;
}

// add new
if(isset($_POST['cmd_save'])) {
	$cdate = date('Y-m-d H:i:s');
	$cdate = str_replace(' ', 'T', $cdate).'.000+0000';
	$jsonPost = array(
		'name' => $_POST['txt_vendor_name'],
		'phone' => $_POST['txt_phone'],
		"contactName" => $_POST['txt_contact_name']
	);		
	if (isset($_POST['txt_id'])) {
		$jsonPost['id'] = $_POST['txt_id'];
		updateVendor(HOST_API, $_POST['txt_id'], json_encode($jsonPost,JSON_UNESCAPED_UNICODE));
	} else {
		$jsonPost['createdOn'] = $cdate;
		$jsonPost['createdById'] = $GLOBALS['USERID'];
		addNewVendor(HOST_API, json_encode($jsonPost, JSON_UNESCAPED_UNICODE));
	}
	$redirect = ROOTHOST.'vendor';
	echo "<script type=\"text/javascript\">window.location='$redirect'</script>";
}

// action update vendor
if (isset($_GET['vendor_id'])) {
	$vendorId = $_GET['vendor_id'];
	$resp = getListVendor(HOST_API, $vendorId);
	$resp = json_decode($resp, true);
	$respData = count($resp) > 0 ? $resp[0] : null;
	$objVendor->id = $respData['id'];
	$objVendor->name = $respData['name'];
	$objVendor->phone = $respData['phone'];
	$objVendor->contactName = $respData['contactName'];
	$objVendor->createdById = $respData['createdById'];
	$objVendor->createdOn = $respData['createdOn'];
}

// action delete manufacture
if(isset($_GET['del_id'])) {
	$depId = $_GET['del_id'];
	deleteVendor(HOST_API, $depId);
	$redirect = ROOTHOST.'vendor';
	echo "<script type=\"text/javascript\">window.location='$redirect'</script>";
}
?>
<section class="" id="widget-grid">
	<div class="row">
		<article class="col-sm-12 col-md-6 col-lg-5">
			<div class="jarviswidget" data-widget-editbutton="false" data-widget-colorbutton="false" data-widget-deletebutton="false" data-widget-togglebutton="false">
				<header>
					<span class="widget-icon"> <i class="fa fa-bank"></i> </span>
					<h2>Thêm Đối Tác</h2>
				</header>

				<!-- widget div-->
				<div role="content">
					<!-- widget content -->
					<div class="widget-body no-padding">
						<form class="smart-form" id="form-vendor" method="POST" novalidate="novalidate" enctype="multipart/form-data" action="">
							<input type="hidden" id="cbo_state_selected" value="<?php echo $objVendor->state?>"/>
							<fieldset>
								<div class="row">
									<section class="col col-6">
										<label class="label">Tên đối tác&nbsp;<span style="color: red">(*)</span></label>
										<label class="input">
											<i class="icon-append fa fa-bank"></i>
											<input type="text" name="txt_vendor_name" id="txt_vendor_name" value="<?php echo $objVendor->name?>">
										</label>
									</section>
									<section class="col col-6">
										<label class="label">Số điện thoại&nbsp;</label>
										<label class="input">
											<i class="icon-append fa fa-phone"></i>
											<input type="number" onkeydown="return event.keyCode !== 69" name="txt_phone" id="txt_phone" value="<?php echo $objVendor->phone;?>">
										</label>
									</section>
                                </div>
                                <section>
                                    <label class="label">&nbsp;Liên hệ</label>
                                    <label class="textarea"> <i class="icon-append fa fa-edit"></i><textarea rows="4" name="txt_contact_name" id="txt_contact_name" placeholder="Mô tả"><?php echo $objVendor->contactName;?></textarea>
                                    </label>
                                </section>
							</fieldset>
							<footer>
								<input type="hidden" name="cmd_save"/>
								<?php if(isset($_GET['vendor_id'])) :?>
									<input type="hidden" name="txt_id" value="<?php echo $_GET['vendor_id'];?>" />
								<?php endif;?>
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
		<article class="col-sm-12 col-md-6 col-lg-7">
			<!-- Widget ID (each widget will need unique ID)-->
			<div class="jarviswidget " data-widget-editbutton="false" data-widget-colorbutton="false" data-widget-deletebutton="false" data-widget-togglebutton="false">
				<header>
					<span class="widget-icon"> <i class="fa fa-table"></i> </span>
					<h2>Danh Sách Đối Tác</h2>
				</header>
				<!-- widget div-->
				<div role="content">
					<!-- widget content -->
					<div class="widget-body no-padding">
						<table id="dt_basic" class="table table-striped table-bordered table-hover" width="100%">
							<thead>			                
								<tr>
									<th width="5%">No.</th>
									<th width="15%">
										Tên đối tác
									</th>
									<th width="15%">
										Số điện thoại
									</th>
									<th width="15%">
										Liên hệ
									</th>
									<th width="15%">
										Ngày tạo
									</th>
									<th width="20%">
										Hành động
									</th>
								</tr>
							</thead>
							<tbody>
								<?php
								$stt=1;
								if (is_array($lstVendor)) {
									foreach ($lstVendor as $key => $item) {?>
										<tr class="<?php if ($item->id == $vendorId) echo 'active';?>">
											<td align="center"><?php echo $stt;?></td>
											<td><?php echo $item->name?></td>
											<td><?php echo $item->phone?></td>
											<td><?php echo $item->contactName?></td>
											<td align="center"><?php echo date('d-m-Y', strtotime($item->createdOn))?></td>
											<td align="center">
					                     		<a title="Sửa" href="<?php echo ROOTHOST?>edit_vendor/<?php echo $item->id?>" class="btn btn-primary">
					                     			<i class="fa fa-edit"></i>
					                     		</a>
					                     		<a title="Xóa" onclick="deleteVendor('<?php echo $item->id?>')" href="#" class="btn btn-danger">
					                     			<i class="fa fa-trash-o "></i>
					                     		</a>
											</td>
										</tr>
									<?php  $stt++;}
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
		$('#txt_vendor_name').focusout(function() {
			$.post("<?php echo ROOTHOST;?>ajaxs/checkDuplicateValue.php",{value : $(this).val(), field : 'vendor_name'}, function($rep) {
				console.log('result: ' + $rep);
				if($rep === 'true') {
	            	$("#txt_vendor_name").val('');
	            	smartErrorMsg('Thông báo', 'Đối tác đã tồn tại', 5000);
	            }
	        })
		})
		// event focusout phone
		$('#txt_phone').focusout(function() {
			if (!validatePhone($(this).val())) {
				$('#txt_phone').val('');
				smartErrorMsg('Lỗi', 'Số điện thoại sai định dạng', 5000);	
			}
		})
	})
	function deleteVendor(vendorId) {
		smartConfirm('Thông báo', 'Bạn có muốn xóa đối tác này không?', function() {
			window.location = '<?php echo ROOTHOST?>del_vendor/' + vendorId;
		})
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
			$('#tbl_manufacturer_part').dataTable({
				"sDom": "<'dt-toolbar'<'col-xs-12 col-sm-6'f><'col-sm-6 col-xs-12 hidden-xs'l>r>"+
					"t"+
					"<'dt-toolbar-footer'<'col-sm-6 col-xs-12 hidden-xs'i><'col-xs-12 col-sm-6'p>>",
				"autoWidth" : true,
				"preDrawCallback" : function() {
					// Initialize the responsive datatables helper once.
					if (!responsiveHelper_dt_basic) {
						responsiveHelper_dt_basic = new ResponsiveDatatablesHelper($('#tbl_manufacturer_part'), breakpointDefinition);
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
			var $updateDocumentForm = $("#form-vendor").validate({
				// Rules for form validation
				rules : {
					txt_vendor_name : {
						required : true
					}
				},
				// Messages for form validation
				messages : {
					txt_vendor_name : {
						required : "Nhập tên đối tác"
					}
				},
				submitHandler : function(form) {
					$(form).ajaxSubmit({
						success : function() {												
							smartInfoMsg('Thông báo', 'Thành công!', 5000);
							setTimeout(function(){
								window.location = '<?php echo ROOTHOST;?>vendor';
							}, 1500);
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
	#dt_basic thead th {
		text-align: center;
	}
	header h2 {
		font-weight: bold;
	}
</style>
