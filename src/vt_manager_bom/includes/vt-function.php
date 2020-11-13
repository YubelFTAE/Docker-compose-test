<?php
function paging($total_rows,$max_rows,$cur_page){
	$max_pages=ceil($total_rows/$max_rows);
	$start=$cur_page-5; if($start<1)$start=1;
	$end=$cur_page+5;	if($end>$max_pages)$end=$max_pages;
	$paging='<div class="paging">
	<form action="" method="post" name="frmpaging" id="frmpaging">
	<input type="hidden" name="txtCurnpage" id="txtCurnpage" value="1" />';
	$paging.="<strong>Total:</strong> $total_rows <strong>on</strong> $max_pages <strong>page</strong><br>";
	if($cur_page >1)
	$paging.='<a href="javascript:gotopage('.($cur_page-1).')"> << </a>';
	if($max_pages>1){
		for($i=$start;$i<=$end;$i++)
		{
			if($i!=$cur_page)
			$paging.="<a href=\"javascript:gotopage($i)\"> $i </a>";
			else
			$paging.="<a href=\"#\" class=\"cur_page\"> $i </a>";
		}
	}
	if($cur_page <$max_pages)
	$paging.='<a href="javascript:gotopage('.($cur_page+1).')"> >> </a>';
	$paging.='</div></form>';
	echo $paging;
}
function paging_index($total_rows,$max_rows,$cur_page){
	$max_pages=ceil($total_rows/$max_rows);
	$start=$cur_page-5; if($start<1)$start=1;
	$end=$cur_page+5;	if($end>$max_pages)$end=$max_pages;
	$paging='<div class="paging">
	<form action="" method="post" name="frmpaging" id="frmpaging">
	<input type="hidden" name="txtCurnpage" id="txtCurnpage" value="'.$cur_page.'" />';
	if($cur_page >1)
		$paging.='<a href="javascript:gotopage('.($cur_page-1).')" class="cur_page"> < </a>';
	if($max_pages>1){
		for($i=$start;$i<=$end;$i++)
		{
			if($i!=$cur_page)
			$paging.="<a href=\"javascript:gotopage($i)\"> $i </a>";
			else
		      $paging.="<a href=\"#\" class=\"cur_page\" > $i </a>";
		}
	}
	if($cur_page <$max_pages)
		$paging.='<a href="javascript:gotopage('.($cur_page+1).')"> > </a>';
	$paging.='</form></div>';
	echo $paging;
}
function un_unicode($str){
	$marTViet=array(
	'à','á','ạ','ả','ã','â','ầ','ấ','ậ','ẩ','ẫ','ă',
	'ằ','ắ','ặ','ẳ','ẵ','è','é','ẹ','ẻ','ẽ','ê','ề'
	,'ế','ệ','ể','ễ',
	'ì','í','ị','ỉ','ĩ',
	'ò','ó','ọ','ỏ','õ','ô','ồ','ố','ộ','ổ','ỗ','ơ'
	,'ờ','ớ','ợ','ở','ỡ',
	'ù','ú','ụ','ủ','ũ','ư','ừ','ứ','ự','ử','ữ',
	'ỳ','ý','ỵ','ỷ','ỹ',
	'đ',
	'A','B','C','D','E','F','J','G','H','I','K','L','M',
	'N','O','P','Q','R','S','T','U','V','W','X','Y','Z',
	'À','Á','Ạ','Ả','Ã','Â','Ầ','Ấ','Ậ','Ẩ','Ẫ','Ă'
	,'Ằ','Ắ','Ặ','Ẳ','Ẵ',
	'È','É','Ẹ','Ẻ','Ẽ','Ê','Ề','Ế','Ệ','Ể','Ễ',
	'Ì','Í','Ị','Ỉ','Ĩ',
	'Ò','Ó','Ọ','Ỏ','Õ','Ô','Ồ','Ố','Ộ','Ổ','Ỗ','Ơ'
	,'Ờ','Ớ','Ợ','Ở','Ỡ',
	'Ù','Ú','Ụ','Ủ','Ũ','Ư','Ừ','Ứ','Ự','Ử','Ữ',
	'Ỳ','Ý','Ỵ','Ỷ','Ỹ',
	'Đ',",","?","`","~","!","@","#","$","%","^","&","*","(",")","'",'"','&','/','|','   ','  ',' ','---','--');

	$marKoDau=array('a','a','a','a','a','a','a','a','a','a','a',
	'a','a','a','a','a','a',
	'e','e','e','e','e','e','e','e','e','e','e',
	'i','i','i','i','i',
	'o','o','o','o','o','o','o','o','o','o','o','o'
	,'o','o','o','o','o',
	'u','u','u','u','u','u','u','u','u','u','u',
	'y','y','y','y','y',
	'd',
	'a','b','c','d','e','f','j','g','h','i','k','l','m',
	'n','o','p','q','r','s','t','u','v','w','x','y','z',
	'a','a','a','a','a','a','a','a','a','a','a','a'
	,'a','a','a','a','a',
	'e','e','e','e','e','e','e','e','e','e','e',
	'i','i','i','i','i',
	'o','o','o','o','o','o','o','o','o','o','o','o'
	,'o','o','o','o','o',
	'u','u','u','u','u','u','u','u','u','u','u',
	'y','y','y','y','y',
	'd',"","","","","","","","","","","","",'','','','','','','',' ',' ','-','-','-');

	$str = str_replace($marTViet, $marKoDau, $str);
	return $str;
}
?>