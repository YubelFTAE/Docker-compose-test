<?php
// get list all products
$lstProducts = getListProduct(HOST_API, '*');
$lstProducts = json_decode($lstProducts);

if (isset($_GET['pro_id'])) {
	$proId = $_GET['pro_id'];
	// get product by id
	$resp = getListProduct(HOST_API, $proId);
	$resp = json_decode($resp);
	$objProSelected = is_array($resp) ? $resp[0] : null;
} else {
	// set default product equalse item 0
	if (is_array($lstProducts) && count($lstProducts) > 0) {
		$objProSelected = $lstProducts[0];
	}
	$proId = $objProSelected != null ? $objProSelected->id : null;
}
?>
<article class="col-xs-12 col-sm-4 col-md-4 col-lg-3">
<!-- <article class="col-xs-12 col-sm-4 col-md-2 col-lg-2"> -->
	<div class="jarviswidget" data-widget-editbutton="false" data-widget-colorbutton="false" data-widget-deletebutton="false" data-widget-togglebutton="false">
		<header>
			<span class="widget-icon"> <i class="fa fa-table"></i> </span>
			<h2 class="title_widget">Thông Tin Sản Phẩm</h2>
		</header>

		<!-- widget div-->
		<div role="content">
			<!-- widget content -->
			<div class="widget-body">
				<table>
					<tr>
						<td><label class="lbl_text">Mã sản phẩm: </label></td>
						<td>
							<span class="right_info">
								<?php echo $objProSelected != null ? $objProSelected->item_number : 'N/A';?>
							</span>
						</td>
					</tr>
					<tr>
						<td><label class="lbl_text">Tên sản phẩm: </label></td>
						<td>
							<span class="right_info">
								<?php echo $objProSelected != null ? $objProSelected->name : 'N/A';?>
							</span>
						</td>
					</tr>
					<tr>
						<td><label class="lbl_text">Người tạo: </label></td>
						<td>
							<span class="right_info">
								<?php echo $objProSelected != null ? getNameById(HOST_API, $objProSelected->created_by_id) : 'N/A';?>
							</span>
						</td>
					</tr>
					<tr>
						<td><label class="lbl_text">Ngày tạo: </label></td>
						<td>
							<span class="right_info">
								<?php echo $objProSelected != null ? date('d-m-Y', strtotime($objProSelected->created_on)) : 'N/A';?>
							</span>
						</td>
					</tr>
					<tr>
						<td><label class="lbl_text">Người sửa đổi: </label></td>
						<td>
							<span class="right_info">
								<?php echo $objProSelected != null ? getNameById(HOST_API, $objProSelected->modified_by_id) : 'N/A';?>
							</span>
						</td>
					</tr>
					<tr>
						<td><label class="lbl_text">Ngày sửa: </label></td>
						<td>	
							<span class="right_info">
								<?php echo $objProSelected != null ? date('d-m-Y', strtotime($objProSelected->modified_on)) : 'N/A';?>
							</span>
						</td>
					</tr>
					<tr>
						<td><label class="lbl_text">Trạng thái: </label></td>
						<td>
							<span class="right_info">
								<?php echo $objProSelected != null ? $objProSelected->state : 'N/A';?>
							</span>
						</td>
					</tr>
				</table>
			</div>
			<!-- end widget content -->
			
		</div>
		<!-- end widget div -->
		
	</div>
	<!-- end widget -->								
</article>

