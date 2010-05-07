﻿<?php 
	include_once('../frame.php');
	$db = get_db();
?>
<!DOCTYPE HTML PUBLIC "-//W3C//DTD HTML 4.01 Transitional//EN" "http://www.w3c.org/TR/1999/REC-html401-19991224/loose.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
	<meta http-equiv=Content-Type content="text/html; charset=utf-8">
	<meta http-equiv=Content-Language content=zh-cn>
	<title>福布斯-活动列表</title>
	<?php
		use_jquery();
		js_include_tag('public','right');
		css_include_tag('news','public','right_inc');
	?>
</head>
<body>
<div id=ibody>
		<?php include_top();?>
		<div id=bread>		
			<a href="#">活动列表</a>
		</div>
		<div id=bread_line></div>
		
		<div id=l>
			<div id=list_content>
					<?php
					$sql = "select * from fb_event order by id desc";
					$record = $db->paginate($sql,15);
					$count = count($record);
					for($i=0;$i<$count;$i++){
					?>
					<div class=list_box>
							<div class=title><a title="<?php echo $record[$i]->title;?>" href="<?php echo $record[$i]->url;?>" target="_blank"><?php echo $record[$i]->title?></a></div>
							<div class=info>举办地：<?php echo $record[$i]->place;?>　举办时间：<?php echo $record[$i]->time;?></div>
					</div>
					<?php }?>
					<div id=page><?php paginate();?></div>
			</div>
		</div>	
		<div id="right_inc">
			<?php include_right("ad");?>
			<?php include_right("favor");?>
			<?php include_right("four");?>
			<?php include_right("forum");?>
			<?php include_right("magazine");?>
			
		</div>
		<?php include_bottom();?>
</div>
</body>
<html>