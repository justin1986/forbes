<?php 
	include_once('../frame.php');
	$key = $_GET['key'];
	$db = get_db();
	if(strlen($key)>20){
		redirect('error.html');
		die();
	}
	if(empty($key)){
		$count = 0;
		$page_record_count = 0;
	}else{
		$sql = "select * from fb_news where title like '%$key%' or short_title like '%$key%' or description like '%$key%' order by created_at desc";
		$record = $db->paginate($sql,10);
		$count = $db->record_count;
	}
	
?>
<!DOCTYPE HTML PUBLIC "-//W3C//DTD HTML 4.01 Transitional//EN" "http://www.w3c.org/TR/1999/REC-html401-19991224/loose.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
	<meta http-equiv=Content-Type content="text/html; charset=utf-8">
	<meta http-equiv=Content-Language content=zh-cn>
	<title>福布斯-新闻列表</title>
	<?php
		use_jquery();
		js_include_tag('public','right');
		css_include_tag('news','public','right_inc');
	?>
</head>
<body <?php if($news->forbbide_copy == 1){ ?> oncontextmenu="return false" ondragstart="return false" onselectstart ="return false" onselect="return false" oncopy="return false" onbeforecopy="return false" onmouseup="return false" <?php }?>>
<div id=ibody>
		<?php include "../inc/top.inc.php";?>
		<div id=bread>
			<span>新闻检索</span>
		</div>
		<div id=bread_line></div>
		
		<div id=l>
			<div class=news_caption>
					<div class=captions>搜索关键字“<?php echo $key;?>”的新闻<span>共<?php echo $page_record_count;?>篇</span></div>
			</div>
			<div id=list_content>
				<?php
					for($i=0;$i<$count;$i++){
				?>
				<div class=list_box>
						<div class=title><a title="<?php echo $record[$i]->title;?>" href="<?php echo static_news_url($record[$i]);?>"><?php echo $record[$i]->title?></a></div>
						<div class=info>《福布斯》　记者：<?php echo $record[$i]->author;?>　发布于：<?php echo substr($record[$i]->created_at,0,10);?></div>
						<div class=description ><?php echo $record[$i]->description;?></div>
				</div>
				<?php }?>
				<div id=page><?php paginate();?></div>
			</div>
		</div>	
		<div id="right_inc">
			<?php include "../right/ad.php";?>
			<?php include "../right/favor.php";?>
			<?php include "../right/four.php";?>
			<?php include "../right/forum.php";?>
			<?php include "../right/magazine.php";?>
		</div>
		<?php include "../inc/bottom.inc.php";?>
</div>
</body>
<html>