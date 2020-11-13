<?php
$lstFiles = getListFile(HOST_API, '*');
$lstFiles = json_decode($lstFiles);
?>
<div aria-hidden="true" aria-labelledby="remoteModalLabel" data-backdrop="static" data-keyboard="false"  role="dialog" tabindex="-1" id="dialog_file_list" class="modal fade" style="display: none; ">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <button aria-hidden="true" data-dismiss="modal" class="close" type="button">
                    ×
                </button>
                <h4 id="myModalLabel" class="modal-title"><i class="fa fa-file-pdf-o"></i><span id="title_dialog">
                	Chọn file từ danh sách
                </span>
            	</h4>
            </div>
            <form class="smart-form ng-untouched ng-pristine ng-valid" id="form_add_file_part" novalidate="novalidate" method="POST" enctype="multipart/form-data">
                <!-- Hidden params -->
                <input type="hidden" name="part_id" id="dlg_file_part_id" value="">
                <input type="hidden" name="created_by_id" id="created_by_id" value="<?php echo $GLOBALS['USERID'];?>">
                <input type="hidden" name="txt_add_from" id="txt_add_from" value="list">
                <input type="hidden" name="txt_id_selected" id="txt_id_selected" value="">
                <!-- The end -->
                <div class="description description-tabs">
                    <ul id="tabPanel" class="nav nav-tabs">
                        <li class="active item_tab" addFrom="list" id="tab_list_files">
                            <a href="#add_files_from_list" data-toggle="tab" class="no-margin" aria-expanded="true" 
                            style="color: #333 !important;">Danh sách file</a>
                        </li>
                        <li class="item_tab" addFrom="file" id="tab_file">
                            <a href="#add_new_file" data-toggle="tab" class="no-margin" aria-expanded="true"
                            style="color: #333 !important;">Thêm mới file</a>
                        </li>
                    </ul>
                    <div id="myTabContent" class="tab-content">
                        <div class="tab-pane active fade in" id="add_files_from_list">
                            <div class="modal-body" style="padding-top:5px;" style="width: 850px;">
                                <div role="content">
                                    <div class="widget-body">
                                        <table id="table_list_files" class="table table-striped table-bordered table-hover tbl_part_list" width="100%">
                                            <thead>                         
                                                <tr>
                                                    <th width="2%">No.</th>
                                                    <th width="3%">
                                                        Chọn
                                                    </th>
                                                    <th width="35%">
                                                        Tên file
                                                    </th>
                                                    <th width="20%">
                                                        Size
                                                    </th>
                                                    <th width="20%">
                                                        Loại tài liệu
                                                    </th>
                                                    <th width="20%">
                                                        Hành động
                                                    </th>
                                                </tr>
                                            </thead>
                                            <tbody>
                                                <?php
                                                $i=1;
                                                if (is_array($lstFiles)) {
                                                    foreach ($lstFiles as $key => $item) { ?>
                                                        <tr>
                                                            <td align="center"><?php echo $i;?></td>
                                                            <td align="center">
                                                                <input type="checkbox" name="chk_file_item" class="chk_file_item" value="<?php echo $item->id;?>">
                                                            </td>
                                                            <td><?php echo $item->fileName;?></td>
                                                            <td align="center"><?php echo $item->fileSize;?></td>
                                                            <td align="left">
                                                                <?php echo getDocNameById(HOST_API, $item->documentId)?>
                                                            </td>
                                                            <td align="center">
                                                                <a title="Xem tài liệu" style="padding: 3px 6px;" href="<?php echo $item->filePath?>" target="_blank" class="btn btn-success">
                                                                    <i class="fa fa-eye"></i>
                                                                </a>
                                                            </td>
                                                        </tr>
                                                    <?php $i++;} 
                                                }
                                                ?>
                                            </tbody>
                                        </table>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="tab-pane fade in" id="add_new_file">
                            <div class="row" style="padding: 15px;">
                                <section class="col col-4">
                                    <label class="select">
                                        <select name="cbo_document" id="cbo_document">
                                            <option value="">Chọn loại tài liệu</option>
                                            <?php
                                                $lstDocument = getListDocument(HOST_API, '*');
                                                $lstDocument = json_decode($lstDocument);
                                                if (is_array($lstDocument)) {
                                                    foreach($lstDocument as $key => $item) {
                                                        echo "<option value=".$item->id.">".$item->name."</option>";
                                                    }
                                                }
                                            ?>
                                        </select><i></i>
                                    </label>
                                </section>
                                <section class="col col-4">
                                    <input type="file" multiple="multiple" name="files[]">
                                    <span class="err" style="color: red; display: none">Bạn chưa chọn file</span>
                                    <span style="color:red">Định dạng cho phép: csv","xls","xlsx","doc", "docx", "pdf", "txt</span>
                                </section>
                            </div>
                        </div>
                    </div>
                </div>
                <footer>
                    <a href="#" class="btn btn-danger" data-dismiss="modal">
                        <i class="fa fa-times-circle"></i> Đóng</a>
                    <a href="#" class="btn btn-success" onclick="addFileForPart()">
                        <i class="fa fa-save"></i> Lưu</a>
                </footer>
            </form>
        </div>
    </div>
