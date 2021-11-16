<?php require_once 'header.php'; require_once 'db_inc.php'; $tid=$_GET["tid"];?>
<div id="tab-1" class="tab">
		<article>
			<div class="text-section">
			<h1>Questions Entry</h1>
			<p><!--This is a quick overview of some features--></p>
		</div>
  <?php if(isset($_GET["res"])){
if($_GET["res"]=="ex"){?>
         <ul class='states'><li class='error'>Error : Question Already Exists.</li></ul>
       <?php } if($_GET["res"]=="success") {  ?>
       <ul class='states'><li class='succes'>Success : Question Updated successfully.</li></ul>
       <?php } if($_GET["res"]=="val") {  ?>
       <ul class='states'><li class='error'>Error : Kindly fill all the fields.</li></ul>
       <?php }}?>
<style>.main-form-table3 a{cursor:pointer;}.inp-form{width:190px;}.dropdown{width:206px;}</style>
<?php if(isset($_GET["type"])){
if($_GET["type"]=="new"){?>
    <form id="testEntry" name="testEntry" action="questions_entry_save.php" method="POST" enctype="multipart/form-data">
   <table class="main-form-table">
       <tr style="height:20px;"><td>&nbsp;</td></tr>
       <!--<tr><td>Class</td><td>
       <select id="tstname" name="tstname" class="dropdown required">
       <?php $tres=mysql_query("select test_id,test_name from test_master where test_id='".$tid."'");
	  while($trow=mysql_fetch_array($tres)){echo "<option value='".$trow["test_id"]."'>".$trow["test_name"]."</option>";}?>
       </select></td></tr>-->
       <tr><td>Subject</td><td><input type="hidden" name="testname" value="<?php echo $tid;?>"/><select id="sname" name="sname" class="dropdown required"><option value="">Select</option><?php $sres=mysql_query("SELECT tsm.subject_id,subject_name FROM test_subject_relation_master tsm inner join subject_master s on tsm.subject_id=s.subject_id where test_id=".$tid) or die ('er');
while($srow=mysql_fetch_array($sres)){echo "<option value='".$srow["subject_id"]."'>".$srow["subject_name"]."</option>";}?></select>       
       </td></tr>
       <tr><td>Topic</td><td><select id="tname" name="tname" class="dropdown"><option value="">Select</option>     
       </select></td></tr>
       <!--<tr><td>Sub Topic</td><td><select id="stname" name="stname" class="dropdown"><option value="">Select</option></select></td></tr>
       <tr><td>Level</td><td>
       <select id="level" name="level" class="dropdown">
       <option value="">Select</option>
      <option value="L">Low Level</option>
      <option value="M">Medium Level</option>
      <option value="A">Advance Level</option>
      <option value="E">Expert Level</option>
       </select></td></tr>-->
  <tr><td>Question</td><td><textarea cols="70" rows="10" class="txtarea" id="qname" name="qname"></textarea>  </td></tr>
   <tr><td>&nbsp;</td><td>Or Image :<input type="file" name="qImg" id="qImg"/></td></tr>
   <tr><td>Marks</td><td><input type="text" name="marks" id="marks" class="inp-form required" maxlength="2"/></td></tr>
   <tr><td>Answer Type</td><td><input type="radio" value="Y" name="ansType" id="anstype1"/>Text Box&emsp;<input type="radio" checked="checked" value="N" name="ansType" id="anstype2"/>Normal</td></tr>
   <tr><td>Answer 1</td><td><textarea cols="70" rows="5" class="txtarea" name="ans1" id="ans1"></textarea> or Image : <input type="file" name="fans1" id="fans1"/></td></tr>
  <tr><td>Answer 2</td><td><textarea cols="70" rows="5" class="txtarea" name="ans2" id="ans2"></textarea> or Image : <input type="file" name="fans2" id="fans2"/></td></tr>
  <tr><td>Answer 3</td><td><textarea cols="70" rows="5" class="txtarea" name="ans3" id="ans3"></textarea> or Image : <input type="file" name="fans3" id="fans3"/></td></tr>
  <tr><td>Answer 4</td><td><textarea cols="70" rows="5" class="txtarea" name="ans4" id="ans4"></textarea> or Image : <input type="file" name="fans4" id="fans4"/></td></tr>
  <tr><td>Correct Ans</td><td>
       <select id="cans" name="cans" class="dropdown">
       <option value="">Select</option>
      <option value="ans1">Answer 1</option>
      <option value="ans2">Answer 2</option>
      <option value="ans3">Answer 3</option>
      <option value="ans4">Answer 4</option>
       </select></td></tr>
       <tr><td>Solution</td><td><textarea cols="70" rows="5" class="txtarea" name="sol" id="sol"></textarea></td></tr>
         <tr style="height:15px;"><td>&nbsp;<input type="hidden" value=""  id="qHidden" name="qHidden"/></td></tr>
       <tr><td><input type="submit" value="Submit" name="submit" class="submit-button"/> </td><td><input type="reset" class="reset-button" id="reset"/></td></tr>
       
      </table>
      </form>
      <?php }
	if($_GET["type"]=="edit"){
    if(isset($_GET["qid"]))
	{	
	?>
    <form id="testEntry" name="testEntry" action="questions_entry_save.php" method="POST" enctype="multipart/form-data">
    <?php $qres=mysql_query("select * from question_master where ques_id=".$_GET["qid"]);
	 while($qrow=mysql_fetch_array($qres))
	 {
	 ?>  
   <table class="main-form-table">
       <tr style="height:20px;"><td>&nbsp;</td></tr>
       <tr><td>Test</td><td><input type="hidden" name="testname" value="<?php echo $tid;?>"/>
       <select id="tstname" name="tstname" class="dropdown required">       
       <?php $tres=mysql_query("select test_id,test_name from test_master where test_id='".$tid."'");
	  while($trow=mysql_fetch_array($tres)){echo "<option value='".$trow["test_id"]."'>".$trow["test_name"]."</option>";}?>
       </select></td></tr>
       <tr><td>Subject</td><td>
       <select id="sname" name="sname" class="dropdown required">
       <option value="">Select</option>
       <?php $tres=mysql_query("select s.subject_id,subject_name from subject_master s inner join test_subject_relation_master tsm on tsm.subject_id=s.subject_id and test_id=".$tid);
	  while($trow=mysql_fetch_array($tres)){echo "<option value='".$trow["subject_id"]."'>".$trow["subject_name"]."</option>";}?>
       </select></td></tr>
       <tr><td>Topic</td><td>
       <select id="tname" name="tname" class="dropdown ">
       <option value="">Select Topic</option>
       <?php $tres=mysql_query("SELECT topic_id,topic_name FROM topic_master where subject_id='".$qrow["subject_id"]."'") or die ('er');while($trow=mysql_fetch_array($tres)){echo "<option value='".$trow["topic_id"]."'>".$trow["topic_name"]."</option>";}?>      
       </select></td></tr>
        <tr><td>Sub Topic</td><td>
       <select id="stname" name="stname" class="dropdown">
       <option value="">Select Sub Topic</option>
       <?php $tres=mysql_query("SELECT sub_topic_id,sub_topic_name FROM sub_topic_master where subject_id='".$qrow["subject_id"]."' and topic_id='".$qrow["topic_id"]."'") or die ('er');while($trow=mysql_fetch_array($tres)){echo "<option value='".$trow["sub_topic_id"]."'>".$trow["sub_topic_name"]."</option>";} ?>      
       </select></td></tr>
       <tr><td>Level</td><td>
       <select id="level" name="level" class="dropdown ">
       <option value="">Select Level</option>
      <option value="L">Low Level</option>
      <option value="M">Medium Level</option>
      <option value="A">Advance Level</option>
      <option value="E">Expert Level</option>
       </select></td></tr>
  <tr><td>Question</td><td><textarea cols="70" rows="10" class="txtarea" id="qname" name="qname"><?php echo $qrow["ques"];?></textarea>  </td></tr>
  <tr><td>&nbsp;</td><td>Or Image :<input type="file" name="qImg" id="qImg"/></td></tr>
  <tr><td>Marks</td><td><input type="text" value="<?php echo $qrow["marks"];?>" name="marks" id="marks" class="inp-form" maxlength="2"/></td></tr>
<tr><td>Answer Type</td><td><input type="radio" value="Y" name="ansType" id="anstype1" class="required"/>Text Box&emsp;<input type="radio" checked="checked" value="N" name="ansType" id="anstype2"/>Normal</td></tr>
   <tr><td colspan="2">Question Image : <img id="qimg1"/></td></tr>
  <tr><td>Answer 1</td><td><textarea cols="70" rows="5" class="txtarea" name="ans1" id="ans1"><?php echo $qrow["ans1"];?></textarea> or Image : <input type="file" name="fans1" id="fans1"/></td></tr>
  <tr><td colspan="2">Answer 1 Image : <img id="aimg1" /></td></tr>
  <tr><td>Answer 2</td><td><textarea cols="70" rows="5" class="txtarea" name="ans2" id="ans2"><?php echo $qrow["ans2"];?></textarea> or Image : <input type="file" name="fans2" id="fans2"/></td></tr>
   <tr><td colspan="2">Answer 2 Image : <img id="aimg2" /></td></tr>
  <tr><td>Answer 3</td><td><textarea cols="70" rows="5" class="txtarea" name="ans3" id="ans3"><?php echo $qrow["ans3"];?></textarea> or Image : <input type="file" name="fans3" id="fans3"/></td></tr>
  <tr><td colspan="2">Answer 3 Image : <img id="aimg3"/></td></tr>
  <tr><td>Answer 4</td><td><textarea cols="70" rows="5" class="txtarea" name="ans4" id="ans4"><?php echo $qrow["ans4"];?></textarea> or Image : <input type="file" name="fans4" id="fans4"/></td></tr>
  <tr><td colspan="2">Answer 4 Image : <img  id="aimg4"/></td></tr>
  <tr><td>Correct Ans</td><td>
       <select id="cans" name="cans" class="dropdown required">
       <option value="">Select</option>
      <option value="ans1">Answer 1</option>
      <option value="ans2">Answer 2</option>
      <option value="ans3">Answer 3</option>
      <option value="ans4">Answer 4</option>
       </select></td></tr>
       <tr><td>Solution</td><td><textarea cols="70" rows="5" class="txtarea" name="sol" id="sol"><?php echo $qrow["solution"];?></textarea></td></tr>
         <tr style="height:15px;"><td>&nbsp;<input type="hidden" value="<?php echo $qrow["ques_id"];?>" id="qHidden" name="qHidden"/></td></tr>
       <tr><td><input type="submit" value="Submit" name="submit" class="submit-button"/> </td><td><input type="reset" class="reset-button" id="reset"/></td></tr>       
      </table>
      </form>         
     <script>function dispdata(){   
	  document.getElementById('cans').value='<?php echo $qrow["correct"];?>';
	  document.getElementById('level').value='<?php echo $qrow["level"];?>';
	  document.getElementById('tname').value='<?php echo $qrow["topic_id"];?>';
	  document.getElementById('sname').value='<?php echo $qrow["subject_id"];?>';
	  document.getElementById('stname').value='<?php echo $qrow["sub_topic_id"];?>';
	  document.getElementById('tstname').value='<?php echo $qrow["test_id"];?>';
	  if("<?php echo $qrow["isTextBox"];?>"=="Y"){$("#anstype1").attr("checked","checked");}else{$("#anstype2").attr("checked","checked");}
	  document.getElementById('qimg1').src='uploads/questions/<?php echo $qrow["ques_image"];?>';
	  document.getElementById('aimg1').src='uploads/answer_1/<?php echo $qrow["ans1_img"];?>';
	  document.getElementById('aimg2').src='uploads/answer_2/<?php echo $qrow["ans2_img"];?>';
	  document.getElementById('aimg3').src='uploads/answer_3/<?php echo $qrow["ans3_img"];?>';
	  document.getElementById('aimg4').src='uploads/answer_4/<?php echo $qrow["ans4_img"];?>';
	  }dispdata();</script>
<?php }
	}
}   
}?>
  <br/><br/>  
  <link rel="stylesheet" type="text/css" href="css/stylespaginate.css" media="screen"/>
