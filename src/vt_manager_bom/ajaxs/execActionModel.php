<?php
require_once("../api/apiPart.php");
require_once("../api/apiModel.php");
require_once("../includes/vt-config.php");
$action = "";
if (isset($_POST['action'])) {
	$action = $_POST['action'];
	if ($action == 'delete') {
		$modId = $_POST['mod_id'];
		deleteModel(HOST_API, $modId);

	} else if ($action == 'get_info_part_of_model') {
		$modId = $_POST['mod_id'];
		$rsp = getInfoPartByModelId(HOST_API, $modId);
		$rsp = json_decode($rsp);
		$html="<table id=\"table_basic\" class=\"table table-striped table-bordered table-hover\" width=\"100%\">
			<thead>			                
			<tr>
				<th width=\"10%\">
					Mã part
				</th>
				<th width=\"10%\">
					Phiên bản
				</th>
				<th width=\"10%\">
					Chủng loại
				</th>
				<th width=\"10%\">
					Trạng thái
				</th>
				<th width=\"20%\">
					Mô tả
				</th>
				<th width=\"30%\">
					Vị trí
				</th>
				<th width=\"10%\">
					Giá
				</th>
			</tr>
			</thead>
			<tbody>";
		foreach($rsp as $k => $item) {
			$html.="<tr>
                <td align=\"center\">".$item->item_number."</td>
                <td align=\"center\"><span class=\"badge bg-color-orange\">".$item->version."</span></td>
                <td align=\"left\">".$item->category."</td>
                <td align=\"center\">";if ($item->active == 1) {
                    $html.= "<span class=\"label label-success\">Active</span>";
                } else {
                    $html.= "<span class=\"label label-danger\">Deactive</span>";
                }
                $html.="</td>
                <td align=\"left\">".$item->description."</td>
                <td align=\"left\">".$item->reference_designator."</td>
                <td align=\"center\">".$item->cost."</td>
            </tr>";
		}
		$html.="</tbody></table>";
		echo $html;

	} else if ($action == 'get_model_info') {
		$modId = $_POST['mod_id'];
		$proId = $_POST['pro_id'];
		$tmpData = getListModel(HOST_API, $modId);
		$tmpData = json_decode($tmpData);
		$rsp = $tmpData[0];
		$userId = $_POST['user_id'];
		$html="";
		$html.="
		<form class=\"smart-form\" id=\"form_model_info\" method=\"POST\" novalidate=\"novalidate\" enctype=\"multipart/form-data\" action=\"\">
			<input type=\"hidden\" name=\"action\" value=\"update_info_model\">
			<input type=\"hidden\" name=\"txt_modified_by_id\" id=\"txt_modified_by_id\" value=\"$userId\">
			<input type=\"hidden\" name=\"txt_mod_id\" id=\"txt_mod_id\" value=\"$modId\">
			<input type=\"hidden\" name=\"txt_product_id\" id=\"txt_product_id\" value=\"$proId\">
			<input type=\"hidden\" name=\"id_part_number\" id=\"id_part_number\" value=\"$rsp->id_part_number\">
			<fieldset>
				<div class=\"form-wrapper\">
					<div class=\"tab-pane active fade in\" id=\"info_model\">
						<div class=\"row\">
							<section class=\"col col-3\">
								<label class=\"label\">Mã model&nbsp;<span style=\"color: red\">(*)</span></label>
								<label class=\"input\">
									<i class=\"icon-append fa fa-credit-card\"></i>
									<input type=\"text\" name=\"txt_model_number\" id=\"txt_model_number\" value=\"$rsp->item_number\">
								</label>
							</section>
							<section class=\"col col-3\">
								<label class=\"label\">Tên model&nbsp;<span style=\"color: red\">(*)</span></label>
								<label class=\"input\">
									<i class=\"icon-append fa fa-gears\"></i>
									<input type=\"text\" name=\"txt_model_name\" id=\"txt_model_name\" value=\"$rsp->name\">
								</label>
							</section>
						</div>
						<div class=\"row\">
							<section class=\"col col-3\">
								<label class=\"label\">Version number&nbsp;<span style=\"color: red\">(*)</span></label>
								<label class=\"input\">
									<i class=\"icon-append fa fa-credit-card\"></i>
									<input type=\"number\" name=\"txt_version_number\" onkeydown=\"return event.keyCode !== 69\" id=\"txt_version_number\" value=\"$rsp->version_number\">
								</label>
							</section>
							<section class=\"col col-3\">
								<label class=\"label\">Release number&nbsp;<span style=\"color: red\">(*)</span></label>
								<label class=\"input\">
									<i class=\"icon-append fa fa-gears\"></i>
									<input type=\"number\" name=\"txt_release_number\" onkeydown=\"return event.keyCode !== 69\" id=\"txt_release_number\" value=\"$rsp->release_number\">
								</label>
							</section>
						</div>
						<section>
							<label class=\"label\"> <i class=\"icon-append fa fa-edit\"></i>
								<b class=\"tooltip tooltip-bottom-right\">Mô tả</b>
							</label>
							<label class=\"textarea\"> <i class=\"icon-append fa fa-edit\"></i><textarea rows=\"4\" name=\"txt_description\" id=\"txt_description\" placeholder=\"Mô tả\">".$rsp->description."</textarea>
							</label>
						</section>
					</div>
				</div>
			</fieldset>
		</form>";
		echo $html;

	} else if ($action == 'update_info_model') {
		$modId = $_POST['txt_mod_id'];
		$modifiedDate = date('Y-m-d H:i:s');
		$modifiedDate = str_replace(' ', 'T', $modifiedDate).'.000+0000';
		$jsonPost = array(
			'name' => $_POST['txt_model_name'],
			'item_number' => $_POST['txt_model_number'],
			'version_number' => $_POST['txt_version_number'],
			'release_number' => $_POST['txt_release_number'],
			'description' => $_POST['txt_description'],
			'modified_by_id' => $_POST['txt_modified_by_id'],
			"modified_on" => $modifiedDate,
			'product_id' =>  $_POST['txt_product_id'],
			'id_part_number' =>  $_POST['id_part_number']
		);
		updateInfoModel(HOST_API, $modId, json_encode($jsonPost, JSON_UNESCAPED_UNICODE));	
	}
}
?>