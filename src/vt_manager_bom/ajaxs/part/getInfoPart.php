<?php
require_once("../../api/apiPart.php");
require_once("../../api/apiManufacturer.php");
require_once("../../api/apiVendor.php");
require_once("../../api/apiCommon.php");
require_once("../../includes/vt-config.php");
$partId = isset($_POST['part_id']) ? $_POST['part_id'] : 0;
//  call api get part by id
$resp = getListParts(HOST_API, $partId);
// echo $resp;
$arrData = json_decode($resp);
if (!is_array($arrData)) {
	echo null;
	return;
}
$objPart = count($arrData) > 0 ? $arrData[0] : null;
$releasedDate =  date('Y-m-d', strtotime($objPart->release_date));
$effectiveDate =  date('Y-m-d', strtotime($objPart->effective_date));

// =================================================================

$html="";
if ($objPart == null ) {
    echo $html; 
    return;
}
$html.="
    <ul>
        <li><label class=\"title\"><i class=\"fa fa-caret-right\"></i>&nbsp;Mã part:&nbsp;</label><span><strong style=\"color: red\">".$objPart->item_number."</strong></span></li>
        <li><label class=\"title\"><i class=\"fa fa-caret-right\"></i>&nbsp;Tên part:&nbsp;</label><span>".$objPart->name."</span></li>
        <li><label class=\"title\"><i class=\"fa fa-caret-right\"></i>&nbsp;Phiên bản:&nbsp;</label><span class=\"badge bg-color-orange\">".$objPart->version."</span></li>
        <li><label class=\"title\"><i class=\"fa fa-caret-right\"></i>&nbsp;Trạng thái:&nbsp;</label><span>";
            if ($objPart->active == 1) {
                $html.= "<span class=\"label label-success\">Active</span>";
            } else {
                $html.= "<span class=\"label label-danger\">Deactive</span>";
            }
        $html.="</span></li>
        <li><label class=\"title\"><i class=\"fa fa-caret-right\"></i>&nbsp;Giá:&nbsp;</label><span>".$objPart->cost."</span></li>
        <li><label class=\"title\"><i class=\"fa fa-caret-right\"></i>&nbsp;Cân nặng:&nbsp;</label><span>".$objPart->weight."</span></li>
        <li><label class=\"title\"><i class=\"fa fa-caret-right\"></i>&nbsp;Số lượng:&nbsp;</label><span>".$objPart->quantity."</span></li>
        <li><label class=\"title\"><i class=\"fa fa-caret-right\"></i>&nbsp;Chủng loại:&nbsp;</label><span>".$objPart->category."</span></li>
        <li><label class=\"title\"><i class=\"fa fa-caret-right\"></i>&nbsp;Loại thiết kế:&nbsp;</label><span>".$objPart->external_type."</span></li>
        <li><label class=\"title\"><i class=\"fa fa-caret-right\"></i>&nbsp;Nhà sản xuất:&nbsp;</label><span>".getManuNameById(HOST_API, $objPart->manufacturer_id)."</span></li>
        <li><label class=\"title\"><i class=\"fa fa-caret-right\"></i>&nbsp;Đối tác:&nbsp;</label><span>".getVendorNameById(HOST_API, $objPart->vendorId)."</span></li>
        <li><label class=\"title\"><i class=\"fa fa-caret-right\"></i>&nbsp;Vị trí:&nbsp;</label><span>".$objPart->reference_designator."</span></li>
        <li><label class=\"title\"><i class=\"fa fa-caret-right\"></i>&nbsp;Ngày hiệu lực:&nbsp;</label><span>".$effectiveDate."</span></li>
        <li><label class=\"title\"><i class=\"fa fa-caret-right\"></i>&nbsp;Ngày hoàn thành:&nbsp;</label><span>".$releasedDate."</span></li>
        <li><label class=\"title\"><i class=\"fa fa-caret-right\"></i>&nbsp;Người tạo:&nbsp;</label><span>".getNameById(HOST_API, $objPart->created_by_id)."</span></li>
        <li><label class=\"title\"><i class=\"fa fa-caret-right\"></i>&nbsp;Ngày tạo:&nbsp;</label><span>".date('d-m-Y', strtotime($objPart->created_on))."</span></li>
        <li><label class=\"title\"><i class=\"fa fa-caret-right\"></i>&nbsp;Mô tả:&nbsp;</label><span>".$objPart->description."</span></li>
    </ul>
    ";
echo $html;
?>
<style>
.title {
    font-weight: bold;
}
ul {
    list-style: none;
    padding: 0;
    margin: 0;
}
ul li {
    padding: 5px 10px;
}
</style>