<!--  <div id="paging_container2" class="container" style="width:100%"> 
   <div class="page_navigation"></div>
 <table id="test_display_table" style="text-align:center;" class="content main-form-table3" width="100%">
    <thead><tr><th>SNo.</th><th>Test Name</th><th>No of Questions</th><th>No of Subjects</th></tr></thead>
     <tbody><?php //$i=1;$res=mysql_query("select test_id,test_name,(select count(ques_id) from question_master q where q.test_id=t.test_id) as qcount,(select count( distinct subject_id) from question_master q where q.test_id=t.test_id) as scount from test_master t order by qcount desc");while($row=mysql_fetch_array($res)){echo "<tr id='r$i'><td>$i</td><td style='cursor:pointer;' onclick=\"fn_set_test('".$row["test_id"]."');\">".$row["test_name"]."</td><td>".$row["qcount"]."</td><td>".$row["scount"]."</td></tr>";$i++;}?>
       </tbody>       
      </table>
      <div class="page_navigation"></div></div>
      <br/>-->
             <div id="paging_container" class="container"> 
       <div class="page_navigation"></div>
      <table id="question_display_table" style="text-align:center;" class="content main-form-table3" width="100%">
    <thead><tr><th>SNo.</th><th>Test</th><th>Subject</th><th>Topic Name</th><th style="width:400px;">Question</th><th>Marks</th><th>Is Visible</th><th>Actions</th></tr></thead>
     <tbody id="question_display_table_tbody">
     <?php $tres=mysql_query("select q.*,subject_name,topic_name,sub_topic_name,test_name from question_master q left join subject_master s on q.subject_id=s.subject_id left join topic_master tp on q.topic_id=tp.topic_id left join sub_topic_master stm on q.sub_topic_id=stm.sub_topic_id left join test_master tm on q.test_id=tm.test_id where q.test_id=".$tid) or die ('er');$i=1;
