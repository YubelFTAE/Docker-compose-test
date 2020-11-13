 <?php
// call api get list model of product
 $proId = null;
 if (isset($_GET['pro_id'])) {
 	// set proId
 	$proId = $_GET['pro_id'];
 } else {
	 // proId default
	 if ($objProSelected != null) {
		$proId = $objProSelected->id;
	 }
 }
 $lstModelOfPro = getListModelByProId(HOST_API, $proId);
 $lstModelOfPro = json_decode($lstModelOfPro);
//  var_dump($lstModelOfPro);
 ?>
 <!-- Table list model of products -->
 <table id="tbl_list_model_of_product" class="table table-striped table-bordered table-hover" width="100%">
	<thead>
		<tr>
			<th width="5%">No.</th>
			<th width="15%">Mã model</th>
			<th width="25%">Tên model</th>
			<th width="15%">Release number</th>
			<th width="15%">Version number</th>
			<th width="15%">Mã part [...]</th>
			<th width="10%">Hành động</th>
		</tr>
	</thead>
	<tbody>
		<?php
			$stt = 1;
			if (is_array($lstModelOfPro)) {
				foreach ($lstModelOfPro as $key => $item) {?>
					<tr>
						<td align="center"><?php echo $stt;?></td>
						<td align="center">
							<?php echo $item->item_number?>
						</td>
						<td align="left">
							<?php echo $item->name?>
						</td>
						<td align="center">
							<?php echo $item->release_number?>
						</td>
						<td align="center">
							<?php echo $item->version_number?>
						</td>
						<td align="center">
							<span>
								<?php 
									echo getPartNumberById(HOST_API, $item->id_part_number);	
								?>
							</span>
							<a href="#" onclick="viewInfoPart('<?php echo $item->id ;?>')" style="padding-left: 10px; float:right">
								<i class="fa fa-lg fa-eye"></i>	
							</a>
							<a href="#" onclick="changePart('<?php echo $item->id ;?>')" style="padding-left: 10px; float:right">
								<i class="fa fa-lg fa-edit"></i>	
							</a>
						</td>
						<td align="center">
							<a title="Xóa" onclick="actionDelModel('<?php echo $item->id;?>')" href="#" class="btn btn-danger">
								<i class="fa fa-trash-o "></i>
							</a>
						</td>
					</tr>
				<?php $stt++; }
			}?>
	</tbody>
</table>
<!-- The end table list model -->

<!-- Include popup change part for model -->
<?php include('components/com_popup/p_change_part.php')?>
<!-- The end -->
<?php include('components/com_popup/p_info_part.php')?>

<script type="text/javascript">
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
	function changePart(modelId) {
		$("#dialog_change_part").modal("show");
		$("#model_id").val(modelId);
	}
	// view info part
	function viewInfoPart(modId) {
		$("#dialog_info_part").modal("show");
		$.post("<?php echo ROOTHOST;?>ajaxs/execActionModel.php",{action: 'get_info_part_of_model', mod_id: modId},function($rep){	
			$("#info_part_of_model").html($rep);
		})
	}
</script>

<style type="text/css">
	#tbl_list_model_of_product_wrapper {
		border: 1px solid #ddd !important;
	}
	table tr {
		height: 26px !important;
		line-height: 26px !important;
	}
	#tbl_list_model_of_product thead th {
		text-align: center;
	}
</style>