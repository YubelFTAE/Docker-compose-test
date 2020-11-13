<?php
$lstManufacturerPart = getPartOfManu(HOST_API, $manuId);
$lstManufacturerPart = json_decode($lstManufacturerPart);
?>
<article class="col-sm-12 col-md-12 col-lg-12 sortable-grid ui-sortable">
    <div class="jarviswidget" data-widget-editbutton="false" data-widget-colorbutton="false" data-widget-deletebutton="false" data-widget-togglebutton="false">
        <header role="heading">
            <ul class="nav nav-tabs pull-left in">
                <li class="active">
                    <a data-toggle="tab" href="#list_manufacturer_part" aria-expanded="false"> <i class="fa fa-lg fa-bookmark-o"></i> 
                    <span class="hidden-mobile hidden-tablet">
                        Danh sách part nhà SX <label style="color:red">[<?php echo getManuNameById(HOST_API, $manuId);?>]</label>
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
                                            <th width="15%">
                                                Mã part
                                            </th>                    
                                            <th width="15%">
                                                Tên part
                                            </th>
                                            <th width="10%">
                                                Trạng thái
                                            </th>
                                            <th width="10%">
                                                Version
                                            </th>
                                            <th width="10%">
                                                Giá
                                            </th>
                                            <th width="10%">
                                                Đơn vị
                                            </th>
                                           
                                        </tr>
                                    </thead>
                                    <tbody>
                                        <?php
                                        $stt = 1;
                                        if (is_array($lstManufacturerPart)) {
                                            foreach ($lstManufacturerPart as $key => $item) {?>
                                                <tr>
                                                    <td align="center"><?php echo $stt;?></td>
                                                    <td align="center">
                                                        <?php echo $item->item_number?>
                                                    </td>                                                   
                                                    <td>
                                                        <?php echo $item->name?>
                                                    </td>
                                                    <td align="center">
                                                        <?php echo $item->active == 1 ? "<span class=\"label label-success\">Active</span>" : "<span class=\"label label-danger\">Deactive</span>";?>
                                                    </td>
                                                    <td align="center">
                                                        <?php echo $item->version?>
                                                    </td>
                                                    <td align="center">
                                                        <?php echo $item->cost?>
                                                    </td>
                                                    <td align="center">
                                                        <?php echo $item->unit?>
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
	function deletePartOfManufacturer(partId) {
		smartConfirm('Thông báo', 'Bạn có muốn xóa part của nhà sản xuất này không?', function() {
			$.post("<?php echo ROOTHOST;?>ajaxs/execActionPart.php",{action: 'delete', part_id: partId},function($rep){	
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