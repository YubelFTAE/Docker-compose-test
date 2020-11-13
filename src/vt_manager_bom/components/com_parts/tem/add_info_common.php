<?php
class objPart {
	public $id = null;
	public $partName = null;
	public $partNumber = null;
	public $viettelCode = null;
	public $version = 1;
	public $active = 1;
	public $state = 'Preliminary';
	public $type = 'Assembly';
	public $makeBuy = 'Make';
	public $price = 0;
	public $weight = 0;
	public $quantity = 1;
	public $unit = 'Chiếc';
	public $majorRev = null;
	public $category = 'CAPACITOR';
	public $externalType = 'CAPACITOR';
	public $manufacturer = null;
	public $vendor = null;
	public $effectiveDate = null;
	public $releaseDate = null;
	public $description = null;
}
$objPart = new objPart();

$infoPart = null;
if (isset($partId)) {
	$infoPart = getListParts(HOST_API, $partId);
	$infoPart = json_decode($infoPart);
}

if (is_array($infoPart) && count($infoPart)>0) {
	$objPart->id = $infoPart[0]->id;
	$objPart->partName = $infoPart[0]->name;
	$objPart->partNumber = $infoPart[0]->item_number;
	$objPart->viettelCode = $infoPart[0]->viettelCode;
	$objPart->version = $infoPart[0]->version;
	$objPart->state = $infoPart[0]->state;
	$objPart->active = $infoPart[0]->active;
	$objPart->type = $infoPart[0]->classification;
	$objPart->makeBuy = $infoPart[0]->make_by;
	$objPart->price = $infoPart[0]->cost;
	$objPart->weight = $infoPart[0]->weight;
	$objPart->unit = $infoPart[0]->unit;
	$objPart->quantity = $infoPart[0]->quantity;
	$objPart->majorRev = $infoPart[0]->major_rev;
	$objPart->category = $infoPart[0]->category;
	$objPart->externalType = $infoPart[0]->external_type;
	$objPart->manufacturer = $infoPart[0]->manufacturer;
	$objPart->vendor = $infoPart[0]->vendor;
	$objPart->effectiveDate = date('Y-m-d', strtotime($infoPart[0]->effective_date));
	$objPart->releaseDate = date('Y-m-d', strtotime($infoPart[0]->release_date));
	$objPart->description = $infoPart[0]->description;
}
?>
<!-- Hidden value -->
<div class="row">
	<input type="hidden" id="cbo_state_selected" value="<?php echo $objPart->state?>"/>
	<input type="hidden" id="cbo_type_selected" value="<?php echo $objPart->type?>"/>
	<input type="hidden" id="cbo_status_selected" value="<?php echo $objPart->active?>"/>
	<input type="hidden" id="cbo_makebuy_selected" value="<?php echo $objPart->makeBuy?>"/>
	<input type="hidden" id="cbo_unit_selected" value="<?php echo $objPart->unit?>"/>
	<input type="hidden" id="cbo_manufacturer_selected" value="<?php echo $objPart->manufacturer?>"/>
	<input type="hidden" id="cbo_vendor_selected" value="<?php echo $objPart->vendor?>"/>
</div>

<Strong>Loại bom </Strong><select id="parttype" name="parttype" onchange="changePartType();">
	<option value="Bom Điện Tử">Bom Điện Tử</option>
	<option value="Bom Cơ Khí">Bom Cơ Khí</option>
</select>

