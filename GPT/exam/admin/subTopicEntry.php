<?php include_once 'header.php'?><style>.main-form-table3 a{cursor:pointer;}</style>
<div id="tab-1" class="tab">
						<article>
							<div class="text-section">
								<h1>Sub Topic Entry</h1>
								<p><!--This is a quick overview of some features--></p>
							</div>
<?php include 'db_inc.php';$msg="";
	if($_SERVER['REQUEST_METHOD']=="POST" && isset($_POST["submit"]))
	{
	if(($_POST['tname']!="")&&($_POST['sname']!="")&&($_POST['stname']!=""))
	{
	if($_POST["tHidden"] !="")
	{
  				$dup2row=mysql_fetch_array(mysql_query("select count(*) from sub_topic_master where sub_topic_name='".$_POST['stname']."' and sub_topic_id <>".$_POST["tHidden"]));
				if($dup2row[0]>0)
				{
					$msg="<ul class='states'><li class='error'>Error : Sub Topic Already Exists.</li></ul>";;
				}
				else
				{				
					mysql_query("update sub_topic_master set sub_topic_name='".$_POST['stname']."',subject_id='".$_POST['sname']."' and topic_id='".$_POST['tname']."' where sub_topic_id=".$_POST['tHidden']) or die ('topic update failed');
				$msg="<ul class='states'><li class='succes'>Success : Sub Topic Updated successfully.</li></ul>";						
				}
	}
	else
	{
  			$dup2row=mysql_fetch_row(mysql_query("select count(*) from sub_topic_master where sub_topic_name='".$_POST["tname"]."'"));
			if($dup2row[0]>0)
				{
					$msg="<ul class='states'><li class='error'>Error : Sub Topic Already Exists.</li></ul>";
				}
				else
				{				
mysql_query("INSERT INTO sub_topic_master (subject_id,topic_id,sub_topic_name) VALUES('".$_POST["sname"]."','".$_POST["tname"]."','".$_POST["stname"]."')") or die ('sub topic Saving Failed.'. mysql_error());
					$msg="<ul class='states'><li class='succes'>success : Sub Topic Added successfully.</li></ul>";		
				}
	}
}else{$msg="<ul class='states'><li class='error'>Error : Please All the feilds.</li></ul>";}}echo $msg;?>
    <form id="topicEntry" name="topicEntry" action="<?php $_PHP_SELF?>" method="POST">
   <table class="main-form-table">
       <tr style="height:20px;"><td>&nbsp;</td></tr>
       <tr><td>Subject Name</td><td>
       <select onchange="fn_get_topics('')" id="sname" name="sname" class="dropdown">
       <option value="">Select Subject</option>
       <?php $tres=mysql_query("select * from subject_master");
	   while($trow=mysql_fetch_array($tres)){echo "<option value='".$trow["subject_id"]."'>".$trow["subject_name"]."</option>";}?>
       </select></td></tr>
        <tr><td>Select Topic</td><td><select id="tname" name="tname" class="dropdown"><option value="">Select Topic</option></select></td></tr>
        <tr><td> Sub Topic</td><td><input id="stname" name="stname" class="inp-form" maxlength="70"/></td></tr>
         <tr style="height:15px;"><td>&nbsp;<input type="hidden" value=""  id="tHidden" name="tHidden"/></td></tr>
       <tr><td><input type="submit" value="Submit" name="submit" class="submit-button"/> </td><td><input type="reset" class="reset-button" id="reset"/></td></tr>
      </table>
      </form>
      <br/><br/>
      <link rel="stylesheet" type="text/css" href="css/stylespaginate.css" media="screen"/>
       <div id="paging_container" class="container">       
       <div class="page_navigation"></div>
     <table style="text-align:center;" class="content main-form-table3" width="100%">
    <thead><tr><th>SNo.</th><th>Subject</th><th>Topic</th><th>Sub Topic</th><th>Actions</th></tr></thead>
     <tbody><?php $i=1;$res=mysql_query("SELECT stm.*,subject_name,topic_name FROM sub_topic_master stm INNER JOIN topic_master t ON stm.topic_id=t.topic_id INNER JOIN subject_master s ON s.subject_id=stm.subject_id");
	while($row=mysql_fetch_array($res)){
	echo "<tr id='r$i'><td>$i</td><td align='left'>".$row["subject_name"]."</td><td align='left'>".$row["topic_name"]."</td><td align='left'>".$row["sub_topic_name"]."</td><td>";?><a onclick="fn_set('e','<?php echo "$i','".$row["sub_topic_id"]."','".$row["subject_id"]."','".$row["sub_topic_name"]."','".$row["topic_id"];?>');">Edit</a>&ensp;<a onclick="fn_set('d','<?php echo "$i','".$row["topic_id"];?>');">Delete</a></td></tr><?php $i++;}?>
       </tbody>
      </table>
       <div class="page_navigation"></div></div>
	</article>
	</div>
<script>
$(document).ready(function(){$('#paging_container').shashwat3({items_per_page:15,num_page_links_to_display:10,nav_label_next:"<img src='images/snext.png'/>",nav_label_prev:"<img src='images/sprevious.png'/>",abort_on_small_lists:true});});
function fn_set(t,rid,id,sid,stname,tid){if(t=="e"){if(confirm("Edit this sub topic ?")){$("#tHidden").val(id);$("#sname").val(sid);$("#stname").val(stname);fn_get_topics(tid);}}
if(t=="d"){if(confirm("Delete thissub topic ?")){$("#reset").trigger('click');$.ajax({type:"POST",data:'t=d&id='+id,url:"subTopicEntryAjax.php",success:function(result){if(result=="s"){$("#r"+rid).slideUp();}else{$("#r" +rid).after("<tr id='tmp"+rid+ "' class='red-left'><td colspan='3'>Sorry could not process the request.\n try again later.</td></tr>");$("#tmp"+rid).slideUp(6000);}}});}}}
function fn_get_topics(id){var dl="#sname";var ddl="#tname";$.blockUI({message:'<div class="block-ui-popup"><img src="login/images/busy.gif"/>&ensp;Loading Topics. Please Wait...</div>'});$.ajax({type:"POST",data:'t=tp&sid='+$(dl).val()+'&rd='+Math.random(),url:"questionEntryAjax.php",success:function(result){$.unblockUI();if(result=="e"){$(dl).val("");alert("Sorry There has been some error. kindly try again."); }else{$(ddl).html("<option value=''>Select</option>"+result).val(id);}},error:function(jqXHR,textStatus,errorThrown){$(dl).val("");alert("Sorry the server is Currently Very busy. Please Choose Subject again.");}});}</script><script src="js/jquery003.js" type="text/javascript"></script><script type="text/javascript" src="js/jquery002.js"></script>
<?php include_once 'footer.php'?>