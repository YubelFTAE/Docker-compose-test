<?php
include_once("includes/vt-includes-js.php");
defined('ISHOME') or die("Can't acess this page, please come back!");
$txt_create_on = date('d-m-Y');

// get list department
$lstDepartment = getListDepartment(HOST_API, '*');
$lstDepartment = json_decode($lstDepartment);

$jsonDep = null;
// add new department
if(isset($_POST['cmd_save'])) {
	$cdate = date('Y-m-d H:i:s', strtotime($_POST['txt_created_on']));
	$cdate = str_replace(' ', 'T', $cdate).'.000+0000';
	$jsonPost['created_on'] = $cdate;
	$jsonPost = array(
		'par_id' => $_POST['cbo_par_id'],
		'name' => $_POST['txt_department_name'],
		'code' => $_POST['txt_code'],
		'description' => $_POST['txt_description']
	);
	// echo $_POST['input_department'];
	if (isset($_POST['txt_id'])) {
		$jsonPost['id'] = $_POST['txt_id'];
		// Call api update department
		updateDepartment(HOST_API, $_POST['txt_id'], json_encode($jsonPost,JSON_UNESCAPED_UNICODE));
	} else {
		// Call api add new department
		addNewDepartment(HOST_API, json_encode($jsonPost, JSON_UNESCAPED_UNICODE));
	}
}

if (isset($_GET['dep_id'])) {
	$depId = $_GET['dep_id'];
	$resp = getListDepartment(HOST_API, $depId);
	$resp = json_decode($resp);
	$jsonDep = count($resp)>0 ? $resp[0] : null;
	$txt_create_on = date('d-m-Y', strtotime($jsonDep->created_on));
}