<!-- Row1 -->
<div class="row">
	<section class="col col-2">
		<label class="label">Mã part&nbsp;<span style="color: red">(*)</span></label>
		<label class="input">
			<i class="icon-append fa fa-code"></i>
			<input type="text" name="txt_part_number" id="txt_part_number" value="<?php echo $objPart->partNumber;?>">
		</label>
	</section>
	<section class="col col-2">
		<label class="label">Mã viettel&nbsp;</label>
		<label class="input">
			<i class="icon-append fa fa-code"></i>
			<input type="text" name="txt_viettel_code" id="txt_viettel_code" value="<?php echo $objPart->viettelCode;?>">
		</label>
	</section>
	<section class="col col-2">
		<label class="label">Tên part&nbsp;<span style="color: red">(*)</span></label>
		<label class="input">
			<i class="icon-append fa fa-gears"></i>
			<input type="text" name="txt_part_name" id="txt_part_name" value="<?php echo $objPart->partName;?>">
		</label>
	</section>
	<section class="col col-2">
		<label class="label">Version&nbsp;<span style="color: red">(*)</span></label>
		<label class="input">
			<i class="icon-append fa fa-ge"></i>
			<input type="number" readonly="true" name="txt_version" id="txt_version" value="<?php echo $objPart->version;?>">
		</label>
	</section>
	<section class="col col-2 disablefield">
		<label class="label">Trạng thái&nbsp;<span style="color: red">(*)</span></label>
		<label class="select">
			<select name="cbo_status" id="cbo_status">
				<option value="1">Active</option>
				<option value="0">Deactive</option>
			</select>
		</label>
	</section>
	<section class="col col-2 disablefield">
		<label class="label">Tình trạng&nbsp;<span style="color: red">(*)</span></label>
		<label class="select">
			<select name="cbo_state" id="cbo_state">
				<option value="Preliminary">Preliminary</option>
				<option value="Released">Released</option>
			</select>
		</label>
	</section>
</div>
<!-- Row2 -->
<div class="row">
	<section class="col col-2">
		<label class="label">Loại part&nbsp;<span style="color: red">(*)</span></label>
		<label class="select">
			<select name="cbo_type" id="cbo_type">
				<option value="Assembly">Assembly</option>
				<option value="Component">Component</option>
				<option value="Material">Material</option>
				<option value="Software">Software</option>
				<option value="Electronic">electronic</option>
			</select>
		</label>
	</section>
	<section class="col col-2 disablefield">
		<label class="label">Make/Buy&nbsp;<span style="color: red">(*)</span></label>
		<label class="select">
			<select name="cbo_makebuy" id="cbo_makebuy">
				<option value="Make">Make</option>
				<option value="Buy">Buy</option>	
			</select>
		</label>
	</section>
	<section class="col col-2">
		<label class="label">Đơn vị&nbsp;<span style="color: red">(*)</span></label>
		<label class="select">
			<select name="cbo_unit" id="cbo_unit">
				<option value="Chiếc">Chiếc</option>
			</select>
		</label>
	</section>
	<section class="col col-2 disablefield">
		<label class="label">Giá</label>
		<label class="input">
			<i class="icon-append fa fa-dollar"></i>
			<input type="number" name="txt_price" id="txt_price" onkeydown="return event.keyCode !== 69" value="<?php echo $objPart->price;?>">
		</label>
	</section>
	<section class="col col-2 disablefield">
		<label class="label">Cân nặng</label>
		<label class="input">
			<i class="icon-append fa fa-gears"></i>
			<input type="number" name="txt_weight" id="txt_weight" onkeydown="return event.keyCode !== 69" value="<?php echo $objPart->weight;?>">
		</label>
	</section>
	<section class="col col-2">
		<label class="label">Chủng loại</label>
		<label class="input">
			<i class="icon-append fa fa-bookmark-o"></i>
			<input type="text" name="txt_category" id="txt_category" value="<?php echo $objPart->category;?>">
		</label>
	</section>