</div>

<!-- Javascript -->
<script type="text/javascript">

    $(document).ready(function (e) {
        // event submit form
        $("#form_add_file_part").on('submit',function(e) {
            e.preventDefault();
            $.ajax({
                url: "<?php echo ROOTHOST;?>ajaxs/addFileForPart.php",
                type: "POST",
                data: new FormData(this),
                contentType: false,
                cache: false,
                processData:false,
                success: function(data){
                    $("#dialog_file_list").modal("hide");
                    smartInfoMsg('Thông báo', 'Thành công!', 5000);
                    setTimeout(function() {
                        loadAjaxDataFiles($('#partParentId').val());
                    }, 1000)
                }
            });
        });
        
        // event checked checkbox
        $('.chk_file_item').change(function() {
            var strids = '';
            var objs=document.getElementsByName('chk_file_item');
            for(i=0;i<objs.length;i++) {
                if(objs[i].checked==true)
                    strids+=objs[i].value+",";
            }
            $('#txt_id_selected').val(strids);
        })

        // Set value add part bom from list or file
        $('.item_tab').click(function(){
            var attr = $(this).attr('addFrom');
            $("#txt_add_from").val(attr);
        })
	});
    
    function addFileForPart() {
        var addFrom = $('#txt_add_from').val();
        // add file from list
        if (addFrom == 'list') {
            var fileSelected = $('input[name=chk_file_item].chk_file_item:checked').val();
            if (fileSelected ==  null) {
                smartErrorMsg('Thông báo', 'Bạn chưa chọn file', 5000);
                return;
            }
            $.post("<?php echo ROOTHOST;?>ajaxs/execActionPart.php", {
                    action: 'add_file_for_part', 
                    part_id: $('#partParentId').val(), 
                    file_selected: $("#txt_id_selected").val()
                }, function($rep) {  
                    smartInfoMsg('Thông báo', 'Thành công!', 5000);
                    $("#dialog_file_list").modal("hide");
                    setTimeout(function() {
                        loadAjaxDataFiles($('#partParentId').val());
                    }, 1000)
                }
            )
        } else {
            $("#form_add_file_part").submit();
        }
    }
</script>
<!-- Style -->
<style type="text/css">
    #dialog_file_list .modal-dialog {
        width: 980px;
    }
    #table_list_files thead th {
        text-align: center;
    }
    #table_list_files_wrapper {
        padding: 0 13px;
    }
    #dialog_file_list .dataTables_filter .input-group-addon {
        width: 16px;
        height: 16px;
    }
</style>