<?php
include_once("includes/vt-includes-js.php");
defined('ISHOME') or die("Can't acess this page, please come back!");
$cbo_state = "";
$cbo_type = "";
$cbo_unit = "Chiếc";
$cbo_makebuy = "";

// Execute add new part
if (isset($_POST['cmd_save'])) {
	$cdate = date('Y-m-d H:i:s');
	$cdate = str_replace(' ', 'T', $cdate).'.000+0000';
	$effectiveDate =  date('Y-m-d H:i:s', strtotime($_POST['txt_effective_date']));
	$effectiveDate = str_replace(' ', 'T', $effectiveDate).'.000+0000';
	$releaseDate =  date('Y-m-d H:i:s', strtotime($_POST['txt_release_date']));
	$releaseDate = str_replace(' ', 'T', $releaseDate).'.000+0000';

	$jsonPost = array(
		"item_number" => $_POST['txt_part_number'],
		"vietelCode" => $_POST['txt_viettel_code'],
		"name" => $_POST['txt_part_name'],
		"description" => $_POST['txt_description'],
		"category" => $_POST['txt_category'],
		"manufacturer_id" => $_POST['cbo_manufacturer'],
		"vendorId" => $_POST['cbo_vendor'],
		"number_manufacturer_res" => 0,
		"lead_time" => null,
		"classification" => $_POST['cbo_type'],
		"state" => $_POST['cbo_state'],
		"active" => $_POST['cbo_status'],
		"current_state" => "current_state",
		"version" => $_POST['txt_version'],
		"cost" => $_POST['txt_price'],
		"make_by" => $_POST['cbo_makebuy'],
		"unit" =>  $_POST['cbo_unit'],
		"weight" => $_POST['txt_weight'],
		"thumbnail" => null,
		"created_by_id" => $GLOBALS['USERID'],
		"created_on" => $cdate,
		"modified_by_id" => $GLOBALS['USERID'],
		"modified_on" => $cdate,
		"locked_by_id" => $GLOBALS['USERID'],
		"not_lockable" => true,
		"generation" => null,
		"release_date" => $releaseDate,
		"effective_date" => $effectiveDate,
		"is_released" => true,
		"is_current" => true,
		"major_rev" => null,
		"has_change_pending" => true,
		"permission_id" => null,
		"external_type" => $_POST['txt_external_type'],
		"quantity" => $_POST['txt_quantity'],
		"sort_order" => 0,
		"reference_designator" => null
	);
	$parttype = $_POST['parttype'];
	// call api add new part
	addNewPart(HOST_API, json_encode($jsonPost, JSON_UNESCAPED_UNICODE),$parttype);
}

?>
<section class="" id="widget-grid">
	<div class="row">
		<article class="col-sm-12 col-md-12 col-lg-12">
			<div class="jarviswidget" data-widget-editbutton="false" data-widget-colorbutton="false" data-widget-deletebutton="false" data-widget-togglebutton="false">
				<header>
					<span class="widget-icon"> <i class="fa fa-table"></i> </span>
					<h2>Thêm Mới Part</h2>
				</header>
				<!-- widget div-->
				<div role="content">
					<!-- widget content -->
					<div class="widget-body no-padding">
						
						<form class="smart-form" id="form_add_part" method="POST" novalidate="novalidate" enctype="multipart/form-data" action="">
							<input type="hidden" name="txt_lock" id="txt_lock" value="0">
							
							<fieldset>
								<div class="description description-tabs">
									<ul id="myTab2" class="nav nav-tabs">
										<li class="active">
											<a href="#info_common_part" data-toggle="tab" class="no-margin" aria-expanded="true" style="color: #333 !important;">Thông tin part</a>
										</li>
									</ul>
									
									<div id="myTabContent" class="tab-content">
										<div class="tab-pane active fade in" id="info_common_part">
											<?php include('add_info_common.php');?>
										</div>
									</div>
								</div>
							</fieldset>
							<footer>
								<input type="hidden" name="cmd_save"/>
								<?php if(isset($_GET['id'])) :?>
									<input type="hidden" name="txt_id" value="<?php echo $_GET['id'];?>" />
								<?php endif;?>
								<button type="reset" name="reset" id="btn_reset" class="btn btn-success">
									<i class="fa fa-refresh "></i>&nbsp;Reset
								</button>
								<button type="submit" name="i_submit" id="btn_save" class="btn btn-primary">
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
	// =====================================
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

		/* END BASIC */
		var $updateDocumentForm = $("#form_add_part").validate({
			
			// Rules for form validation
			rules : {
				txt_part_number : {
					required : true
				},
				txt_part_name : {
					required : true
				},
				txt_version : {
					required : true
				},
				cbo_state : {
					required : true
				},
				cbo_type : {
					required : true
				},
				cbo_makebuy : {
					required : true
				},
				cbo_unit : {
					required : true
				},
				txt_viettel_code : {
					required : true
				}
			},

			// Messages for form validation
		
			messages : {
				txt_part_number : {
					required : "Nhập mã part"
				},
				txt_part_name : {
					required : "Nhập tên part"
				},
				txt_version : {
					required : "Nhập version"
				},
				cbo_state : {
					required : "Chọn trạng thái"
				},
				cbo_type : {
					required : "Chọn type"
				},
				cbo_makebuy : {
					required : "Chọn make or buy"
				},
				cbo_unit : {
					required : "Chọn đơn vị"
				},
				txt_viettel_code : {
					required : "Nhập mã viettel"
				}
			},
		
			submitHandler : function(form) {
				$(form).ajaxSubmit({
					success : function() {												
						smartInfoMsg('Thông báo', 'Thêm mới thành công!', 5000);	
						window.location = '<?php echo ROOTHOST?>mgmt_parts';
					}
				});
			},

			// Do not change code below
			errorPlacement : function(error, element) {
				error.insertAfter(element.parent());
			}
		});
		$('#txt_effective_date').datepicker({
			dateFormat : 'dd-mm-yy',
			prevText : '<i class="fa fa-chevron-left"></i>',
			nextText : '<i class="fa fa-chevron-right"></i>',
			onSelect : function(selectedDate) {
				$('#finishdate').datepicker('option', 'minDate', selectedDate);
			}
		});
		$('#txt_release_date').datepicker({
			dateFormat : 'dd-mm-yy',
			prevText : '<i class="fa fa-chevron-left"></i>',
			nextText : '<i class="fa fa-chevron-right"></i>',
			onSelect : function(selectedDate) {
				$('#finishdate').datepicker('option', 'minDate', selectedDate);
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
							loadScript("<?php echo ROOTHOST.THIS_TEM_PATH; ?>js/plugin/bootstraptree/bootstrap-tree.min.js", pagefunction)
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
	#myTabContent {
		padding: 15px;
	}
	.dataTables_filter label {
		height: 40px;
	}
	.dataTables_filter .input-group-addon {
		height: 16px;
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