</div>
<!-- Row3 -->
<div class="row">
	
	<section class="col col-2 disablefield">
		<label class="label">Loại thiết kế</label>
		<label class="input">
			<i class="icon-append fa fa-bookmark-o"></i>
			<input type="text" name="txt_external_type" id="txt_external_type" value="<?php echo $objPart->externalType;?>">
		</label>
	</section>
	<section class="col col-2 disablefield">
		<label class="label">Chọn nhà sản xuất</label>
		<label class="select">
			<select name="cbo_manufacturer" id="cbo_manufacturer">
				<option value="">Chọn nhà sản xuất</option>
				<?php
					$lstManufacturer = getListManufacturer(HOST_API, '*');
					$lstManufacturer = json_decode($lstManufacturer);
					if (is_array($lstManufacturer)) {
						foreach($lstManufacturer as $key => $item) {
							echo "<option value=".$item->id.">".$item->name."</option>";
						}
					}
				?>
			</select>
		</label>
	</section>
	<section class="col col-2 disablefield">
		<label class="label">Chọn đối tác</label>
		<label class="select">
			<select name="cbo_vendor" id="cbo_vendor">
				<option value="">Chọn đối tác</option>
				<?php
					$lstVendor = getListVendor(HOST_API, '*');
					$lstVendor = json_decode($lstVendor);
					if (is_array($lstVendor)) {
						foreach($lstVendor as $key => $item) {
							echo "<option value=".$item->id.">".$item->name."</option>";
						}
					}
				?>
			</select>
		</label>
	</section>
	<section class="col col-2">
		<label class="label">Ngày hiệu lực</label>
		<label class="input">
			<i class="icon-append fa fa-calendar"></i>
			<input type="text" name="txt_effective_date" id="txt_effective_date" value="<?php echo $objPart->effectiveDate;?>">
		</label>
	</section>
	<section class="col col-2">
		<label class="label">Ngày hoàn thành</label>
		<label class="input">
			<i class="icon-append fa fa-calendar"></i>
			<input type="text" name="txt_release_date" id="txt_release_date"  value="<?php echo $objPart->releaseDate;?>">
		</label>
	</section>
	<section class="col col-2">
		<label class="label" id="label_quantity">Số lượng dự phòng</span></label>
		<label class="input">
			<i class="icon-append fa fa-bookmark-o"></i>
			<input type="number" name="txt_quantity" id="txt_quantity"  onkeydown="return event.keyCode !== 69" value="<?php echo $objPart->quantity;?>">
		</label>
	</section> 
</div>
<!-- Row4 -->
<section>
	<label class="label"> <i class="icon-append fa fa-lock"></i>
        <b class="tooltip tooltip-bottom-right">Mô tả</b>
    </label>
    <label class="textarea"> <i class="icon-append fa fa-edit"></i><textarea rows="4" name="txt_description" id="txt_description" placeholder="Ghi chú"><?php echo $objPart->description;?></textarea>
    </label>
</section>
<!-- Script -->
<script type="text/javascript">
	$(document).ready(function() {
		$("#cbo_state").select2().select2('val', $("#cbo_state_selected").val());

		$("#cbo_type").select2().select2('val', $("#cbo_type_selected").val());

		$("#cbo_status").select2().select2('val', $("#cbo_status_selected").val());
		
		$("#cbo_makebuy").select2().select2('val', $("#cbo_makebuy_selected").val());
		
		$("#cbo_unit").select2().select2('val', $("#cbo_unit_selected").val());

		$("#cbo_manufacturer").select2().select2('val', $("#cbo_manufacturer_selected").val());

		$("#cbo_vendor").select2().select2('val', $("#cbo_vendor_selected").val());
		
		// event focusout txt part number
		$('#txt_part_number').focusout(function() {
			$.post("<?php echo ROOTHOST;?>ajaxs/execActionPart.php",{action: 'check_part_number', part_number : $(this).val()},function($rep) {
	            if($rep == 'exist') {
	            	$("#txt_part_number").val('');
	            	smartErrorMsg('Thông báo', 'Mã part đã tồn tại', 5000);
	            }
	        })
		})
	})

	function changePartType() {
		if($("#parttype").val() == "Bom Cơ Khí") {
			$("#label_quantity").text("Số lượng")
			$(".disablefield").each(function( index ,element) {
				$(element).hide();
			});
		}else{
			$("#label_quantity").text("Số lượng dự phòng")
			$(".disablefield").each(function( index ,element) {
				$(element).show();
			});
		}
		
	}
</script>
<style type="text/css">
	#s2id_cbo_state,
	#s2id_cbo_type,
	#s2id_cbo_makebuy,
	#s2id_cbo_unit,
	#s2id_cbo_status,
	#s2id_cbo_manufacturer,
	#s2id_cbo_vendor {
		width: 100%;
	}
</style>