if(isset($_GET['del_id'])) {
	$depId = $_GET['del_id'];
	$resp = deleteDepartment(HOST_API, $depId);
	$root = ROOTHOST.'department_list';
	if ($resp === 'DEPARTMENT_USED') {
		echo "<script type=\"text/javascript\">window.location='$root';alert('Bạn không thể xóa phòng ban này, vì đã có dữ liệu người dùng.')</script>";
	} else {
		echo "<script type=\"text/javascript\">window.location='$root'</script>";
	}
}
?>
<section class="" id="widget-grid">
	<div class="row">
		<article class="col-sm-12 col-md-6 col-lg-5">
			<div class="jarviswidget" data-widget-editbutton="false" data-widget-colorbutton="false" data-widget-deletebutton="false" data-widget-togglebutton="false">
				<header>
					<span class="widget-icon"> <i class="fa fa-table"></i> </span>
					<h2>Thêm Mới Phòng Ban</h2>
				</header>

				<!-- widget div-->
				<div role="content">
					<!-- widget content -->
					<div class="widget-body no-padding">
						
						<form class="smart-form" id="form-department" method="POST" novalidate="novalidate" enctype="multipart/form-data" action="">
							<input type="hidden" name="par_id_selected" id="par_id_selected" value="<?php if($jsonDep != null) echo $jsonDep->par_id?>">
							<input type="hidden" name="txt_created_on" value="<?php echo $txt_create_on?>">
							<fieldset>
								<div class="row">
									<section class="col col-6">
										<label class="label">Tên Phòng&nbsp;<span style="color: red">(*)</span></label>
										<label class="input">
											<i class="icon-append fa fa-bank"></i>
											<input type="text" name="txt_department_name" id="txt_department_name" value="<?php if($jsonDep != null) echo $jsonDep->name;?>">
										</label>
									</section>
									<section class="col col-6">
										<label class="label">Ký hiệu&nbsp;<span style="color: red">(*)</span></label>
										<label class="input">
											<i class="icon-append fa fa-code"></i>
											<input type="text" name="txt_code" id="txt_code" value="<?php if($jsonDep != null) echo $jsonDep->code;?>">
										</label>
									</section>
								</div>
								
								<section>
									<label class="label">Thuộc cấp phòng <span style="color: red">(*)</span></label>
									<label class="select">						
										<input type="text" id="inputBoxDepartment" placeholder="Chọn phòng ban" autocomplete="off"/>
									</label>
								</section>
								<section>
									<label class="label">Mô tả</label>
									<label class="textarea">	
										<i class="icon-append fa fa-edit"></i>
										<textarea name="txt_description" id="txt_description" rows="3"><?php if($jsonDep !== null) echo $jsonDep->description; else echo 'Lorem ipsum dolor sit amet consectetur adipisicing elitLorem ipsum dolor sit amet consectetur adipisicing elit'?></textarea>
									</label>
								</section>

							</fieldset>
							
							<footer>
								<input type="hidden" name="cmd_save"/>
								<?php if(isset($_GET['dep_id'])) :?>
									<input type="hidden" name="txt_id" value="<?php echo $_GET['dep_id'];?>" />
								<?php endif;?>
								<button type="reset" name="reset" id="reset" class="btn btn-success">
									<i class="fa fa-refresh "></i>&nbsp;Reset
								</button>
								<input type="hidden" class="input_department" value="" name="cbo_par_id"/>
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
					<h2>Danh Sách Phòng Ban</h2>
				</header>

				<!-- widget div-->
				<div role="content">
					<!-- widget content -->
					<div class="widget-body no-padding">
						<table id="dt_basic" class="table table-striped table-bordered table-hover" width="100%">
							<thead>			                
								<tr>
									<th width="5%">No.</th>
									<th width="20%">
										Tên phòng
									</th>
									<th width="15%">
										Ký hiệu
									</th>
									<th width="25%">
										Thuộc cấp phòng
									</th>
									<th width="15%">
										Ngày tạo</th>
									<th width="20%">
										Hành động
									</th>
								</tr>
							</thead>
							<tbody>
								<?php
								$stt=1;
								if (is_array($lstDepartment)) {
									foreach ($lstDepartment as $key => $item) {?>
										<tr>
											<td align="center"><?php echo $stt;?></td>
											<td><?php echo $item->name?></td>
											<td><?php echo $item->code?></td>
											<td><?php
												echo $item->par_id == 0 ? 'Root' : getDepNameById(HOST_API, $item->par_id);
											?></td>
											<td align="center"><?php echo date('d-m-Y', strtotime($item->created_on))?></td>
											<td align="center">
					                     		<a title="Sửa" href="<?php echo ROOTHOST?>update_department/<?php echo $item->id?>" class="btn btn-primary approve-schedule">
					                     			<i class="fa fa-edit"></i>
					                     		</a>
					                     		<a title="Xóa" onclick="deleteDepartment('<?php echo $item->id?>')" href="#" class="btn btn-danger">
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
		$.post("<?php echo ROOTHOST;?>ajaxs/getTreeDepartment.php",{},function($rep) {
			var comboTree2 = $('#inputBoxDepartment').comboTree({
				source : jQuery.parseJSON($rep),
				isMultiple: false
			});
		})
		
		$('#txt_department_name').focusout(function() {
			$.post("<?php echo ROOTHOST;?>ajaxs/checkDuplicateValue.php",{value : $(this).val(), field : 'department_name'},function($rep) {
				if($rep === 'true') {
	            	$("#txt_department_name").val('');
	            	smartErrorMsg('Thông báo', 'Tên phòng ban đã tồn tại', 5000);
	            }
	        })
		})
	})

	var cboParId = $("#par_id_selected").val();
	$("#cbo_par_id").select2().select2('val', cboParId);

	function deleteDepartment(depId) {
		smartConfirm('Thông báo', 'Bạn có muốn xóa phòng ban này không?', function() {
			window.location = '<?php echo ROOTHOST;?>del_department/' + depId;
		})
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
		var $updateDocumentForm = $("#form-department").validate({
			
			// Rules for form validation
			rules : {
				txt_department_name : {
					required : true
				},
				cbo_par_id : {
					required : true
				},
				txt_code : {
					required : true
				}
			},

			// Messages for form validation
		
			messages : {
				txt_department_name : {
					required : "Nhập tên phòng ban đơn vị"
				},
				cbo_par_id : {
					required : "Chọn cấp phòng ban"
				},
				txt_code : {
					required : "Nhập ký hiệu phòng ban"
				}
			},
		
			submitHandler : function(form) {
				$(form).ajaxSubmit({
					success : function() {												
						smartInfoMsg('Thông báo', 'Thành công	!', 5000);
						setTimeout(function(){
							window.location = '<?php echo ROOTHOST;?>department_list';
						}, 1500);
					}
				});
			},

			// Do not change code below
			errorPlacement : function(error, element) {
				error.insertAfter(element.parent());
			}
		});

		$('#txt_create_on').datepicker({
			dateFormat : 'dd-mm-yy',
			prevText : '<i class="fa fa-chevron-left"></i>',
			nextText : '<i class="fa fa-chevron-right"></i>',
			onSelect : function(selectedDate) {
				$('#finishdate').datepicker('option', 'minDate', selectedDate);
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
	#s2id_cbo_par_id {
		width: 100%;
	}
	#dt_basic thead th {
		text-align: center;
	}
	header h2 {
		font-weight: bold;
	}
</style>

