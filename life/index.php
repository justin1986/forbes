<?php 
	include_once(dirname(__FILE__).'/../frame.php');
	$db = get_db();
	$nav=$db->query('select id from fb_navigation where name="生活"');
	$nav=$nav[0]->id;		
?>
<!DOCTYPE HTML PUBLIC "-//W3C//DTD HTML 4.01 Transitional//EN" "http://www.w3c.org/TR/1999/REC-html401-19991224/loose.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
	<meta http-equiv=Content-Type content="text/html; charset=utf-8">
	<meta http-equiv=Content-Language content=zh-cn>
	<title>福布斯-奢侈品</title>
	<?php
		use_jquery();
		js_include_tag('public');
		css_include_tag('public','right','life');
		init_page_items();
	?>
</head>
<body>
<div id=ibody>
<? include_once(dirname(__FILE__).'/../inc/top.inc.php');?>
<div id=life_top>
	<object classid="clsid:D27CDB6E-AE6D-11cf-96B8-444553540000" codebase="http://download.macromedia.com/pub/shockwave/cabs/flash/swflash.cab#version=7,0,19,0" width="1000" height="540">
       <param name="movie" value="life1.swf">
       <param name="quality" value="high">
       <param name="wmode" value="transparent" />
       <embed src="life1.swf" quality="high" wmode="transparent" pluginspage="http://www.macromedia.com/go/getflashplayer" type="application/x-shockwave-flash" width="1000" height="540"></embed>
	</object>
</div>
<div id=life_middle>
	<div id="life_middle_flash">
			<object classid="clsid:D27CDB6E-AE6D-11cf-96B8-444553540000" codebase="http://download.macromedia.com/pub/shockwave/cabs/flash/swflash.cab#version=7,0,19,0" width="525" height="140">
            <param name="movie" value="life2.swf">
            <param name="quality" value="high">
            <param name="wmode" value="transparent" />
            <embed src="life2.swf" quality="high" wmode="transparent" pluginspage="http://www.macromedia.com/go/getflashplayer" type="application/x-shockwave-flash" width="525" height="140"></embed>
			</object>
	</div>
	<div id=life_middle_bg></div>
	<?php $pos_name = "lifeindex_column"?>
	<div id=life_middle_column <?php show_page_pos($pos_name)?>>
		<div id=picture><img src="<?php echo $pos_items->$pos_name->image1;?>" width="120" height="120" border="0" /></div>
		<div id=title><?php show_page_href($pos_items,$pos_name,true,"_blank")?></div>
		<div id=text><?php echo $pos_items->$pos_name->description;?></div>
		<div id=link><a href="<?php echo $pos_items->$pos_name->href;?>" target="_blank">进入专栏</a></div>
	</div>
</div>	

