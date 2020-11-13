<?php
defined('ISHOME') or die("Can't acess this page, please come back!");
$objProSelected = null;
$lstProducts = null;
$lstModelOfPro = null;
$lstPart = null;
$proId = null;
?>
<section class="" id="widget-grid">
	<!-- Include list product and view info each product -->
	<div class="row">
		<?php include('list_product.php');?>
	</div>
	<!-- The end -->

	<!-- Include model of product -->
	<div class="row">
		<article class="col-sm-12 col-md-12 col-lg-12 sortable-grid ui-sortable">
			<div class="jarviswidget" data-widget-editbutton="false" data-widget-colorbutton="false" data-widget-deletebutton="false" data-widget-togglebutton="false">
			    <header role="heading">
			        <ul class="nav nav-tabs pull-left in">
			            <li class="active">
			                <a data-toggle="tab" href="#hr1" aria-expanded="false"> <i class="fa fa-lg fa-hdd-o"></i>
			                	<span class="hidden-mobile hidden-tablet"> Model sản phẩm</span>
			            	</a>
			            </li>
			            <li>
			                <a data-toggle="tab" href="#hr2" aria-expanded="true"> <i class="fa fa-lg fa-plus-circle"></i> <span class="hidden-mobile hidden-tablet"> Thêm mới model</span>
			                </a>
			            </li>

			        </ul>
			        <span class="jarviswidget-loader"><i class="fa fa-refresh fa-spin"></i></span></header>

			    <!-- widget div-->
			    <div role="content">

			        <!-- widget edit box -->
			        <div class="jarviswidget-editbox">
			            <!-- This area used as dropdown edit box -->

			        </div>
			        <!-- end widget edit box -->

			        <!-- widget content -->
			        <div class="widget-body">

			            <div class="tab-content">
			                <div class="tab-pane active" id="hr1">
			                	<!-- List model of product -->
			                   <?php include('list_model_of_product.php');?>
								<!-- The end -->
			                </div>

			                <div class="tab-pane" id="hr2">
			                	<!-- Add model for product -->
			                	<?php include('add_model.php');?>
			                	<!-- The end -->
			                </div>
			            </div>

			        </div>
			        <!-- end widget content -->

			    </div>
			    <!-- end widget div -->

			</div>
		</article>
	</div>
	<!-- The end  -->

</section>

<!-- SCRIPTS ON PAGE EVENT -->
<script type="text/javascript">	
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

			$('#table_list_product').dataTable({
				"sDom": "<'dt-toolbar'<'col-xs-12 col-sm-6'f><'col-sm-6 col-xs-12 hidden-xs'l>r>"+
					"t"+
					"<'dt-toolbar-footer'<'col-sm-6 col-xs-12 hidden-xs'i><'col-xs-12 col-sm-6'p>>",
				"autoWidth" : true,
				"preDrawCallback" : function() {
					// Initialize the responsive datatables helper once.
					if (!responsiveHelper_dt_basic) {
						responsiveHelper_dt_basic = new ResponsiveDatatablesHelper($('#table_list_product'), breakpointDefinition);
					}
				},
				"rowCallback" : function(nRow) {
					responsiveHelper_dt_basic.createExpandIcon(nRow);
				},
				"drawCallback" : function(oSettings) {
					responsiveHelper_dt_basic.respond();
				}
			});

			$('#table_list_parts').dataTable({
				"sDom": "<'dt-toolbar'<'col-xs-12 col-sm-6'f><'col-sm-6 col-xs-12 hidden-xs'l>r>"+
					"t"+
					"<'dt-toolbar-footer'<'col-sm-6 col-xs-12 hidden-xs'i><'col-xs-12 col-sm-6'p>>",
				"autoWidth" : true,
				"preDrawCallback" : function() {
					// Initialize the responsive datatables helper once.
					if (!responsiveHelper_dt_basic) {
						responsiveHelper_dt_basic = new ResponsiveDatatablesHelper($('#table_list_parts'), breakpointDefinition);
					}
				},
				"rowCallback" : function(nRow) {
					responsiveHelper_dt_basic.createExpandIcon(nRow);
				},
				"drawCallback" : function(oSettings) {
					responsiveHelper_dt_basic.respond();
				}
			});

			$('#tbl_list_parts').dataTable({
				"sDom": "<'dt-toolbar'<'col-xs-12 col-sm-6'f><'col-sm-6 col-xs-12 hidden-xs'l>r>"+
					"t"+
					"<'dt-toolbar-footer'<'col-sm-6 col-xs-12 hidden-xs'i><'col-xs-12 col-sm-6'p>>",
				"autoWidth" : true,
				"preDrawCallback" : function() {
					// Initialize the responsive datatables helper once.
					if (!responsiveHelper_dt_basic) {
						responsiveHelper_dt_basic = new ResponsiveDatatablesHelper($('#tbl_list_parts'), breakpointDefinition);
					}
				},
				"rowCallback" : function(nRow) {
					responsiveHelper_dt_basic.createExpandIcon(nRow);
				},
				"drawCallback" : function(oSettings) {
					responsiveHelper_dt_basic.respond();
				}
			});

			$('#tbl_list_model_of_product').dataTable({
				"sDom": "<'dt-toolbar'<'col-xs-12 col-sm-6'f><'col-sm-6 col-xs-12 hidden-xs'l>r>"+
					"t"+
					"<'dt-toolbar-footer'<'col-sm-6 col-xs-12 hidden-xs'i><'col-xs-12 col-sm-6'p>>",
				"autoWidth" : true,
				"preDrawCallback" : function() {
					// Initialize the responsive datatables helper once.
					if (!responsiveHelper_dt_basic) {
						responsiveHelper_dt_basic = new ResponsiveDatatablesHelper($('#tbl_list_model_of_product'), breakpointDefinition);
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
		var $updateDocumentForm = $("#form_add_model").validate({
			
			// Rules for form validation
			rules : {
				txt_model_number : {
					required : true
				},
				txt_model_name : {
					required : true
				},
				txt_version_number : {
					required : true
				},
				txt_release_number : {
					required : true
				}
			},

			// Messages for form validation
		
			messages : {
				txt_model_number : {
					required : "Nhập mã model"
				},
				txt_model_name : {
					required : "Nhập tên model"
				},
				txt_version_number : {
					required : "Nhập version number"
				},
				txt_release_number : {
					required : "Nhập release number"
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

	function deleteProducts(id) {
		smartConfirm('Thông báo', 'Bạn có muốn xóa sản phẩm này không?', function() {
			
		})
	}

</script>

