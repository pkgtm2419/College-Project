<?php require_once '../admin/db_inc.php';session_start();?><script>function fn_display_bar_chart(){var chart;var chartData =[<?php $prefix = '';
$cmarks=0;$tmarks=0;$get_subject_name=mysql_query("select subject_id,(select subject_name from subject_master where subject_id=tsm.subject_id) as subject_name from test_subject_relation_master tsm where test_id=".$_GET["tid"]." order by subject_id asc");
while($sname=mysql_fetch_array($get_subject_name)){
echo $prefix . " {\n".'  "subject": "' .$sname["subject_name"] . '",' . "\n";
$query="select correct,marks,answer,t.negative_marks as tst_negative_marks,tsm.negative_marks as sub_negative_marks from question_master q left join ";
if($_GET["event"]=="true"){$query .="event_";}
$query .="answer_master a on q.subject_id=a.subject_id and q.ques_id=a.ques_id and user_id='".$_SESSION["uid"]."' and q.test_id=a.test_id left join test_master t on q.test_id=t.test_id left join test_subject_relation_master tsm on q.test_id=tsm.test_id and q.subject_id=tsm.subject_id where q.subject_id=".$sname["subject_id"]." and q.test_id=".$_GET["tid"];
$get_answers=mysql_query($query);while($getans=mysql_fetch_array($get_answers)){
$tmarks=$tmarks+$getans["marks"];
if($getans["answer"]==$getans["correct"]){$cmarks=$cmarks+$getans["marks"];}
else if(($getans["answer"]!=$getans["correct"])&&($getans["answer"]!=""))
{
if($getans["sub_negative_marks"]!=""){$cmarks=$cmarks-$getans["sub_negative_marks"];}
else{$cmarks=$cmarks-$getans["tst_negative_marks"];}
}
}
echo '  "scored": ' . $cmarks . ',' . "\n".'  "total": ' . $tmarks  . "\n". " }";
$prefix = ",\n";
$tmarks=0;$cmarks=0;
};?>];

    chart = new AmCharts.AmSerialChart();
    chart.dataProvider = chartData;
    chart.categoryField = "subject";
    chart.fontSize = 14;
    chart.startDuration = 1;
    chart.plotAreaFillAlphas = 0.2;

    chart.angle = 30;
    chart.depth3D = 40;

    var categoryAxis = chart.categoryAxis;
    categoryAxis.gridAlpha = 0.2;
    categoryAxis.gridPosition = "start";
    categoryAxis.axisColor = "#DADADA";
    categoryAxis.axisAlpha = 1;
    categoryAxis.dashLength = 5;
	categoryAxis.labelRotation = 45;

    // value
    var valueAxis = new AmCharts.ValueAxis();
    valueAxis.stackType = "3d";
    valueAxis.gridAlpha = 0.2;
    valueAxis.axisColor = "#DADADA";
    valueAxis.axisAlpha = 1;
    valueAxis.dashLength = 5;
    chart.addValueAxis(valueAxis);

    // GRAPHS         
    // first graph
    var graph1 = new AmCharts.AmGraph();

    graph1.valueField = "scored";
    graph1.type = "column";
    graph1.lineAlpha = 0;
    graph1.lineColor = "#D2CB00";
    graph1.fillAlphas = 1;
    graph1.balloonText = "Marks scored in [[category]] : [[value]]";
    chart.addGraph(graph1);

    // second graph
    var graph2 = new AmCharts.AmGraph();
    graph2.valueField = "total";
    graph2.type = "column";
    graph2.lineAlpha = 0;
    graph2.lineColor = "#BEDF66";
    graph2.fillAlphas = 1;
    graph2.balloonText = "Total marks in [[category]] : [[value]]";
    chart.addGraph(graph2);

    chart.write("chartdiv");

}<?php echo "fn_display_bar_chart();";?></script>