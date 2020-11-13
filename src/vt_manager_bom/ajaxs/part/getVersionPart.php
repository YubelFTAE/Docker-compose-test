<?php
require_once("../../api/apiPart.php");
require_once("../../api/apiManufacturer.php");
require_once("../../api/apiVendor.php");
require_once("../../api/apiCommon.php");
require_once("../../includes/vt-config.php");
$partId = isset($_POST['part_id']) ? $_POST['part_id'] : 0;
$resp = getVersionPart(HOST_API, $partId);
$arrData = json_decode($resp);
$html="";
if ($arrData == null ) {
    echo $html; 
    return;
}
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
        foreach($arrData as $k => $item) {
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
?>
