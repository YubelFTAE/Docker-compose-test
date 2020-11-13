<?php
defined('ISHOME') or die("Can't acess this page, please come back!");
include_once("includes/vt-includes-js.php");
$lstModel = null;
$objModSelected = null;
$modId = null;
// call api get all model
$lstModel = getListModel(HOST_API,  '*');
$lstModel = json_decode($lstModel);

if (isset($_GET['mod_id'])) {
	// get model by id
	$modId = $_GET['mod_id'];
	$resp = getListModel(HOST_API, $modId);
	// echo $resp;
	$resp = json_decode($resp);
	$objModSelected = is_array($resp) ? $resp[0] : null;
	
} else {
	if (is_array($lstModel)) {
		$objModSelected = count($lstModel) > 0 ? $lstModel[0] : null;
	}
	$modId = isset($objModSelected->id) ? $objModSelected->id : null;
}
?>
<section class="" id="widget-grid">
	<div class="row">
		<article class="col-xs-12 col-sm-4 col-md-3 col-lg-3">
			<div class="jarviswidget" data-widget-editbutton="false" data-widget-colorbutton="false" data-widget-deletebutton="false" data-widget-togglebutton="false">
				<header>
					<span class="widget-icon"> <i class="fa fa-table"></i> </span>
					<h2 class="title_widget">Thông Tin Models</h2>
				</header>

				<!-- widget div-->
				<div role="content">
					<!-- widget content -->
					<div class="widget-body">
						<table>
							<tr>
								<td><label class="lbl_text">Mã model: </label></td>
								<td><span class="right_info info_model_number"><?php echo $objModSelected != null ? $objModSelected->item_number : 'N/A';?></span></td>
							</tr>
							<tr>
								<td><label class="lbl_text">Tên model: </label></td>
								<td><span class="right_info info_model_name"><?php echo $objModSelected != null ? $objModSelected->name : 'N/A';?></span></td>
							</tr>
							<tr>
								<td><label class="lbl_text">Mã part: </label></td>
								<td>
									<span class="right_info info_part_model"><?php echo $objModSelected != null ? getPartNumberById(HOST_API, $objModSelected->id_part_number) : 'N/A';?></span>
									<a href="#" onclick="viewInfoPart('<?php echo $modId;?>')">
										<i class="fa fa-eye"></i>&nbsp;[Xem...]
									</a>
								</td>
							</tr>
							<tr>
								<td><label class="lbl_text">Version number: </label></td>
								<td><span class="right_info info_version_number"><?php echo $objModSelected != null ? $objModSelected->version_number : 'N/A';?></span></td>
							</tr>
							<tr>
								<td><label class="lbl_text">Release number: </label></td>
								<td><span class="right_info info_release_number"><?php echo $objModSelected != null ? $objModSelected->release_number : 'N/A';?></span></td>
							</tr> 
							<tr>
								<td><label class="lbl_text">Người tạo: </label></td>
								<td><span class="right_info info_user_create"><?php echo getNameById(HOST_API, $objModSelected->created_by_id)?></span></td>
							</tr> 
							<!-- <tr>
								<td><label class="lbl_text">Ngày tạo: </label></td>
								<td><span class="right_info info_create_date"><?php //echo $objModSelected != null ? date('d-m-Y', strtotime($objModSelected->created_on)) : 'N/A';?></span></td>
							</tr> -->
							<!-- <tr>
								<td><label class="lbl_text">Người sửa đổi: </label></td>
								<td><span class="right_info info_user_change"><?php //getNameById(HOST_API, $objModSelected->created_by_id)?></span></td>
							</tr>
							<tr>
								<td><label class="lbl_text">Ngày sửa: </label></td>
								<td><span class="right_info info_change_date"><?php //echo $objModSelected != null ? date('d-m-Y', strtotime($objModSelected->modified_on)) : 'N/A';?></span></td>
							</tr> -->
						</table>
					</div>
					<!-- end widget content -->
					
				</div>
				<!-- end widget div -->
				
			</div>
			<!-- end widget -->								


		</article>

		<article class="col-xs-12 col-sm-8 col-md-9 col-lg-9">
			<!-- Widget ID (each widget will need unique ID)-->
			<div class="jarviswidget " data-widget-editbutton="false" data-widget-colorbutton="false" data-widget-deletebutton="false" data-widget-togglebutton="false">

				<header>
					<span class="widget-icon"> <i class="fa fa-table"></i> </span>
					<h2 class="title_widget">Danh Sách Models</h2>
				</header>

				<!-- widget div-->
				<div role="content">
					<!-- widget content -->
					<div class="widget-body no-padding">
						<table id="dt_basic" class="table table-striped table-bordered table-hover tbl_model_list" width="100%">
							<thead>			                
								<tr>
									<th width="5%">No.</th>
									<th width="15%">
										Mã model
									</th>
									<th width="15%">
										Tên model
									</th>
									<th width="15%">
										Mã part
									</th>
									<th width="20%">
										Mô tả
									</th>
									<th width="20%">
										Hành động
									</th>
								</tr>
							</thead>
							<tbody>
								<?php
								$stt = 1;
								if (is_array($lstModel)) {
									foreach ($lstModel as $key => $item) { ?>
										<tr class="<?php echo $item->id == $modId ? 'active' : ''?>">
											<td align="center"><?php echo $stt;?></td>
											<td align="center"><?php echo $item->item_number;?></td>
											<td><?php echo $item->name;?></td>
											<td align="center"><?php echo getPartNumberById(HOST_API, $item->id_part_number)?></td>
											<td><?php echo $item->description?></td>
											<td align="center">
												<a title="Xem chi tiết" href="#" onclick="getModelById('<?php echo $item->id?>')" class="btn btn-success">
													<i class="fa fa-eye"></i>
												</a>
												<a title="Sửa" onclick="changeInfoModel('<?php echo $item->id?>', '<?php echo $GLOBALS['USERID']?>', '<?php echo $item->product_id?>')" href="#" class="btn btn-primary approve-schedule">
													<i class="fa fa-edit"></i>
												</a>
												<a title="Xóa" onclick="actionDelModel('<?php echo $item->id;?>')" href="#" class="btn btn-danger">
													<i class="fa fa-trash-o "></i>
												</a>
											</td>
										</tr>
									<?php $stt++;}
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

<?php include('components/com_popup/p_info_part.php')?>
<?php include('components/com_popup/p_change_info_model.php')?>

<!-- SCRIPTS ON PAGE EVENT -->
<script type="text/javascript">
	// view info part
	function viewInfoPart(modId) {
		$("#dialog_info_part").modal("show");
		$.post("<?php echo ROOTHOST;?>ajaxs/execActionModel.php",{action: 'get_info_part_of_model', mod_id: modId},function($rep){	
			$("#info_part_of_model").html($rep);
		})
	}

	// get info model
	function getModelById(modId) {
		setTimeout(() => {
			window.location = '<?php echo ROOTHOST?>edit_model/' + modId;
		}, 500);
	}
	function changeInfoModel(modId, userId, proId) {
		$("#dialog_info_model").modal("show");
		$.post("<?php echo ROOTHOST;?>ajaxs/execActionModel.php",{action: 'get_model_info', mod_id: modId, user_id: userId, pro_id: proId},function($rep){	
			$("#model_info_content").html($rep);
		})
	}
	function submitUpdatInfoModel(modId) {
		$.post("<?php echo ROOTHOST;?>ajaxs/execActionModel.php", $("#form_model_info").serialize(),function($rep){	
			$("#dialog_info_model").modal("hide");
			smartInfoMsg('Thông báo', 'Cập nhật model thành công!', 5000);
			setTimeout(() => {
				location.reload();
			});
		})
	}
	function actionDelModel(modId) {
		smartConfirm('Thông báo', 'Bạn có muốn xóa model không?', function() {
			$.post("<?php echo ROOTHOST;?>ajaxs/execActionModel.php",{action: 'delete', mod_id: modId},function($rep){	
				smartInfoMsg('Thông báo', 'Xóa model thành công!', 5000);
			})
			setTimeout(function() {
				location.reload();
			}, 1500);
		})
	}

	pageSetUp();
	
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
	.tbl_model_list tr {
		cursor: pointer;
	}
	table tr {
		height: 26px !important;
		line-height: 26px !important;
	}
	#dt_basic thead th,
	#models_info thead th {
		text-align: center;
	}
	.title_widget {
		font-weight: bold;
	}
	.lbl_text {
		font-weight: bold;	
	}
	#myTabContent2 {
		background: #fff;
	}
	#models_info {
		padding: 15px;
	}
	.right_info {
		padding-left: 15px;
	}	
</style>

