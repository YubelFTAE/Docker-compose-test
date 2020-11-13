<?php
defined('ISHOME') or die("Can't acess this page, please come back!");
include_once("includes/vt-includes-js.php");
$lstDocument = null;
$docId = null;
$respData = null;
class objDocument {
	public $id = null;
	public $name = null;
	public $description = 'Lorem ipsum dolor sit amet consectetur adipisicing';
	public $createdById = null;
	public $createdOn = null;
}
$objDoc = new objDocument();

// ================================
// get list 
$lstDocument = getListDocument(HOST_API, '*');
$lstDocument = json_decode($lstDocument);
if (is_array($lstDocument) && count($lstDocument) > 0) {
	$docId = $lstDocument[0]->id;
}

// add new
if(isset($_POST['cmd_save'])) {
	$cdate = date('Y-m-d H:i:s');
	$cdate = str_replace(' ', 'T', $cdate).'.000+0000';
	$jsonPost = array(
		'name' => $_POST['txt_name'],
		"description" => $_POST['txt_description']
	);		
	if (isset($_POST['txt_id'])) {
		$jsonPost['modified_by_id'] = $GLOBALS['USERID'];
		$jsonPost['id'] = $_POST['txt_id'];
		updateDocument(HOST_API, $_POST['txt_id'], json_encode($jsonPost,JSON_UNESCAPED_UNICODE));
	} else {
		$jsonPost['created_by_id'] = $GLOBALS['USERID'];
		$jsonPost['created_on'] = $cdate;
		addNewDocument(HOST_API, json_encode($jsonPost, JSON_UNESCAPED_UNICODE));
	}
}

// action update
if (isset($_GET['doc_id'])) {
	$docId = $_GET['doc_id'];
	$resp = getListDocument(HOST_API, $docId);
	$resp = json_decode($resp);
	$respData = count($resp) > 0 ? $resp[0] : null;
	$objDoc->id = $respData->id;
	$objDoc->name = $respData->name;
	$objDoc->description = $respData->description;
	$objDoc->createdById = $respData->created_by_id;
	$objDoc->createdOn = $respData->created_on;
}
?>
<section class="" id="widget-grid">
	<div class="row">
		<article class="col-sm-12 col-md-6 col-lg-5">
			<div class="jarviswidget" data-widget-editbutton="false" data-widget-colorbutton="false" data-widget-deletebutton="false" data-widget-togglebutton="false">
				<header>
					<span class="widget-icon"> <i class="fa fa-bank"></i> </span>
					<h2>Thêm Mới Tài Liệu</h2>
				</header>
				<!-- widget div-->
				<div role="content">
					<!-- widget content -->
					<div class="widget-body no-padding">
						<form class="smart-form" id="form-manufacturer" method="POST" novalidate="novalidate" enctype="multipart/form-data" action="">
							<input type="hidden" id="cbo_state_selected" value="<?php echo $objDoc->state?>"/>
							<fieldset>
								<div class="row">
									<section class="col col-6">
										<label class="label">Tên nhóm tài liệu&nbsp;<span style="color: red">(*)</span></label>
										<label class="input">
											<i class="icon-append fa fa-file-excel-o"></i>
											<input type="text" name="txt_name" id="txt_name" value="<?php echo $objDoc->name?>">
										</label>
									</section>
									<section class="col col-6">
										<label class="label">&nbsp;Mô tả</label>
										<label class="textarea"> <i class="icon-append fa fa-edit"></i><textarea rows="4" name="txt_description" id="txt_description" placeholder="Mô tả"><?php echo $objDoc->description;?></textarea>
										</label>
									</section>
								</div>
							</fieldset>
							<footer>
								<input type="hidden" name="cmd_save"/>
								<?php if(isset($_GET['doc_id'])) :?>
									<input type="hidden" name="txt_id" value="<?php echo $_GET['doc_id'];?>" />
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
					<h2>Danh Sách Tài Liệu</h2>
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
										Tên nhóm tài liệu
									</th>
									<th width="15%">
										Mô tả
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
								if (is_array($lstDocument)) {
									foreach ($lstDocument as $key => $item) {?>
										<tr class="<?php if ($item->id == $docId) echo 'active';?>">
											<td align="center"><?php echo $stt;?></td>
											<td><?php echo $item->name?></td>
											<td><?php echo $item->description?></td>
											<td align="center"><?php echo date('d-m-Y', strtotime($item->created_on))?></td>
											<td align="center">
					                     		<a title="Sửa" href="<?php echo ROOTHOST?>edit_document/<?php echo $item->id?>" class="btn btn-primary approve-schedule">
					                     			<i class="fa fa-edit"></i>
					                     		</a>
					                     		<a title="Xóa" onclick="deleteDocument('<?php echo $item->id?>')" href="#" class="btn btn-danger">
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
	<?php include('document_file.php')?>
	<!-- The end -->
</section>

<!-- SCRIPTS ON PAGE EVENT -->
<script type="text/javascript">
	$(document).ready(function() {
		$('#txt_name').focusout(function() {
			$.post("<?php echo ROOTHOST;?>ajaxs/checkDuplicateValue.php",{value : $(this).val(), field : 'document_name'}, function($rep) {
				console.log('result: ' + $rep);
				if($rep === 'true') {
	            	$("#txt_name").val('');
	            	smartErrorMsg('Thông báo', 'Tên nhóm tài liệu đã tồn tại', 5000);
	            }
	        })
		})
		var state = $("#cbo_state_selected").val();
	})
	function deleteDocument(docId) {
		smartConfirm('Thông báo', 'Bạn có muốn xóa nhóm tài liệu này không?', function() {
			$.post("<?php echo ROOTHOST;?>ajaxs/documentFile/execActionFile.php",{action: 'delete_doc', doc_id: docId},function($rep){	
					if ($rep === 'DOC_USED') {
					smartErrorMsg('Thông báo', 'Bạn không thể xóa nhóm tài liệu vì đã có file thuộc tài liệu part', 5000);
				} else  {
					smartInfoMsg('Thông báo', 'Xóa thành công!', 5000);
					setTimeout(function() {
						location.reload();
					}, 1500);
				}
			})
			
		})
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
						smartInfoMsg('Thông báo', 'Thành công!', 5000);
						setTimeout(function(){
							window.location = '<?php echo ROOTHOST;?>document';
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
	
	function resetForm(){}
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
