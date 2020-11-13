<div aria-hidden="true" aria-labelledby="remoteModalLabel" data-backdrop="static" data-keyboard="false"  role="dialog" tabindex="-1" id="dialog_change_avatar" class="modal fade" style="display: none; ">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <button aria-hidden="true" data-dismiss="modal" class="close" type="button">
                    ×
                </button>
                <h4 id="myModalLabel" class="modal-title"><i class="fa fa-edit"></i><span>
                	Thay đổi ảnh đại diện
                </span></h4>
            </div>
            <div class="modal-body" style="padding-top:0px;">
				<form class="smart-form" id="form_change_avatar" method="POST" novalidate="novalidate" enctype="multipart/form-data">
					<fieldset>
						<section>
							<label class="label">File đính kèm</label>
							<label for="file" class="input input-file">
								<div class="button"><input type="file" multiple="multiple" name="files[]" onchange="this.parentNode.nextSibling.value = this.value">Browse</div><input type="text" placeholder="Chọn file từ máy tính của bạn..." readonly="">
							</label>
						</section>
						<input type="hidden" name="id_user_change_avatar" value="" id="id_user_change_avatar" placeholder="">
					</fieldset>
					<footer>
						<a href="#" onClick="CancelChangeAvatar()" class="btn btn-danger"><i class="fa fa-mail-reply"></i>Hủy</a>
						<a href="#" class="btn btn-primary" id="cmd_submit_upload_avatar"><i class="fa fa-check"></i>Lưu </a>
					</footer>
				</form>		
            </div>
        </div>
    </div>
</div>