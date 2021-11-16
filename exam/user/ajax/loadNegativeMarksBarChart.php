<?php require_once '../admin/db_inc.php';session_start();?><script>function fn_display_negative_bar_chart(){var chart;var chartData =[<?php $prefix = '';
$cmarks=0;$get_subject_name=mysql_query("select subject_id,(select subject_name from subject_master where subject_id=tsm.subject_id) as subject_name from test_subject_relation_master tsm where test_id=".$_GET["tid"]." order by subject_id asc");
while($sname=mysql_fetch_array($get_subject_name)){
$qr="select correct,answer,t.negative_marks as tst_negative_marks,tsm.negative_marks as sub_negative_marks from question_master q left join ";
if($_GET["event"]=="true"){$qr .="event_";}$qr .="answer_master a on q.subject_id=a.subject_id and q.ques_id=a.ques_id and user_id='".$_SESSION["uid"]."' and q.test_id=a.test_id left join test_master t on q.test_id=t.test_id left join test_subject_relation_master tsm on q.test_id=tsm.test_id and q.subject_id=tsm.subject_id where q.subject_id=".$sname["subject_id"]." and q.test_id=".$_GET["tid"];
$get_answers=mysql_query($qr);while($getans=mysql_fetch_array($get_answers)){
if(($getans["answer"]!=$getans["correct"])&&($getans["answer"]!=""))
{
if($getans["sub_negative_marks"]!="")
{
$cmarks=$cmarks+$getans["sub_negative_marks"];
}
else{$cmarks=$cmarks+$getans["tst_negative_marks"];}
}
}
echo $prefix . " {\n".'  "subject": "' .$sname["subject_name"] . '",' . "\n".'  "scored": ' . $cmarks . ',' . "\n".'  "color": "#fe0000"'. "\n". " }";
$prefix = ",\n";
$cmarks=0;
};?>];

chart = new AmCharts.AmSerialChart();
chart.dataProvider = chartData;
chart.categoryField = "subject";
// the following two lines makes chart 3D
chart.depth3D = 20;
chart.angle = 30;

// AXES
// category
var categoryAxis = chart.categoryAxis;
categoryAxis.labelRotation = 45;
categoryAxis.dashLength = 5;
categoryAxis.gridPosition = "start";

// value
var valueAxis = new AmCharts.ValueAxis();
valueAxis.title = "Negative marks";
valueAxis.dashLength = 5;
chart.addValueAxis(valueAxis);

// GRAPH            
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