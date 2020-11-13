<?php
// get list part
$lstPart = getListParts(HOST_API, '*');
$lstPart = json_decode($lstPart);
?>
<div aria-hidden="true" aria-labelledby="remoteModalLabel" data-backdrop="static" data-keyboard="false"  role="dialog" tabindex="-1" id="dialog_change_part" class="modal fade" style="display: none; ">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <button aria-hidden="true" data-dismiss="modal" class="close" type="button">
                    ×
                </button>
                <h4 id="myModalLabel" class="modal-title"><i class="fa fa-gears"></i><span>
                	Danh sách parts
                </span>
            	</h4>
            </div>
                <div class="modal-body" style="padding-top:5px;" id="content_quick_view" style="width: 850px;">
                    <!-- widget div-->
                    <div role="content">
                        <!-- widget content -->
                        <div class="widget-body">
                            <table id="table_list_parts" class="table table-striped table-bordered table-hover tbl_part_list" width="100%">
                                <thead>                         
                                    <tr>
                                        <th width="2%">No.</th>
                                        <th width="2%">
                                            Chọn
                                        </th>
                                        <th width="10%">
                                            Mã part
                                        </th>
                                        <th width="10%">
                                            Phiên bản
                                        </th>
                                        <th width="10%">
                                            Chủng loại
                                        </th>
                                        <th width="8%">
                                            Trạng thái
                                        </th>
                                        <th width="25%">
                                            Mô tả
                                        </th>
                                        <th width="25%">
                                            Vị trí
                                        </th>
                                        <th width="10%">
                                            Đơn giá
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
                                                    <label class="radio">
                                                        <input type="radio" name="rd_part" class="rd_part" value="<?php echo $item->id;?>">
                                                        <i></i>
                                                    </label>
                                                </td>
                                                <td align="left"><?php echo $item->item_number;?></td>
                                                <td align="center"><?php
                                                    echo "<span class=\"badge bg-color-orange\">".$item->version."</span>";
                                                ?></td>
                                                <td align="left"><?php echo $item->category;?></td>
                                                <td align="center"><?php 
                                                    if ($item->active == 1) {
                                                        echo "<span class=\"label label-success\">Active</span>";
                                                    } else {
                                                        echo "<span class=\"label label-danger\">Deactive</span>";
                                                    }
                                                ?></td>
                                                <td align="left"><?php echo $item->description;?></td>
                                                <td align="left"><?php echo $item->reference_designator;?></td>
                                                <td align="left"><?php echo $item->cost;?></td>
                                            </tr>
                                        <?php $i++;} 
                                    }
                                    ?>
                                </tbody>
                            </table>
                        </div>
                        <!-- end widget content -->
                        
                    </div>
                    <!-- end widget div --> 
                </div>
                <form class="smart-form">
                    <input type="hidden" name="model_id" id="model_id" value="">
                    <footer>
                        <a href="#" class="btn btn-danger" data-dismiss="modal">
                            <i class="fa fa-times-circle"></i> Đóng</a>
                        <a href="#" class="btn btn-success" onclick="actionChangePartForModel()">
                            <i class="fa fa-save"></i> Lưu</a>
                    </footer>
                </form>
        </div>
    </div>
</div>

<!-- Javascript -->
<script type="text/javascript">
    function actionChangePartForModel() {
        var partSelected = $('input[name=rd_part].rd_part:checked').val();
        if (partSelected ==  null) {
            smartErrorMsg('Thông báo', 'Bạn chưa chọn part!', 5000);
            return;
        }
        var modelId = $('#model_id').val();
        smartConfirm('Thông báo', 'Bạn có chắc chắn muốn thay đổi part của model hay không?', function() {
            $.post("<?php echo ROOTHOST;?>ajaxs/execActionProduct.php",{action: 'change_part', model_id: modelId, part_id: partSelected},function($rep){  
                smartInfoMsg('Thông báo', 'Thay đổi part thành công!', 5000);
                $("#dialog_change_part").modal("hide");
                setTimeout(function() {
                    location.reload();
                }, 1000)
            })
        })
    }
</script>
<!-- Style -->
<style type="text/css">
    #dialog_change_part .modal-dialog {
        width: 1280px;
    }
    #table_list_parts thead th {
        text-align: center;
    }
    .rd_part:hover {
        cursor: pointer;
    }
    .rd_part {
        width: 18px;
        height: 18px;
    }
</style>