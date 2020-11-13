<?php
defined('ISHOME') or die("Can't acess this page, please come back!");
include_once("includes/vt-includes-js.php");
$lstManufacturerPart = null;
$manuId = null;
$respData = null;
class objManufacturer {
	public $id = null;
	public $name = null;
	public $state = 'Preliminary';
	public $phone = null;
	public $contactName = 'Lorem ipsum dolor sit amet consectetur adipisicing';
	public $createdById = null;
	public $createdOn = null;
}
$objManu = new objManufacturer();
// ================================
// get list 
$lstManufacturer = getListManufacturer(HOST_API, '*');
$lstManufacturer = json_decode($lstManufacturer);
if (is_array($lstManufacturer) && count($lstManufacturer) > 0) {
	$manuId = $lstManufacturer[0]->id;
}

// add new
if(isset($_POST['cmd_save'])) {
	$cdate = date('Y-m-d H:i:s');
	$cdate = str_replace(' ', 'T', $cdate).'.000+0000';
	$jsonPost = array(
		'name' => $_POST['txt_manu_name'],
		'state' => $_POST['cbo_state'],
		'phone' => $_POST['txt_phone'],
		"contact_name" => $_POST['txt_contact_name']
	);		
	if (isset($_POST['txt_id'])) {
		$jsonPost['id'] = $_POST['txt_id'];
		updateManufacturer(HOST_API, $_POST['txt_id'], json_encode($jsonPost,JSON_UNESCAPED_UNICODE));
	} else {
		$jsonPost['created_on'] = $cdate;
		$jsonPost['created_by_id'] = $GLOBALS['USERID'];
		addNewManufacturer(HOST_API, json_encode($jsonPost, JSON_UNESCAPED_UNICODE));
	}
}

// action update manufacturer
if (isset($_GET['manu_id'])) {
	$manuId = $_GET['manu_id'];
	$resp = getListManufacturer(HOST_API, $manuId);
	$resp = json_decode($resp, true);
	$respData = count($resp) > 0 ? $resp[0] : null;
	$objManu->id = $respData['id'];
	$objManu->name = $respData['name'];
	$objManu->state = $respData['state'];
	$objManu->phone = $respData['phone'];
	$objManu->contactName = $respData['contact_name'];
	$objManu->createdById = $respData['created_by_id'];
	$objManu->createdOn = $respData['created_on'];
}

