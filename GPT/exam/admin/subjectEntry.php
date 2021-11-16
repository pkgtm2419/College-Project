<?php include_once 'header.php'?><style>.main-form-table3 a{cursor:pointer;}</style>
<div id="tab-1" class="tab">
						<article>
							<div class="text-section">
								<h1>Subject Entry</h1>
								<p><!--This is a quick overview of some features--></p>
							</div>
<?php include 'db_inc.php';$msg="";
	if($_SERVER['REQUEST_METHOD']=="POST" && isset($_POST["submit"]))
	{
	if($_POST['sname']!="")
	{
	if($_POST["sHidden"] !="")
	{
  				$dup2row=mysql_fetch_array(mysql_query("select count(*) from subject_master where subject_name='".$_POST['sname']."' and subject_id <>".$_POST["sHidden"]));
				if($dup2row[0]>0)
				{
					$msg="<ul class='states'><li class='error'>Error : Subject Already Exists.</li></ul>";;
				}
				else
				{				
					mysql_query("update subject_master set subject_name='".$_POST['sname']."' where subject_id=".$_POST['sHidden']) or die ('subject update failed');
				$msg="<ul class='states'><li class='succes'>success : Subject Updated successfully.</li></ul>";						
				}
	}
	else
	{
  			$dup2row=mysql_fetch_row(mysql_query("select count(*) from subject_master where subject_name='".$_POST["sname"]."'"));
			if($dup2row[0]>0)
				{
					$msg="<ul class='states'><li class='error'>Error : Subject Already Exists.</li></ul>";
				}
				else
				{				
mysql_query("INSERT INTO subject_master (subject_name) VALUES('".$_POST["sname"]."')") or die ('Subject Saving Failed.'. mysql_error());
					$msg="<ul class='states'><li class='succes'>success : Subject Added successfully.</li></ul>";		
				}
	}
}else{$msg="<ul class='states'><li class='error'>Error : Subject Name Cannot be blank.</li></ul>";}}echo $msg;?>
    <form id="subjectEntry" name="subjectEntry" action="<?php $_PHP_SELF?>" method="POST">
   <table class="main-form-table">
       <tr style="height:20px;"><td>&nbsp;</td></tr>
        <tr><td>Subject Name</td><td><input class="inp-form" type="text" id="sname" name="sname" placeholder="Enter Subject Name"/>  </td></tr>
        <!--<tr><td>Cut Off Marks</td><td><input class="inp-form" type="text" id="cutoffmarks" maxlength="2" name="cutoffmarks" /></td></tr>
 		 <tr><td>Negative Marks</td><td><input class="inp-form" type="text" id="marks"  maxlength="1" name="marks" /></td></tr>
  		<tr><td>Below Average Marks</td><td><input class="inp-form" type="text" id="marks" maxlength="2" name="marks" /></td></tr>
  		<tr><td>Average Marks</td><td><input class="inp-form" type="text" id="marks"  name="marks" maxlength="2" /></td></tr>
  		<tr><td>Above Above Marks</td><td><input class="inp-form" type="text" id="marks" name="marks" maxlength="2"/></td></tr>-->
         <tr style="height:15px;"><td>&nbsp;<input type="hidden" value=""  id="sHidden" name="sHidden"/></td></tr>
       <tr><td><input type="submit" value="Submit" name="submit" class="submit-button"/></td><td><input type="reset" class="reset-button" id="reset"/></td></tr>
      </table>
      </form>
      <br/><br/>
     <table style="text-align:center;" class="main-form-table3" width="100%">
    <thead><tr><th>SNo.</th><th>Subject Name</th><th>Actions</th></tr></thead>
     <tbody><?php $i=1;$res=mysql_query("select * from subject_master");
	while($row=mysql_fetch_array($res)){
	echo "<tr id='r$i'><td>$i</td><td>".$row["subject_name"]."</td><td>";?><a onclick="fn_set('e','<?php echo "$i','".$row["subject_id"]."','".$row["subject_name"];?>');">Edit</a>&ensp;<a onclick="fn_set('d','<?php echo "$i','".$row["subject_id"];?>');">Delete</a></td></tr><?php $i++;}?>
       </tbody>
      </table>
	</article>
	</div>
<script>
function fn_set(t,rid,id,name)
{
if(t=="e"){if(confirm("Edit this Subject ?")){$("#sname").val(name);$("#sHidden").val(id);}}
if(t=="d"){if(confirm("Delete this Subject ?")){$("#reset").trigger('click');$.ajax({type:"POST",data:'id='+id,url:"subjectEntryAjax.php",success:function(result){if(result=="s"){$("#r"+rid).slideUp();}else{$("#r" +rid).after("<tr id='tmp"+rid+ "' class='red-left'><td colspan='3'>Sorry could not process the request.\n try again later.</td></tr>");$("#tmp"+rid).slideUp(6000);}}});}}
}
</script>
<?php include_once 'footer.php'?>