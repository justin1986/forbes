<?php	
	define(CURRENT_DIR, dirname(__FILE__) ."/");
	define(ROOT_DIR_NONE, dirname(__FILE__));	
	define(ROOT_DIR,CURRENT_DIR);
	require('config/config.php');
	include_once(CURRENT_DIR ."lib/pubfun.php");
	include_once(CURRENT_DIR ."lib/database_connection_class.php");
	include_once(CURRENT_DIR ."lib/database_connection_mssql_class.php");
	include_once(CURRENT_DIR ."lib/table_class.php");
	include_once(CURRENT_DIR ."lib/category_class.php");
	include_once(CURRENT_DIR ."lib/table_images_class.php");
	include_once(CURRENT_DIR ."lib/upload_file_class.php");
	require_once CURRENT_DIR ."lib/image_handler_class.php";
	if(file_exists(ROOT_DIR ."inc/project_pubfun.php")){
		require_once CURRENT_DIR ."inc/project_pubfun.php";
	}
	
	function get_config($var,$path=''){
		if(empty($path)){$path = LIB_PATH .'../config/config.php';}
		include_once($path);
		global $$var;
		return $$var;
	}	
	
	function &get_db() {
		global $g_db;
		if(!is_object($g_db)){
			if(get_config('db_type') == 'mssql'){
				$g_db = new database_connection_mssql_class();
			}else
			{
				$g_db = new database_connection_class();
			}
			
		}
		if($g_db->connected) return $g_db;
		$servername = get_config('db_server_name');
		$dbname = get_config('db_database_name');
		$username = get_config('db_user_name');
		$password = get_config('db_password');
		$code = get_config('db_code');
		$note_emails = "chenlong@xun-ao.com, sunyoujie@xun-ao.com, shengzhifeng@xun-ao.com, zhanghao@xun-ao.com";
		if($g_db->connect($servername,$dbname,$username,$password,$code)===false){			
			$last_time = file_get_contents(dirname(__FILE__) .'/config/last_disconnect.txt');
			
			if($last_time == ''){				
				write_to_file(dirname(__FILE__) .'/config/last_disconnect.txt',now(),'w');
				@mail($note_emails,'数据库连接失败','主备数据库均无法连接，请立即检查'.$this->servername);
				
			}
			/*
			$servername = get_config('db_server_name_bak');
			$dbname = get_config('db_database_name_bak');
			$username = get_config('db_user_name_bak');
			$password = get_config('db_password_bak');
			$code = get_config('db_code_bak');
			if($g_db->connect($servername,$dbname,$username,$password,$code)===false){
				
			}
			*/
		};	
		return $g_db;	
	}
	
	function close_db() {
		$db = &get_db();
		$db->close();
	}
	
	function use_jquery(){
		js_include_once_tag('jquery');
	}
	
	function use_jquery_ui(){
		js_include_once_tag('jquery');
		js_include_once_tag('jquery-ui');	
		css_include_tag('jquery_ui');
	
	}
	
	function validate_form($form_name) {
		js_include_once_tag('jquery');
		js_include_once_tag('jquery.validate');
		?>
		<script>
			$(function(){
				$("#<?php echo $form_name;?>").validate();
			});
		</script>
		<?php
	}
	function js_include_tag($js){
		if (func_num_args()>1) {
			foreach (func_get_args() as $v){
				js_include_tag($v);
			}
			return ;
		}
		$js = _get_js_file($js);
		echo '<script type="text/javascript" language="javascript" src="' .$js .'"></script>';		
	}
	function _get_js_file($js){
		if (strtolower($js) == "default") {
			return ROOT_PATH ."javascript/jquery.js";		
		}else {		
			$ljs = strtolower($js);
			if (strpos($ljs, "http://") !== false || strpos($ljs,"www.") !== false) {	
				return $js;		
			}else {
				if (substr($ljs,-3) == ".js"){$js = substr_replace($js,"",-3);}			
				return  ROOT_PATH ."javascript/" .$js .".js";			
			}		
		}	
	}
