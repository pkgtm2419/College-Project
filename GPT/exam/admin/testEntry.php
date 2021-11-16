<?php require_once 'db_inc.php';require_once 'header.php';?>
<div id="tab-1" class="tab">
<article>
    <div class="text-section">
        <h1>Test Entry</h1>
        <p><!--This is a quick overview of some features--></p>
    </div>
  <?php if(isset($_GET["res"])){
if($_GET["res"]=="er"){?>
 <ul class='states'><li class='error'>Error : Question Already Exists.</li></ul>
<?php } if($_GET["res"]=="success") {  ?>
<ul class='states'><li class='succes'>Success : Question Updated successfully.</li></ul>
<?php } if($_GET["res"]=="val") {  ?>
<ul class='states'><li class='error'>Error : Kindly fill all the fields.</li></ul>
<?php }}?>
<style>.main-form-table3 a{cursor:pointer;}.addSubDetail{display:none;clear:both;}</style>
<?php if(isset($_GET["type"])){
if($_GET["type"]=="new"){?>
<form id="testEntry" autocomplete="off" name="testEntry" action="testEntrySave.php" method="POST">
<table class="main-form-table">
<tr style="height:20px;"><td>&nbsp;</td></tr>
<tr><td>Category</td><td>
<select id="cname" name="cname" class="dropdown required">
<option value="">Select Category</option>
<?php $tres=mysql_query("select * from category_master");
while($trow=mysql_fetch_array($tres)){echo "<option value='".$trow["category_id"]."'>".$trow["category_name"]."</option>";}?>
</select></td></tr>
<tr><td>Test Name</td><td><input class="inp-form required" type="text" id="tname" name="tname" placeholder="Enter test Name"/></td></tr>
<tr><td>Test Type</td><td><select id="isEvent" class="dropdown required" name="isEvent"><option value="F">Free Test</option><option value="P">Paid Test</option><option value="E">Event</option></select></td></tr>
<!--<tr id="trEventDisplay" style="display:none;"><td>Event Name</td><td><input class="inp-form" type="text" id="ename" name="ename" placeholder="Enter Event Name"/></td></tr>-->
<tr><td>Test Duration (in min)</td><td><input class="inp-form required" type="text" id="duration" name="duration" maxlength="4"/></td></tr>
<tr><td>Cut Off Marks</td><td><input class="inp-form" type="text" id="cutoffmarks" maxlength="4" name="cutoffmarks" /></td></tr>
<tr><td>Negative Marks</td><td><input class="inp-form" type="text" id="negativeMarks"  maxlength="2" name="negativeMarks" /></td></tr>
<!--<tr><td>Below Average Marks</td><td><input class="inp-form required" type="text" id="belowAverageMarks" maxlength="4" name="belowAverageMarks" /></td></tr>
<tr><td>Average Marks</td><td><input class="inp-form required" type="text" id="averageMarks"  name="averageMarks" maxlength="4" /></td></tr>
<tr><td>Above Above Marks</td><td><input class="inp-form required" type="text" id="aboveAverageMarks" name="aboveAverageMarks" maxlength="4"/></td></tr>  -->
  <tr><td>Add Subjects</td><td><table><tr>
  <?php $i=1;$totalSub=0;$tres=mysql_query("select * from subject_master");while($trow=mysql_fetch_array($tres)){echo "<td><input id='chkSub_$i' name='chkSub[$i]' onclick='fn_add_subject(this)' type='checkbox' value='".$trow["subject_id"]."'/>".$trow["subject_name"]."<br/>
  <div id='addSubDetail_$i' class='addSubDetail'>
  <input style='width:100px;' class='inp-form' type='text' name='cutoffmarksS[$i]' maxlength='4' placeholder='Cut Off Marks'/>&ensp;
  <input style='width:100px;' class='inp-form' type='text' name='negativeMarksS[$i]' maxlength='2' placeholder='Negative Marks'/></div></td>";if($i%2==0){echo"</tr><tr>";}$i++;$totalSub++;}?>
  <input type="hidden" value="<?php echo $totalSub;?>" name="totalSub"/>
  <!--&ensp;<input style='width:120px;' class='inp-form' type='text' name='belowAverageMarksS[$i]' maxlength='4' placeholder='Below Average Marks'/>&ensp;
  <input style='width:120px;' class='inp-form' type='text' name='averageMarksS[$i]' maxlength='4' placeholder='Average Marks'/>&ensp;
  <input style='width:120px;' class='inp-form' type='text' name='aboveAverageMarksS[$i]' maxlength='4' placeholder='Above Average Marks'/>-->
  </tr></table></td></tr>
<!--  <tr><td>Instructions</td><td><textarea cols="70" rows="10" class="txtarea required" id="instructions" name="instructions"></textarea>  </td></tr>-->
         <tr style="height:15px;"><td>&nbsp;<input type="hidden" value=""  id="tHidden" name="tHidden"/></td></tr>
       <tr><td><input type="submit" value="Submit" name="submit" class="submit-button"/> </td><td><input type="reset" class="reset-button" id="reset"/></td></tr>
      </table>
      </form>
      <?php }
	if($_GET["type"]=="edit"){
    if(isset($_GET["tid"]))
	{	
	?>
     <form id="testEntry" name="testEntry" action="testEntrySave.php" method="POST">
     <?php $tres=mysql_query("select * from test_master where test_id=".$_GET["tid"]);
	 while($trow=mysql_fetch_array($tres))
	 {
	 ?>  
<table class="main-form-table">
<tr style="height:20px;"><td>&nbsp;</td></tr>

<tr><td>Category</td><td>
<select id="cname" name="cname" class="dropdown required">
<option value="">Select Category</option>
<?php $cres=mysql_query("select * from category_master");
while($crow=mysql_fetch_array($cres)){echo "<option value='".$crow["category_id"]."'>".$crow["category_name"]."</option>";}?>
</select></td></tr>
<tr><td>Test Type</td><td><select id="isEvent" class="dropdown required" name="isEvent"><option value="F">Free Test</option><option value="P">Paid Test</option><option value="E">Event</option></select></td></tr>
<script>function dispdata(){$("#cname").val("<?php echo $trow["category_id"];?>");$("#isEvent").val("<?php echo $trow["isEvent"];?>");}dispdata();</script>
<tr><td>Test Name</td><td><input class="inp-form required" type="text" id="tname" name="tname" value="<?php echo $trow["test_name"];?>" placeholder="Enter test Name"/></td></tr>
<tr><td>Test Duration (in min)</td><td><input class="inp-form required" type="text" id="duration" value="<?php echo $trow["test_duration"];?>" name="duration" maxlength="4"/></td></tr>
<tr><td>Cut Off Marks</td><td><input class="inp-form required" type="text" id="cutoffmarks" maxlength="4" name="cutoffmarks" value="<?php echo $trow["cutoff_marks"];?>"/></td></tr>
<tr><td>Negative Marks</td><td><input class="inp-form required" type="text" id="negativeMarks"  maxlength="2" name="negativeMarks" value="<?php echo $trow["negative_marks"];?>"/></td></tr>
<!--<tr><td>Below Average Marks</td><td><input class="inp-form required" type="text" id="belowAverageMarks" maxlength="4" name="belowAverageMarks" value="<?php //echo $trow["below_average_marks"];?>"/></td></tr>
<tr><td>Average Marks</td><td><input class="inp-form required" type="text" id="averageMarks" name="averageMarks" maxlength="4" value="<?php //echo $trow["average_marks"];?>"/></td></tr>
<tr><td>Above Above Marks</td><td><input class="inp-form required" type="text" id="aboveAverageMarks" name="aboveAverageMarks" maxlength="4" value="<?php //echo $trow["above_average_marks"];?>"/></td></tr> --> 
  <tr><td>Add Subjects</td><td><table><tr><?php $i=1;$totalSub=0;$sres=mysql_query("select s.subject_id as subid,s.subject_name,tsm.* from subject_master s left join test_subject_relation_master tsm on s.subject_id=tsm.subject_id and tsm.test_id=".$trow["test_id"]);
  while($srow=mysql_fetch_array($sres)){
  echo "<td><input id='chkSub_$i' name='chkSub[$i]' onclick='fn_add_subject(this)' type='checkbox' value='".$srow["subid"]."'";
  if($srow["subject_id"]!=""){echo "checked='checked'";}echo"/>".$srow["subject_name"]."<br/><div id='addSubDetail_$i' ";
  if($srow["subject_id"]==""){echo "class='addSubDetail'";}
  echo "><input style='width:100px;' value='".$srow["cutoff_marks"]."' class='inp-form' type='text' name='cutoffmarksS[$i]' maxlength='4' placeholder='Cut Off Marks'/>&ensp;<input style='width:100px;' value='".$srow["negative_marks"]."' class='inp-form' type='text' name='negativeMarksS[$i]' maxlength='2' placeholder='Negative Marks'/></div></td>";if($i%2==0){echo"</tr><tr>";}$i++;$totalSub++;}?>
  <input type="hidden" value="<?php echo $totalSub;?>" name="totalSub"/>
 <!-- &ensp;<input style='width:120px;' value='".$srow["average_marks"]."' class='inp-form' type='text' name='belowAverageMarksS[$i]' maxlength='4' placeholder='Below Average Marks'/>&ensp;<input style='width:120px;' value='".$srow["below_average_marks"]."' class='inp-form' type='text' name='averageMarksS[$i]' maxlength='4' placeholder='Average Marks'/>&ensp;<input style='width:120px;' value='".$srow["above_average_marks"]."' class='inp-form' type='text' name='aboveAverageMarksS[$i]' maxlength='4' placeholder='Above Average Marks'/>-->
  </tr></table></td></tr>
<!--  <tr><td>Instructions</td><td><textarea cols="70" rows="10" class="txtarea" id="instructions" name="instructions"><?php //echo $trow["instructions"];?></textarea></td></tr>-->
         <tr style="height:15px;"><td>&nbsp;<input type="hidden" id="tHidden" name="tHidden" value="<?php echo $trow["test_id"];?>"/></td></tr>
       <tr><td><input type="submit" value="Submit" name="submit" class="submit-button"/> </td><td><input type="reset" class="reset-button" id="reset"/></td></tr>
      </table>
      </form>      
 <?php }
	}
}   
}?>   
      <br/><br/>
      <link rel="stylesheet" type="text/css" href="css/stylespaginate.css" media="screen"/>
       <div id="paging_container" class="container">       
		<!--<input type="text" class="search inp-form" name="search" placeholder="Search..." maxlength="50">-->
       <div class="page_navigation"></div>
     <table style="text-align:center;" class="content main-form-table3" width="100%">
    <thead><tr><th>SNo.</th><th>Category</th><th>Test Name</th><th>Test Type</th><th>Cut Off Marks</th><th>Duration(min)</th><th>Is Visible</th><th>Actions</th></tr></thead>
     <tbody><?php $i=1;$res=mysql_query("select test_id,test_name,isEvent,cutoff_marks,test_duration,isVisible,category_name from test_master t inner join category_master c on t.category_id=c.category_id");while($row=mysql_fetch_array($res)){
	echo "<tr id='r$i'><td>$i</td><td>".$row["category_name"]."</td><td><a href='questionEntry.php?tid=".$row["test_id"]."&type=new'>".$row["test_name"]."</a></td><td>".$row["isEvent"]."</td><td>".$row["cutoff_marks"]."</td><td>".$row["test_duration"]."</td><td><input type='checkbox'";if($row["isVisible"]==""){echo "checked='checked'";}echo " value='".$row["test_id"]."' onclick=\"fn_display_it(this,'$i');\"/>";?></td><td><a onclick="fn_set('e','<?php echo $row["test_id"];?>');">Edit</a>&ensp;<a onclick="fn_set('d','<?php echo "$i','".$row["test_id"];?>');">Delete</a></td></tr><?php $i++;}?>
       </tbody>
      </table>
       <div class="page_navigation"></div></div>
	</article>
	</div>
<script>
function fn_add_subject(chk){var id=chk.id.split("_");if(chk.checked==true){$("#addSubDetail_"+id[1]).show("fast");}else{$("#addSubDetail_"+id[1]).hide("fast");}}
function fn_set(t,rid,id)
{
if(t=="e"){if(confirm("Edit this Test ?")){window.open("testEntry.php?type=edit&tid="+rid,"_parent");}}if(t=="d"){if(confirm("Delete this test ?")){$("#reset").trigger('click');$.ajax({type:"POST",data:'t=del&id='+id,url:"testEntryAjax.php",success:function(result){if(result=="s"){$("#r"+rid).slideUp();}else{$("#r" +rid).after("<tr id='tmp"+rid+ "' class='red-left'><td colspan='3'>Sorry could not process the request.\n try again later.</td></tr>");$("#tmp"+rid).slideUp(6000);}}});}}
}
function fn_display_it(chk,rid){
if(chk.checked==true){
if(confirm("Are You sure to display this Test."))
{
$("#reset").trigger('click');$.ajax({type:"POST",data:'t=show&id='+chk.value,url:"testEntryAjax.php",success:function(result){if(result=="s"){$("#r"+rid).after("<tr id='tmp"+rid+ "' class='green-left'><td colspan='3'>Successfully displayed this test.</td></tr>");$("#tmp"+rid).slideUp(6000);}else{$("#r"+rid).after("<tr id='tmp"+rid+"' class='red-left'><td colspan='3'>Sorry could not process the request.\n try again later.</td></tr>");$("#tmp"+rid).slideUp(6000);}}});
}else{chk.checked=false;}
}
else{
if(confirm("Are You sure to hide this Test."))
{
$("#reset").trigger('click');$.ajax({type:"POST",data:'t=hide&id='+chk.value,url:"testEntryAjax.php",success:function(result){if(result=="s"){$("#r" +rid).after("<tr id='tmp"+rid+ "' class='green-left'><td colspan='3'>Successfully hidden this test.</td></tr>");$("#tmp"+rid).slideUp(6000);}else{$("#r" +rid).after("<tr id='tmp"+rid+ "' class='red-left'><td colspan='3'>Sorry could not process the request.\n try again later.</td></tr>");$("#tmp"+rid).slideUp(6000);}}});
}else{chk.checked=true;}
}
}
$(document).ready(function(){$("#testEntry").validate();$('#paging_container').shashwat3({items_per_page:15,num_page_links_to_display:10,nav_label_next:"<img src='images/snext.png'/>",nav_label_prev:"<img src='images/sprevious.png'/>",abort_on_small_lists:true});
//bkLib.onDomLoaded(function(){new nicEditor({fullPanel:true,iconsPath:'images/nicEditorIcons.gif'}).panelInstance('instructions');});
});</script><script src="js/jquery003.js" type="text/javascript"></script><script src="js/jquery.validate.min.js" type="text/javascript"></script><?php include_once 'footer.php'?>