// action delete manufacture
if(isset($_GET['del_id'])) {
	$depId = $_GET['del_id'];
	deleteManufacturer(HOST_API, $depId);
	$redirect = ROOTHOST.'manufacturer';
	echo "<script type=\"text/javascript\">window.location='$redirect'</script>";
}
?>
<section class="" id="widget-grid">
	<div class="row">
		<article class="col-sm-12 col-md-6 col-lg-5">
			<div class="jarviswidget" data-widget-editbutton="false" data-widget-colorbutton="false" data-widget-deletebutton="false" data-widget-togglebutton="false">
				<header>
					<span class="widget-icon"> <i class="fa fa-bank"></i> </span>
					<h2>Thêm Mới Nhà Sản Xuất</h2>
				</header>

				<!-- widget div-->
				<div role="content">
					<!-- widget content -->
					<div class="widget-body no-padding">
						<form class="smart-form" id="form-manufacturer" method="POST" novalidate="novalidate" enctype="multipart/form-data" action="">
							<input type="hidden" id="cbo_state_selected" value="<?php echo $objManu->state?>"/>
							<fieldset>
								<div class="row">
									<section class="col col-6">
										<label class="label">Tên Nhà Sản Xuất&nbsp;<span style="color: red">(*)</span></label>
										<label class="input">
											<i class="icon-append fa fa-bank"></i>
											<input type="text" name="txt_manu_name" id="txt_manu_name" value="<?php echo $objManu->name?>">
										</label>
									</section>
									<section class="col col-6">
										<label class="label">Trạng thái&nbsp;<span style="color: red">(*)</span></label>
										<label class="select">
											<select name="cbo_state" id="cbo_state">
												<option value="Preliminary">Preliminary</option>
												<option value="Released">Released</option>
											</select>
										</label>
									</section>
								</div>
								<div class="row">
									<section class="col col-6">
										<label class="label">Số điện thoại&nbsp;</label>
										<label class="input">
											<i class="icon-append fa fa-phone"></i>
											<input type="number" onkeydown="return event.keyCode !== 69" name="txt_phone" id="txt_phone" value="<?php echo $objManu->phone;?>">
										</label>
									</section>
									<section class="col col-6">
										<label class="label">&nbsp;Liên hệ</label>
										<label class="textarea"> <i class="icon-append fa fa-edit"></i><textarea rows="4" name="txt_contact_name" id="txt_contact_name" placeholder="Mô tả"><?php echo $objManu->contactName;?></textarea>
										</label>
									</section>
								</div>
							</fieldset>
							<footer>
								<input type="hidden" name="cmd_save"/>
								<?php if(isset($_GET['manu_id'])) :?>
									<input type="hidden" name="txt_id" value="<?php echo $_GET['manu_id'];?>" />
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
					<h2>Danh Sách Nhà Sản Xuất</h2>
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
										Tên nhà sản xuất
									</th>
									<th width="15%">
										Số điện thoại
									</th>
									<th width="15%">
										Liên hệ
									</th>
									<th width="15%">
										Trạng thái
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
								if (is_array($lstManufacturer)) {
									foreach ($lstManufacturer as $key => $item) {?>
										<tr class="<?php if ($item->id == $manuId) echo 'active';?>">
											<td align="center"><?php echo $stt;?></td>
											
											<td><?php echo $item->name?></td>
											<td><?php echo $item->phone?></td>
											<td><?php echo $item->contact_name?></td>
											<td><?php echo $item->state?></td>
											<td align="center"><?php echo date('d-m-Y', strtotime($item->created_on))?></td>
											<td align="center">
					                     		<a title="Sửa" href="<?php echo ROOTHOST?>edit_manufacturer/<?php echo $item->id?>" class="btn btn-primary approve-schedule">
					                     			<i class="fa fa-edit"></i>
					                     		</a>
					                     		<a title="Xóa" onclick="deleteManufacturer('<?php echo $item->id?>')" href="#" class="btn btn-danger">
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

	<!-- Import manufacturer part -->
	<?php include('manufacturer_part.php')?>
	<!-- The end -->
</section>

<!-- SCRIPTS ON PAGE EVENT -->
<script type="text/javascript">
	$(document).ready(function() {
		var state = $("#cbo_state_selected").val();
		$("#cbo_state").select2().select2('val', state);
		$('#txt_manu_name').focusout(function() {
			$.post("<?php echo ROOTHOST;?>ajaxs/checkDuplicateValue.php",{value : $(this).val(), field : 'txt_manu_name'}, function($rep) {
				if($rep === 'true') {
	            	$("#txt_manu_name").val('');
	            	smartErrorMsg('Thông báo', 'Tên nhà sản xuất đã tồn tại', 5000);
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
	
	function deleteManufacturer(manuId) {
		smartConfirm('Thông báo', 'Bạn có muốn xóa nhà sản xuất này không?', function() {
			window.location = '<?php echo ROOTHOST?>del_manufacturer/' + manuId;
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
		var $updateDocumentForm = $("#form-manufacturer").validate({
			// Rules for form validation
			rules : {
				txt_manu_name : {
					required : true
				},
				cbo_state : {
					required : true
				}
			},
			// Messages for form validation
			messages : {
				txt_manu_name : {
					required : "Nhập tên nhà sản xuất"
				},
				cbo_state : {
					required : "Chọn trạng thái"
				}
			},
			submitHandler : function(form) {
				$(form).ajaxSubmit({
					success : function() {												
						smartInfoMsg('Thông báo', 'Thành công!', 5000);
						setTimeout(function(){
							window.location = '<?php echo ROOTHOST;?>manufacturer';
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
	#s2id_cbo_state {
		width: 100%;
	}
	#dt_basic thead th {
		text-align: center;
	}
	header h2 {
		font-weight: bold;
	}
</style>
