<?php include_once 'header.php'?><style>.main-form-table3 a{cursor:pointer;}.HideContent{display:none;}</style>
<?php
include 'db_inc.php';
$db = new PDO(DB_INFO, DB_USER, DB_PASS);
function getClass($id)
{
global $db;
$sql="Select *
FROM category_master
WHERE category_id='$id'
LIMIT 1";
$stmt=$db->prepare($sql);
$stmt->execute();
$news=$stmt->fetch();
return $news;
}
?>
<div id="tab-1" class="tab">
<article>
<div class="text-section">
<h1>Student Show</h1>
<p><!--This is a quick overview of some features--></p>
</div>
<br/>

<table cellspacing="0px" border="1px" id="test_display_table" style="text-align:center;" class="container" width="100%">
 <thead>
 <tr><th><input type="checkbox" onclick="for(c in document.getElementsByName('check[]')) document.getElementsByName('check[]').item(c).checked = this.checked"></th><th>SNo.</th><th>Student Name</th><th>Course</th><th>CODE</th><th>Mail ID</th><th>Password</th><th>Address</th><th>Gender</th><th>Mobile Number</th><th>Status</th>
 </tr>
 </thead>
<tbody>
<div align="center"><form method='POST' action='inc/statusChange.inc.php'>
<?php
if(isset($_SESSION['admin_notice']))
{
echo $_SESSION['admin_notice'];
$_SESSION['admin_notice']=null;
}
$sn=1;
$t=1;
  $query="SELECT * FROM `registration`";
  $result = mysql_query($query);
  while($row = mysql_fetch_object($result))
  {
  $class=getClass($row->course);
							if($row->status==1)
							{
							$status='<img src="images/check.png" />';
							}
							else
							{
							$status='<img src="images/cancel.png" />';
							}
							if($row->codestatus==1)
							{
							$color='green';
							}
							else
							{
							$color='red';
							}
			?>	<tr>
	<td><input name='check[]' type='checkbox' value="<?php echo $row->user_id;?>" /></td>
	<td><?php echo $sn;?></td>
	<td><?php echo $row->student_name;?></td>
	<td><?php echo $row->course;?></td>
	<td><font color="<?php echo $color;?>"><?php echo $row->code;?></font></td>
	<td><?php echo $row->mail_id ;?></td>
	<td><?php echo $row->password;?></td>
	<td><?php echo $row->address; ?></td>
	<td><?php echo $row->gender;?></td>
	<td><?php echo $row->mobile_number;?></td>
		  
	<td><?php echo $status;?></td>	  
	</tr>
	
	<?php
$sn++;
$t=$t+1;
}
?></table>
</div>

</tbody>
</table>

<html>
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>Student Show</title>
</head>
<body>

							
							
<div>
<input type="submit" name="submit" value="Refresh" />
<input type="submit" name="submit" value="Active" />
<input type="submit" name="submit" value="Deactive" /><input Onclick="return confirm('Are You Sure You Want to delete this???');" type="submit" name="submit" value="Delete" />
</form>
</div>
</form>

</body>
</script><script type="text/javascript" src="js/jquery002.js"></script>
<?php include_once 'footer.php'?>
</html>