<!-- <article class="col-xs-12 col-sm-8 col-md-10 col-lg-10"> -->
<article class="col-xs-12 col-sm-8 col-md-8 col-lg-9">
	<!-- Widget ID (each widget will need unique ID)-->
	<div class="jarviswidget " data-widget-editbutton="false" data-widget-colorbutton="false" data-widget-deletebutton="false" data-widget-togglebutton="false">
		<header>
			<span class="widget-icon"> <i class="fa fa-table"></i> </span>
			<h2 class="title_widget">Danh Sách Sản Phẩm</h2>
			<div class="widget-toolbar">
				<a href="<?php echo ROOTHOST?>add_products" title="Thêm mới linh kiện">
					<button data-toggle="modal"  class="btn btn-primary" style="padding:7px 10px!important; font-weight:bold;">
					<i class="fa fa-plus-circle"></i>
	                  Thêm mới
	                </button>
                </a>
            </div>
		</header>
		<!-- widget div-->
		<div role="content">
			<!-- widget content -->
			<div class="widget-body no-padding">
				<table id="table_list_product" class="table table-striped table-bordered table-hover tbl_product_list" width="100%">
					<thead>			                
						<tr>
							<th width="5%">No.</th>
							<th width="15%">
								&nbsp;Mã sản phẩm
							</th>
							<th width="25%">
								&nbsp;Tên sản phẩm
							</th>
							<th width="15%">
								&nbsp;Trạng thái
							</th>
							<th width="25%">
								&nbsp;Mô tả
							</th>
							<th width="15%">
								&nbsp;Hành động		
							</th>
						</tr>
					</thead>
					<tbody>
						<?php
						$stt=1;
						if (is_array($lstProducts)) {
							foreach ($lstProducts as $key => $item) { ?>
								<tr class="<?php echo $item->id == $proId ? 'active' : ''?>">
									<td align="center"><?php echo $stt;?></td>
									<td align="left"><?php echo $item->item_number;?></td>
									<td><?php echo $item->name?></td>
									<td align="left">
										<?php echo $item->state=='Released' ? "<span class=\"label label-success\">". $item->state."</span>" : "<span class=\"label label-primary\">". $item->state."</span>";?>
									</td>
									<td><?php echo $item->description;?></td>
									<td align="center">							
										<a title="Xem chi tiết" href="#" onclick="getProductById('<?php echo $item->id;?>')" class="btn btn-success">
											<i class="fa fa-eye"></i>
										</a>			
										<a title="Sửa" href="<?php echo ROOTHOST?>edit_product/<?php echo $item->id;?>" class="btn btn-primary">
											<i class="fa fa-edit"></i>
										</a>
										<a title="Xóa" href="#" onclick="actionDelProduct('<?php echo $item->id;?>')" class="btn btn-danger">
											<i class="fa fa-trash-o "></i>
										</a>
									</td>
								</tr>
							<?php $stt++;} 
						}?>
					</tbody>
				</table>
			</div>
			<!-- end widget content -->
		</div>
		<!-- end widget div -->
	</div>
	<!-- end widget -->
</article>
<script type="text/javascript">
	function getProductById(proId) {
		$('.loading').css({'display': 'block'});
		setTimeout(() => {
			window.location = '<?php echo ROOTHOST?>product/' + proId
			$('.loading').css({'display': 'none'});
		}, 500);
	}
	function actionLockOrUnlock(proId, lockVal) {
		smartConfirm('Thông báo', 'Bạn có muốn lock or unlock sản phẩm này hay không?', function() {
			$.post("<?php echo ROOTHOST;?>ajaxs/execActionProduct.php",{action: 'lock_or_unlock',pro_id: proId, lock_val: lockVal},function($rep){	
				smartInfoMsg('Thông báo', 'Thay đổi trạng thái thành công!', 5000);
				setTimeout(function(){
					location.reload();
				}, 1500);
			})
		})
	}
	function actionDelProduct(proId) {
		smartConfirm('Thông báo', 'Bạn có muốn xóa sản phẩm này hay không?', function() {
			$.post("<?php echo ROOTHOST;?>ajaxs/execActionProduct.php",{action: 'delete', pro_id: proId},function($rep){	
				smartInfoMsg('Thông báo', 'Xóa sản phẩm thành công!', 5000);
				setTimeout(function(){
					location.reload();
				}, 1500);
			})
		})
	}
</script>
<style type="text/css">
	.tbl_product_list tr:hover {
		cursor: pointer;
	}
	table tr {
		height: 26px !important;
		line-height: 26px !important;
	}
	#table_list_product thead th {
		text-align: center;
	}
	.title_widget {
		font-weight: bold;
	}
	.lbl_text {
		margin-bottom: 0px;
		margin-right: 10px;
	}
	#table_list_product tr.active {
		background: #ffcc33;
	}
</style>