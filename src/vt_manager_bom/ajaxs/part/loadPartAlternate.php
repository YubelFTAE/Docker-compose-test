<?php
require_once("../../api/apiPart.php");
require_once("../../includes/vt-config.php");
$partId = $_POST['partId'];
$lstPartAlternate = getListPartRelationShip(HOST_API, $str="?part_id=".$partId."&type=".PART_ALTERNATE);
$lstPartAlternate = json_decode($lstPartAlternate);
    
$html="
<div role=\"content\">
	<div class=\"smart-form\">
		<footer>
			<button type=\"button\" class=\"btn btn-danger\" onclick=\"deletePartRelation(".PART_ALTERNATE.")\">
				<i class=\"fa fa-trash-o\"></i>&nbsp; Xóa
			</button>
			<button type=\"button\" class=\"btn btn-primary\" onclick=\"showListPart(".PART_ALTERNATE.", $partId)\">
				<i class=\"fa fa-plus-circle\"></i>&nbsp; Thêm
			</button>
		</footer>
	</div>
	<div class=\"widget-body\">
		<table id=\"tbl_list_part_alternate\" class=\"table table-striped table-bordered table-hover\" width=\"100%\">
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
				if (is_array($lstPartAlternate)) {
					foreach ($lstPartAlternate as $key => $item) {
						$html.="<tr>
							<td align=\"center\">".$stt."</td>
							<td align=\"center\">
								<label class=\"checkbox\">
									<input type=\"checkbox\" name=\"chk_palternate_del\" class=\"chk_palternate_del\" value=\"$item->id\">
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
								".$item->quantity."
							</td>
							<td align=\"center\">
								".$item->unit."
							</td>
							<td>
								".$item->reference_designator."
							</td>
						</tr>";
					$stt++; }	
				}
			$html.="</tbody>
		</table>
	</div>
</div>";
echo $html;