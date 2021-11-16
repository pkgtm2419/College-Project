<?php include 'db_inc.php';$msg="";
	if($_SERVER['REQUEST_METHOD']=="POST" && isset($_POST["submit"]))
	{
	if($_POST['cname']!="")
	{
	if($_POST["cHidden"] !="")
	{
  				$dup2row=mysql_fetch_array(mysql_query("select count(*) from category_master where category_name='".$_POST['cname']."' and category_id <>".$_POST["cHidden"]));
				if($dup2row[0]>0)
				{
					$msg="<ul class='states'><li class='error'>Error : Category Already Exists.</li></ul>";;
				}
				else
				{				
					mysql_query("update category_master set category_name='".$_POST['cname']."' where category_id=".$_POST['cHidden']) or die ('category update failed');
				$msg="<ul class='states'><li class='succes'>Success : Category Updated successfully.</li></ul>";						
				}
	}
	else
	{
  		$dup2row=mysql_fetch_row(mysql_query("select count(*) from category_master where category_name='".$_POST["cname"]."'"));
			if($dup2row[0]>0)
				{
					$msg="<ul class='states'><li class='error'>Error : Category Already Exists.</li></ul>";
				}
				else
				{				
mysql_query("INSERT INTO category_master (category_name) VALUES('".$_POST["cname"]."')") or die ('category Saving Failed.'. mysql_error());
					$msg="<ul class='states'><li class='succes'>success : Category Added successfully.</li></ul>";		
				}
	}
}else{$msg="<ul class='states'><li class='error'>Error : category Name Cannot be blank.</li></ul>";}}?>
<?php include_once 'header.php'?><style>.main-form-table3 a{cursor:pointer;}</style>
<div id="tab-1" class="tab">
<article>
<div class="text-section">
<h1>Category Entry</h1>
<p><!--This is a quick overview of some features--></p>
</div><?php echo $msg;?>
    <form id="categoryEntry" name="categoryEntry" action="<?php $_PHP_SELF?>" method="POST">
   <table class="main-form-table">
       <tr style="height:20px;"><td>&nbsp;</td></tr>
        <tr><td>Category Name</td><td><input class="inp-form" type="text" id="cname" name="cname" placeholder="Enter category Name"/>  </td></tr>
         <tr style="height:15px;"><td>&nbsp;<input type="hidden" value=""  id="cHidden" name="cHidden"/></td></tr>
       <tr><td><input type="submit" value="Submit" name="submit" class="submit-button"/> </td><td><input type="reset" class="reset-button" id="reset"/></td></tr>
      </table>
      </form>
      <br/><br/>
      <link rel="stylesheet" type="text/css" href="css/stylespaginate.css" media="screen"/>
       <div id="paging_container" class="container">       
		<!--<input type="text" class="search inp-form" name="search" placeholder="Search..." maxlength="50">-->
       <div class="page_navigation"></div>
     <table style="text-align:center;" class="content main-form-table3" width="100%">
    <thead><tr><th>SNo.</th><th>category Name</th><th>Actions</th></tr></thead>
     <tbody><?php $i=1;$res=mysql_query("select * from category_master");
	while($row=mysql_fetch_array($res)){
	echo "<tr id='r$i'><td>$i</td><td>".$row["category_name"]."</td><td>";?><a onclick="fn_set('e','<?php echo "$i','".$row["category_id"]."','".$row["category_name"];?>');">Edit</a>&ensp;<a onclick="fn_set('d','<?php echo "$i','".$row["category_id"];?>');">Delete</a></td></tr><?php $i++;}?>
       </tbody>
      </table>
      <div class="page_navigation"></div></div>
	</article>
	</div>
<script>
function fn_set(t,rid,id,name)
{
if(t=="e"){if(confirm("Edit this category ?")){$("#cname").val(name);$("#cHidden").val(id);}}
if(t=="d"){if(confirm("Delete this category ?")){$("#reset").trigger('click');$.ajax({type:"POST",data:'id='+id,url:"categoryEntryAjax.php",success:function(result){if(result=="s"){$("#r"+rid).slideUp();}else{$("#r" +rid).after("<tr id='tmp"+rid+ "' class='red-left'><td colspan='3'>Sorry could not process the request.\n try again later.</td></tr>");$("#tmp"+rid).slideUp(6000);}}});}}
}
$(document).ready(function(){$('#paging_container').shashwat3({items_per_page:10,num_page_links_to_display:10,nav_label_next:"<img src='images/snext.png'/>",nav_label_prev:"<img src='images/sprevious.png'/>",abort_on_small_lists:true});});</script><script src="js/jquery003.js" type="text/javascript"></script><?php include_once 'footer.php'?>