<?php include_once 'header.php'?><style>.main-form-table3 a{cursor:pointer;}.HideContent{display:none;}</style>
<div id="tab-1" class="tab">
<article>
<div class="text-section">
<h1>Event Management</h1>
<p><!--This is a quick overview of some features--></p>
</div>
<?php include 'db_inc.php';?>
<br/>
<table id="test_display_table" style="text-align:center;" class="main-form-table3" width="100%">
 <thead><tr><th>SNo.</th><th>Category</th><th>Event Name</th><th>Cut Off Marks</th><th>Duration(min)</th><th>Is Visible</th><th>View Results</th></tr></thead>
<tbody>
<?php $i=1;$res=mysql_query("select test_id,test_name,isEvent,cutoff_marks,test_duration,isVisible,category_name from test_master t inner join category_master c on t.category_id=c.category_id where isEvent='E'");while($row=mysql_fetch_array($res)){
echo "<tr id='r$i'><td>$i</td><td>".$row["category_name"]."</td><td><a href='eventQuestionEntry.php?type=new&tid=".$row["test_id"]."'>".$row["test_name"]."</a></td><td>".$row["cutoff_marks"]."</td><td>".$row["test_duration"]."</td><td><input type='checkbox'";if($row["isVisible"]==""){echo "checked='checked'";}echo " value='".$row["test_id"]."' onclick=\"fn_display_it(this,'$i');\"/>";?></td><td><a onclick="fn_view_results('<?php echo $row["test_id"];?>');">View</a></td></tr><?php $i++;}?>


</tbody>
</table>
<br/>
<ul style="display:none;" class='states'><li class='succes'>Success : Mail Sent successfully.</li></ul>
<div style="padding-right:20px;float:right;"  id="sendMail" class="HideContent"><input type="button" onClick="sendmail();" value="Send Mail" class="submit-button"/>&emsp;<input id="exportexcel" type="button" value="Export To Excel" class="submit-button"/></div>
<table id="test_display_table" style="text-align:center;" class="main-form-table3 HideContent" width="100%">
<thead>
<tr><th>SNo.</th><th>Name</th><th>Email</th><th>Marks Scored</th></tr></thead>

<tbody id="loadData"></tbody></table>
</article>
</div>
<script>
function sendmail(){
if(confirm("Are You Sure to send mail.?"))
{
$.blockUI({message:'<div class="block-ui-popup"><img src="login/images/busy.gif"/>&ensp;Loading Event Results. Please Wait...</div>'});
$.ajax({type:"GET",data:'&ajaxRequestId='+Math.random()+'&tid='+$("#ename").val()+'&type=sendmail',url:"manageEventAjax.php",success:function(result){
if(result="s"){$.unblockUI();$(".states").removeAttr("style");$(".succes").html("Success : Mail Sent Successfully.");}
}});
}
}
function fn_view_results(tid){
$.blockUI({message:'<div class="block-ui-popup"><img src="login/images/busy.gif"/>&ensp;Loading Event Results. Please Wait...</div>'});
$("#loadData").html("");
$.ajax({type:"GET",data:'&ajaxRequestId='+Math.random()+'&tid='+tid+'&type=view',url:"manageEventAjax.php",success:function(result){
$("#loadData").html(result);$(".main-form-table3").removeClass("HideContent");$.unblockUI();
$("#sendMail").removeClass("HideContent");
$("#exportexcel").attr("onclick","javascript:window.open('exportEventResultToExcel.php?tid="+tid+"','_blank');");
}});
}
function fn_display_it(chk,rid){
if(chk.checked==true)
{
if(confirm("Are You sure to display this Test."))
{
$("#reset").trigger('click');$.ajax({type:"POST",data:'t=show&id='+chk.value,url:"testEntryAjax.php",success:function(result){if(result=="s"){$("#r"+rid).after("<tr id='tmp"+rid+ "' class='green-left'><td colspan='3'>Successfully displayed this event.</td></tr>");$("#tmp"+rid).slideUp(6000);}else{$("#r"+rid).after("<tr id='tmp"+rid+"' class='red-left'><td colspan='3'>Sorry could not process the request.\n try again later.</td></tr>");$("#tmp"+rid).slideUp(6000);}}});
}else{chk.checked=false;}
}
else{
if(confirm("Are You sure to hide this Test."))
{
$("#reset").trigger('click');$.ajax({type:"POST",data:'t=hide&id='+chk.value,url:"testEntryAjax.php",success:function(result){if(result=="s"){$("#r" +rid).after("<tr id='tmp"+rid+ "' class='green-left'><td colspan='3'>Successfully hidden this event.</td></tr>");$("#tmp"+rid).slideUp(6000);}else{$("#r" +rid).after("<tr id='tmp"+rid+ "' class='red-left'><td colspan='3'>Sorry could not process the request.\n try again later.</td></tr>");$("#tmp"+rid).slideUp(6000);}}});
}else{chk.checked=true;}
}
}</script><script type="text/javascript" src="js/jquery002.js"></script>
<?php include_once 'footer.php'?>