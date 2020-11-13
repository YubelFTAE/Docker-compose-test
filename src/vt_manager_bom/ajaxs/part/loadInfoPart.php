<?php
require_once("../../api/apiPart.php");
require_once("../../api/apiManufacturer.php");
require_once("../../api/apiVendor.php");
require_once("../../api/apiCommon.php");
require_once("../../includes/vt-config.php");
$partId = $_POST['partId'];
$userId = $_POST['userId'];
//  call api get part by id
$resp = getListParts(HOST_API, $partId);
// echo $resp;
$arrData = json_decode($resp);
if (!is_array($arrData)) {
	echo null;
	return;
}
$objPart = count($arrData) > 0 ? $arrData[0] : null;
$effectiveDate = null;
$releasedDate = null;
if (strpos($objPart->effective_date, '1970-01-01') === false) {
    $effectiveDate = date('d-m-Y', strtotime($objPart->effective_date));
}
if (strpos($objPart->release_date, '1970-01-01') === false) {
    $releasedDate = date('d-m-Y', strtotime($objPart->release_date));
}

// =================================================================

$html="";
if ($objPart == null ) {
    echo $html; 
    return;
}
$html.="<form class=\"smart-form\" id=\"form-update-info-part\" method=\"POST\" novalidate=\"novalidate\" enctype=\"multipart/form-data\" action=\"\">
	<input type=\"hidden\" value=\"$userId\" name=\"txt_modified_id\"/>
	<input type=\"hidden\" value=\"$partId\" name=\"txt_part_id\"/>
	<input type=\"hidden\" value=\"$objPart->created_by_id\" name=\"txt_created_by_id\"/>
	<input type=\"hidden\" id=\"cbo_status_selected\" value=\"$objPart->active\"/>
	<input type=\"hidden\" id=\"cbo_state_selected\" value=\"$objPart->state\"/>
	<input type=\"hidden\" id=\"cbo_type_selected\" value=\"$objPart->classification\"/>
	<input type=\"hidden\" id=\"cbo_makebuy_selected\" value=\"$objPart->make_by\"/>
	<input type=\"hidden\" id=\"cbo_unit_selected\" value=\"$objPart->unit\"/>
	<input type=\"hidden\" id=\"cbo_manufacturer_selected\" value=\"$objPart->manufacturer_id\"/>
	<input type=\"hidden\" id=\"cbo_vendor_selected\" value=\"$objPart->vendorId\"/>
	<input type=\"hidden\" id=\"part_number_old\" value=\"".trim($objPart->item_number)."\"/>
    <fieldset>
        <div class=\"description description-tabs\">
            <div id=\"myTabContent\" class=\"tab-content\">
                <div class=\"tab-pane active fade in\" id=\"info_common_part\">
				<div class=\"row\">
					<section class=\"col col-2\">
						<label class=\"label\">Mã part&nbsp;<span style=\"color: red\">(*)</span></label>
						<label class=\"input\">
							<i class=\"icon-append fa fa-code\"></i>
							<input type=\"text\" name=\"txt_part_number\" id=\"txt_part_number\" value=\"".trim($objPart->item_number)."\">
						</label>
					</section> 
					<section class=\"col col-2\">
						<label class=\"label\">Mã viettel&nbsp;<span style=\"color: red\">(*)</span></label>
						<label class=\"input\">
							<i class=\"icon-append fa fa-code\"></i>
							<input type=\"text\" name=\"txt_viettel_code\" id=\"txt_viettel_code\" value=\"".trim($objPart->vietelCode)."\">
						</label>
					</section>
					<section class=\"col col-2\">
						<label class=\"label\">Tên part&nbsp;<span style=\"color: red\">(*)</span></label>
						<label class=\"input\">
							<i class=\"icon-append fa fa-gears\"></i>
							<input type=\"text\" name=\"txt_part_name\" id=\"txt_part_name\" value=\"".trim($objPart->name)."\">
						</label>
					</section>
					<section class=\"col col-2\">
						<label class=\"label\">Version&nbsp;<span style=\"color: red\">(*)</span></label>
						<label class=\"input\">
							<i class=\"icon-append fa fa-ge\"></i>
							<input type=\"number\" readonly=\"true\" name=\"txt_version\" id=\"txt_version\" value=\"$objPart->version\">
						</label>
					</section>
					<section class=\"col col-2\">
						<label class=\"label\">Trạng thái&nbsp;<span style=\"color: red\">(*)</span></label>
						<label class=\"select\">
							<select name=\"cbo_status\" id=\"cbo_status\">
								<option value=\"1\">Active</option>
								<option value=\"0\">Deactive</option>
							</select>
						</label>
					</section>
					<section class=\"col col-2\">
						<label class=\"label\">Tình trạng&nbsp;<span style=\"color: red\">(*)</span></label>
						<label class=\"select\">
							<select name=\"cbo_state\" id=\"cbo_state\">
								<option value=\"Preliminary\">Preliminary</option>
								<option value=\"Released\">Released</option>
							</select>
						</label>
					</section>
				</div>
				<!-- Row2 -->
				<div class=\"row\">
					<section class=\"col col-2\">
						<label class=\"label\">Loại part&nbsp;<span style=\"color: red\">(*)</span></label>
						<label class=\"select\">
							<select name=\"cbo_type\" id=\"cbo_type\">
								<option value=\"Assembly\">Assembly</option>
								<option value=\"Component\">Component</option>
								<option value=\"Material\">Material</option>
								<option value=\"Software\">Software</option>
								<option value=\"Electronic\">Electronic</option>
							</select>
						</label>
					</section>
					<section class=\"col col-2\">
						<label class=\"label\">Make/Buy&nbsp;<span style=\"color: red\">(*)</span></label>
						<label class=\"select\">
							<select name=\"cbo_makebuy\" id=\"cbo_makebuy\">
								<option value=\"Make\">Make</option>
								<option value=\"Buy\">Buy</option>	
							</select>
						</label>
					</section>
					<section class=\"col col-2\">
						<label class=\"label\">Đơn vị&nbsp;<span style=\"color: red\">(*)</span></label>
						<label class=\"select\">
							<select name=\"cbo_unit\" id=\"cbo_unit\">
								<option value=\"Chiếc\">Chiếc</option>
							</select>
						</label>
					</section>
					<section class=\"col col-2\">
						<label class=\"label\">Giá</label>
						<label class=\"input\">
							<i class=\"icon-append fa fa-dollar\"></i>
							<input type=\"number\" name=\"txt_price\" id=\"txt_price\" onkeydown=\"return event.keyCode !== 69\" value=\"$objPart->cost\">
						</label>
					</section>
					<section class=\"col col-2\">
						<label class=\"label\">Cân nặng</label>
						<label class=\"input\">
							<i class=\"icon-append fa fa-gears\"></i>
							<input type=\"number\" name=\"txt_weight\" id=\"txt_weight\" onkeydown=\"return event.keyCode !== 69\" value=\"$objPart->weight\">
						</label>
					</section>
					<section class=\"col col-2\">
						<label class=\"label\">Chủng loại</label>
						<label class=\"input\">
							<i class=\"icon-append fa fa-bookmark-o\"></i>
							<input type=\"text\" name=\"txt_category\" id=\"txt_category\" value=\"".trim($objPart->category)."\">
						</label>
					</section>
				</div>
				<!-- Row3 -->
				<div class=\"row\">	
					<section class=\"col col-2\">
						<label class=\"label\">Loại thiết kế</label>
						<label class=\"input\">
							<i class=\"icon-append fa fa-bookmark-o\"></i>
							<input type=\"text\" name=\"txt_external_type\" id=\"txt_external_type\" value=\"".trim($objPart->external_type)."\">
						</label>
					</section>
					<section class=\"col col-2\">
						<label class=\"label\">Chọn nhà sản xuất</label>
						<label class=\"select\">
							<select name=\"cbo_manufacturer\" id=\"cbo_manufacturer\">
								<option value=\"\">Chọn nhà sản xuất</option>";
								$lstManufacturer = getListManufacturer(HOST_API, '*');
								$lstManufacturer = json_decode($lstManufacturer);
								if (is_array($lstManufacturer)) {
									foreach($lstManufacturer as $key => $item) {
										$html.="<option value=\"$item->id\">".$item->name."</option>";
									}
								}
							$html.="</select>
						</label>
					</section>
					<section class=\"col col-2\">
						<label class=\"label\">Chọn đối tác</label>
						<label class=\"select\">
							<select name=\"cbo_vendor\" id=\"cbo_vendor\">
								<option value=\"\">Chọn đối tác</option>";
								$lstVendor = getListVendor(HOST_API, '*');
								$lstVendor = json_decode($lstVendor);
								if (is_array($lstVendor)) {
									foreach($lstVendor as $key => $item) {
										$html.="<option value=\"$item->id\">".$item->name."</option>";
									}
								}
							$html.="</select>
						</label>
					</section>
					<section class=\"col col-2\">
						<label class=\"label\">Ngày hiệu lực</label>
						<label class=\"input\">
							<i class=\"icon-append fa fa-calendar\"></i>
							<input type=\"text\" name=\"txt_effective_date\" id=\"txt_effective_date\" value=\"$effectiveDate\">
						</label>
					</section>
					<section class=\"col col-2\">
						<label class=\"label\">Ngày hoàn thành</label>
						<label class=\"input\">
							<i class=\"icon-append fa fa-calendar\"></i>
							<input type=\"text\" name=\"txt_release_date\" id=\"txt_release_date\" value=\"$releasedDate\">
						</label>
					</section>
					<section class=\"col col-2\">
						<label class=\"label\">Số lượng dự phòng</label>
						<label class=\"input\">
							<i class=\"icon-append fa fa-bookmark-o\"></i>
							<input type=\"number\" name=\"txt_quantity\" id=\"txt_quantity\" value=\"".trim($objPart->quantity)."\">
						</label>
					</section>
				</div>
				<!-- Row4 -->
				<section>
					<label class=\"label\"> <i class=\"icon-append fa fa-lock\"></i>
						<b class=\"tooltip tooltip-bottom-right\">Mô tả</b>
					</label>
					<label class=\"textarea\"><i class=\"icon-append fa fa-edit\"></i><textarea rows=\"4\" name=\"txt_description\" id=\"txt_description\" placeholder=\"Mô tả\">".$objPart->description."</textarea>
					</label>
				</section>
                </div>
            </div>
        </div>
    </fieldset>
    <footer>
        <input type=\"hidden\" name=\"cmd_save\"/>
        <input type=\"hidden\" name=\"txt_id\" value=\"$partId\"/>
        <button type=\"reset\" name=\"reset\" id=\"btn_reset\" class=\"btn btn-success\">
            <i class=\"fa fa-refresh\"></i>&nbsp;Reset
        </button>
        <button type=\"button\" onclick=\"updateInfoPart()\" name=\"i_submit\" id=\"btn_save\" class=\"btn btn-primary\">
            <i class=\"fa fa-save\"></i>&nbsp;Lưu
        </button>
    </footer>
