<?php
$lstDocument = getFileOfDocument(HOST_API, $docId);
$lstDocument = json_decode($lstDocument);
?>
<article class="col-sm-12 col-md-12 col-lg-12 sortable-grid ui-sortable">
    <div class="jarviswidget" data-widget-editbutton="false" data-widget-colorbutton="false" data-widget-deletebutton="false" data-widget-togglebutton="false">
        <header role="heading">
            <ul class="nav nav-tabs pull-left in">
                <li class="active">
                    <a data-toggle="tab" href="#list_manufacturer_part" aria-expanded="false"> <i class="fa fa-lg fa-bookmark-o"></i> 
                    <span class="hidden-mobile hidden-tablet">
                        Danh sách file <label style="color:red">[<?php echo getDocNameById(HOST_API, $docId);?>]</label>
                    </span> </a>
                </li>
            </ul>
            <span class="jarviswidget-loader"><i class="fa fa-refresh fa-spin"></i></span></header>
        <!-- widget div-->
        <div role="content">
            <!-- widget content -->
            <div class="widget-body">
                <div class="tab-content">
                    <div class="tab-pane active" id="list_manufacturer_part">
                        <div role="content">
                            <!-- widget content -->
                            <div class="widget-body">
                                <table id="tbl_manufacturer_part" class="table table-striped table-bordered table-hover" width="100%">
                                    <thead>			                
                                        <tr>
                                            <th width="5%">No.</th>
                                            <th width="10%">
                                                Tên file
                                            </th>
                                            <th width="15%">
                                                Size
                                            </th>
                                            <th width="10%">
                                                Hành động
                                            </th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        <?php
                                        $stt = 1;
                                        if (is_array($lstDocument)) {
                                            foreach ($lstDocument as $key => $item) {?>
                                                <tr>
                                                    <td align="center"><?php echo $stt;?></td>
                                                    <td align="left">
                                                        <?php echo $item->fileName?>
                                                    </td>
                                                    <td align="center">
                                                        <?php echo $item->fileSize?>
                                                    </td>
                                                    <td align="center">
                                                        <a title="Xóa" onclick="deleteFileOfDocument('<?php echo $item->id;?>')" href="#" class="btn btn-danger">
                                                            <i class="fa fa-trash-o "></i>
                                                        </a>
                                                        <a title="Xem tài liệu" href="<?php echo ROOTHOST.$item->filePath;?>" target="_blank" class="btn btn-success">
                                                            <i class="fa fa-eye"></i>
                                                        </a>
                                                    </td>
                                                </tr>
                                            <?php $stt++; }	
                                        }
                                        ?>
                                    </tbody>
                                </table>
                            </div>
                            <!-- end widget content -->
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</article>
<script type="text/javascript">
	function deleteFileOfDocument(fileId) {
		smartConfirm('Thông báo', 'Bạn có muốn xóa file này không?', function() {
			$.post("<?php echo ROOTHOST;?>ajaxs/documentFile/execActionFile.php",{action: 'delete_file', file_id: fileId},function($rep){	
				smartInfoMsg('Thông báo', 'Xóa thành công!', 5000);
			})
			setTimeout(function() {
				location.reload();
			}, 1500);
		})
	}
</script>
<style type="text/css">
	table tr {
		height: 26px !important;
		line-height: 26px !important;
	}
	#tbl_manufacturer_part thead th {
		text-align: center;
	}
</style>