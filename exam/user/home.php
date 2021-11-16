<?php session_start();
require_once('header.php');
require_once('navigation.php');
?>
<style>.main-form-table3 td{ padding-left:10px;border: 1px solid #C0CD79;}.main-form-table3 img{cursor:pointer;vertical-align:top;}.mainth{font-size:17px;width:100px;}
#loadTest{color:black;}#loadTest img{width:15px;vertical-align:top;margin-right:7px;}.pbold{font-weight:bold;}.gins{font-size: 15px;padding-left: 10px;text-decoration: underline;}.headDiv{background-color:#96AC20;padding: 4px 0 4px 10px;}#loadTest p{font-size:13px;margin-top:0px;margin-bottom: 12px;}#loadTest span{font-size:13px;padding-left: 8px;vertical-align: top;}.ppad{ padding-left:20px;}</style>
<link rel="stylesheet" type="text/css" href="css/styles.css"/>
<div id="main-body">
<div id="main-body-surround">
<div id="main-content" class="x-c-s">
<br/><br/>
<link type='text/css' href='css/basic.css' rel='stylesheet' media='screen' />
<!--[if lt IE 7]>
<link type='text/css' href='css/basic_ie.css' rel='stylesheet' media='screen' />
<![endif]-->
<table class="main-form-table3" style="margin-left: 30px;">
<tr style="background-color:#0c5a74;"><td style="width: 250px; color:#fff"  class="mainth">Online Test</td><td style="color:#fff" class="mainth">Category</td><td style="color:#fff"" class="mainth">Duration</td><td class="mainth">&nbsp;</td></tr>
<?php 
require_once('admin/db_inc.php');
if(isset($_SESSION['admin_notice']))
{
    echo '<center><font size="5" color="red">'.$_SESSION['admin_notice'].'</font></center>';
    $_SESSION['admin_notice']=null;
}

$classme=$_SESSION['class'];
$sql="Select test_id,test_name,category_name,test_duration,isEvent from test_master t inner join category_master c on t.category_id=c.category_id where isVisible is null and t.category_id='$classme'";
if(!($_SESSION['paid']))
{
$sql.="and isEvent='F'";
}
$res=mysql_query($sql);
while($row=mysql_fetch_array($res))
{
	if($row["isEvent"]=="F"){
?>
<tr valign="middle"><td><img src="images/rss-top.png"/>&ensp;<?php echo $row["test_name"];?></td><td><?php echo $row["category_name"];?></td><td><?php echo $row["test_duration"];?> min</td><td><a href="instructions.php?tid=<?php echo $row["test_id"];?>" style="background:url(images/start.jpg) no-repeat scroll 0 0 rgba(0, 0, 0, 0);float: left;height: 28px;width: 81px;"></a></td></tr>
<?php }
else{
?>
<tr valign="middle"><td><img src="images/PAID.png"/>&ensp;<?php echo $row["test_name"];?></td><td><?php echo $row["category_name"];?></td><td><?php echo $row["test_duration"];?> min</td><td><a href="instructions.php?tid=<?php echo $row["test_id"];?>" style="background:url(images/start.jpg) no-repeat scroll 2px 2px rgba(0, 0, 0, 0);float: left;height: 28px;width: 81px;"></a></td></tr>
<?php	
}
}?>
</table>
<div style="display:none;" id="loadTest">Hello</div>
<br/><br/>
</div></div></div>
<script>function fn_open_test(id){$.blockUI({message:'<div class="block-ui-popup"><img src="images/busy.gif"/>&ensp;Loading Test Instructions. Please Wait...</div>'});$.ajax({type:"POST",data:'tid='+id+'&rd='+Math.random(),url:"ajax/loadtestInstructions.php",success:function(result){$.unblockUI();if(result=="e"){alert("Sorry There has been some error. kindly try again.");}else{$("#loadTest").html(result).modal({minHeight:'400px',autoResize:true});}},error:function(jqXHR,textStatus,errorThrown){$.unblockUI();alert("Sorry the server is Currently Very busy. Please try again.");}});}function fn_start_test(id){$.modal.close();window.open('exam.php?tid='+id,'_blank','channelmode=yes,fullscreen=yes,scrollbar=yes,location=no,menubar=no,status=no,toolbar=no');}</script><script type='text/javascript' src='js/jquery009.js'></script><script type='text/javascript' src='admin/js/jquery002.js'></script><?php require_once('footer.php');?>