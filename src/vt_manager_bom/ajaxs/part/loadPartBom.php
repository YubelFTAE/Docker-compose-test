<?php
require_once("../../api/apiPart.php");
require_once("../../includes/vt-config.php");
$partId = $_POST['partId'];
$lstPartBom = getListPartRelationShip(HOST_API, $str="?part_id=".$partId."&type=".PART_BOM);
$lstPartBom = json_decode($lstPartBom);
    
$html="
<div role=\"content\">
	<div class=\"smart-form\">
		<footer>
			<button type=\"button\" class=\"btn btn-danger\" onclick=\"deletePartRelation(".PART_BOM.")\">
				<i class=\"fa fa-trash-o\"></i>&nbsp; Xóa
			</button>
			<button type=\"button\" class=\"btn btn-primary\" onclick=\"showListPart(".PART_BOM.", $partId)\">
				<i class=\"fa fa-plus-circle\"></i>&nbsp; Thêm
			</button>
		</footer>
	</div>
	<div class=\"widget-body\">
		<table id=\"tbl_list_part_bom\" class=\"table table-striped table-bordered table-hover\" width=\"100%\">
			<thead>			                
				<tr>
					<th width=\"3%\">No.</th>
					<th width=\"2%\">
						Chọn
					</th>
					<th width=\"15%\">
						Mã part
					</th>
					<th width=\"10%\">
						Chủng loại
					</th>
					<th width=\"10%\">
						Số lượng
					</th>
					<th width=\"10%\">
						Đơn vị
					</th>
					<th width=\"50%\">
						Vị trí
					</th>
				</tr>
			</thead>
			<tbody>";
				$stt = 1;
				if (is_array($lstPartBom)) {
					foreach ($lstPartBom as $key => $item) {
						$html.="<tr>
							<td align=\"center\">".$stt."</td>
							<td align=\"center\">
								<label class=\"checkbox\" style=\"margin-top:0px;\">
									<input type=\"checkbox\" name=\"chk_pbom_del\" class=\"chk_pbom_del\" value=\"$item->id\">
									<i></i>
								</label>
							</td>
							<td>
								".$item->item_number."
							</td>
							<td align=\"center\">
								".$item->category."
							</td>
							<td align=\"center\">
								<div class=\"change_quantity_$item->id\">
									<div style=\"display: inline-flex\"><span class=\"quantity_$item->id\">$item->quantity</span></div>
									<div style=\"display: inline-flex; float: right\"><a href=\"#\" onclick=\"showBlockChangeQuantity($item->id)\">Sửa</a></div>
								</div>
								<div class=\"save_quantity_$item->id\" style=\"display: none\">
									<div style=\"display: inline-flex; width: 50%; float: left\">
										<input style=\"width: 80%;\" type=\"number\" value=\"$item->quantity\" class=\"quantity_change_$item->id\"/>
									</div>
									<div style=\"display: inline-flex; float: right\"><a href=\"#\" onclick=\"updateQuantity($item->id,$partId)\">Lưu</a></div>
								</div>
							</td>
							<td align=\"center\">
								".$item->unit."
							</td>
							<td>
								<div class=\"change_location_$item->id\">
									<div style=\"display: inline-flex\"><span class=\"location_$item->id\">$item->reference_designator</span></div>
									<div style=\"display: inline-flex; float: right\"><a href=\"#\" onclick=\"showBlockChangeLocation($item->id)\">Sửa</a></div>
								</div>
								<div class=\"save_location_$item->id\" style=\"display: none\">
									<div style=\"display: inline-flex; width: 50%; float: left\">
										<textarea style=\"width: 80%;\" class=\"location_change_$item->id\">$item->reference_designator</textarea>
									</div>
									<div style=\"display: inline-flex; float: right\"><a href=\"#\" onclick=\"updateLocation($item->id,$partId)\">Lưu</a></div>
								</div>
							</td>
						</tr>";
					$stt++; }	
				}
			$html.="</tbody>
		</table>
	</div>
</div>";
echo $html;