#only include once
	function js_include_once_tag($js){
		global $loaded_js;
		if (empty($loaded_js)){
			$loaded_js = array();
		}
		if (func_num_args()>1) {
			foreach (func_get_args() as $v){
				js_include_once_tag($v);
			}
			return ;
		}
		$js_name = _get_js_file($js);
		if (in_array($js_name,$loaded_js,false)) {
			return ;
		}else {
			$loaded_js[] = $js_name;
			js_include_tag($js);
		}
	}
	
	function css_include_tag($filename){
		if (func_num_args()>1) {
			foreach (func_get_args() as $v){
				css_include_tag($v);
			}
			return ;
		}
		$css_name = _get_css_file($filename);	
		echo '<link href="' .$css_name .'" rel="stylesheet" type="text/css">';	
	}
	
	function _get_css_file($filename){
		$ljs = strtolower($filename);
		if (strpos($ljs, "http://") !== false || strpos($ljs,"www.") !== false) {	
			return $ljs;				
		}else {
			if (substr($ljs,-4) == ".css"){$filename = substr_replace($filename,"",-4);}			
			$ljs = ROOT_PATH ."css/" .$filename .".css";			
		}
		return $ljs;
	}
	
	function css_include_once_tag($filename){
		global $loaded_css;
		if (empty($loaded_css)){
			$loaded_css = array();
		}
		if (func_num_args()>1) {
			foreach (func_get_args() as $v){
				css_include_once_tag($v);
			}
			return ;
		}
		$f = _get_css_file($filename);
		if (in_array($f,$loaded_css,false)) {	
			return ;	
		}else {
			$loaded_css[] = $f;
			css_include_tag($filename);
		}
	}	
	

	function judge_role(){
		return require_role('admin');
	}
	
	function show_fckeditor($name,$toolbarset='Admin',$expand_toolbar=true,$height="200",$value="",$width = null) {
		include_once(ROOT_DIR . 'ckeditor/ckeditor_php5.php');
		include_once(ROOT_DIR . 'ckfinder/ckfinder.php');
		$editor = new CKEditor(ROOT_DIR . 'ckeditor');
		$editor->config['toolbar'] = $toolbarset;
		$editor->config['toolbarStartupExpanded'] = $expand_toolbar;
		$editor->config['height'] = $height;
		CKFinder::SetupCKEditor($editor, '/ckfinder/');
		if($width){
			$editor->config['width'] = $width;
		}
		$editor->editor($name,$value);
	}

function paginate($url="",$ajax_dom=null,$page_var="page",$force_show = false)
{
	global $page_type;
	$pageindextoken = empty($page_var) ? "page" : $page_var;
	$record_count_token = $pageindextoken . "_record_count";	

	$pagecounttoken = $pageindextoken . "_page_count";

	global $$pagecounttoken;
	global $$record_count_token;
	$pageindex = isset($_REQUEST[$pageindextoken]) ? $_REQUEST[$pageindextoken] : 1;
	$pagecount = isset($_REQUEST[$pagecounttoken]) ? $_REQUEST[$pagecounttoken] : $$pagecounttoken;
	if ($pagecount <= 1 && !$force_show) return;
	if(empty($url)){
		$url = $_SERVER['PHP_SELF'] ."?";
	}
	$turl = $_SERVER['PHP_SELF'];
	$pattern = '/(.+)\.php$/';
	if($page_type=='static' && !preg_match($pattern,$turl)){
		$url = $_SERVER['PHP_SELF'];
		$pattern = '/(.+)\/page\/(\d+)/';
		if(preg_match($pattern,$url)){
			$url = preg_replace($pattern,'$1',$url);
		}
		$pagefirst = $url . "/page/1";
		$pagenext = $url ."/page/" .($pageindex + 1);
		$pageprev = $url ."/page/" .($pageindex-1);
		$pagelast = $url ."/page/" .($pagecount);
		
	}else{
		parse_str($_SERVER['QUERY_STRING'], $params);
		unset($params[$pageindextoken]);
		
		foreach ($params as $k => $v) {
			$url .= "&" .$k . "=" . urlencode($v);
		}
		$pagefirst = $url . "&$pageindextoken=1";
		$pagenext = $url ."&$pageindextoken=" .($pageindex + 1);
		$pageprev = $url ."&$pageindextoken=" .($pageindex-1);
		$pagelast = $url ."&$pageindextoken=" .($pagecount);
	}
	
	
	if ($pageindex == 1 || $pageindex ==null || $pageindex == "")
	{?>
	  <span>[首页]</span> 
	  <span>[上页]</span>	
	  <?php 
	  	if($pagecount > 1){
	  ?>
	  <span><a class="paginate_link" href="<?php echo $pagenext; ?>">[下页]</a></span> 
	  <span><a class="paginate_link" href="<?php echo $pagelast; ?>">[尾页]</a></span>
	  <?php }else{?>
	  <span>[下页]</span> 
	  <span>[尾页]</span>		  
	<?php	
	  }
	}
	if ($pageindex < $pagecount && $pageindex > 1 )
	{?>
	  <span><a class="paginate_link" href="<?php echo $pagefirst; ?>">[首页]</a></span> 
	  <span><a class="paginate_link" href="<?php echo $pageprev; ?>">[上页]</a></span>			
	  <span><a class="paginate_link" href="<?php echo $pagenext; ?>">[下页]</a></span> 
	  <span><a class="paginate_link" href="<?php echo $pagelast; ?>">[尾页]</a></span>		
	 <?php
	}
	if ($pageindex == $pagecount && $pageindex != 1)
	{?>
	  <span><a class="paginate_link" href="<?php echo $pagefirst; ?>">[首页]</a></span> 
	  <span><a class="paginate_link" href="<?php echo $pageprev; ?>">[上页]</a></span>
	  <span>[下页]</span> 
	  <span>[尾页]</span>	  		
	<?php	
	}
	?>共找到<?php echo $$record_count_token; ?>条记录　
  当前第<select name="pageselect" id="pageselect" onChange="jumppage('<?php echo $url ."&" .$page_var ."="; ?>',this.options[this.options.selectedIndex].value);">
	<?php	
	//产生所有页面链接
	for($i=1;$i<=$pagecount;$i++){ ?>
		<option <?php if($pageindex== $i) echo 'selected="selected"';?> value="<?php echo $i;?>" ><?php echo $i;?></option>
		<?php	
	}
	?>
	</select>页　共<?php echo $pagecount;?>页
	<script>
			function jumppage(urlprex,pageindex)
			{
			<?php 
				if($page_type=='static' && !preg_match($pattern,$turl)){
					$str = "'{$url}/page/' + pageindex;";	
				}else{
					$str = "urlprex + pageindex;";
				}
				echo "var surl = $str";
				if($ajax_dom){
					echo "$('#{$ajax_dom}').load(surl);";
				}else{ 
					echo "window.location.href=surl;";
				}
				?>	
				
			} 
	</script>
	
	<?php
	if(!empty($ajax_dom)){
		?>
		<script>
			$(".paginate_link").click(function(e){
				e.preventDefault();
				$("#<?php echo $ajax_dom;?>").load($(this).attr('href'));
			});
		</script>
		<?php
	}
}

