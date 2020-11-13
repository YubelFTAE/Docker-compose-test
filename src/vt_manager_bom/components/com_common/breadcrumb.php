<ol class="breadcrumb">
	<li class="parent">
		<i class="fa fa-home"></i>&nbsp;Trang chủ</li>
	<?php if (isset($_GET['viewtype'])) :
		$viewtype = $_GET['viewtype'];
		switch ($viewtype) {
			case 'dashboard':
				echo "<li>Danh sách linh kiện</li>";
				break;
			case 'account_list':
				echo "<li class=\"parent\">Quản lý phân quyền</li>";
				echo "<li>Tài khoản người dùng</li>";
				break;
			case 'group_list':
				echo "<li class=\"parent\">Quản lý phân quyền</li>";
				echo "<li>Nhóm người dùng</li>";
				break;
			case 'mgmt_function':
				echo "<li class=\"parent\">Quản lý phân quyền</li>";
				echo "<li>Quản lý chức năng</li>";
				break;
			case 'mgmt_products':
				echo "<li>Quản lý sản phẩm</li>";
				break;
			case 'add_products':
				echo "<li>Thêm mới sản phẩm</li>";
				break;
			case 'mgmt_models':
				echo "<li>Quản lý model</li>";
				break;
			case 'add_models':
				echo "<li>Thêm mới model</li>";
				break;
			case 'mgmt_parts':
				echo "<li>Quản lý part</li>";
				break;
			case 'add_parts':
				echo "<li>Thêm mới part</li>";
				break;
			case 'mgmt_documents':
				echo "<li>Quản lý tài liệu</li>";
				break;
			case 'mgmt_logs':
				echo "<li>Quản lý log</li>";
				break;
			case 'mgmt_api':
				echo "<li>Quản lý api</li>";
				break;
			default:
				echo "<li>Danh sách linh kiện</li>";
				break;
		}
	?>
    <?php endif;?>
</ol>
<style type="text/css" scoped="true">
	#ribbon .breadcrumb, #ribbon .breadcrumb a {
		color: #fff !important;
	}
	#ribbon .breadcrumb li:last-child, #ribbon .breadcrumb>.active {
		color: yellow !important;
	}
</style>
