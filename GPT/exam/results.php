<?php session_start(); if(!(isset($_SESSION['sprg_admin']) && $_SESSION['sprg_admin']== 1)){header('Location: login.php');} ob_start();if(isset($_GET["event"])){if($_GET["event"]=="true"){header("Location:eventResult.php");}}require_once('headerresult.php');require_once('navigation.php');require_once 'admin/db_inc.php';if(isset($_GET["uid"])){$_SESSION["uid"]=$_GET["uid"];}?>
<link href="css/styles.css" rel="stylesheet">
<link href="css/animateprogressbar.css" rel="stylesheet">
<div id="main-body">
<div id="main-body-surround">
<div id="main-content" class="x-c-s">
<style>.main-form-table3 td{font-size: 13px;padding-left:10px;}.main-form-table3 th{background-color:#C0CD79;}.addborder tr{border: 1px solid #C0CD79;}.listyle{display:inline;list-style:none outside none;padding:9px;border-right:1px solid gray;cursor:pointer;}.liactive{background-color:#96AC20;color:#FFF;}.listyle a{cursor:pointer;text-decoration:none;color:inherit;}.txtalign tr{text-align:left;background-color:#F0F0F0;}.dRow{display:none;}.main-form-table{text-align:left;}.mainHeading{color:#800000;font-size:17px;font-weight:bold;padding-left:30px;text-align: left;text-decoration:underline;}.resultsMenu{width:96%;border:1px solid gray;margin:10px 10px 15px 20px;padding:7px 0;}.negativeMarks{background-color:#F5F5DC;border-bottom:1px solid #C0C0C0;border-top:1px solid #C0C0C0;font-size:16px;font-weight:bold;padding:5px 0 5px 20px;}</style>
<div class="resultsMenu">
<ul>
<li class="listyle liactive"><a href="#">Summary</a></li>
<li class="listyle"><a href="resultsSubjectWise.php?event=<?php echo $_GET["event"];?>&tid=<?php echo $_GET['tid'];?>">Subject Wise</a></li>
<li class="listyle"><a href="resultsDifficultyWise.php?event=<?php echo $_GET["event"];?>&tid=<?php echo $_GET['tid'];?>">Difficulty Wise</a></li>
</ul></div><br/>
<div style="width:100%;">
<div class="mainHeading" style="text-decoration:none;display:inline;">Total Assesment of Test -</div><div style="width:200px;margin-left:15px;color:rgb(126,122,0);font-size:19px;display:inline;"><?php $get_test=mysql_fetch_array(mysql_query("select test_name from test_master where test_id=".$_GET["tid"]));echo $get_test[0];?></div><br/><br/>
<table class="main-form-table3 txtalign" width="100%" style="margin-left:30px;">
<tr><td width="280px">My Marks</td><td><b><span id="mymarks"></span></b> out of <b><span id="totmarks"></span></b></td></tr>
<tr><td>My Correct Ans</td><td><b><span id="qcorrect"></span></b> out of <b><span id="qtotal1"></span></b> questions</td></tr>
<tr><td>Incorrect Ans</td><td><b><span id="qincorrect"></span></b> out of <b><span id="qtotal2"></span></b> questions</td></tr>
<tr><td>% Attempted</td><td><div class="Progress default" id="percentAttemptProgress"><div></div></div></td></tr>
<tr><td>% Not Attempted</td><td><div class="Progress default" id="percentNotAttemptProgress"><div></div></div></td></tr>
</table>
<br/>
<div class="mainHeading">Summary of Performance in Test -</div>
<table><tr><td><div id="chartdiv" style="width:500px; height: 250px;margin-left:-15px;"></div></td><td>
<div id="chartdiv2" style="width:700px; height: 335px;margin-left: -165px;"></div></td></tr></table>
<div class="negativeMarks" style="font-size:15px;font-weight: bold;padding-left:20px;">Question wise analysis of Test-<div style="width:300px;margin-left:15px;color:rgb(126,122,0);font-size:12px;display:inline;">(click on respective question to view solution)</div></div><br/><br/>
<table class="main-form-table3 addborder" style="width:100%; text-align: center;">
<tr><th>#QNo.</th><th>Subject</th><th>Topic</th><th>You Answered</th><th>Correct Ans</th><th>Scored</th><th>Answer Status</th></tr>
<?php $total=0;$correct=0;$incorrect=0;$att=0;$natt=0;$tques=0;$mymarks=0;$i=1;$isempty="";$scored=0;
$query="SELECT q.ques_id,subject_name,topic_name,correct,marks,(select answer from ";
if($_GET["event"]=="true"){$query .="event_";}
$query .="answer_master a where user_id='".$_SESSION["uid"]."' and a.ques_id=q.ques_id and a.test_id=q.test_id) as answer,tst.negative_marks,tsm.negative_marks as sub_negative_marks FROM question_master q left join subject_master s on q.subject_id=s.subject_id left join topic_master t on q.topic_id=t.topic_id left join test_master tst on q.test_id=tst.test_id left join test_subject_relation_master tsm on q.test_id=tsm.test_id and q.subject_id=tsm.subject_id where q.test_id=".$_GET["tid"]." order by subject_name asc";
$get_result_set=mysql_query($query);
while($get_result=mysql_fetch_array($get_result_set)){
$total=$total+$get_result["marks"];
$tques++;$scored=0;
if($get_result["answer"]==$get_result["correct"])
{
$att++;$mymarks=$mymarks+$get_result["marks"];$correct++;$isempty="Correctly Answered";$scored=$get_result["marks"];
}
elseif(($get_result["answer"]!=$get_result["correct"])&&($get_result["answer"]!=""))
{
$att++;$incorrect++;$isempty="Incorrectly Answered";
if($get_result["sub_negative_marks"]==""){$mymarks=$mymarks-$get_result["negative_marks"];}else{$mymarks=$mymarks-$get_result["sub_negative_marks"];}
}
else
{
$natt++;$isempty="Not Attempted";
}
?>
<tr><td><a href='javascript:void(0);' onclick="fn_get_question('<?php echo $get_result["ques_id"];?>','<?php echo $i;?>');">#<?php echo $i;?></a></td><td><?php echo $get_result["subject_name"];?></td><td><?php echo $get_result["topic_name"];?><td>
<?php if($get_result["answer"]=="ans1")
{
$qrans="ans1,ans1_img";$isrc="answer_1";
}
elseif($get_result["answer"]=="ans2")
{
$qrans="ans2,ans2_img";$isrc="answer_2";
}
elseif($get_result["answer"]=="ans3")
{
$qrans="ans3,ans3_img";$isrc="answer_3";
}
else
{
$qrans="ans4,ans4_img";$isrc="answer_4";
}
if($get_result["correct"]=="ans1")
{
$qrc=" ans1,ans1_img";$icsrc="answer_1";
}
elseif($get_result["correct"]=="ans2")
{
$qrc=" ans2,ans2_img";$icsrc="answer_2";
}
elseif($get_result["correct"]=="ans3")
{
$qrc=" ans3,ans3_img";$icsrc="answer_3";
}
else
{
$qrc=" ans4,ans4_img";$icsrc="answer_4";
}
if($get_result["answer"]!="")
{
$answered = mysql_fetch_row(mysql_query("SELECT ".$qrans." FROM question_master where ques_id=".$get_result["ques_id"]));
}
else{
$answered[0]="Not Attempted";$answered[1]="";
}
$canswered = mysql_fetch_row(mysql_query("SELECT ".$qrc." FROM question_master where ques_id=".$get_result["ques_id"]));
echo $answered[0];
if($answered[1]!="")
{
echo "<img src='admin/uploads/$isrc/".$answered[1]."'/>";
}
echo "</td><td>".$canswered[0];
if($canswered[1]!="")
{
echo "<img src='admin/uploads/$icsrc/".$canswered[1]."'/>";
}
echo "</td><td>$scored</td><td>$isempty</td></tr><tr id='detail_".$i."' class='dRow'><td colspan='7' id='detail_col_".$i."'></td></tr>";
$i++;
}
$patt=round((($att/$tques)*100),2);$pnatt=round((($natt/$tques)*100),2);?>
<script>$(document).ready(function(){$('#mymarks').html("<?php echo $mymarks;?>");$('#totmarks').html("<?php echo $total;?>");$('#qcorrect').html("<?php echo $correct;?>");$('#qincorrect').html("<?php echo $incorrect;?>");$('#qtotal1').html("<?php echo $tques;?>");$('#qtotal2').html("<?php echo $tques;?>");var pBarWidth1=<?php echo $patt;?> * $("#percentAttemptProgress").width()/100;var pBarWidth2=<?php echo $pnatt;?> * $("#percentNotAttemptProgress").width()/100;$("#percentAttemptProgress").find('div').animate({width: pBarWidth1},2200).html(<?php echo $patt;?>+"%&nbsp;");$("#percentNotAttemptProgress").find('div').animate({width:pBarWidth2},2200).html(<?php echo $pnatt;?>+"%&nbsp;");});
</script>
</table>
<div align="center" style="width:470px;display:none;" id="quesDisplay" class="modalData"></div>
<br/>
</div>
</div>
</div>
</div>
<script>var chart2;var chartData=[{"type": "Incorrect Answers","value": <?php echo $incorrect;?>},{"type": "Correct Answers","value": <?php echo $correct;?>}];
var chartData2=[{"Marks": "Total Marks","scored": <?php echo $total;?>,"color":"#D2CB00"},{"Marks": "My Marks","scored": <?php echo $mymarks;?>,"color":"#BEDF66"}]; 
$(document).ready(function(){
$("html, body").scrollTop($(".mainHeading").offset().top);
var chart = new AmCharts.AmSerialChart();
chart.dataProvider = chartData2;
chart.categoryField = "Marks";
chart.startDuration = 2;
chart.depth3D = 20;
chart.angle = 30;
var categoryAxis = chart.categoryAxis;
categoryAxis.labelRotation = 45;
categoryAxis.dashLength = 5;
categoryAxis.gridPosition = "start";
var valueAxis = new AmCharts.ValueAxis();
valueAxis.title = "Marks";
valueAxis.stackType = "3d";
valueAxis.gridAlpha = 0.2;
valueAxis.axisColor = "#DADADA";
valueAxis.axisAlpha = 1;
valueAxis.dashLength = 5;
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
chart.write("chartdiv");

// PIE CHART

chart2 = new AmCharts.AmPieChart();   
chart2.dataProvider = chartData;
chart2.titleField = "type";
chart2.valueField = "value";
chart2.sequencedAnimation = true;
chart2.startEffect = "elastic";
chart2.innerRadius = "30%";
chart2.startDuration = 2;
chart2.labelRadius = 15;
chart2.balloonText = "[[title]]<br><span style='font-size:14px'><b>[[value]]</b> ([[percents]]%)</span>";
chart2.depth3D = 10;
chart2.angle = 15;                                
chart2.write("chartdiv2");
});
function fn_get_question(qid,rid){$("#detail_"+rid).slideToggle(function(){$("#detail_col_"+rid).html("");$("#detail_col_"+rid).html("&emsp;&emsp;<img src='images/busy.gif'>&emsp;Loading Please Wait....");$.ajax({type:"GET",data:'qid='+qid,url:"ajax/getQuestion.php",success:function(result){$("#detail_col_"+rid).html(result);}});});}</script>
<script src="js/amcharts.js" ></script><script type="text/javascript" src="js/pie.js"></script><script type="text/javascript" src="js/serial.js" ></script><?php require_once('footer.php');?>