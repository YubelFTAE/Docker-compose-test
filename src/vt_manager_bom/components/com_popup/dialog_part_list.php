<?php
// get list part
$lstPart = getListParts(HOST_API, '*');
$lstPart = json_decode($lstPart);
?>
<div aria-hidden="true" aria-labelledby="remoteModalLabel" data-backdrop="static" data-keyboard="false"  role="dialog" tabindex="-1" id="dialog_part_list" class="modal fade" style="display: none; ">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <button aria-hidden="true" data-dismiss="modal" class="close" type="button">
                    ×
                </button>
                <h4 id="myModalLabel" class="modal-title"><i class="fa fa-gears"></i><span id="title_dialog">
                	Chọn part bom từ danh sách
                </span>
            	</h4>
            </div>
            <form class="smart-form ng-untouched ng-pristine ng-valid" id="form-add-part" novalidate="novalidate" method="POST" enctype="multipart/form-data">
                <!-- Hidden params -->
                <input type="hidden" name="part_id" id="part_id" value="">
                <input type="hidden" name="created_by_id" id="created_by_id" value="<?php echo $GLOBALS['USERID'];?>">
                <input type="hidden" name="txt_id_selected" id="txt_id_selected" value="">
                <input type="hidden" name="txt_add_from" id="txt_add_from" value="list">
                <input type="hidden" name="txt_relationship" id="txt_relationship" value="">
                <!-- The end -->
                <div class="description description-tabs">
                    <ul id="tabPanel" class="nav nav-tabs">
                        <li class="active item_tab" addFrom="list" id="tab_list_part">
                            <a href="#add_part_bom_list" data-toggle="tab" class="no-margin" aria-expanded="true" 
                            style="color: #333 !important;">Danh sách part</a>
                        </li>
                        <li class="item_tab" addFrom="file" id="tab_file">
                            <a href="#add_part_bom_file" data-toggle="tab" class="no-margin" aria-expanded="true"
                            style="color: #333 !important;">Thêm từ file</a>
                        </li>
                    </ul>
                    <div id="myTabContent" class="tab-content">
                        <div class="tab-pane active fade in" id="add_part_bom_list">
                            <div class="modal-body" style="padding-top:5px;" style="width: 850px;">
                                <div role="content">
                                    <div class="widget-body">
                                        <table id="table_list_parts" class="table table-striped table-bordered table-hover tbl_part_list" width="100%">
                                            <thead>                         
                                                <tr>
                                                    <th width="3%">No.</th>
                                                    <th width="2%">
                                                        Chọn
                                                    </th>
                                                    <th width="25%">
                                                        Mã part
                                                    </th>
                                                    <th width="10%">
                                                        Chủng loại
                                                    </th>
                                                    <th width="10%">
                                                        Version
                                                    </th>
                                                    <th width="20%">
                                                        Nhà sản xuất
                                                    </th>
                                                    <th width="30%">
                                                        Mô tả
                                                    </th>
                                                </tr>
                                            </thead>
                                            <tbody>
                                                <?php
                                                $i=1;
                                                if (is_array($lstPart)) {
                                                    foreach ($lstPart as $key => $item) { ?>
                                                        <tr>
                                                            <td align="center"><?php echo $i;?></td>
                                                            <td align="center">
                                                                <input type="checkbox" name="chk_part_item" class="chk_part_item" value="<?php echo $item->id;?>">
                                                            </td>
                                                            <td align="left"><?php echo $item->item_number;?></td>
                                                            <td><?php echo $item->category;?></td>
                                                            <td><?php echo $item->version;?></td>
                                                            <td align="left"><?php echo $item->manufacturer;?></td>
                                                            <td align="left"><?php echo $item->description;?></td>
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
                        <div class="tab-pane fade in" id="add_part_bom_file">
                            <section style="padding: 15px;">
                                <label class="label"><b>Chọn file</b> <span style="color: red">(*) Định dạng .excel</span></label>
                                <input type="file" multiple="multiple" name="files[]" accept=".csv, application/vnd.openxmlformats-officedocument.spreadsheetml.sheet, application/vnd.ms-excel">
                                <span class="err" style="color: red; display: none">Bạn chưa chọn file</span>
                            </section>
                        </div>
                    </div>
                </div>
                <footer>
                    <a href="#" class="btn btn-danger" data-dismiss="modal">
                        <i class="fa fa-times-circle"></i> Đóng</a>
                    <a href="#" class="btn btn-success" onclick="addPartBomForPart()">
                        <i class="fa fa-save"></i> Lưu</a>
                </footer>
            </form>
        </div>
    </div>
</div>

<!-- Javascript -->
<script type="text/javascript">
    $(document).ready(function (e) {
        // event submit form add part from files BOM MAU
        $("#form-add-part").on('submit',function(e) {
            var partId = $('#part_id').val();
            var relationship = $("#txt_relationship").val();
            e.preventDefault();
            $.ajax({
                url: "<?php echo ROOTHOST;?>ajaxs/addPartFromFile.php",
                type: "POST",
                data: new FormData(this),
                contentType: false,
                cache: false,
                processData:false,
                success: function(data){
                    $("#dialog_part_list").modal("hide");
                    smartInfoMsg('Thông báo', 'Thành công!', 5000);
                    setTimeout(function() {
                        console.log(partId + '--' + relationship);
                        var callbacks = $.Callbacks( "unique memory" );
                        if (relationship == 0) {
                            callbacks.add(loadPartBom(partId));
                            callbacks.add(loadStructBom(partId));
                        } else if (relationship == 1) {
                            callbacks.add(loadPartAlternate(partId));
                        } else {
                            callbacks.add(loadPartBuy(partId));
                        }
                    }, 1000)
                }
            });
        });
        
        // event checked checkbox
        $('.chk_part_item').change(function() {
            var strids = '';
            var objs=document.getElementsByName('chk_part_item');
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
    
    function addPartBomForPart() {
        var addFrom = $('#txt_add_from').val();
        // case add part from list
        if (addFrom == 'list') {
            var partSelected = $('input[name=chk_part_item].chk_part_item:checked').val();
            var relationship = $("#txt_relationship").val();
            var partId = $('#part_id').val();
            if (partSelected ==  null) {
                smartErrorMsg('Thông báo', 'Bạn chưa chọn part', 5000);
                return;
            }
            $.post("<?php echo ROOTHOST;?>ajaxs/execActionPart.php", {
                    action: 'add_part', 
                    relationship: relationship, 
                    part_id: partId,
                    part_selected: $("#txt_id_selected").val()
                }, function($rep) {  
                    smartInfoMsg('Thông báo', 'Thành công!', 5000);
                    $("#dialog_part_list").modal("hide");
                    setTimeout(function() {
                        var callbacks = $.Callbacks( "unique memory" );
                        if (relationship == 0) {
                            callbacks.add(loadPartBom(partId));
                            callbacks.add(loadStructBom(partId));
                        } else if (relationship == 1) {
                            callbacks.add(loadPartAlternate(partId));
                        } else {
                            callbacks.add(loadPartBuy(partId));
                        }
                    }, 1000)
                }
            )
        } 
        else {
            // case add part from file BOM_MAU
            $("#form-add-part").submit();
        }
    }
</script>
<!-- Style -->
<style type="text/css">
    #dialog_part_list .modal-dialog {
        width: 1024px;
    }
    #table_list_parts thead th {
        text-align: center;
    }
    #table_list_parts_wrapper {
        padding: 0 13px;
    }
    #dialog_part_list .dataTables_filter .input-group-addon {
        width: 16px;
        height: 16px;
    }
</style>