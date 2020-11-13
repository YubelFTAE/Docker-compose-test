<?php
include_once("includes/vt-includes-js.php");
defined('ISHOME') or die("Can't acess this page, please come back!");
$groupname = $strIdFunction = "";
$txt_create_on = date('d/m/Y');
if(isset($_POST['cmd_save'])) {
}

if (isset($_GET['id'])) {
	$id=$_GET['id'];
}

if(isset($_GET['del'])) {
	echo "<script>window.location='".ROOTHOST."register_member';</script>";
}

?>
<section class="" id="widget-grid">
	<div class="row">
		<article class="col-sm-12 col-md-6 col-lg-5">
			<div class="jarviswidget" data-widget-editbutton="false" data-widget-colorbutton="false" data-widget-deletebutton="false" data-widget-togglebutton="false">
				<header>
					<span class="widget-icon"> <i class="fa fa-table"></i> </span>
					<h2>Thêm Mới Chức Năng</h2>
				</header>
				<!-- widget div-->
				<div role="content">
					<!-- widget content -->
					<div class="widget-body no-padding">
						
						<form class="smart-form" id="form_create_group_user" method="POST" novalidate="novalidate" enctype="multipart/form-data" action="">
							<fieldset>
								<div class="row">
									<section class="col col-8">
										<label class="label">Tên chức năng&nbsp;<span style="color: red">(*)</span></label>
										<label class="input">
											<i class="icon-append fa fa-share-alt"></i>
											<input type="text" name="txt_group_name" id="txt_group_name" value="">
										</label>
									</section>
									<section class="col col-4">
										<label class="label">Ngày tạo</label>
										<label class="input"> 
											<i class="icon-append fa fa-calendar"></i>
												<input type="text" name="txt_create_on" value="<?php echo $txt_create_on;?>" id="txt_create_on" placeholder="">
											</label>
									</section>
								</div>
								<section>
									<label class="label"> <i class="icon-append fa fa-lock"></i>
			                            <b class="tooltip tooltip-bottom-right">Mô tả</b>
			                        </label>
			                        <label class="textarea"> <i class="icon-append fa fa-edit"></i><textarea rows="4" name="txt_description" id="txt_description" placeholder="Mô tả chức năng"></textarea>
			                        </label>
								</section>

								
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
					<h2>Danh Sách Chức Năng</h2>
				</header>

				<!-- widget div-->
				<div role="content">
					<!-- widget content -->
					<div class="widget-body no-padding">
						<table id="dt_basic" class="table table-striped table-bordered table-hover" width="100%">
							<thead>			                
								<tr>
									<th width="5%">No.</th>
									<th width="35%">
										<i class="fa fa-fw fa-share-alt txt-color-blue"></i>
										Tên chức năng
									</th>
									<th width="25%">
										<i class="fa fa-fw fa-calendar"></i> Ngày tạo</th>
									<th width="20%">
										Hành động
									</th>
								</tr>
							</thead>
							<tbody>
								
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
		var $updateDocumentForm = $("#form_create_group_user").validate({
			
			// Rules for form validation
			rules : {
				txt_group_name : {
					required : true
				}
			},

			// Messages for form validation
		
			messages : {
				txt_group_name : {
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
<style type="text/css">
#dt_basic thead th {
	text-align: center;
}
header h2 {
	font-weight: bold;
}
</style>

