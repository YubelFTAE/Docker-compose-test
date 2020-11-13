<?php
defined('ISHOME') or die("Can't acess this page, please come back!");
include_once("includes/vt-includes-js.php");
$partDefault = null;
$partId = null;
$lstPart = getListParts(HOST_API, '*');
$lstPart = json_decode($lstPart);
if (is_array($lstPart)) {
	$partDefault = count($lstPart) > 0 ? $lstPart[0] : null;
	$partId = $partDefault != null ? $partDefault->id : null;
}
?>
<section class="" id="widget-grid">
	<div class="row">
		<input type="hidden" id="partParentId" value="<?php echo $partId;?>"/>
		<article class="col-xs-12 col-sm-4 col-md-2 col-lg-3">
			<div class="jarviswidget" data-widget-editbutton="false" data-widget-colorbutton="false" data-widget-deletebutton="false" data-widget-togglebutton="false">
				<header>
					<span class="widget-icon"> <i class="fa fa-table"></i> </span>
					<h2 class="title_widget">Thông Tin Part</h2>
				</header>
				<div role="content">
					<div class="widget-body" id="quick-info-part">
						<!-- Quick info part -->
					</div>
				</div>
			</div>
		</article>
		<article class="col-xs-12 col-sm-8 col-md-10 col-lg-9">
			<!-- Widget ID (each widget will need unique ID)-->
			<div class="jarviswidget " data-widget-editbutton="false" data-widget-colorbutton="false" data-widget-deletebutton="false" data-widget-togglebutton="false">

				<header>
					<span class="widget-icon"> <i class="fa fa-table"></i> </span>
					<h2 class="title_widget">Danh Sách Parts</h2>
					<div class="widget-toolbar">
						<a href="#" onclick="deleteMutiplePart()" title="Xuất role up tree">
							<button data-toggle="modal"  class="btn btn-danger" style="padding:7px 10px!important; font-weight:bold;">
			                  <i class="fa fa-trash-o "></i>
			                  Xóa part
			                </button>
		                </a>
		            </div>
					<div class="widget-toolbar">
						<a href="<?php echo ROOTHOST?>add_parts" title="Thêm mới part">
							<button data-toggle="modal"  class="btn btn-primary" style="padding:7px 10px!important; font-weight:bold;">
			                  <i class="fa fa-plus-circle"></i>
			                  Thêm Part
			                </button>
		                </a>
		            </div>
					<div class="widget-toolbar">
						<a href="#" onclick="exportPartBom()" title="Xuất bom mẫu">
							<button data-toggle="modal"  class="btn btn-success" style="padding:7px 10px!important; font-weight:bold;">
			                  <i class="fa fa-file-excel-o"></i>
			                  Export Bom
 			                </button>
		                </a>
		            </div>
					<div class="widget-toolbar">
						<a href="#" onclick="exportRoleUpTree()" title="Xuất role up tree">
							<button data-toggle="modal"  class="btn btn-primary" style="padding:7px 10px!important; font-weight:bold;">
			                  <i class="fa fa-sitemap"></i>
			                  Role Up Tree
			                </button>
		                </a>
		            </div>
				</header>

				<!-- widget div-->
				<div role="content">
					<!-- widget content -->
					<div class="widget-body no-padding">
						<table id="dt_basic" class="table table-striped table-bordered table-hover tbl_part_list" width="100%">
							<thead>			                
								<tr>
									<th width="5%">No.</th>
									<th width="5%">
										<input type="checkbox" name="chk_all_part" class="chk_all_part" onClick="checkAll()">
									</th>
									<th width="25%">
										Mã parts
									</th>
									<th width="20%">
										Chủng loại
									</th>
									<th width="15%">
										Loại part
									</th>
									<th width="10%">
										Version
									</th>
									<th width="10%">
										Trạng thái
									</th>
								</tr>
							</thead>
							<tbody class="context-menu-one">
								<?php
								// get list part
								$lstPart = getListParts(HOST_API, '*');
								$lstPart = json_decode($lstPart);
								$i=1;
								if (is_array($lstPart)) {
									foreach ($lstPart as $key => $item) { ?>
										<tr class="<?php echo $item->id == $partId ? 'active row_item '.$item->id : 'row_item '.$item->id?>" p-id="<?php echo $item->id?>">
											<td align="center" class="td_row_item"><?php echo $i;?></td>
											<td align="center">
												<label class="checkbox">
													<input type="checkbox" name="chk_part" class="chk_part" value="<?php echo $item->id?>">
													<i></i>
												</label>
											</td>
											<td align="left" class="td_row_item"><?php echo $item->item_number;?></td>
											<td class="td_row_item"><?php echo $item->category;?></td>
											<td align="center" class="td_row_item"><?php echo $item->external_type;?></td>
											<td align="center" class="td_row_item"><span class="badge bg-color-orange"><?php echo $item->version != '' ? $item->version : 1;?></span></td>
											<td align="center" class="td_row_item">
												<?php echo $item->active == 1 ? "<span class=\"label label-success\">Active</span>" : "<span class=\"label label-danger\">Deactive</span>";?>
											</td>
										</tr>
									<?php $i++;} 
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
	<!-- Tab -->
	<div class="row">
		<article class="col-sm-12 col-md-12 col-lg-12 sortable-grid ui-sortable">
			<div class="jarviswidget" data-widget-editbutton="false" data-widget-colorbutton="false" data-widget-deletebutton="false" data-widget-togglebutton="false">
			    <header role="heading">
			        <ul class="nav nav-tabs pull-left in">
						<li class="active">
			                <a data-toggle="tab" href="#tab_info_part" aria-expanded="false"> <i class="fa fa-lg fa-bookmark-o"></i> <span class="hidden-mobile hidden-tablet"> Thông tin part </span> </a>
			            </li>
			            <li>
			                <a data-toggle="tab" href="#tab_part_bom" aria-expanded="false"> <i class="fa fa-lg fa-gear"></i> <span class="hidden-mobile hidden-tablet"> Part Bom </span> </a>
			            </li>
						<li>
			                <a data-toggle="tab" href="#tab_struct_bom" aria-expanded="false"> <i class="fa fa-lg fa-gear"></i> <span class="hidden-mobile hidden-tablet"> Cấu trúc Bom </span> </a>
			            </li>
			            <li>
			                <a data-toggle="tab" href="#tab_part_alternate" aria-expanded="false"> <i class="fa fa-lg fa-gear"></i> <span class="hidden-mobile hidden-tablet"> Part thay thế </span> </a>
			            </li>
			            <li>
			                <a data-toggle="tab" href="#tab_part_buy" aria-expanded="false"> <i class="fa fa-lg fa-gear"></i> <span class="hidden-mobile hidden-tablet"> Part mua </span> </a>
			            </li>
			            <li>
			                <a data-toggle="tab" href="#tab_files_part" aria-expanded="false"> <i class="fa fa-lg fa-file-pdf-o"></i> <span class="hidden-mobile hidden-tablet"> Tài liệu part </span> </a>
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
							<div class="tab-pane active" id="tab_info_part">
								<!-- load ajax data -->
			                </div>
			                <div class="tab-pane" id="tab_part_bom">
			                	<!-- load ajax data -->
			                </div>
							<div class="tab-pane" id="tab_struct_bom">
								<!-- load ajax data -->
								<table id="tree-table" class="table table-hover table-bordered">
									<tbody>
										<th>#</th>
										<th>Test</th>
										<tr data-id="1" data-parent="0" data-level="1">
											<td data-column="name">Node 1</td>
											<td>Additional info</td>
										</tr>
										<tr data-id="2" data-parent="1" data-level="2">
											<td data-column="name">Node 1</td>
											<td>Additional info</td>
										</tr>
										<tr data-id="3" data-parent="1" data-level="2">
											<td data-column="name">Node 1</td>
											<td>Additional info</td>
										</tr>
										<tr data-id="4" data-parent="3" data-level="3">
											<td data-column="name">Node 1</td>
											<td>Additional info</td>
										</tr>
										<tr data-id="5" data-parent="3" data-level="3">
											<td data-column="name">Node 1</td>
											<td>Additional info</td>
										</tr>
									</tbody>
									
								</table>
			                </div>
			                <div class="tab-pane" id="tab_part_alternate">
			                	<!-- load ajax data -->
			                </div>
			                <div class="tab-pane" id="tab_part_buy">
			                	<!-- load ajax data -->
			                </div>
			                <div class="tab-pane" id="tab_files_part">
								<!-- load ajax data -->
							</div>
			            </div>

			        </div>
			        <!-- end widget content -->
			    </div>
			    <!-- end widget div -->
			</div>
		</article>
	</div>
</section>

<!-- Include dialog list part-->
<?php include('components/com_popup/dialog_part_list.php')?>
<!-- Include dialog list file -->
<?php include('components/com_popup/dialog_add_file_for_part.php')?>
<!-- Include dialog show detail part -->
<?php include('components/com_popup/dialog_info_part.php')?>
<!-- Include dialog show list version part -->
<?php include('components/com_popup/dialog_list_version_part.php')?>

<!-- SCRIPTS ON PAGE EVENT -->
<script type="text/javascript">	
	$(document).ready(function() {
		loadData($("#partParentId").val());
		$(function() {
			$(".context-menu-one").contextMenu({
				selector: 'tr',
				callback: function(key, options) {
					var partId = $(this).attr('p-id');
					if (!partId) {
						smartInfoMsg('Thông báo', 'Không có dữ liệu', 5000);
						return;
					}
					if (key === 'delete') {
						actionDelPart(partId);
					} else if (key === 'clone') {
						clonePart(partId);
					} else if (key === 'info') {
						showInfoPart(partId);
					} else if (key === 'version') {
						showListVersion(partId);
					} 
				},
				items: {
					"info": {name: "Chi tiết part", icon: "fa-eye"},
					"clone": {name: "Sao chép part", icon: "fa-copy"},
					"version": {name: "Danh sách phiên bản", icon: "fa-gears"},
					"delete": {name: "Xóa part", icon: "delete"},
				}
			});
			$('.context-menu-one tr .td_row_item').on('click', function(e){
				var partId = $(this).parent().attr('p-id');
				getPartById(partId);
			})
		});
	});
	function loadData(partId) {
		var callbacks = $.Callbacks( "unique memory" );
		callbacks.add(loadInfoPart(partId));
		callbacks.add(loadPartBom(partId));
		callbacks.add(loadStructBom(partId));
		callbacks.add(loadPartAlternate(partId));
		callbacks.add(loadPartBuy(partId));
		callbacks.add(loadAjaxDataFiles(partId));
		callbacks.add(loadQuickInfoPart(partId, true));
		
		findCollaps();
	}
	// ajaxs load info current part
	function loadQuickInfoPart(partId, flg) {
		$.post('ajaxs/part/loadQuickInfo.php', {partId: partId}, function($rep) {
			$("#quick-info-part").html($rep);
			if (flg) {
				loadScript("<?php echo ROOTHOST.THIS_TEM_PATH; ?>js/plugin/datatables/jquery.dataTables.min.js", function(){
					loadScript("<?php echo ROOTHOST.THIS_TEM_PATH; ?>js/plugin/datatables/dataTables.bootstrap.min.js", function(){
						loadScript("<?php echo ROOTHOST.THIS_TEM_PATH; ?>js/plugin/datatable-responsive/datatables.responsive.min.js", function(){
							loadScript("<?php echo ROOTHOST.THIS_TEM_PATH; ?>js/javascript.js", pagefunction);
						})
					});
				});
			} else {
				// pagefunctionTab();
			}
		})
	}
	// ajaxs load info part
	function loadInfoPart(partId) {
		$.post('ajaxs/part/loadInfoPart.php', {partId: partId, userId: '<?php echo $GLOBALS['USERID']?>'}, function($rep) {
			$("#tab_info_part").html($rep);
		})
	}
	// ajaxs load data part bom
	function loadPartBom(partId) {
		$.post('ajaxs/part/loadPartBom.php', {partId: partId}, function($rep) {
			$("#tab_part_bom").html($rep);
		})
	}
	// ajaxs load data part alternate
	function loadPartAlternate(partId) {
		$.post('ajaxs/part/loadPartAlternate.php', {partId: partId}, function($rep) {
			$("#tab_part_alternate").html($rep);
		})
	}
	// ajaxs load data part buy
	function loadPartBuy(partId) {
		$.post('ajaxs/part/loadPartBuy.php', {partId: partId}, function($rep) {
			$("#tab_part_buy").html($rep);
		})
	}
	// ajaxs load struct bom
	function loadStructBom(partId) {
		$.post('ajaxs/part/loadStructBom.php', {partId: partId}, function($rep) {
			$("#tab_struct_bom").html($rep);
		})
	}
	// load ajax data file for part
	function loadAjaxDataFiles(partId) {
		$.post('ajaxs/documentFile/loadDataFiles.php', {partId: partId}, function($rep) {
			$("#tab_files_part").html($rep);
		})
	}
	showBlockChangeQuantity = (id) => {
		$(".change_quantity_" + id).css({'display': 'none'});
		$(".save_quantity_" +  id).css({'display': 'block'});
	}
	showBlockChangeLocation = (id) => {
		$(".change_location_" + id).css({'display': 'none'});
		$(".save_location_" +  id).css({'display': 'block'});
	}
	updateQuantity = (id,pid) => {	
		debugger	
		const newQuantity = $('.quantity_change_' + id).val();
		$(".quantity_" + id).html(newQuantity);
		$(".change_quantity_" + id).css({'display': 'block'});
		$(".save_quantity_" +  id).css({'display': 'none'});
		$.post("<?php echo ROOTHOST;?>ajaxs/execActionPart.php",{action: 'update_quantity', part_id : id, parent_id : pid ,quantity: newQuantity},function($rep) {
			smartInfoMsg('Thông báo', 'Cập nhật số lượng thành công!', 5000);
		})
	}
	updateLocation = (id,pid) => {	
		debugger	
		const newLocation = $('.location_change_' + id).val();
		$(".location_" + id).html(newLocation);
		$(".change_location_" + id).css({'display': 'block'});
		$(".save_location_" +  id).css({'display': 'none'});
		$.post("<?php echo ROOTHOST;?>ajaxs/execActionPart.php",{action: 'update_location', part_id : id, parent_id : pid ,location: newLocation},function($rep) {
			smartInfoMsg('Thông báo', 'Cập nhật vị trí thành công!', 5000);
		})
	}
	function checkAll() {
		if($('input[name="chk_all_part"]').is(':checked')) {
			$( ".chk_part" ).prop( "checked", true );
		} else {
			$( ".chk_part" ).prop( "checked", false );
		}
	}
	// event click view info part from grid datatables
	function getPartById(partId) {
		$("#partParentId").val(partId);
		$(".row_item").removeClass('active');
		$(".row_item." + partId).addClass('active');
		$('.loading').css({'display': 'block'});
		var callbacks = $.Callbacks( "unique memory" );
		callbacks.add(loadInfoPart(partId));
		callbacks.add(loadPartBom(partId));
		callbacks.add(loadStructBom(partId));
		callbacks.add(loadPartAlternate(partId));
		callbacks.add(loadPartBuy(partId));
		callbacks.add(loadAjaxDataFiles(partId));
		callbacks.add(loadQuickInfoPart(partId, false));
		setTimeout(() => {
			$('.loading').css({'display': 'none'});
			$('html, body').animate({
				scrollTop: $("#tab_info_part").offset().top
			}, 1000);
			findCollaps();
		}, 1000);
	}
	findCollaps = function () {
		var $table = $('#tree-table'),
        rows = $table.find('tr');

		rows.each(function (index, row) {
			var
				$row = $(row),
				level = $row.data('level'),
				id = $row.data('id'),
				$columnName = $row.find('td[data-column="name"]'),
				children = $table.find('tr[data-parent="' + id + '"]');

			if (children.length) {
				var expander = $columnName.prepend('' +
					'<span class="treegrid-expander glyphicon glyphicon-chevron-right"></span>' +
					'');

				children.hide();

				expander.on('click', function (e) {
					var $target = $(e.target);
					if ($target.hasClass('glyphicon-chevron-right')) {
						$target
							.removeClass('glyphicon-chevron-right')
							.addClass('glyphicon-chevron-down');

						children.show();
					} else {
						$target
							.removeClass('glyphicon-chevron-down')
							.addClass('glyphicon-chevron-right');

						reverseHide($table, $row);
					}
				});
			}

			$columnName.prepend('' +
				'<span class="treegrid-indent" style="width:' + 15 * level + 'px"></span>' +
				'');
		});
	}

    // Reverse hide all elements
    reverseHide = function (table, element) {
        var
            $element = $(element),
            id = $element.data('id'),
            children = table.find('tr[data-parent="' + id + '"]');

        if (children.length) {
            children.each(function (i, e) {
                reverseHide(table, e);
            });

            $element
                .find('.glyphicon-chevron-down')
                .removeClass('glyphicon-chevron-down')
                .addClass('glyphicon-chevron-right');

            children.hide();
        }
    };
	// function clone struct part by partid
	function clonePart(partId) {
		smartConfirm('Thông báo', 'Bạn có chắc chắn muốn sao chép part này không?', function() {
			$.post("<?php echo ROOTHOST;?>ajaxs/execActionPart.php",{action: 'clone_part', part_id: partId},function($rep){	
				smartInfoMsg('Thông báo', 'Sao chép part thành công!', 5000);
				setTimeout(function(){
					location.reload();
				}, 1500);
			})
		})
	}
	// show info part
	function showInfoPart(partId) {
		$.post("<?php echo ROOTHOST;?>ajaxs/part/getInfoPart.php",{part_id: partId}, function($rep){
			$('#view_info_part').html($rep);
			$("#dialog_info_part").modal("show");
		})
	}
	// show list version part
	function showListVersion(partId) {
		$.post("<?php echo ROOTHOST;?>ajaxs/part/getVersionPart.php",{part_id: partId}, function($rep){
			$('#list_version_part').html($rep);
			$("#dialog_list_version_part").modal("show");
		})
	}
	// exports struct bom of part
	function exportPartBom() {
		var partId = $("#partParentId").val();
		window.open('http://<?php echo HOST_API?>/part/download/' + partId, '_blank');
	}
	// exports role up tree
	function exportRoleUpTree() {
		var partId = $("#partParentId").val();
		window.open('http://<?php echo HOST_API?>/part/downloadRoleUpTree/' + partId, '_blank');
	}
	// function deleted part from grid datatable
	function actionDelPart(partId) {
		smartConfirm('Thông báo', 'Bạn có muốn xóa part này hay không?', function() {
			$.post("<?php echo ROOTHOST;?>ajaxs/execActionPart.php",{action: 'delete', part_id: partId},function($rep){	
				smartInfoMsg('Thông báo', 'Xóa part thành công!', 5000);
				setTimeout(function(){
					location.reload();
				}, 1500);
			})
		})
	}
	// function show dialog list part
	function showListPart(relationship, partId) {
		$('input:checkbox').removeAttr('checked');
		$("#part_id").val(partId);
		$("#created_by_id").val('<?php echo $GLOBALS['USERID']?>');
		$("#txt_relationship").val(relationship);
		$("#dialog_part_list").modal("show");

		if (relationship == 0) {
			isShowHidenTabContent(relationship);
			$("#title_dialog").html('Chọn part bom từ danh sách');

        } else if (relationship == 1) {
			isShowHidenTabContent(relationship);
			$("#title_dialog").html('Chọn part thay thế từ danh sách');

		} else if (relationship == 2) {
			isShowHidenTabContent(relationship);
			$("#title_dialog").html('Chọn part mua từ danh sách');

		} else  {
			// TODO
		}
	}
	function isShowHidenTabContent(relationship) {
		if (relationship != 0) {
			$("#tab_file").css({"display": "none"});
			$("#add_part_bom_file").css({"display": "none"});
			$("#tab_list_part").addClass('active');
			$("#add_part_bom_list").addClass('active in');
		} else  {
			$("#tab_file").css({"display": "block"});
			$("#add_part_bom_file").css({"display": "block"});
			$("#tab_file").removeClass('active');
			$("#add_part_bom_file").removeClass('active in');
		}
	}
	// del one or more part from tab
	function deletePartRelation(relationship) {
		if (isSelectedCheckbox(relationship)) {
			smartConfirm('Thông báo', 'Bạn có muốn xóa part này hay không?', function() {
				var objs = null;
				if (relationship == 0) {
					objs = document.getElementsByName('chk_pbom_del');
				} else if (relationship == 1) {
					objs = document.getElementsByName('chk_palternate_del');
				} else {
					objs = document.getElementsByName('chk_pbuy_del');
				}
				var strids = '';
				for(i=0;i<objs.length;i++) {
					if(objs[i].checked==true)
						strids+=objs[i].value+",";
				}
				$.post("<?php echo ROOTHOST;?>ajaxs/execActionPart.php",{action: 'del_part_relationshop', part_id: $("#partParentId").val(), part_selected: strids, type: relationship},function($rep){	
					smartInfoMsg('Thông báo', 'Xóa quan hệ part thành công!', 5000);
					var partId = $("#partParentId").val();
					var callbacks = $.Callbacks( "unique memory" );
					if (relationship == 0) {
						callbacks.add(loadPartBom(partId));
						callbacks.add(loadStructBom(partId));
					} else if (relationship == 1) {
						callbacks.add(loadPartAlternate(partId));
					} else {
						callbacks.add(loadPartBuy(partId));
					}
				})
			})
		}
	}

	function deleteMutiplePart() {
		var partSelected = $('input[name=chk_part].chk_part:checked').val();
		if (partSelected ==  null) {
			smartErrorMsg('Thông báo', 'Bạn chưa chọn part', 5000);
			return false;
		} else {
			smartConfirm('Thông báo', 'Bạn có muốn xóa part danh sách part hay không?', function() {
				var objs = document.getElementsByName('chk_part');
				var strids = '';
				for(i=0;i<objs.length;i++) {
					if(objs[i].checked==true)
						strids+=objs[i].value+",";
				}
				$.post("<?php echo ROOTHOST;?>ajaxs/execActionPart.php",{action: 'del_mutiple_part', part_selected: strids},function($rep){	
					smartInfoMsg('Thông báo', 'Xóa part thành công!', 5000);
					setTimeout(() => {
						location.reload();
					}, 1500);
				})
			})
		}
	}
	// check
	function isSelectedCheckbox(relationship) {
		if (relationship == 0) {
			var partSelected = $('input[name=chk_pbom_del].chk_pbom_del:checked').val();
		}
		else if (relationship == 1) {
			var partSelected = $('input[name=chk_palternate_del].chk_palternate_del:checked').val();
		}
		else if (relationship == 2) {
			var partSelected = $('input[name=chk_pbuy_del].chk_pbuy_del:checked').val();
		}
		if (partSelected ==  null) {
			smartErrorMsg('Thông báo', 'Bạn chưa chọn part', 5000);
			return false;
		}
		return true;
	}
	function exportData() {
		smartInfoMsg('Thông báo', 'Tính năng đang phát triển', 5000);
	}
	// update info part
	function updateInfoPart() {
		if ($("#part_number_old").val() !== $("#txt_part_number").val()) {
			$.post("<?php echo ROOTHOST;?>ajaxs/execActionPart.php",{action: 'check_part_number', part_number : $("#txt_part_number").val()},function($rep) {
				if ($rep=='exist') {
					$("#txt_part_number").val($("#part_number_old").val());
					smartErrorMsg('Thông báo', 'Mã part đã tồn tại', 5000);
				}
			})
		} else {
			$.post("<?php echo ROOTHOST;?>ajaxs/part/updateInfoPart.php", $("#form-update-info-part").serialize(),function($rep){	
				smartInfoMsg('Thông báo', 'Cập nhật thông tin part thành công!', 5000);
				setTimeout(() => {
					location.reload();
				}, 1000);
			})
		}
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
		$('#table_list_files').dataTable({
			"sDom": "<'dt-toolbar'<'col-xs-12 col-sm-6'f><'col-sm-6 col-xs-12 hidden-xs'l>r>"+
				"t"+
				"<'dt-toolbar-footer'<'col-sm-6 col-xs-12 hidden-xs'i><'col-xs-12 col-sm-6'p>>",
			"autoWidth" : true,
			"preDrawCallback" : function() {
				if (!responsiveHelper_dt_basic) {
					responsiveHelper_dt_basic = new ResponsiveDatatablesHelper($('#table_list_files'), breakpointDefinition);
				}
			},
			"rowCallback" : function(nRow) {
				responsiveHelper_dt_basic.createExpandIcon(nRow);
			},
			"drawCallback" : function(oSettings) {
				responsiveHelper_dt_basic.respond();
			}
		});
		$('#tbl_list_part_bom').dataTable({
			"sDom": "<'dt-toolbar'<'col-xs-12 col-sm-6'f><'col-sm-6 col-xs-12 hidden-xs'l>r>"+
				"t"+
				"<'dt-toolbar-footer'<'col-sm-6 col-xs-12 hidden-xs'i><'col-xs-12 col-sm-6'p>>",
			"autoWidth" : true,
			"preDrawCallback" : function() {
				if (!responsiveHelper_dt_basic) {
					responsiveHelper_dt_basic = new ResponsiveDatatablesHelper($('#tbl_list_part_bom'), breakpointDefinition);
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
		$('#tbl_list_part_alternate').dataTable({
			"sDom": "<'dt-toolbar'<'col-xs-12 col-sm-6'f><'col-sm-6 col-xs-12 hidden-xs'l>r>"+
				"t"+
				"<'dt-toolbar-footer'<'col-sm-6 col-xs-12 hidden-xs'i><'col-xs-12 col-sm-6'p>>",
			"autoWidth" : true,
			"preDrawCallback" : function() {
				if (!responsiveHelper_dt_basic) {
					responsiveHelper_dt_basic = new ResponsiveDatatablesHelper($('#tbl_list_part_alternate'), breakpointDefinition);
				}
			},
			"rowCallback" : function(nRow) {
				responsiveHelper_dt_basic.createExpandIcon(nRow);
			},
			"drawCallback" : function(oSettings) {
				responsiveHelper_dt_basic.respond();
			}
		});
		$('#tbl_list_part_buy').dataTable({
			"sDom": "<'dt-toolbar'<'col-xs-12 col-sm-6'f><'col-sm-6 col-xs-12 hidden-xs'l>r>"+
				"t"+
				"<'dt-toolbar-footer'<'col-sm-6 col-xs-12 hidden-xs'i><'col-xs-12 col-sm-6'p>>",
			"autoWidth" : true,
			"preDrawCallback" : function() {
				if (!responsiveHelper_dt_basic) {
					responsiveHelper_dt_basic = new ResponsiveDatatablesHelper($('#tbl_list_part_buy'), breakpointDefinition);
				}
			},
			"rowCallback" : function(nRow) {
				responsiveHelper_dt_basic.createExpandIcon(nRow);
			},
			"drawCallback" : function(oSettings) {
				responsiveHelper_dt_basic.respond();
			}
		});
		$('#tbl_document_list').dataTable({
			"sDom": "<'dt-toolbar'<'col-xs-12 col-sm-6'f><'col-sm-6 col-xs-12 hidden-xs'l>r>"+
				"t"+
				"<'dt-toolbar-footer'<'col-sm-6 col-xs-12 hidden-xs'i><'col-xs-12 col-sm-6'p>>",
			"autoWidth" : true,
			"preDrawCallback" : function() {
				if (!responsiveHelper_dt_basic) {
					responsiveHelper_dt_basic = new ResponsiveDatatablesHelper($('#tbl_document_list'), breakpointDefinition);
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

	var pagefunctionTab = function() {
		var responsiveHelper_dt_basic = undefined;
		var responsiveHelper_datatable_fixed_column = undefined;
		var responsiveHelper_datatable_col_reorder = undefined;
		var responsiveHelper_datatable_tabletools = undefined;
		var breakpointDefinition = {
			tablet : 1024,
			phone : 480
		};
		$('#tbl_list_part_bom').dataTable({
			"autoWidth" : true,
			"preDrawCallback" : function() {
				if (!responsiveHelper_dt_basic) {
					responsiveHelper_dt_basic = new ResponsiveDatatablesHelper($('#tbl_list_part_bom'), breakpointDefinition);
				}
			},
			"rowCallback" : function(nRow) {
				responsiveHelper_dt_basic.createExpandIcon(nRow);
			},
			"drawCallback" : function(oSettings) {
				responsiveHelper_dt_basic.respond();
			}
		});
		$('#tbl_list_part_alternate').dataTable({
			"autoWidth" : true,
			"preDrawCallback" : function() {
				if (!responsiveHelper_dt_basic) {
					responsiveHelper_dt_basic = new ResponsiveDatatablesHelper($('#tbl_list_part_alternate'), breakpointDefinition);
				}
			},
			"rowCallback" : function(nRow) {
				responsiveHelper_dt_basic.createExpandIcon(nRow);
			},
			"drawCallback" : function(oSettings) {
				responsiveHelper_dt_basic.respond();
			}
		});
		$('#tbl_document_list').dataTable({
			"autoWidth" : true,
			"preDrawCallback" : function() {
				if (!responsiveHelper_dt_basic) {
					responsiveHelper_dt_basic = new ResponsiveDatatablesHelper($('#tbl_document_list'), breakpointDefinition);
				}
			},
			"rowCallback" : function(nRow) {
				responsiveHelper_dt_basic.createExpandIcon(nRow);
			},
			"drawCallback" : function(oSettings) {
				responsiveHelper_dt_basic.respond();
			}
		});
	};

</script>
<style type="text/css">
	.tbl_part_list tr {
		cursor: pointer;
	}
	table tr {
		height: 26px !important;
		line-height: 26px !important;
	}
	#tbl_list_part_bom thead th,
	#tbl_list_part_alternate thead th,
	#tbl_list_part_buy thead th,
	#tbl_document_list thead th,
	#table_basic thead th,
	#models_info thead th,
	#dt_basic thead th {
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