while($row=mysql_fetch_array($tres)){
echo "<tr id='r$i'><td>$i</td><td>".$row["test_name"]."</td><td>".$row["subject_name"]."</td><td>".$row["topic_name"]."</td><td align='left'>".html_entity_decode($row["ques"]);
if($row["ques_image"]!=""){"&ensp;<img src='uploads/questions/".$row["ques_image"]."'/>";}echo"</td><td>".$row["marks"]."</td><td><input type='checkbox'";if($row["isVisible"]==""){echo "checked='checked'";}echo " value='".$row["test_id"]."' onclick=\"fn_display_it(this,'$i');\"/><td>";?><a onclick="fn_set('e','<?php echo $row["ques_id"];?>','<?php echo $row["test_id"];?>');">Edit</a>&ensp;<a onclick="fn_set('d','<?php echo "$i','".$row["ques_id"];?>','<?php echo $row["test_id"];?>');">Delete</a></td></tr><?php $i++;
}?>
</tbody>
      </table>
      <div class="page_navigation"></div></div>
      <br/>
	</article>
	</div>   
    
<script>function fn_set_test(tstid){$("#tstname").val(tstid).trigger("change");}function fn_set(t,rid,id,tid){if(t=="e"){if(confirm("Edit this Question ?")){window.open("questionEntry.php?type=edit&qid="+rid+"&tid="+id,"_parent");}}if(t=="d"){if(confirm("Delete this question ?")){$("#reset").trigger('click');$.ajax({type:"POST",data:'t=d&id='+id+'&rd='+Math.random()+'&tid='+tid,url:"questionEntryAjax.php",success:function(result){if(result=="s"){$("#r"+rid).slideUp();}else{$("#r" +rid).after("<tr id='tmp"+rid+"' class='red-left'><td colspan='7'>Sorry could not process the request.\n try again later.</td></tr>");$("#tmp"+rid).slideUp(6000);}}});}}}$(document).ready(function(){var dl="#sname";var ddl="#tname";var stpc="#stname";var tst="#tstname";$("#testEntry").validate();$("#paging_container").shashwat3({items_per_page:10,num_page_links_to_display:10,nav_label_next:"<img src='images/snext.png'/>",nav_label_prev:"<img src='images/sprevious.png'/>",abort_on_small_lists:true});
$(dl).bind("change",function(){$.blockUI({message:'<div class="block-ui-popup"><img src="images/busy.gif"/>&ensp;Loading Topics. Please Wait...</div>'});$.ajax({type:"POST",data:'t=tp&sid='+$(this).val()+'&rd='+Math.random(),url:"questionEntryAjax.php",success:function(result){$.unblockUI();if(result=="e"){$(dl).val("");alert("Sorry There has been some error. kindly try again."); }else{$(ddl).html("<option value=''>Select</option>"+result);}},error:function(jqXHR,textStatus,errorThrown){$(dl).val("");alert("Sorry the server is Currently Very busy. Please Choose Subject again.");}});});$(ddl).bind("change",function(){$.blockUI({message:'<div class="block-ui-popup"><img src="images/busy.gif"/>&ensp;Loading Sub Topics. Please Wait...</div>'});$.ajax({type:"POST",data:'t=stp&tid='+$(this).val()+'&rd='+Math.random()+'&sid='+$(dl).val(),url:"questionEntryAjax.php",success:function(result){$.unblockUI();if(result=="e"){$(stpc).val("");alert("Sorry There has been some error. kindly try again.");}else{$(stpc).html("<option value=''>Select</option>"+result);}},error:function(jqXHR,textStatus,errorThrown){$(dl).val("");alert("Sorry the server is Currently Very busy. Please Choose Topic again.");}});});
$(tst).bind("change",function(){$("#question_display_table_tbody").html("<tr><td align='center'><img src='images/table-ajax-loader.gif'/>Loding Questions. Please Wait..</td></tr>");$.ajax({type:"POST",data:'t=sub&tid='+$(this).val()+'&rd='+Math.random(),url:"questionEntryAjax.php",success:function(result){if(result=="e"){$(tst).val("");alert("Sorry There has been some error. kindly try again."); return false;}else{$(dl).html("<option value=''>Select</option>"+result);}},error:function(jqXHR,textStatus,errorThrown){$(tst).val("");alert("Sorry the server is Currently Very busy. Please Choose Subject again.");return false;}});$.ajax({type:"POST",data:'t=get&tstid='+$(this).val()+'&rd='+Math.random(),url:"questionEntryAjax.php",success:function(result){if(result=="e"){$(tst).val("");alert("Sorry There has been some error loading questions. kindly try again.");}else{$("#paging_container2").slideUp();$("#question_display_table_tbody").html(result);$("#paging_container").slideDown().shashwat3({items_per_page:15,num_page_links_to_display:10,nav_label_next:"<img src='images/snext.png'/>",nav_label_prev:"<img src='images/sprevious.png'/>",abort_on_small_lists:true});}},error:function(jqXHR,textStatus,errorThrown){$(tst).val("");alert("Sorry the server is Currently Very busy. Please Choose Test again.");}});});
jQuery('textarea').tinymce({
		script_url : 'js/tiny_mce/tiny_mce.js',
		theme : "advanced",
		plugins : "jbimages,safari,pagebreak,style,layer,table,save,advhr,advimage,advlink,emotions,iespell,inlinepopups,insertdatetime,preview,media,searchreplace,print,contextmenu,paste,directionality,fullscreen,noneditable,visualchars,nonbreaking,xhtmlxtras,template",
		theme_advanced_buttons1 : "save,newdocument,|,bold,italic,underline,strikethrough,|,justifyleft,justifycenter,justifyright,justifyfull,styleselect,formatselect,fontselect,fontsizeselect",
		theme_advanced_buttons2 : "cut,copy,paste,pastetext,pasteword,|,search,replace,|,bullist,numlist,|,outdent,indent,blockquote,|,undo,redo,|,link,unlink,anchor,|,image,jbimages,|,cleanup,help,code,|,insertdate,inserttime,preview,|,forecolor,backcolor",
		theme_advanced_buttons3 : "tablecontrols,|,hr,removeformat,visualaid,|,sub,sup,|,charmap,emotions,iespell,media,advhr,|,print,|,ltr,rtl,|,fullscreen",
		theme_advanced_buttons4 : "insertlayer,moveforward,movebackward,absolute,|,styleprops,|,cite,abbr,acronym,del,ins,attribs,|,visualchars,nonbreaking,template,pagebreak",
		theme_advanced_toolbar_location : "top",
		theme_advanced_toolbar_align : "left",
		theme_advanced_statusbar_location : "bottom",
		theme_advanced_resizing : true,
		extended_valid_elements :  "iframe[src|width|height|name|align]",
		relative_urls:false
	});
});</script><script type="text/javascript" src="js/tiny_mce/jquery.tinymce.js"></script><script type="text/javascript" src="js/jquery002.js"></script><script src="js/jquery003.js" type="text/javascript"></script><script src="js/jquery.validate.min.js" type="text/javascript"></script><?php include_once 'footer.php'?>