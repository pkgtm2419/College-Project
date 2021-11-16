<?php require_once '../admin/db_inc.php';session_start();?><script>function fn_display_negative_bar_chart(){var chart;var chartData=[<?php $prefix='';$cmarks=0;$old_level="";$new_level="";$qr="select correct,CASE level WHEN 'E' THEN 'Expert Level' WHEN 'L' THEN 'Low Level' WHEN 'M' THEN 'Medium Level' WHEN 'A' THEN 'Advance Level' END as lvl,answer,t.negative_marks as tst_negative_marks,tsm.negative_marks as sub_negative_marks from question_master q left join ";if($_GET["event"]=="true"){$qr .="event_";}$qr .="answer_master a on q.subject_id=a.subject_id and q.ques_id=a.ques_id and user_id='".$_SESSION["uid"]."' and q.test_id=a.test_id left join test_master t on q.test_id=t.test_id left join test_subject_relation_master tsm on q.test_id=tsm.test_id and q.subject_id=tsm.subject_id where q.test_id=".$_GET["tid"]." order by level";
$get_answers=mysql_query($qr);while($getans=mysql_fetch_array($get_answers)){$new_level=$getans["lvl"];
if(($getans["answer"]!=$getans["correct"])&&($getans["answer"]!=""))
{
if($getans["sub_negative_marks"]!="")
{
$cmarks=$cmarks+$getans["sub_negative_marks"];
}
else{$cmarks=$cmarks+$getans["tst_negative_marks"];}
}
if($old_level!=$new_level)
{
echo $prefix . " {\n".'  "level": "' .$getans["lvl"] . '",' . "\n".'  "scored": ' . $cmarks . ',' . "\n".'  "color": "#fe0000"'. "\n". " }";$prefix = ",\n";$cmarks=0;
}
$old_level=$new_level;}?>];
chart = new AmCharts.AmSerialChart();
chart.dataProvider=chartData;
chart.categoryField="level";
chart.depth3D=20;
chart.angle=30;
var categoryAxis=chart.categoryAxis;
categoryAxis.labelRotation=45;
categoryAxis.dashLength=5;
categoryAxis.gridPosition="start";
var valueAxis=new AmCharts.ValueAxis();
valueAxis.title="Negative marks";
valueAxis.dashLength=5;
chart.addValueAxis(valueAxis);
var graph = new AmCharts.AmGraph();
graph.valueField = "scored";
graph.colorField = "color";
graph.balloonText = "<span style='font-size:14px'>[[category]]: <b>[[value]]</b></span>";
graph.type = "column";
graph.lineAlpha = 0;
graph.fillAlphas = 1;
chart.addGraph(graph);
var chartCursor = new AmCharts.ChartCursor();
chartCursor.cursorAlpha = 0;
chartCursor.zoomable = false;
chartCursor.categoryBalloonEnabled = false;
chart.addChartCursor(chartCursor);
chart.write("negativeChart");
}<?php echo "fn_display_negative_bar_chart();";?></script>