<!DOCTYPE html><html><head><script>function fn_reloadPage(type,res,tid){window.open("questionEntry.php?type="+type+"&tid="+tid+"&res="+res,"_parent");}</script></head><body>
<?php 
	if($_SERVER['REQUEST_METHOD']=="POST" && isset($_POST["submit"]))
	{	$tstname=$_POST['testname'];
	if(($_POST['qname']!="")&&($_POST['sname']!="")&&($_POST['qname']!=""))	{require_once 'db_inc.php';extract($_POST);		
	if($qHidden!="")
	{
  				$dup2row=mysql_fetch_array(mysql_query("select count(1) from question_master where ques='$qname' and ques_id <>$qHidden"));
				if($dup2row[0]>0)
				{	?><script>fn_reloadPage("new","er",<?php echo $tstname;?>);</script><?php }
				else
				{	
					$qimg="";$qh=$qHidden;
				$qr="update question_master set ques='".nl2br($qname)."',ans1='".nl2br($ans1)."',ans2='".nl2br($ans2)."',ans3='".nl2br($ans3)."',ans4='".nl2br($ans4)."',correct='$cans',subject_id='$sname',test_id='$tstname',topic_id='$tname',sub_topic_id='$stname',`level`='$level',marks='$marks',isTextBox='$ansType',solution='".nl2br($sol)."'";
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
				echo $qr."where ques_id='$qh'";
				mysql_query($qr."where ques_id='$qh'") or die ('Question update failed'. mysql_error());
				?><script>fn_reloadPage("new","success",<?php echo $tstname;?>);</script><?php					
			}
	}
	else
	{
	//echo "<pre>";print_r($_POST);die();
  			$dup2row=mysql_fetch_row(mysql_query("select count(1) from question_master where test_id='$tstname' and ques='$qname'"));
			if($dup2row[0]>0){?><script>fn_reloadPage("new","er",<?php echo $tstname;?>);</script><?php	}
				else
				{ 
				$qimg="";
				$qr="insert into question_master(ques,ans1,ans2,ans3,ans4,correct,subject_id,test_id,topic_id,sub_topic_id,`level`,marks,isTextBox,solution,ques_image,ans1_img,ans2_img,ans3_img,ans4_img)values('".nl2br($qname)."','".nl2br($ans1)."','".nl2br($ans2)."','".nl2br($ans3)."','".nl2br($ans4)."','$cans','$sname','$tstname','$tname','$stname','$level','$marks','$ansType','".nl2br($sol)."'";
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
				mysql_query($qr) or die ('Question Saving Failed.'. mysql_error());
				?><script>fn_reloadPage("new","success",<?php echo $tstname;?>);</script><?php		
		}
	}
}else{?><script>fn_reloadPage("new","er",<?php echo $tstname;?>);</script><?php }}?></body></html>