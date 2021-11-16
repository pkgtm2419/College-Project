<!DOCTYPE html><html><head><script>function fn_reloadPage(type,res){window.open("questionEntry.php?type="+type+"&res="+res,"_parent");}</script></head><body>
<?php require_once 'db_inc.php';
	if($_SERVER['REQUEST_METHOD']=="POST" && isset($_POST["submit"]))
	{
	if(($_POST['qname']!="")&&($_POST['sname']!="")&&($_POST['tstname']!="")&&($_POST['tname']!="")&&($_POST['level']!="")&&($_POST['qname']!="")&&($_POST['cans']!="")&&($_POST['marks']!=""))	{
		
	if($_POST["qHidden"] !="")
	{
  				$dup2row=mysql_fetch_array(mysql_query("select count(1) from question_master where ques='".$_POST['qname']."' and ques_id <>".$_POST["qHidden"]));
				if($dup2row[0]>0)
				{	?><script>fn_reloadPage("new","er");</script><?php }
				else
				{	
					$qimg="";$qh=$_POST['qHidden'];
				$qr="update question_master set ques='".nl2br($_POST['qname'])."',ans1='".$_POST['ans1']."',ans2='".$_POST['ans2']."',ans3='".$_POST['ans3']."',ans4='".$_POST['ans4']."',correct='".$_POST['cans']."',subject_id='".$_POST['sname']."',test_id='".$_POST['tstname']."',topic_id='".$_POST['tname']."',`level`='".$_POST['level']."',marks='".$_POST['marks']."'";
				if($_FILES["qImg"]["size"]>0)
				{
					$qi=mysql_fetch_row(mysql_query("SELECT ques_image FROM question_master where ques_id='$qh'"));
					if($qi[0]!=""){unlink("uploads/questions/".$qi[0]);}	
					$qimg=md5(time()).".".end(explode(".",$_FILES["qImg"]["name"]));
					move_uploaded_file($_FILES['qImg']['tmp_name'],"uploads/questions/".$qimg);
					$qr=$qr.",ques_image='$qimg'";
				}
				if($_FILES["fans1"]["size"]>0)
				{
					$qi=mysql_fetch_row(mysql_query("SELECT ques_image FROM question_master where ques_id='$qh'"));
					if($qi[0]!=""){unlink("uploads/answer_1/".$qi[0]);}
					$qimg=md5(time()).".".end(explode(".",$_FILES["fans1"]["name"]));
					move_uploaded_file($_FILES['fans1']['tmp_name'],"uploads/answer_1/".$qimg);
					$qr=$qr.",ans1_img='$qimg'";
				}
				if($_FILES["fans2"]["size"]>0)
				{
					$qi=mysql_fetch_row(mysql_query("SELECT ans2_img FROM question_master where ques_id='$qh'"));
					if($qi[0]!=""){unlink("uploads/answer_2/".$qi[0]);}
					$qimg=md5(time()).".".end(explode(".",$_FILES["fans2"]["name"]));
					move_uploaded_file($_FILES['fans2']['tmp_name'],"uploads/answer_2/".$qimg);
					$qr=$qr.",ans2_img='$qimg'";
				}
				if($_FILES["fans3"]["size"]>0)
				{
					$qi=mysql_fetch_row(mysql_query("SELECT ans3_img FROM question_master where ques_id='$qh'"));
					if($qi[0]!=""){unlink("uploads/answer_3/".$qi[0]);}
					$qimg=md5(time()).".".end(explode(".",$_FILES["fans3"]["name"]));
					move_uploaded_file($_FILES['fans3']['tmp_name'],"uploads/answer_3/".$qimg);
					$qr=$qr.",ans3_img='$qimg'";
				}
				if($_FILES["fans4"]["size"]>0)
				{
					$qi=mysql_fetch_row(mysql_query("SELECT ans4_img FROM question_master where ques_id='$qh'"));
					if($qi[0]!=""){unlink("uploads/answer_4/".$qi[0]);}
					$qimg=md5(time()).".".end(explode(".",$_FILES["fans4"]["name"]));
					move_uploaded_file($_FILES['fans4']['tmp_name'],"uploads/answer_4/".$qimg);
					$qr=$qr.",ans4_img='$qimg'";
				}
				mysql_query($qr."where ques_id='$qh'") or die ('Question update failed'. mysql_error());
				?><script>fn_reloadPage("new","success");</script><?php					
			}
	}
	else
	{
  			$dup2row=mysql_fetch_row(mysql_query("select count(*) from question_master where test_id='".$_POST["tstname"]."' and ques='".$_POST['qname']."'"));
			if($dup2row[0]>0){?><script>fn_reloadPage("new","er");</script><?php	}
				else
				{ 
				$qimg="";
				$qr="insert into question_master(ques,ans1,ans2,ans3,ans4,correct,subject_id,test_id,topic_id,`level`,marks,ques_image,ans1_img,ans2_img,ans3_img,ans4_img)values('".nl2br($_POST["qname"])."','".$_POST["ans1"]."','".$_POST["ans2"]."','".$_POST["ans3"]."','".$_POST["ans4"]."','".$_POST["cans"]."','".$_POST["sname"]."','".$_POST["tstname"]."','".$_POST["tname"]."','".$_POST["level"]."','".$_POST["marks"]."'";
				if($_FILES["qImg"]["size"]>0)
				{
					$qimg=md5(time()).".".end(explode(".",$_FILES["qImg"]["name"]));
					move_uploaded_file($_FILES['qImg']['tmp_name'],"uploads/questions/".$qimg);
					$qr=$qr.",'$qimg'";
				}
				else
				{
				$qr=$qr.",''";
				}
				if($_FILES["fans1"]["size"]>0)
				{
					$qimg=md5(time()).".".end(explode(".",$_FILES["fans1"]["name"]));
					move_uploaded_file($_FILES['fans1']['tmp_name'],"uploads/answer_1/".$qimg);
					$qr=$qr.",'$qimg'";
				}
				else
				{
				$qr=$qr.",''";
				}
				if($_FILES["fans2"]["size"]>0)
				{
					$qimg=md5(time()).".".end(explode(".",$_FILES["fans2"]["name"]));
					move_uploaded_file($_FILES['fans2']['tmp_name'],"uploads/answer_2/".$qimg);
					$qr=$qr.",'$qimg'";
				}
				else
				{
				$qr=$qr.",''";
				}
				if($_FILES["fans3"]["size"]>0)
				{
					$qimg=md5(time()).".".end(explode(".",$_FILES["fans3"]["name"]));
					move_uploaded_file($_FILES['fans3']['tmp_name'],"uploads/answer_3/".$qimg);
					$qr=$qr.",'$qimg'";
				}
				else
				{
				$qr=$qr.",''";
				}
				if($_FILES["fans4"]["size"]>0)
				{
					$qimg=md5(time()).".".end(explode(".",$_FILES["fans4"]["name"]));
					move_uploaded_file($_FILES['fans4']['tmp_name'],"uploads/answer_4/".$qimg);
					$qr=$qr.",'$qimg'";
				}
				else
				{
				$qr=$qr.",''";
				}
				$qr=$qr.")";
				mysql_query($qr) or die ('Test Saving Failed.'. mysql_error());
				?><script>fn_reloadPage("new","success");</script><?php		
		}
	}
}else{?><script>fn_reloadPage("new","er");</script><?php }}?></body></html>