<!DOCTYPE HTML PUBLIC "-//W3C//DTD HTML 4.01 Transitional//EN" "http://www.w3c.org/TR/1999/REC-html401-19991224/loose.dtd">
<head>
   <meta http-equiv=Content-Type content="text/html; charset=utf-8">
	<meta http-equiv=Content-Language content=zh-cn>
	<title>福布斯-榜单首页</title>
	<?php
		include_once(dirname(__FILE__).'/../frame.php');
		$db = get_db();
		use_jquery();
		js_include_tag('public');
		css_include_tag('list','public');
	?>
</head>
<body>
<?php
	$id = intval($_GET['id']);
	$order = $_GET['order'];
	if(strlen($order)>20||$id==""){
		die();
	}
	$desc = intval($_GET['desc']);
	
	$list = new table_class('fb_custom_list_type');
	$list->find($id);
	if($list->table_name=="")
	{
		die();
	}
?>
<div id=ibody>
		<?php require_once(dirname(__FILE__).'/../inc/top.inc.php');?>
		<div id=bread><a href="index.php">榜单</a> > <span style="color:#246BB0;"><?php echo $list->name;?></span></div>
		<div id=bread_line></div>
		<div id="list_list_content" style="width:1000px;">
			<div id="list_title2"><?php echo $list->name;?></div>
			<?php
				if($list->table_name=="fb_famous_list_items"){
			?>
				<table border="0" cellspacing="1" >
					<tr id="list_top_tr">
							<td valign="middle" width="10%"><a href="more.php?id=<?php echo $id;?>&order=overall_order&desc=<?php echo ($order=='overall_order')?!$desc:'0';?>">综合<br>排名</a></td>
							<td valign="middle" width="10%">姓名</td>
							<td valign="middle" width="15%">职业</td>
							<td valign="middle" width="15%"><a href="more.php?id=<?php echo $id;?>&order=fortune&desc=<?php echo ($order=='fortune')?!$desc:'1';?>">收入<br>（万人民币）</a></td>
							<td valign="middle" width="10%"><a href="more.php?id=<?php echo $id;?>&order=fortune_order&desc=<?php echo ($order=='fortune_order')?!$desc:'0';?>">收入排名</a></td>
							<td valign="middle" width="10%"><a href="more.php?id=<?php echo $id;?>&order=exposure_rate&desc=<?php echo ($order=='exposure_rate')?!$desc:'0';?>">曝光率指数</a></td>
							<td valign="middle" width="10%"><a href="more.php?id=<?php echo $id;?>&order=exposure_order&desc=<?php echo ($order=='exposure_order')?!$desc:'0';?>">曝光率排名</a></td>
							<td valign="middle" width="20%">上榜理由</td>
					</tr>

					<?php
						if(empty($order)){
							$order = "overall_order";
						}
						if(empty($desc)){
							$desc = "asc";
						}else{
							$desc = "desc";
						}
						$sql = "select * from fb_famous_list_items where list_id=$id order by $order $desc";
						$list = $db->paginate($sql,100);
						$count = count($list);
						for($i=0;$i<$count;$i++){
					?>
					<tr class="list_btr">
						<td valign="middle" width="10%" style="color:#246BB0;"><?php echo $list[$i]->overall_order;?></td>
						<td valign="middle" width="10%">
							<?php if($list[$i]->famous_id!=''){?>
								<a href="/famous/famous.php?id=<?php echo $list[$i]->famous_id;?>">
							<?php }?>
							<?php echo $list[$i]->name;?>
							<?php if($list[$i]->famous_id!=''){?></a><?php }?></td>
						<td valign="middle" width="15%"><?php echo $list[$i]->job;?></td>
						<td valign="middle" width="15%"><?php echo $list[$i]->fortune;?></td>
						<td valign="middle" width="10%"><?php echo $list[$i]->fortune_order;?></td>
						<td valign="middle" width="10%"><?php echo $list[$i]->exposure_rate;?></td>
						<td valign="middle" width="10%"><?php echo $list[$i]->exposure_order;?></td>
						<td valign="middle" width="20%"><?php echo $list[$i]->reason;?></td>
					</tr>
					<?php }?>
				</table>
			<?php }else if($list->table_name=="fb_rich_list_items"){?>
				<table border="0" cellspacing="1" >
					<tr id="list_top_tr">
							<td valign="middle" width="10%"><a href="more.php?id=<?php echo $id;?>&order=overall_order&desc=<?php echo ($order=='overall_order')?!$desc:'0';?>">综合排名</a></td>
							<td valign="middle" width="15%">姓名</td>
							<td valign="middle" width="15%">年龄</td>
							<td valign="middle" width="15%"><a href="more.php?id=<?php echo $id;?>&order=fortune&desc=<?php echo ($order=='fortune')?!$desc:'1';?>">年收入<br>（<?php echo $list->unit;?>）</a></td>
							<td valign="middle" width="15%">所属省市</td>
							<td valign="middle" width="15%">公司名</td>
							<td valign="middle" width="15%">主要产业</td>
					</tr>

					<?php
						if(empty($order)){
							$order = "overall_order";
						}
						if(empty($desc)){
							$desc = "asc";
						}else{
							$desc = "desc";
						}
						$sql = "select * from fb_rich_list_items where list_id=$id order by $order $desc";
						$list = $db->paginate($sql,100);
						$count = count($list); 
						for($i=0;$i<$count;$i++){
					?>
					<tr class="list_btr">
						<td valign="middle" width="10%" style="color:#246BB0;"><?php echo $list[$i]->overall_order;?></td>
						<td valign="middle" width="15%">
							<?php if($list[$i]->rich_id!=''){?>
								<a href="/rich/rich.php?id=<?php echo $list[$i]->rich_id;?>">
							<?php }?>
							<?php echo $list[$i]->name;?>
							<?php if($list[$i]->famous_id!=''){?></a><?php }?></td>
						<td valign="middle" width="15%"><?php echo $list[$i]->age;?>岁</td>
						<td valign="middle" width="15%"><?php echo $list[$i]->fortune;?></td>
						<td valign="middle" width="15%"><?php echo $list[$i]->zone;?></td>
						<td valign="middle" width="15%"><?php echo $list[$i]->company;?></td>
						<td valign="middle" width="15%"><?php echo $list[$i]->industry;?></td>
					</tr>
					<?php }?>
				</table>
			<?php }else{?>
				<table border="0" cellspacing="1" >
					<tr id="list_top_tr">
							<?php 
								$fields = $db->query("show full fields FROM {$list->table_name}");
								$count = $db->record_count;
								$width = 100/$count;
								for($i=1;$i<$count;$i++){
							?>
							<td <?php if($i==1){?>style="border-left:0;"<?php }?> <?php if($i==($count-1)){?>style="border-right:0;"<?php }?> width="<?php echo $width;?>%" valign="middle">
								<?php if($fields[$i]->Key=='MUL'){
									echo "<a href='more.php?id=$id&order={$fields->Field}&desc=";
									echo ($order==$fields->Field)?!$desc:'1';
									echo "'>";
								}
								echo $fields[$i]->Comment;
								if($fields[$i]->Key=='MUL'){
									echo "</a>";
								}?>
							</td>
							<?php }?>
					</tr>
					<?php
						if(empty($order)){
							$order = "id";
						}
						if(empty($desc)){
							$desc = "asc";
						}else{
							$desc = "desc";
						}
						$sql = "select * from {$list->table_name} order by $order $desc";
						$list = $db->paginate($sql,100);
						$list_count = count($list);
						for($i=0;$i<$list_count;$i++){
					?>
					<tr class="list_btr">
						<?php for($j=1;$j<$count;$j++){
							$field_name = field_.$j;
						?>
						<td  width="<?php echo $width;?>%" valign="middle" ><?php echo $list[$i]->$field_name;?></td>
						<?php }?>
					</tr>
					<?php }?>
				</table>
			<?php }?>
			</div>
			<div id="more_paginate">
				<?php paginate();?>
			</div>
		<?php require_once(dirname(__FILE__).'/../inc/bottom.inc.php');?>
	</div>
</body>