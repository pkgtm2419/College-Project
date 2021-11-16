<?php include_once 'header.php'?><style>.main-form-table3 a{cursor:pointer;}</style>
<div id="tab-1" class="tab">
						<article>
							<div class="text-section">
								<h1>Topic Entry</h1>
								<p><!--This is a quick overview of some features--></p>
							</div>
<?php include 'db_inc.php';
	$msg="";
	if($_SERVER['REQUEST_METHOD']=="POST" && isset($_POST["submit"]))
	{
	if(($_POST['tname']!="")&&($_POST['sname']!=""))
	{
	if($_POST["tHidden"] !="")
	{
  				$dup2row=mysql_fetch_array(mysql_query("select count(*) from topic_master where topic_name='".$_POST['tname']."' and topic_id <>".$_POST["tHidden"]));
				if($dup2row[0]>0)
				{
					$msg="<ul class='states'><li class='error'>Error : topic Already Exists.</li></ul>";;
				}
				else
				{				
					mysql_query("update topic_master set topic_name='".$_POST['tname']."',subject_id='".$_POST['sname']."' where topic_id=".$_POST['tHidden']) or die ('topic update failed');
				$msg="<ul class='states'><li class='succes'>success : topic Updated successfully.</li></ul>";						
				}
	}
	else
	{
  			$dup2row=mysql_fetch_row(mysql_query("select count(*) from topic_master where topic_name='".$_POST["tname"]."'"));
			if($dup2row[0]>0)
				{
					$msg="<ul class='states'><li class='error'>Error : topic Already Exists.</li></ul>";
				}
				else
				{				
mysql_query("INSERT INTO topic_master (topic_name,subject_id) VALUES('".$_POST["tname"]."','".$_POST["sname"]."')") or die ('topic Saving Failed.'. mysql_error());
					$msg="<ul class='states'><li class='succes'>success : topic Added successfully.</li></ul>";		
				}
	}
}else{$msg="<ul class='states'><li class='error'>Error : Please All the feilds.</li></ul>";}}echo $msg;?>
    <form id="topicEntry" name="topicEntry" action="<?php $_PHP_SELF?>" method="POST">
   <table class="main-form-table">
       <tr style="height:20px;"><td>&nbsp;</td></tr>
       <tr><td>Subject Name</td><td>
       <select id="sname" name="sname" class="dropdown">
       <option value="">Select Subject</option>
       <?php $tres=mysql_query("select * from subject_master");
	   while($trow=mysql_fetch_array($tres)){echo "<option value='".$trow["subject_id"]."'>".$trow["subject_name"]."</option>";}?>
       </select></td></tr>
        <tr><td>Topic Name</td><td><input type="text" id="tname" name="tname" class="inp-form"/></td></tr>
         <tr style="height:15px;"><td>&nbsp;<input type="hidden" value=""  id="tHidden" name="tHidden"/></td></tr>
       <tr><td><input type="submit" value="Submit" name="submit" class="submit-button"/> </td><td><input type="reset" class="reset-button" id="reset"/></td></tr>
      </table>
      </form>
      <br/><br/>
     <table style="text-align:center;" class="main-form-table3" width="100%">
    <thead><tr><th>SNo.</th><th>Subject Name</th><th>Topic Name</th><th>Actions</th></tr></thead>
     <tbody><?php $i=1;$res=mysql_query("select t.*,subject_name from topic_master t inner join subject_master s on t.subject_id=s.subject_id");
	while($row=mysql_fetch_array($res)){
	echo "<tr id='r$i'><td>$i</td><td>".$row["subject_name"]."</td><td>".$row["topic_name"]."</td><td>";?><a onclick="fn_set('e','<?php echo "$i','".$row["topic_id"]."','".$row["topic_name"]."','".$row["subject_id"];?>');">Edit</a>&ensp;<a onclick="fn_set('d','<?php echo "$i','".$row["topic_id"];?>');">Delete</a></td></tr><?php $i++;}?>
       </tbody>
      </table>
	</article>
	</div>
<script>
function fn_set(t,rid,id,name,sname)
{
if(t=="e"){if(confirm("Edit this topic ?")){$("#tname").val(name);$("#tHidden").val(id);$("#sname").val(sname);}}
if(t=="d"){if(confirm("Delete this topic ?")){$("#reset").trigger('click');$.ajax({type:"POST",data:'id='+id,url:"topicEntryAjax.php",success:function(result){if(result=="s"){$("#r"+rid).slideUp();}else{$("#r" +rid).after("<tr id='tmp"+rid+ "' class='red-left'><td colspan='3'>Sorry could not process the request.\n try again later.</td></tr>");$("#tmp"+rid).slideUp(6000);}}});}}
}
</script>
<?php include_once 'footer.php'?>