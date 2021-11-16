<?php  session_start();$msg="";extract($_GET);
require_once 'admin/db_inc.php';$msg="";
error_reporting(E_ALL); ini_set('display_errors', 'On');
if(isset($_GET["submit"]))
{
$coupon="";for($j=0;$j<4;$j++){$coupon .=$CouponCode[$j];}
$dup2row=mysql_fetch_row(mysql_query("select COUNT(1) from coupons where CouponCode='".$coupon."'  and IsActive='1' and RedeemUser='0'"));
if($dup2row[0]>0){header("Location:instructions.php?tid=".$tid);die();}
else{$msg="<ul class='states'><li class='error'>Error : Invalid Coupon.</li></ul>";
}
}
require_once('header.php');require_once('navigation.php');?>
<style>.main-form-table3 td{ padding-left:10px;border: 1px solid #C0CD79;}.main-form-table3 img{cursor:pointer;}.mainth{font-size:17px;width:100px;}.couponCode{font-size: 16px;width: 60px;}.states{list-style:none;margin:0;padding:0;}.states li{vertical-align:top;margin:0 0 1px;padding:9px 5px 12px 55px;}.states .error{background:#ffdede url(images/sprite.png) no-repeat 17px -712px;color:#be0000;}.pbold{font-weight:bold;}.gins{font-size: 15px;padding-left: 10px;text-decoration: underline;}.headDiv{background-color:#96AC20;padding: 4px 0 4px 10px;}#loadTest p{font-size:13px;margin-top:0px;margin-bottom: 12px;}.ppad{ padding-left:20px;}</style>
<link rel="stylesheet" type="text/css" href="css/styles.css"/>
<div id="main-body">
<div id="main-body-surround">
<div id="main-content" class="x-c-s">
<br/><br/>
<?php echo $msg;?><div style="margin:0 auto ; width:550px;"> 
<table class="main-form-table" width="100%">
<tr><td class="mainth"><div style="font-size:14px;background-color:#C0CD79;margin:10px 10px 0;padding: 10px;font-weight: bold;">Paid Exam Name > <?php $test=mysql_fetch_array(mysql_query("Select test_name from test_master where isVisible is null and test_id ='$tid'")); echo  $test[0];?></div>
</td></tr>
<tr><td>
<div style="padding:10px; margin:10px;" class="ui-state-highlight ui-corner-all"><span style="margin:3px; float:left;" class="ui-icon ui-icon-alert">&nbsp;</span><span style="margin:-17px 0 3px 20px; float:left; width:490px;">This is Paid Exam. You will have to purchase it through a coupon code. <br>
To purchase a coupon code <a style="font-weight:bold; text-decoration:underline; color:#990000;" href="contact.php">Contact Us</a><br/>
If you have a Coupon you can purchase this exam by entering the code below</span>
<br style="clear:left;"></div>                                                                        
</td></tr>
<tr><td>
<div class="ui-state-default ui-corner-all" style="padding:15px; width:500px; margin:0 auto; font-size:16px">

  <form method="GET" action="buyTest.php?tid=<?php echo $tid; ?>">
    <strong>Enter Coupon Code : </strong>
    <?php
for($i = 0; $i < 4; $i++)
{
echo '<input class="couponCode" maxlength="4" id="coupon'.$i.'" type="text" name="CouponCode['.$i.']" value="">';
echo ($i < 3) ? '-' : '';
}
?>
    <div style="padding:20px; text-align:center;">
      <input type="submit" style="padding:10px; font-size:16px;" name="submit" value="Purchase This Exam" />
    </div>
    <input type="hidden" name="tid" value="<?php echo $tid; ?>" />
  </form>
 </div>

</td></tr></table></div>

<br/><br/>
</div></div></div>
<script type="text/javascript">
$(document).ready(function(){
$('input.couponCode').bind('keyup', function(){ 
CurrentID = parseInt($(this).attr('id').substr(-1, 1));
if (CurrentID == 3)
return true;
if ($(this).val().length > 3)
{
$('#coupon' + (CurrentID + 1)).focus();
$('#coupon' + (CurrentID + 1)).select();
}
});
});
</script>
<?php require_once('footer.php');?>