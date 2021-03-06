<?php // content="text/plain; charset=utf-8"
require_once ('../../lib/jpgraph/jpgraph.php');
require_once ('../../lib/jpgraph/jpgraph_line.php');
// Some (random) data
$str = file_get_contents('./ipo');
$xdata = array("9:30","9:31","10:00","10:30","11:00","11:30","13:00","13:30","14:00","14:30","15:00","15:30");
eval($str);

#var_dump($xdata);
#var_dump($ydata);
#$ydata = array(1.2,7.2,8.2);#,12,5,5,9,13,5,7,10,13,12,13,20,25);
#$datax = array("9:30","10:00","10:30");
$len = count($data);
if(empty($ydata)) exit;
// Size of the overall graph

$len = count($xdata);
/*
if($len > 6){
$tmp = round($len /2);
for($i=1;$i< $len-1; $i++){
	if($i == $tmp) continue;
	$xdata[$i] = "";
}
}
*/
$width=300;
$height=200;

// Create the graph and set a scale.
// These two calls are always required
$graph = new Graph($width,$height);
$graph->SetScale('linlin',0,0,0,11);
$graph->SetMarginColor('white');
$graph->SetFrame(false);

// Setup margin and titles
$graph->SetMargin(40,10,10,20);
$graph->yaxis->title->SetFont( FF_FONT1 , FS_BOLD );
$graph->xaxis->title->SetFont( FF_FONT1 , FS_BOLD );
$graph->xaxis->SetTickLabels($xdata);

#$graph->yaxis->SetColor('red');

// Create the linear plot
$lineplot=new LinePlot($ydata);
$lineplot->SetColor( 'red' );
$lineplot->SetCenter();
$lineplot->SetWeight( 2 );   // Two pixel wide
$lineplot->mark->SetType(MARK_FILLEDCIRCLE);
$lineplot->mark->SetWidth(3);
$lineplot->mark->SetColor('red');
$lineplot->mark->SetFillColor('red');

$lineplot->value->format = "%.1f";
$lineplot->value->SetFont(FF_ARIAL,FS_NORMAL,7);
$lineplot->value->Show();

// Add the plot to the graph
$graph->Add($lineplot);

// Display the graph
#$graph->Stroke();
$graph->Stroke('../../upload/ipo.png');
#var_dump($ydata);
?>
