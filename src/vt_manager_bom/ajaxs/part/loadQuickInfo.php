<?php
require_once("../../api/apiPart.php");
require_once("../../api/apiCommon.php");
require_once("../../includes/vt-config.php");
$partId = $_POST['partId'];
$resp = getListParts(HOST_API, $partId);
$resp = json_decode($resp);
if (!is_array($resp)) {
    echo null;
    return;
}
$thisObject =  count($resp) > 0 ? $resp[0] : null;
$effectiveDate = null;
$releasedDate = null;
if (strpos($thisObject->effective_date, '1970-01-01') === false) {
    $effectiveDate = date('d-m-Y', strtotime($thisObject->effective_date));
}
if (strpos($thisObject->release_date, '1970-01-01') === false) {
    $releasedDate = date('d-m-Y', strtotime($thisObject->release_date));
}
$html="<table>
        <tr>
            <td><label class=\"lbl_text\">Người tạo: </label></td>
            <td>
                <span class=\"right_info\">
                    ".getNameById(HOST_API, $thisObject->created_by_id)."
                </span>
            </td>
        </tr>
        <tr>
            <td><label class=\"lbl_text\">Ngày tạo: </label></td>
            <td><span class=\"right_info\">
                ".date('d-m-Y', strtotime($thisObject->created_on))."
            </span></td>
        </tr>
        <tr>
            <td><label class=\"lbl_text\">Người chỉnh sửa: </label></td>
            <td><span class=\"right_info\">
                ".getNameById(HOST_API, $thisObject->modified_by_id)."
            </span></td>
        </tr>
        <tr>
            <td><label class=\"lbl_text\">Ngày sửa: </label></td>
            <td><span class=\"right_info\">
                ".date('d-m-Y', strtotime($thisObject->modified_on))."
            </span></td>
        </tr>
        <tr>
            <td><label class=\"lbl_text\">Version: </label></td>
            <td><span class=\"right_info\">
                ".$thisObject->version."
            </span></td>
        </tr>
        <tr>
            <td><label class=\"lbl_text\">Ngày release: </label></td>
            <td><span class=\"right_info\">
                ".$releasedDate."
            </span></td>
        </tr>
        <tr>
            <td><label class=\"lbl_text\">Ngày hiệu lực: </label></td>
            <td><span class=\"right_info\">
                ".$effectiveDate."
            </span></td>
        </tr>
</table>";
echo $html;