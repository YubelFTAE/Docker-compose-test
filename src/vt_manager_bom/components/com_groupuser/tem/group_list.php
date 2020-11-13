<?php
defined('ISHOME') or die("Can't acess this page, please come back!");
include_once("includes/vt-includes-js.php");
$txt_create_on = date('d/m/Y');
$jsonData = null;
// get list group user
$lstGroupAcc = getListGroupAcc(HOST_API, "*");
$lstGroupAcc = json_decode($lstGroupAcc);

if(isset($_POST['cmd_save'])) {
	$cdate = date('Y-m-d H:i:s');
	$cdate = str_replace(' ', 'T', $cdate).'.000+0000';
	$jsonPost = array(
		'name' => $_POST['txt_name'],
		'permistion' => 'permistion',
		'created_on' => $cdate
	);
	
	if (isset($_POST['txt_id'])) {
		$jsonPost['id'] = $_POST['txt_id'];
		// echo json_encode($jsonPost, JSON_UNESCAPED_UNICODE);
		// Call api update
		updateInfoGroupAcc(HOST_API, $_POST['txt_id'], json_encode($jsonPost, JSON_UNESCAPED_UNICODE));
	} else {
		// Call api add new group user
		addNewGroupAcc(HOST_API, json_encode($jsonPost, JSON_UNESCAPED_UNICODE));
	}
}

if (isset($_GET['id'])) {
	$depId = $_GET['id'];
	// get info department
	$resp = getListGroupAcc(HOST_API, $depId);
	$resp = json_decode($resp);
	$jsonData = count($resp)>0 ? $resp[0] : null;
	$txt_create_on = date('d/m/Y', strtotime($jsonData->created_on));
}

if(isset($_GET['del'])) {
	$groupId = $_GET['del'];
	$resp = deleteGroupAcc(HOST_API, $groupId);
	if ($resp === 'GROUPUSER_USED') {
		echo "<script type=\"text/javascript\">window.location='".ROOTHOST."group_list';alert('Bạn không thể xóa nhóm người dùng này vì đã có dữ liệu người dùng.')</script>";
	} else {
		echo "<script type=\"text/javascript\">window.location='".ROOTHOST."group_list';</script>";
	}
}

?>
<section class="" id="widget-grid">
	<div class="row">
		<article class="col-sm-12 col-md-6 col-lg-5">
			<div class="jarviswidget" data-widget-editbutton="false" data-widget-colorbutton="false" data-widget-deletebutton="false" data-widget-togglebutton="false">
				<header>
					<span class="widget-icon"> <i class="fa fa-table"></i> </span>
					<h2>Thêm Mới Nhóm</h2>
				</header>

				<!-- widget div-->
				<div role="content">
					<!-- widget content -->
					<div class="widget-body no-padding">
						
						<form class="smart-form" id="form_create_group_user" method="POST" novalidate="novalidate" enctype="multipart/form-data" action="">
							<fieldset>
								<section>
									<label class="label">Tên nhóm&nbsp;<span style="color: red">(*)</span></label>
									<label class="input">
										<i class="icon-append fa fa-user"></i>
										<input type="text" name="txt_name" id="txt_name" value="<?php echo $jsonData != null ? $jsonData->name : ''?>">
									</label>
								</section>
								<!-- <section>
									<label class="label">Phân quyền chức năng</label>
									<div class="tree smart-form" id="list_tree_member">
										<ul role="tree">
										    <li class="parent_li" role="treeitem">
										        <span title="Collapse this branch"><i class="fa fa-lg fa-gears"></i> Chức năng</span>
										        <ul role="group">
								                    <li style="">
								                        <span> <label class="checkbox inline-block">
								                          <input type="checkbox" name="chk_permistion[]" value="0">
								                          <i></i>Quản lý phân quyền người dùng</label> </span>
								                    </li>
								                    <li style="">
								                        <span> <label class="checkbox inline-block">
								                          <input type="checkbox" name="chk_permistion[]" value="1">
								                          <i></i>Quản lý sản phẩm</label> </span>
								                    </li>
								                    <li style="">
								                        <span> <label class="checkbox inline-block">
								                          <input type="checkbox" name="chk_permistion[]" value="2">
								                          <i></i>Quản lý models</label> </span>
								                    </li>
								                </ul>
										    </li>
										</ul>
									</div>
								</section> -->

							</fieldset>
							
							<footer>
								<input type="hidden" name="cmd_save"/>
								<?php if(isset($_GET['id'])) :?>
									<input type="hidden" name="txt_id" value="<?php echo $_GET['id'];?>" />
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
					<h2>Danh Sách Nhóm</h2>
				</header>

				<!-- widget div-->
				<div role="content">
					<!-- widget content -->
					<div class="widget-body no-padding">
						<table id="dt_basic" class="table table-striped table-bordered table-hover" width="100%">
							<thead>			                
								<tr>
									<th width="5%">No.</th>
									<th width="25%">
										Tên nhóm
									</th>
									<!-- <th width="35%">
										Quyền chức năng
									</th> -->
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
								if (is_array($lstGroupAcc)) {
									foreach ($lstGroupAcc as $key => $item) { ?>
										<tr>
											<td align="center"><?php echo $stt;?></td>
											<td><?php echo $item->name?></td>
											<!-- <td>
												Full quyền chức năng
											</td> -->
											<td align="center"><?php echo date('d-m-Y', strtotime($item->created_on))?></td>
											<td align="center">
					                     		<a title="Sửa" href="<?php echo ROOTHOST;?>update_group/<?php echo $item->id?>" class="btn btn-primary approve-schedule">
					                     			<i class="fa fa-edit"></i>
					                     		</a>
					                     		<a title="Xóa" href="#" onclick="deleteGroupAcc('<?php echo $item->id?>')" class="btn btn-danger cancel-schedule">
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
		$('#txt_name').focusout(function() {
			$.post("<?php echo ROOTHOST;?>ajaxs/checkDuplicateValue.php",{value : $(this).val(), field : 'group_name'}, function($rep) {
	            console.log('value: ' + $rep);
				if($rep === 'true') {
	            	$("#txt_name").val('');
	            	smartErrorMsg('Thông báo', 'Nhóm người dùng đã tồn tại', 5000);
	            }
	        })
		})
	})
	pageSetUp();
	function deleteGroupAcc(groupId) {
		smartConfirm('Thông báo', 'Bạn có muốn xóa nhóm này không?', function() {
			window.location = 'del_group/' + groupId;
		})
	}
	
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
		var $updateDocumentForm = $("#form_create_group_user").validate({
			
			// Rules for form validation
			rules : {
				txt_name : {
					required : true
				}
			},

			// Messages for form validation
		
			messages : {
				txt_name : {
					required : "Nhập tên nhóm"
				}
			},
		
			submitHandler : function(form) {
				$(form).ajaxSubmit({
					success : function() {												
						smartInfoMsg('Thông báo', 'Thêm mới thành công!', 5000);	
						location.reload(true);
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


<script type="text/javascript">
	$('#txt_username').focusout(function(){
		checkUserExist();
	})
	
	function checkUserExist() {
		var username = $('#txt_username').val();
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

	function DeleteAccount(id) {
		smartConfirm('Thông báo', 'Bạn có muốn xóa tài khoản này không?', function() {
			window.location="<?php echo ROOTHOST?>register_member/del/" + id;
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