<div id=life_bottom>
  <div id=life_bottom_left>
  		<div class=life_caption>
				<div class=captions>奢华<span>推荐</span></div>
			</div>
			<div id=life_bottom_flash>
			  <object classid="clsid:D27CDB6E-AE6D-11cf-96B8-444553540000" codebase="http://download.macromedia.com/pub/shockwave/cabs/flash/swflash.cab#version=7,0,19,0" width="660" height="210">
             <param name="movie" value="life3.swf">
              <param name="quality" value="high">
              <param name="wmode" value="transparent" />
              <embed src="life3.swf" quality="high" wmode="transparent" pluginspage="http://www.macromedia.com/go/getflashplayer" type="application/x-shockwave-flash" width="660" height="210"></embed>
			   </object>
			</div>
      
      <div class=life_box>
 				<div class=life_caption>
					<div class=captions>服饰钟表</div>
					<div class=line>|</div>
					<a href="/news/news_list.php?cname=服饰钟表" class=more target="_blank"></a>
				</div>
				
				<?php $pos_name = "liftindex_news_1";	?>
				<div id=picture <?php show_page_pos($pos_name)?>>
					<a href="<?php echo $pos_items->$pos_name->href?>" target="_blank" title="<?php echo $pos_items->$pos_name->title?>"><img src="<?php echo $pos_items->$pos_name->image1;?>" border="0" width="210" height="160" /></a>
				</div>
				<div class=title><?php show_page_href($pos_items,$pos_name,true,"_blank")?></div>
				<div class=description><a href="<?php echo $pos_items->$pos_name->href?>" target="_blank" title="<?php echo $pos_items->$pos_name->title?>"> <?php echo $pos_items->$pos_name->description?></a></div>
      </div>
      
      <div class=life_box>
  			<div class=life_caption>
					<div class=captions>豪车</div>
					<div class=line>|</div>
					<a href="/news/news_list.php?cname=豪车" class=more></a>      	
				</div>	
				
				<?php $pos_name = "liftindex_news_2";?>
				<div id=picture <?php show_page_pos($pos_name)?>>
					<a href="<?php echo $pos_items->$pos_name->href?>" target="_blank" title="<?php echo $pos_items->$pos_name->title?>"><img src="<?php echo $pos_items->$pos_name->image1;?>" border="0" width="210" height="160" /></a>
				</div>
				<div class=title><?php show_page_href($pos_items,$pos_name,true,"_blank")?></div>
				<div class=description><a href="<?php echo $pos_items->$pos_name->href?>" target="_blank" title="<?php echo $pos_items->$pos_name->title?>"> <?php echo $pos_items->$pos_name->description?></a></div>
      </div>
      
      <div class=life_box>
  			<div class=life_caption>
					<div class=captions>游艇飞机</div>
					<div class=line>|</div>
					<a href="/news/news_list.php?cname=游艇飞机" class=more></a> 
				</div>	
				<?php $pos_name = "liftindex_news_3";	?>
				<div id=picture <?php show_page_pos($pos_name)?>>
					<a href="<?php echo $pos_items->$pos_name->href?>" target="_blank" title="<?php echo $pos_items->$pos_name->title?>"><img src="<?php echo $pos_items->$pos_name->image1;?>" border="0" width="210" height="160" /></a>
				</div>
				<div class=title><?php show_page_href($pos_items,$pos_name,true,"_blank")?></div>
				<div class=description><a href="<?php echo $pos_items->$pos_name->href?>" target="_blank" title="<?php echo $pos_items->$pos_name->title?>"> <?php echo $pos_items->$pos_name->description?></a></div>				
      </div>            


			<div id=life_ml>
  			<div class=life_caption>
					<div class=captions>名利场</div>
					<div class=line>|</div>
					<a href="/news/news_list.php?cname=名利场" class=more></a> 
				</div>	
				<?php $pos_name = "lifeindex_news_mlc"?>
				<div id=picture <?php show_page_pos($pos_name)?>>
					<a href="<?php echo $pos_items->$pos_name->href?>" target="_blank" title="<?php echo $pos_items->$pos_name->title?>"><img src="<?php echo $pos_items->$pos_name->image1;?>" border="0" width="500" height="200" /></a>
				</div>
				<div id=content <?php show_page_pos($pos_name)?>>
						<div id=content_title>
							<?php show_page_href($pos_items,$pos_name,true,"_blank")?>
						</div>
						<div id=content_description>
							<a href="<?php echo $pos_items->$pos_name->href?>" target="_blank" title="<?php echo $pos_items->$pos_name->title?>"> <?php echo $pos_items->$pos_name->description?></a>
						</div>
				</div>
			</div>
				

      <div class=life_box>
 				<div class=life_caption>
					<div class=captions>美酒美食</div>
					<div class=line>|</div>
					<a href="/news/news_list.php?cname=美酒美食" class=more></a> 
				</div>
				
				<?php $pos_name = "liftindex_news_4";	?>
				<div id=picture <?php show_page_pos($pos_name)?>>
					<a href="<?php echo $pos_items->$pos_name->href?>" target="_blank" title="<?php echo $pos_items->$pos_name->title?>"><img src="<?php echo $pos_items->$pos_name->image1;?>" border="0" width="210" height="160" /></a>
				</div>
				<div class=title><?php show_page_href($pos_items,$pos_name,true,"_blank")?></div>
				<div class=description><a href="<?php echo $pos_items->$pos_name->href?>" target="_blank" title="<?php echo $pos_items->$pos_name->title?>"> <?php echo $pos_items->$pos_name->description?></a></div>
      </div>
      
      <div class=life_box>
  			<div class=life_caption>
					<div class=captions>体面</div>
					<div class=line>|</div>
					<a href="/news/news_list.php?cname=体面" class=more></a>     	
				</div>	
				
				<?php $pos_name = "liftindex_news_5";?>
				<div id=picture <?php show_page_pos($pos_name)?>>
					<a href="<?php echo $pos_items->$pos_name->href?>" target="_blank" title="<?php echo $pos_items->$pos_name->title?>"><img src="<?php echo $pos_items->$pos_name->image1;?>" border="0" width="210" height="160" /></a>
				</div>
				<div class=title><?php show_page_href($pos_items,$pos_name,true,"_blank")?></div>
				<div class=description><a href="<?php echo $pos_items->$pos_name->href?>" target="_blank" title="<?php echo $pos_items->$pos_name->title?>"> <?php echo $pos_items->$pos_name->description?></a></div>
      </div>
      
      <div class=life_box>
  			<div class=life_caption>
					<div class=captions>文化娱乐</div>
					<div class=line>|</div>
					<a href="/news/news_list.php?cname=文化娱乐" class=more></a> 
				</div>	
				<?php $pos_name = "liftindex_news_6";	?>
				<div id=picture <?php show_page_pos($pos_name)?>>
					<a href="<?php echo $pos_items->$pos_name->href?>" target="_blank" title="<?php echo $pos_items->$pos_name->title?>"><img src="<?php echo $pos_items->$pos_name->image1;?>" border="0" width="210" height="160" /></a>
				</div>
				<div class=title><?php show_page_href($pos_items,$pos_name,true,"_blank")?></div>
				<div class=description><a href="<?php echo $pos_items->$pos_name->href?>" target="_blank" title="<?php echo $pos_items->$pos_name->title?>"> <?php echo $pos_items->$pos_name->description?></a></div>			
      </div>      
  </div>

  <div id=life_bottom_right>
      <div class=life_box2>
  			<div class=life_caption>
					<div class=captions>旅游</div>
					<div class=line>|</div>
					<a href="/news/news_list.php?cname=旅游" class=more></a> 
				</div>	
				<?php $pos_name = "lifeindex_ly";	?>
				<div id=picture <?php show_page_pos($pos_name)?>>
					<a href="<?php echo $pos_items->$pos_name->href?>" target="_blank" title="<?php echo $pos_items->$pos_name->title?>"><img src="<?php echo $pos_items->$pos_name->image1;?>" border="0" width="246" height="160" /></a>
				</div>
      </div>
      
      <div class=life_box2>
  			<div class=life_caption>
					<div class=captions>豪宅</div>
					<div class=line>|</div>
					<a href="/news/news_list.php?cname=豪宅" class=more></a> 
				</div>	
				<?php $pos_name = "lifeindex_hz";	?>
				<div id=picture <?php show_page_pos($pos_name)?>>
					<a href="<?php echo $pos_items->$pos_name->href?>" target="_blank" title="<?php echo $pos_items->$pos_name->title?>"><img src="<?php echo $pos_items->$pos_name->image1;?>" border="0" width="246" height="160" /></a>
				</div>
      </div>     	
			
			<div class=life_box2>
  			<div class=life_caption>
					<div class=captions>关注</div>
					<div class=line>|</div>
					<a href="/news/news_list.php?cname=关注" class=more></a> 
				</div>
				<div id=line></div>

				<?php 
					for($i=0;$i<3;$i++ ){
						$pos_name = "lifeindex".$i;
				?>
				<div id=list <?php show_page_pos($pos_name);?>>
					<?php show_page_href($pos_items,$pos_name,true,"_blank")?>
				</div>
				<?php }?>
			</div>
				

      <div class=life_box2>
  			<div class=life_caption>
					<div class=captions>奢华专题</div>
					<div class=line>|</div>
					<a href="/news/news_list.php?cname=生活" class=more></a> 
				</div>	
				<?php $pos_name = "lifeindex_zt";	?>
				<div id=picture <?php show_page_pos($pos_name)?>>
					<a href="<?php echo $pos_items->$pos_name->href?>" target="_blank" title="<?php echo $pos_items->$pos_name->title?>"><img src="<?php echo $pos_items->$pos_name->image1;?>" border="0" width="246" height="160" /></a>
				</div>
				<div class=title><?php show_page_href($pos_items,$pos_name,true,"_blank")?></div>
      </div>  

      <div class=life_box2>
  			<div class=life_caption>
					<div class=captions>慈善</div>
					<div class=line>|</div>
					<a href="/news/news_list.php?cname=慈善" class=more></a> 
				</div>	
				<?php $pos_name = "lifeindex_cs";	?>
				<div id=picture <?php show_page_pos($pos_name)?>>
					<a href="<?php echo $pos_items->$pos_name->href?>" target="_blank" title="<?php echo $pos_items->$pos_name->title?>"><img src="<?php echo $pos_items->$pos_name->image1;?>" border="0" width="246" height="160" /></a>
				</div>
				<div class=title><?php show_page_href($pos_items,$pos_name,true,"_blank")?></div>
      </div>  
			
  </div>			
</div>
<? include_once(dirname(__FILE__).'/../inc/bottom.inc.php');?>
</div>
</body>