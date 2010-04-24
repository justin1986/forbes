<?php
	include_once('../../frame.php');
	$id = intval($_REQUEST['id']);
	if($id <= 0){
		alert('invalid request!');
		redirect('index.php');
		exit;
	}
	$search = $_REQUEST['search'];
	$list = new table_class('fb_custom_list_type');
	if($list->find($id)===false){
		alert('invalid request!');
		redirect('index.php');
		exit;
	};
	$db = get_db();
	$sql = "select * from fb_famous_list_items where list_id={$id}" ;
	if($search){
		$sql .= " and name like '%{$search}%'";
	}
	$sql .= " order by overall_order asc";
	$record = $db->paginate($sql,30);
	$count = $db->record_count;
?>

<!DOCTYPE HTML PUBLIC "-//W3C//DTD HTML 4.01 Transitional//EN" "http://www.w3c.org/TR/1999/REC-html401-19991224/loose.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
	<meta http-equiv=Content-Type content="text/html; charset=utf-8">
	<meta http-equiv=Content-Language content=zh-CN>
	<title>迅傲信息</title>
	<?php
		css_include_tag('admin');
		use_jquery();
		js_include_tag('admin_pub','admin/list/famous_item_list');
	?>
</head>

<body>
	<table width="795" border="0" id="list">
		<tr class="tr1">
			<td colspan="6">
				<?php if ($id){ ?>   <a href="famous_list_item_edit.php?list_id=<?php echo $id; ?>">添加名人</a> <?php } ?>  搜索　
				<input id="search" type="text" value="<? echo $_REQUEST['search']?>">
    			<input type="button" value="搜索" id="search_b" style="border:1px solid #0000ff; height:21px">
				<a href="index.php" style="cursor:pointer">返回榜单列表</a>
			</td>
		</tr>
		<tr class="tr2">
			<td width="115">姓名</td><td width="110">综合排名</td><td width="130">年度收入</td><td width="210">操作</td>
		</tr>
		<?php
			for($i=0;$i<$count;$i++){
		?>
				<tr class="tr3" id="<?php echo $record[$i]->id;?>">
					<td><?php echo $record[$i]->name;?></td>
					<td><?php echo $record[$i]->overall_order;?></td>
					<td><?php echo $record[$i]->fortune;?></td>
					<td>
						<a href="famous_list_item_edit.php?id=<?php echo $record[$i]->id;?>&list_id=<?php echo $id;?>" class="edit" name="<?php echo $record[$i]->id;?>" style="cursor:pointer">编辑</a>
						<span style="cursor:pointer;color:#FF0000" class="del" name="<?php echo $record[$i]->id;?>">删除</span>
					</td>
				</tr>
				<input type="hidden" id="db_table" value="fb_famous_list_items">
		<?php
			}
		?>
		<tr class="tr3">
			<td colspan=6><?php paginate();?></td>
		</tr>
		<input type="hidden" id="list_id" name="id" value="<?php echo $id;?>"> 
	</table>
</body>
</html>