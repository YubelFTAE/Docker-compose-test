<?php
require_once("../../api/apiFile.php");
require_once("../../api/apiDocument.php");
require_once("../../includes/vt-config.php");
$partId = $_POST['partId'];
$lstFilesPart = getListFileByPartId(HOST_API, $str="?part_id=".$partId);
$lstFilesPart = json_decode($lstFilesPart);

$html="";
$html.="<div role=\"content\">
	<div class=\"smart-form\">
		<footer>
			<button type=\"button\" class=\"btn btn-danger\" onclick=\"deletedFileOfPart($partId)\">
				<i class=\"fa fa-trash-o\"></i>&nbsp; Xóa
			</button>
			<button type=\"button\" class=\"btn btn-primary\" onclick=\"dialogAddFileForPart($partId)\">
				<i class=\"fa fa-plus-circle\"></i>&nbsp; Thêm
			</button>
		</footer>
	</div>
	<div class=\"widget-body\">
		<table id=\"tbl_document_list\" class=\"table table-striped table-bordered table-hover\" width=\"100%\">
			<thead>			                
				<tr>
					<th width=\"2%\">No.</th>
					<th width=\"2%\">
						Chọn
					</th>
					<th width=\"25%\">
						Loại tài liệu
					</th>
					<th width=\"30%\">
						Tên file
					</th>
					<th width=\"15%\">
						Size
					</th>
					<th width=\"20%\">
						Hành động
					</th>
				</tr>
			</thead>
			<tbody>";
				$stt = 1;
				if (is_array($lstFilesPart)) {
					foreach ($lstFilesPart as $key => $item) {
						$html.="<tr>
							<td align=\"center\">".$stt."</td>
							<td align=\"center\">
								<label class=\"checkbox\">
									<input type=\"checkbox\" name=\"chk_file_del\" class=\"chk_file_del\" value=\"$item->id\">
									<i></i>
								</label>
							</td>
							<td align=\"left\">
								".getDocNameById(HOST_API, $item->documentId)."
							</td>
							<td>
								".$item->fileName."
							</td>
							<td align=\"left\">
								".$item->fileSize."
							</td>
							<td align=\"center\">
								<a title=\"Xem tài liệu\" href=\"$item->filePath\" target=\"_blank\" class=\"btn btn-success\">
									<i class=\"fa fa-eye\"></i>
								</a>
							</td>
						</tr>";
					$stt++; }
				}
			$html.="</tbody>
		</table>
	</div>
</div>
";
echo $html;
?>

<script type="text/javascript">
	// show dialog add file for part
	function dialogAddFileForPart(partId) {
		$('input:checkbox').removeAttr('checked');
		$("#dialog_file_list").modal("show");
		$("#dlg_file_part_id").val(partId);
	}
	// delete file of parrt
	function deletedFileOfPart(partId) {
		if (isSelectedFileItem()) {
			var objs=document.getElementsByName('chk_file_del');
			var strids = '';
			for(i=0;i<objs.length;i++) {
				if(objs[i].checked==true)
					strids+=objs[i].value+",";
			}
			smartConfirm('Thông báo', 'Bạn có muốn xóa tài liệu của part không?', function() {
				$.post("<?php echo ROOTHOST;?>ajaxs/documentFile/execActionFile.php",{action: 'delete_file_of_part', part_id: partId, strids: strids},function($rep){	
					smartInfoMsg('Thông báo', 'Xóa thành công!', 5000);
					var callbacks = $.Callbacks( "unique memory" );
					callbacks.add(loadAjaxDataFiles(partId));
					callbacks.add(loadPageFunc());
				})
			})
		}
	}
	// check is selected file del
	function isSelectedFileItem() {
		var fileSelected = $('input[name=chk_file_del].chk_file_del:checked').val();
        if (fileSelected ==  null) {
            smartErrorMsg('Thông báo', 'Bạn chưa chọn file cần xóa', 5000);
            return false;
        }
		return true;
	}
	// THE END TAB FILE
</script>