</form>";
echo $html;
?>

<script type="text/javascript">
	$(document).ready(function() {
		$("#cbo_status").select2().select2('val', $("#cbo_status_selected").val());

		$("#cbo_state").select2().select2('val', $("#cbo_state_selected").val());

		$("#cbo_type").select2().select2('val', $("#cbo_type_selected").val());

		$("#cbo_status").select2().select2('val', $("#cbo_status_selected").val());
		
		$("#cbo_makebuy").select2().select2('val', $("#cbo_makebuy_selected").val());
		
		$("#cbo_unit").select2().select2('val', $("#cbo_unit_selected").val());

		$("#cbo_manufacturer").select2().select2('val', $("#cbo_manufacturer_selected").val());

		$("#cbo_vendor").select2().select2('val', $("#cbo_vendor_selected").val());

		// $('#txt_part_number').focusout(function() {
		// 	if ($("#part_number_old").val() !== $(this).val()) {
		// 		$.post("<?php echo ROOTHOST;?>ajaxs/execActionPart.php",{action: 'check_part_number', part_number : $(this).val()},function($rep) {
		// 			if($rep=='exist') {
		// 				$("#txt_part_number").val($("#part_number_old").val());
		// 				smartErrorMsg('Thông báo', 'Mã part đã tồn tại', 5000);
		// 			}
		// 		})
		// 	}
		// })
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
	})
</script>
<style type="text/css">
	#s2id_cbo_status,
	#s2id_cbo_state,
	#s2id_cbo_type,
	#s2id_cbo_makebuy,
	#s2id_cbo_unit,
	#s2id_cbo_manufacturer,
	#s2id_cbo_vendor {
		width: 100%;
	}
</style>