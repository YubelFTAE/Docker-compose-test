<?php
require_once("../../api/apiPart.php");
require_once("../../includes/vt-config.php");
$partId = $_POST['partId'];
$jsonStructBom = getStructBomById(HOST_API, $partId);
$jsonStructBom = json_decode($jsonStructBom);
if (is_object($jsonStructBom)) {
	$jsonStructBom = $jsonStructBom->children;
}

function generatePartBom($objData, $resp, $parId) {
	foreach($objData as $k => $val) {
		$level = $val->level;
		$resp="<tr data-id=\"$val->id\" data-parent=\"$parId\" data-level=\"$level\" p-id=\"$val->id\">
				<td align=\"left\" data-column=\"name\">";
					$resp.="<i class=\"fa fa-gear pink\"></i>&nbsp;".$val->item_number."
				</td>
				<td align=\"left\">".$val->category."</td>
				<td align=\"left\">".$val->external_type."</td>
				<td align=\"left\">".$val->manufacturer."</td>
				<td align=\"left\">".$val->description."</td>
			</tr>";
		echo $resp;
		if (count($val->children) > 0) {
			generatePartBom($val->children, $resp, $val->id);
		}
	}
}
echo "<div role=\"content\">
	<div class=\"widget-body\">
		<table id=\"tree-table\" class=\"table table-hover table-bordered\">
			<thead>			                
				<tr>
					<th width=\"15%\">
						Mã part
					</th>
					<th width=\"10%\">
						Chủng loại
					</th>
					<th width=\"10%\">
						Loại thiết kế
					</th>
					<th width=\"15%\">
						Nhà sản xuất
					</th>
					<th width=\"25%\">
						Mô tả
					</th>
				</tr>
			</thead>
			<tbody class=\"context-menu-struct\">";
				if (is_array($jsonStructBom)) {
					foreach($jsonStructBom as $key => $item) {
						echo "<tr data-id=\"$item->id\" data-level=\"$item->level\" data-parent=\"0\" p-id=\"$item->id\">
							<td align=\"left\" data-column=\"name\">";
								echo "<i class=\"fa fa-gear pink\"></i>&nbsp;".$item->item_number."
							</td>
							<td align=\"left\">".$item->category."</td>
							<td align=\"left\">".$item->external_type."</td>
							<td align=\"left\">".$item->manufacturer."</td>
							<td align=\"left\">".$item->description."</td>
						</tr>";
						if (count($item->children) > 0) {
							generatePartBom($item->children, $resp="", $item->id);
						}
					}
				}
			echo "</tbody>
		</table>
	</div>
</div>";
?>
<script type="text/javascript">	
	$(document).ready(function() {
		$(function() {
			$(".context-menu-struct").contextMenu({
				selector: 'tr',
				callback: function(key, options) {
					var partId = $(this).attr('p-id');
					if (key === 'info') {
						showInfoPart(partId);
					} else if (key === 'version') {
						showListVersion(partId);
					} 
				},
				items: {
					"info": {name: "Chi tiết part", icon: "fa-eye"},
					"version": {name: "Danh sách phiên bản", icon: "fa-gears"}
				}
			});
		});
	});
</script>