<div id=r_c_title><?php echo $catename[0]->name; ?>活动</div>
<div id=r_c_l></div>
<div id=r_c_c>
	<?php
		for($i=0;$i<5;$i++){$pos_name = $pos."activity".$i;
	?>
	<div class=content <?php show_page_pos($pos_name)?>>
		<div class=pic><?php show_page_img();?></div>
		<div class=pictitle><?php show_page_href();?></div>
	</div>
	<?php }?>
</div>
<div id=r_c_r></div>