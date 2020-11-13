<ul>
	<li>	
		<a href="#" aria-expanded="false">
			<i class="fa fa-lg fa-fw fa-cog"></i>
			<span class="menu-item-parent">Quản Lý Sản Phẩm</span>
		</a>
		<ul>
		    <li class="<?php if(isset($_GET['viewtype']) && $_GET['viewtype'] == 'mgmt_products') echo 'active'?>">
		        <a href="<?php echo ROOTHOST?>mgmt_products" title="Danh sách sản phẩm">
		            <i class="fa fa-lg fa-cog"></i><span class="menu-item-parent">&nbsp;Danh Sách Sản Phẩm</span>
		        </a>
		    </li>
		    <li class="<?php if(isset($_GET['viewtype']) && $_GET['viewtype'] == 'add_products') echo 'active'?>">
		        <a href="<?php echo ROOTHOST?>add_products" title="Thêm sản phẩm">
		            <i class="fa fa-lg fa-edit"></i>
		            <span class="menu-item-parent">&nbsp;Thêm Sản Phẩm</span>
		        </a>
		    </li>
		    <li class="<?php if(isset($_GET['viewtype']) && $_GET['viewtype'] == 'mgmt_models') echo 'active'?>">
		        <a href="<?php echo ROOTHOST?>mgmt_models" title="Danh sách models">
		            <i class="fa fa-lg fa-hdd-o"></i>
		            <span class="menu-item-parent">&nbsp;Danh Sách Model</span>
		        </a>
		    </li>
		</ul>
	</li>

	<li>	
		<a href="#" aria-expanded="false">
			<i class="fa fa-lg fa-fw fa-gears"></i>
			<span class="menu-item-parent">&nbsp;Quản Lý Part</span>
		</a>
		<ul>
		    <li class="<?php if(isset($_GET['viewtype']) && $_GET['viewtype'] == 'mgmt_parts') echo 'active'?>">
		        <a href="<?php echo ROOTHOST?>mgmt_parts" title="Danh sách parts">
		            <i class="fa fa-lg fa-gears"></i>
		            <span class="menu-item-parent">&nbsp;Danh Sách Part</span>
		        </a>
		    </li>
		    <li class="<?php if(isset($_GET['viewtype']) && $_GET['viewtype'] == 'add_parts') echo 'active'?>">
		        <a href="<?php echo ROOTHOST?>add_parts" title="Thêm mới parts">
					<i class="fa fa-plus-circle"></i>
		            <span class="menu-item-parent">&nbsp;Thêm Part</span>
		        </a>
		    </li>
		</ul>
	</li>
	<li class="<?php if(isset($_GET['viewtype']) && $_GET['viewtype'] == 'document') echo 'active'?>">	
		<a href="<?php echo ROOTHOST?>document" aria-expanded="false">
			<i class="fa fa-lg fa-fw fa-file-pdf-o"></i>
			<span class="menu-item-parent">&nbsp;Quản Lý Tài Liệu</span>
		</a>
	</li>
	<li>
		<a href="#" aria-expanded="false">
			<i class="fa fa-lg fa-fw fa-paw"></i>
			<span class="menu-item-parent">&nbsp;Sourcing</span>
		</a>
		<ul>
		    <li class="<?php if(isset($_GET['viewtype']) && $_GET['viewtype'] == 'manufacturer') echo 'active'?>">
		        <a href="<?php echo ROOTHOST;?>manufacturer" title="Nhà sản xuất">
		            <i class="fa fa-lg fa-home"></i>
		            <span class="menu-item-parent">&nbsp;Nhà Sản Xuất</span>
		        </a>
		    </li>
		    <li class="<?php if(isset($_GET['viewtype']) && $_GET['viewtype'] == 'vendor') echo 'active'?>">
		        <a href="<?php echo ROOTHOST;?>vendor" title="Thêm mới parts">
		            <i class="fa fa-lg fa-user"></i>
		            <span class="menu-item-parent">&nbsp;Đối Tác</span>
		        </a>
		    </li>
		</ul>
	</li>
	<li>
		<a href="#" aria-expanded="true">
			<i class="fa fa-lg fa-fw fa-paw"></i>
			<span class="menu-item-parent">&nbsp;Quản Lý Phân Quyền</span>
		</a>
		<ul>
		    <li class="<?php if(isset($_GET['viewtype']) && $_GET['viewtype'] == 'account_list') echo 'active'?>">
		        <a href="<?php echo ROOTHOST?>account_list" title="Tài khoản người dùng">
		            <i class="fa fa-lg fa-user"></i><span class="menu-item-parent">&nbsp;Tài Khoản Người Dùng</span>
		        </a>
		    </li>
		    <li class="<?php if(isset($_GET['viewtype']) && 
		    	$_GET['viewtype'] == 'group_list') echo 'active'?>">
		        <a href="<?php echo ROOTHOST?>group_list" title="Nhóm người dùng">
		            <i class="fa fa-lg fa-group"></i>
		            <span class="menu-item-parent">&nbsp;Nhóm Người Dùng</span>
		        </a>
		    </li>
		    <li class="<?php if(isset($_GET['viewtype']) && $_GET['viewtype'] == 'department_list') echo 'active'?>">
		        <a href="<?php echo ROOTHOST?>department_list" title="Quản lý phòng ban đơn vị">
		            <i class="fa fa-lg fa-home"></i>
		            <span class="menu-item-parent">&nbsp;Quản Lý Phòng Ban</span>
		        </a>
		    </li>
		</ul>
	</li>
	<li class="<?php if(isset($_GET['viewtype']) && $_GET['viewtype'] == 'mgmt_logs') echo 'active'?>">	
		<a href="#" aria-expanded="false">
			<i class="fa fa-lg fa-fw fa-clock-o"></i>
			<span class="menu-item-parent">&nbsp;Quản Lý Logs</span>
		</a>
	</li>
	<li class="<?php if(isset($_GET['viewtype']) && $_GET['viewtype'] == 'mgmt_api') echo 'active'?>">	
		<a href="#" aria-expanded="false">
			<i class="fa fa-lg fa-fw fa-sitemap"></i>
			<span class="menu-item-parent">&nbsp;API Integate</span>
		</a>
	</li>
	<li>	
		<a href="<?php echo ROOTHOST?>logout" aria-expanded="false">
			<i class="fa fa-lg fa-fw fa-sign-out"></i>
			<span class="menu-item-parent">&nbsp;Đăng xuất</span>
		</a>
	</li>
</ul>
<style type="text/css">
	#header {
		/*position: fixed;
		width: 100%;*/
	}
	#left-panel {
		background: #00918d;
	}
	nav ul li a {
		padding: 15px 5px 10px 10px;
	}
	nav ul ul li>a {
		padding-top: 10px !important;
		padding-bottom: 10px !important;
	}
	nav ul li a,
	nav ul ul li>a {
		color: #fff;

	}
	/*#header>:first-child, aside {
		width: 250px;
	}
	#main {
		margin-left: 250px;
	}
	.hidden-menu #main {
		margin-left: 40px;
	}*/
	/*.page-footer {
		padding-left: 250px;
	}*/
	.login-info a {
		color: #fff;
	}
	.login-info {
		border-bottom: 1px solid #ccc;
		border-right: 1px dotted #fff;
	}
	#ribbon,
	.page-footer {
		background: #00918d;
	}
	.minifyme {
		background: #fff;
		border-bottom: none;
	}
	nav ul li.active {
	    background: #ccc;
	}
	nav ul li.active a {
		color: #333 !important;
	}
	.minified nav>ul>li {
		border-bottom: 1px solid #ccc;
	}
	nav>ul>li>a b {
		top: 15px;
	}
</style>