function redirect_login($type='js',$referer=true){
	$url = '/login/login.php';
	if($referer){
		$url .= '?last_url=' .get_current_url();		
	}
	redirect($url,$type);	
}

function require_role($role='member'){
	if(empty($_SESSION[role_name])){
		redirect_login();
		die();
	}	
}

function role_name(){
	return $_SESSION[role_name];
};

function has_right($right_name){
	return @in_array($right_name,$_SESSION['admin_menu_rights']) || @in_array($right_name,$_SESSION['admin_system_rights']);
}

function role_include($file, $role='member'){
	if ($_SESSION['role_name'] == $role){
		include($file);
	}
}

function require_login($type="redirect"){
	if($_COOKIE['cache_name']){
		return true;
	}
	if($type == 'redirect'){
		$url = '/login/?last_url=' . get_current_url();
		redirect($url);		
	}else{
		return false;
	}
}

function search_content($key,$table_name='fb_news',$conditions=null,$page_count = 10, $order='',$full_text=false){
	$db = get_db();
	if($key){
		$change = array('('=>'\(',')' => '\)');
		strtr($key,$change);
		$key = str_replace('　', ' ', $key);
		$key = str_replace(',', ' ', $key);
		$key = explode(' ',$key);	
		$len = count($key);
		for($i=0;$i<$len;$i++){
			$key[$i] = "({$key[$i]})+";
		}
		$key = implode('|',$key);
	}
	$sql = "select * from {$table_name} where language_tag = 0 ";
	if($conditions){
		$sql .= " and {$conditions}";
	}
	if($key){
		$sql .= " and (title regexp '{$key}' or short_title regexp '{$key}' or keywords regexp '{$key}'";
		if($full_text){
			$sql .= " or content regexp '{$key}'";
		}
		$sql .= ")";
	}
	if( $order ){
		$sql .= " order by " .$order;
	}
	if($page_count > 0){
		return $db->paginate($sql,$page_count);	
	}else{
		return $db->query($sql);
	}
}

function write_log($msg){
	global $g_log_dir;
	if(empty($g_log_dir)){
		return;
	}
	if(is_dir($g_log_dir) === false) return ;
	$file = $g_log_dir .substr(now(),0,10)  .".log";
	$msg = now() . ": " .$msg .chr(13).chr(10);
	write_to_file($file,$msg);
}


?>