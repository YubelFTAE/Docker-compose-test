<div aria-hidden="true" aria-labelledby="remoteModalLabel" data-backdrop="static" data-keyboard="false"  role="dialog" tabindex="-1" id="dialog_info_model" class="modal fade">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <button aria-hidden="true" data-dismiss="modal" class="close" type="button">
                    ×
                </button>
                <h4 id="myModalLabel" class="modal-title"><i class="fa fa-edit"></i><span>
                    Chỉnh sửa thông tin model
                </span></h4>
            </div>
            <div class="modal-body" style="padding-top:0px;">
            	<div id="model_info_content"></div>
				<div class="smart-form">
					<footer>
						<a href="#" data-dismiss="modal" class="btn btn-danger"><i class="fa fa-times-circle"></i> Đóng</a>
                        <button type="button" onclick="submitUpdatInfoModel()" name="i_submit" id="i_submit" class="btn btn-primary">
                            <i class="fa fa-save "></i>&nbsp;Lưu
                        </button>
					</footer>
				</div>		
            </div>
        </div>
    </div>
</div>
<style type="text/css">
#dialog_info_model .modal-dialog {
    width: 980px;
}
#table_basic thead th {
    text-align: center;
}
</style>