<?php
	session_start();
	include_once('../../frame.php');
	judge_role();
?>

<!DOCTYPE HTML PUBLIC "-//W3C//DTD HTML 4.01 Transitional//EN" "http://www.w3c.org/TR/1999/REC-html401-19991224/loose.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
	<meta http-equiv=Content-Type content="text/html; charset=utf-8">
	<meta http-equiv=Content-Language content=zh-CN>
	<title>富豪编辑</title>
	<?php 
		css_include_tag('admin');
		use_jquery();
		validate_form("industry");
	?>
</head>

<?php
	$db = get_db();
	$id = $_REQUEST['id'];
	$record = new table_class('fb_industry');
	if ($id != '')
	{
		$record->find($id);
	}
?>

<body>
	<div id=icaption>
    <div id=title><?php if($id!='')echo "编辑行业";else echo "添加行业";?></div>
	  <a href="index.php" id=btn_back></a>
</div>
<div id=itable>
	<form id="industry" action="edit.post.php" method="post"> 
	<table cellspacing="1" align="center">
		<tr class=tr4>
			<td class=td1 width=15%>行业名称</td><td width="85%" align="left"><input type="text" name="name" value="<?php echo $record->name;?>">
		</tr>
		<tr class=btools>
			<td colspan="10" align="center"><input id="submit" type="submit" value="完成"></td>
		</tr>	
	</table>
		<input type="hidden" name="id" id="id"  value="<?php echo $record->id; ?>">
	</form>
</div>
</body>
</html>