<?php
	session_start();
	require_once('../../frame.php');
	judge_role();
	$db = get_db();
	$id = $_REQUEST['id'];
	if($id!=''){
		$famous = new table_class('fb_mr');
		$famous->find($id);
	}
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
		js_include_tag('../ckeditor/ckeditor.js');
		validate_form("famous_edit");
	?>
</head>
<body>
<div id=icaption>
    <div id=title><?php if($id!=''){echo "编辑名人";}else{echo "添加名人";}?></div>
	  <a href="index.php" id=btn_back></a>
</div>
	<form id="famous_edit" enctype="multipart/form-data" action="edit.post.php" method="post"> 
<div id=itable>
	<table cellspacing="1" align="center">
		<tr class=tr4>
			<td class=td1 width=15%>姓名</td>
			<td width=85%>
				<input type="text" name="mr[name]" value="<?php echo $famous->name;?>" class="required">
			</td>
		</tr>
		<tr class=tr4>
			<td class=td1>性别</td>
			<td>
				<input style="width:40px;" type="radio" name="mr[xb]" value="女" <?php if($famous->xb=='女'){ ?>checked="checked"<?php } ?> class="required">女<br>
				<input style="width:40px;" type="radio" name="mr[xb]" value="男" <?php if($famous->xb=='男'){ ?>checked="checked"<?php } ?> class="required">男
			</td>
		</tr>
		<tr class=tr4>
			<td class=td1>职业</td>
			<td>
				<input type="text" name="mr[zy]" value="<?php echo $famous->zy;?>" class="required">
			</td>
		</tr>
		<tr class=tr4>
			<td class=td1>上传照片</td>
			<td>
				<input type="hidden" name="MAX_FILE_SIZE1" value="2097152">
				<input type="file" name="photo" id="photo" >（请上传小于2M的照片）<?php if($id!=''){?><a target="_blank" href="<?php echo $famous->mr_zp?>">点击查看照片</a><?php }?>
			</td>
		</tr>
		<tr class="tr4">
			<td class=td1>个人简介</td><td><?php show_fckeditor('mr[mr_jj]','Admin',true,"265",$famous->mr_jj);?></td>
		</tr>
		<tr class="btools">
			<td colspan="10" align="center"><input id="submit" type="submit" value="完成"></td>
		</tr>	
	</table>
		<input type="hidden" name="id" value="<?php echo $id;?>">
	</form>
</body>
</html>