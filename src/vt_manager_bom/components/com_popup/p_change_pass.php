<div aria-hidden="true" aria-labelledby="remoteModalLabel" data-backdrop="static" data-keyboard="false"  role="dialog" tabindex="-1" id="dialog_change_pass" class="modal fade">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <button aria-hidden="true" data-dismiss="modal" class="close" type="button">
                    ×
                </button>
                <h4 id="myModalLabel" class="modal-title"><i class="fa fa-edit"></i><span>
                	Thay đổi mật khẩu
                </span></h4>
            </div>
            <div class="modal-body" style="padding-top:0px;">
				<form class="smart-form" id="form_change_pass" method="POST" novalidate="novalidate" enctype="multipart/form-data">
					<fieldset>
						<section>
							<label class="label">Nhập mật khẩu cũ</label>
							<label class="input">
								<i class="icon-append fa fa-lock"></i>
								<input placeholder="Mật khẩu cũ" type="password" name="old_pass"  id="old_pass" value="">
							</label>
						</section>
						<section>
							<label class="label">Nhập mật khẩu mới</label>
							<label class="input">
								<i class="icon-append fa fa-lock"></i>
								<input placeholder="Mật khẩu mới" type="password" name="new_pass"  id="new_pass" value="">
							</label>
						</section>
						<section>
							<label class="label">Nhập lại mật khẩu</label>
							<label class="input">
								<i class="icon-append fa fa-lock"></i>
								<input placeholder="Mật khẩu mới" type="password" name="re_new_pass"  id="re_new_pass" value="">
							</label>
						</section>

						<input type="hidden" name="id_user_change" value="" id="id_user_change" placeholder="">
					</fieldset>
					
					<footer>
						
						<a href="#" data-dismiss="modal" class="btn btn-danger"><i class="fa fa-times-circle"></i> Đóng</a>
						<a href="#" onClick="DoChangePass()" class="btn btn-primary"><i class="fa fa-check"></i> Lưu</a>
		            				
					</footer>
					
				</form>		
            </div>
        </div>
    </div>
</div>