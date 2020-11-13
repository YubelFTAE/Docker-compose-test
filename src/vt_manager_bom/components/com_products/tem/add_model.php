<?php
// get list part
$lstPart = getListParts(HOST_API, '*');
$lstPart = json_decode($lstPart);

// If event POST
if (isset($_POST['cmd_save'])) {
	$cdate = date('Y-m-d H:i:s');
	$cdate = str_replace(' ', 'T', $cdate).'.000+0000';
	$jsonPost = array(
		'id_part_number' => $_POST['rd_part_of_model'],
		'product_id' => $proId,
		'name' => $_POST['txt_model_name'],
		'item_number' => $_POST['txt_model_number'],
		'version_number' => $_POST['txt_version_number'],
		'release_number' => $_POST['txt_release_number'],
		'description' => $_POST['txt_description'],
		'created_by_id' => $GLOBALS['USERID'],
		"created_on" => $cdate
	);
	// call api save model
	// echo json_encode($jsonPost, JSON_UNESCAPED_UNICODE);
	// die;
	addNewModel(HOST_API, json_encode($jsonPost, JSON_UNESCAPED_UNICODE));
}
?>
<form class="smart-form" id="form_add_model" method="POST" novalidate="novalidate" enctype="multipart/form-data" action="">
	<fieldset>
		<div class="form-wrapper">
			<ul id="myTab2" class="nav nav-tabs">
				<li class="active">
					<a href="#info_model" data-toggle="tab" class="no-margin" aria-expanded="true" style="color: #333 !important;">Thông tin chung model</a>
				</li>
				<li>
					<a href="#tab-chose-part-model" data-toggle="tab" class="no-margin" aria-expanded="true" style="color: #333 !important;">Chọn parts</a>
				</li>
			</ul>
			<div id="myTabContent" class="tab-content">
				<div class="tab-pane active fade in" id="info_model">
					<div class="row">
						<section class="col col-3">
							<label class="label">Mã model&nbsp;<span style="color: red">(*)</span></label>
							<label class="input">
								<i class="icon-append fa fa-credit-card"></i>
								<input type="text" name="txt_model_number" id="txt_model_number" value="">
							</label>
						</section>
						<section class="col col-3">
							<label class="label">Tên model&nbsp;<span style="color: red">(*)</span></label>
							<label class="input">
								<i class="icon-append fa fa-gears"></i>
								<input type="text" name="txt_model_name" id="txt_model_name" value="">
							</label>
						</section>
					</div>
					<div class="row">
						<section class="col col-3">
							<label class="label">Version number&nbsp;<span style="color: red">(*)</span></label>
							<label class="input">
								<i class="icon-append fa fa-credit-card"></i>
								<input type="number" name="txt_version_number" onkeydown="return event.keyCode !== 69" id="txt_version_number" value="">
							</label>
						</section>
						<section class="col col-3">
							<label class="label">Release number&nbsp;<span style="color: red">(*)</span></label>
							<label class="input">
								<i class="icon-append fa fa-gears"></i>
								<input type="number" name="txt_release_number" onkeydown="return event.keyCode !== 69" id="txt_release_number" value="">
							</label>
						</section>
					</div>
					<section>
						<label class="label"> <i class="icon-append fa fa-lock"></i>
                            <b class="tooltip tooltip-bottom-right">Mô tả</b>
                        </label>
                        <label class="textarea"> <i class="icon-append fa fa-edit"></i><textarea rows="4" name="txt_description" id="txt_description" placeholder="Mô tả">Lorem ipsum dolor sit amet consectetur adipisicing elit</textarea>
                        </label>
					</section>
				</div>
				<div class="tab-pane fade" id="tab-chose-part-model">
					<!-- widget div-->
					<div role="content">
						<!-- widget content -->
						<div class="widget-body">
							<table id="tbl_list_parts" class="table table-striped table-bordered table-hover" width="100%">
								<thead>			                
									<tr>
										<th width="5%">No.</th>
										<th width="3%">
											Chọn
										</th>
										<th width="20%">
											Mã part
										</th>
										<th width="10%">
											Chủng loại
										</th>
										<th width="10%">
											Loại part
										</th>
										<th width="10%">
											Version
										</th>
										<th width="10%">
											Trạng thái
										</th>
										<th width="10%">
											Giá
										</th>
										<th width="15%">
											Đơn vị
										</th>
									</tr>
								</thead>
								<tbody>
									<?php
									$stt = 1;
									if (is_array($lstPart)) {
										foreach($lstPart as $key => $item) {?>
											<tr>
												<td align="center"><?php echo $stt;?></td>
												<td align="center">
													<label class="radio">
														<input type="radio" class="rd_part_of_model" name="rd_part_of_model" value="<?php echo $item->id;?>">
														<i></i>
													</label>
												</td>
												<td align="left">
													<?php echo $item->item_number?>
												</td>
												<td align="left">
													<?php echo $item->category?>
												</td>
												<td align="left">
													<?php echo $item->external_type?>
												</td>
												<td align="center">
													<?php echo $item->version?>
												</td>
												<td align="center">
													<?php echo $item->active == 1 ? "<span style=\"color: #fff;font-size: 12px;text-align:center\" class=\"label label-success\">Active</span>" : "<span style=\"color: #fff;font-size: 12px;text-align:center\" class=\"label label-danger\">Deactive</span>";?>
												</td>
												<td align="center">
													<?php echo $item->cost?>
												</td align="center">
												<td align="center">
													<?php echo $item->unit?>
												</td>
											</tr>
									<?php $stt++; }
									}?>
								</tbody>
							</table>
						</div>
						<!-- end widget content -->
						
					</div>
					<!-- end widget div -->	
				</div>
			</div>
		</div>
		
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

<!-- Javascript -->
<script type="text/javascript">
	$(document).ready(function() {
		$('#txt_model_number').focusout(function() {
			$.post("<?php echo ROOTHOST?>ajaxs/checkModelNumber.php",{mod_number : $(this).val()},function($rep) {
	            if($rep === "true") {
	            	$("#txt_model_number").val('');
	            	smartErrorMsg('Thông báo', 'Mã model đã tồn tại', 5000);
	            }
	        })
		})
	})
	
</script>

<!-- Style css -->
<style type="text/css" scoped="true">
	#info_model,
	#info_part_of_model {
		padding: 15px;
	}
	table tr {
		height: 26px !important;
		line-height: 26px !important;
	}
	#tbl_list_parts thead th {
		text-align: center;
	}
	#myTabContent {
		border-right: 1px solid #ccc;
		border-left: 1px solid #ccc;
		border-bottom: : 1px solid #ccc;
	}
	#form_add_model .input-group-addon {
		height: 16px;
		width: 16px;
	}
	.dt-toolbar {
		padding-bottom: 10px;
	}
</style>

