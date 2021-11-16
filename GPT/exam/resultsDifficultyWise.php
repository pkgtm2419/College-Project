<?php  session_start();require_once('header.php');require_once('navigation.php');require_once 'admin/db_inc.php';?>
<link href="css/styles.css" rel="stylesheet">
<div id="main-body">
<div id="main-body-surround">
<div id="main-content" class="x-c-s">
<style>.main-form-table3 td{font-size: 13px;}.showPercent{margin-left:100px;margin-top: -22px;}.addborder tr{ border:1px solid silver;}.listyle{display: inline;list-style:none outside none;padding:9px;border-right:1px solid gray;cursor:pointer;}.liactive{background-color:#96AC20;color:#FFF;}.listyle a{ cursor:pointer;text-decoration:none;color:inherit;}.loadingDiv{height:18px;text-align:center;padding:10px;font-size:12px;font-weight:bold;}.loadingDivHide{display:none;}.resultsMenu{width:96%;border:1px solid gray;margin:10px 10px 15px 20px;padding:7px 0;}.negativeMarks{background-color:#F5F5DC;border-bottom:1px solid #C0C0C0;border-top:1px solid #C0C0C0;font-size:16px;font-weight:bold;padding:5px 0 5px 20px;}.sugestion{background-color:#F5F5F5;font-size:14px;padding-left:10px;padding-bottom:1px;}.sugestion img{vertical-align:bottom;width:20px;}.sugestionP{font-size:11px;}</style>
<div class="resultsMenu">
<ul><li class="listyle"><a href="results.php?event=<?php echo $_GET["event"];?>&tid=<?php echo $_GET['tid'];?>">Summary</a></li>
<li class="listyle"><a href="resultsSubjectWise.php?event=<?php echo $_GET["event"];?>&tid=<?php echo $_GET['tid'];?>">Subject Wise</a></li>
<li class="listyle liactive"><a href="#">Difficulty Wise</a></li>
</ul></div>
<div style="width:100%;">
<div style="font-size:13px;font-weight:bold;padding-left:20px;"><?php $get_test=mysql_fetch_array(mysql_query("select test_name,category_name from test_master t inner join category_master c on t.category_id=c.category_id where test_id=".$_GET["tid"]));echo $get_test[1]." > ".$get_test[0];?>&nbsp;>&nbsp;Difficulty Wise Analysis</div>
<div id="loadingDivMain" class="loadingDiv loadingDivHide"><img style="vertical-align:top;" src="images/busy.gif"/> Loading Chart. Please Wait...</div>
<div align="center" style="width:100%"><div id="chartdiv" style="width:500px;height:250px;margin-top:20px;"></div></div>
<br/><br/>
<div class="negativeMarks" style="font-size:15px;font-weight: bold;padding-left:20px;">Negative marks scored in various levels</div>
<div id="loadingDivNegative" class="loadingDiv loadingDivHide"><img style="vertical-align:top;" src="images/busy.gif"/> Loading Negative Marks Chart. Please Wait...</div>
<div align="center" style="width:100%"><div id="negativeChart" style="width:500px;height:250px;margin-top:20px;"></div></div>
</div>
</div>
</div>
</div>
<div class="loadingDivHide" id="getMainScripts"></div>
<div class="loadingDivHide" id="getNegativeMarksScript"></div>
<script>
$(document).ready(function(){
$("#loadingDivMain").removeClass("loadingDivHide");
$.ajax({type:"GET",data:'event=<?php echo $_GET["event"];?>&rnd='+Math.random()+'&tid=<?php echo $_GET['tid'];?>',url:"ajax/loadBarChartDifficultyWise.php",success:function(result){
$("#getMainScripts").html(result);
$("#loadingDivMain").addClass("loadingDivHide");
}});
$("#loadingDivNegative").removeClass("loadingDivHide");
$.ajax({type:"GET",data:'event=<?php echo $_GET["event"];?>&AjaxRequestId='+Math.random()+'&tid=<?php echo $_GET['tid'];?>',url:"ajax/loadNegativeMarksBarChartDifficultyWise.php",success:function(result){
$("#getNegativeMarksScript").html(result);
$("#loadingDivNegative").addClass("loadingDivHide");
}});
});
</script>
<script src="js/amcharts.js" ></script>
<script type="text/javascript" src="js/serial.js" ></script>
<?php require_once('footer.php');?>