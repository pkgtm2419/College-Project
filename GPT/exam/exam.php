<?php if(isset($_SERVER['HTTP_REFERER'])){if($_SERVER['HTTP_REFERER']==""){die();}}else{die();}require_once 'admin/db_inc.php';extract($_GET);session_start(); if(!(isset($_SESSION['sprg_admin']) && $_SESSION['sprg_admin']== 1)){header('Location: login.php');}?>
<!DOCTYPE html>
<html>
<head>
<title>Online Exam Online</title>
<meta http-equiv="content-type" content="text/html; charset=UTF-8"><meta http-equiv="Cache-Control" content="no-cache, no-store, must-revalidate, max-age=0"/><meta http-equiv="Pragma" content="no-cache"/><meta http-equiv="Expires" content="0"/><meta http-equiv="X-UA-Compatible" content="IE=10"/><meta name="author" content="Ankur Tandon"/><META NAME="ROBOTS" CONTENT="NOINDEX, NOFOLLOW">
<style>body{user-select:none;-moz-user-select:none;-webkit-user-select:none;-o-user-select:none;}.workspace{float:right;cursor:pointer;}textarea{border:1px solid silver;border-radius:0.7em 0.7em 0.7em 0.7em;font-size:14px;height:75px;padding:10px 15px;width:95%;}.txtarea{display:none;}.tHeading{font-size:22px;text-align:center;color:#634B30;font-weight:bold;text-decoration:underline;}.show{display:block;}.hide{display:none;}.cwe_nav_inactive,cwe_nav_active{cursor:pointer;}.cwe_nav li{background:none;}.imgTick{display:none;}.imgCheckHide{display:none;}</style>
<link href="css/style1.css" type="text/css" rel="stylesheet">
<script src="js/jquery.min.js" type="text/javascript"></script>
</head>
<body ondragstart="return false" onselectstart="return false">
<script>function cIE(){if(event.button==2){return false;}}function cNS(e){if(document.layers||document.getElementById&&!document.all){if(e.which==2||e.which==3){return false;}}}if(document.layers){document.captureEvents(Event.MOUSEDOWN);document.onmousedown=cNS;}else if(document.all&&!document.getElementById){document.onmousedown=cIE;}document.oncontextmenu=new Function("return false");/*window.onbeforeunload=function(e){e=e||window.event;if(e){e.returnValue='Sure?';}return 'Sure?';};*/</script><?php echo $_SESSION['user'];?>
<div><?php $sG_test_RSet=mysql_fetch_array(mysql_query("SELECT test_name,test_duration,category_name FROM test_master t inner join category_master c on t.category_id=c.category_id where test_id=".$tid));$sG_test_name=$sG_test_RSet["test_name"];$sG_test_duration=($sG_test_RSet["test_duration"])*60;$sG_category_name=$sG_test_RSet["category_name"];?>
<form id="quesForm" action="submitTest.php" method="POST">
<input id="currentQNo" type="hidden" value="1" name="currentQNo">
<input id="currentPage" type="hidden" value="1" name="currentPage">
<input id="submitExam" type="hidden" value="0" name="submitExam">
<input id="examType" type="hidden" value="<?php if(isset($event)){echo $event;}?>" name="examType">
<input id="testid" type="hidden" value="<?php echo $tid?>" name="testid">
<table width="1001px" style="border:1px solid #000000;margin:15px auto;">
<tr><td class="tHeading"><?php echo $sG_category_name." - ".$sG_test_name;?></td><td>
<script src="js/countdown.js"></script><script type="application/javascript">var myCountdown1=new Countdown({time:<?php echo $sG_test_duration;?>,width:250,height:50,rangeHi:"hour",onComplete :fn_onComplete,numbers:{font:"Arial",color:"#FFFFFF",bkgd:"#365D8B",rounded:0.15,shadow:{x:0,y:3,s:4,c:"#000000",a:0.4}}});function fn_onComplete(){alert("Sorry. Time Is Over. Your Answers will be automatically Submitted.");$(".btn").trigger('click');}</script>
</td></tr>
<tr><td>
<div id="disp-form" style="width: 700px;">
<div style="width:100%;">
<fieldset style="width:100%;">
<legend style="font-size:15px; font-weight:bold;font-family:Trebuchet MS;">Select Subject</legend>
<div align="center" class="cwe_nav">
<ul>                                 
<?php $sG_subject_count=1;$qtotal=1;$qinc=1;$q_each_sub="";
$sG_sub_RSet=mysql_query("SELECT distinct q.subject_id,subject_name,count(ques_id) as qcount FROM subject_master s inner join question_master q on s.subject_id=q.subject_id where test_id=".$tid." group by q.subject_id,subject_name order by subject_name");
while($sG_sub_Row=mysql_fetch_array($sG_sub_RSet))
{
if($sG_subject_count==1){
$sG_active_subject=$sG_sub_Row["subject_id"];
$class='cwe_nav_active';
}
else{$class= 'cwe_nav_inactive';}
echo "<li style='background:none;'><a id='a_".$sG_subject_count."' class='".$class."' onClick=\"displayNthQuestion('".$qtotal."','N','T');displayPage('".$sG_subject_count."','".$sG_sub_Row["qcount"]."');\">".$sG_sub_Row["subject_name"]."</a>&emsp;";
$qtotal=$qtotal+$sG_sub_Row["qcount"];
$q_each_sub=$q_each_sub.($qtotal-1)."-";
$sG_subject_count++;
}
$sG_subject_count--;?>
<input id="qtotal" type="hidden" value="<?php $qtotal--;echo $qtotal;?>" name="qtotal">
<input id="qtotalSub" type="hidden" value="<?php echo $q_each_sub;?>" name="qtotalSub">
</ul>
</div>
</fieldset></div>
<div class="cwe_box_check">
            <table border="0" width="99%">
            <tbody><tr>
            <td>
            <?php $sG_ques_RSet=mysql_query("select q.* FROM question_master q inner join subject_master s on q.subject_id=s.subject_id where test_id=".$tid." order by subject_name");$c=1;while($sG_ques_Row=mysql_fetch_array($sG_ques_RSet)){?>
                            <a <?php if($c!=1){echo 'style="display:none"';}?> name="a_<?php echo $sG_ques_Row["ques_id"];?>" id="gbq_<?php echo $c;?>">
                                <table id="tq_<?php echo $c;?>" style="float: left;" width="100%">
                                <tbody><tr>
                                    <td colspan="3"><div class="q_no_heading">
                                            <div class="q_no_heading_left">Question No.<?php echo $c;?>:</div>
                                        <div class="q_no_heading_right">
                                            <font style="padding:1px 10px 2px 10px;"> <?php echo $sG_ques_Row["marks"];?> Marks
                                            </font>
                                        </div>
                                        </div>
                                    </td>
                                </tr>
                                <tr>
                                    <td colspan="3" height="5"></td>
                                </tr>
                                <tr>
                                <td>
                                <div class="cwe_Que_box_Right">
                                <table>
                                <tbody><tr>
                                    <td colspan="3" class="ques-text">
                                 <?php echo $sG_ques_Row["ques"];
								 if($sG_ques_Row["ques_image"]!=""){								 
								 ?>    <span id="q-img-1"><img src="admin/uploads/questions/<?php echo $sG_ques_Row["ques_image"];?>" align="absmiddle"></span><?php }?>
                                    </td>
                                </tr>
                                <tr>
                                    <td colspan="3" height="5"></td>
                                </tr>
                                <input id="qchanged_<?php echo $c;?>" name="qchanged_<?php echo $c;?>" value="<?php echo $sG_ques_Row["ques_id"];?>" type="hidden"> <input id="schanged_<?php echo $c;?>" name="schanged_<?php echo $c;?>" value="<?php echo $sG_ques_Row["subject_id"];?>" type="hidden">
                                <input id="answered_<?php echo $c;?>" name="answered_<?php echo $c;?>" value="" type="hidden">
                                        <tr>
                                            <td width="5%"></td>
                                            <td width="5%"><label class="checkbox_unchecked2" for="ans_<?php echo $c;?>_1" id="label_<?php echo $c;?>_1">1.</label><img onClick="fn_save_answer('ans1','<?php echo $c;?>','1','S')" src="images/checkbox_unchecked_icon.png" id="ans_chk_<?php echo $c;?>_1" /><img src="images/tick.png" class="imgTick" id="ans_tick_<?php echo $c;?>_1"/>
                                            </td>
                                            <td style="font-size:12px" align="left"> <?php echo $sG_ques_Row["ans1"];
								 if($sG_ques_Row["ans1_img"]!=""){								 
								 ?>    <span id="q-img-1"><img src="admin/uploads/answer_1/<?php echo $sG_ques_Row["ans1_img"];?>" align="absmiddle"></span><?php }?></td>
                                        </tr>
                                        <tr>
                                    		<td colspan="3" height="5"></td>
                                		</tr>
                                        <tr>
                                            <td width="5%"></td>
                                            <td width="5%"><label class="checkbox_unchecked2" for="ans_<?php echo $c;?>_2" id="label_ans_<?php echo $c;?>_2">2.</label><img src="images/checkbox_unchecked_icon.png" alt="Answer 2" onClick="fn_save_answer('ans2','<?php echo $c;?>','2')"  id="ans_chk_<?php echo $c;?>_2" /><img src="images/tick.png" class="imgTick" id="ans_tick_<?php echo $c;?>_2"/></td>
                                            <td style="font-size:12px" align="left"> <?php echo $sG_ques_Row["ans2"];
								 if($sG_ques_Row["ans2_img"]!=""){								 
								 ?>    <span id="q-img-1"><img src="admin/uploads/answer_2/<?php echo $sG_ques_Row["ans2_img"];?>" align="absmiddle"></span><?php }?></td>
                                        </tr>
                                        <tr>
                                    		<td colspan="3" height="5"></td>
                                		</tr>
                                        <tr>
                                            <td width="5%"></td>
                                            <td width="5%"><label class="checkbox_unchecked2" for="ans_<?php echo $c;?>_3" id="label_ans_<?php echo $c;?>_3">3.</label><img src="images/checkbox_unchecked_icon.png" alt="Answer 3" onClick="fn_save_answer('ans3','<?php echo $c;?>','3')"  id="ans_chk_<?php echo $c;?>_3" /><img src="images/tick.png" class="imgTick" id="ans_tick_<?php echo $c;?>_3"/></td>
                                            <td style="font-size:12px" align="left"> <?php echo $sG_ques_Row["ans3"];
								 if($sG_ques_Row["ans3_img"]!=""){								 
								 ?>    <span id="q-img-1"><img src="admin/uploads/answer_3/<?php echo $sG_ques_Row["ans3_img"];?>" align="absmiddle"></span><?php }?> </td>
                                        </tr>
                                       <tr>
                                    		<td colspan="3" height="5"></td>
                                		</tr>
                                        <tr>
                                            <td width="5%"></td>
                                            <td width="5%"><label class="checkbox_unchecked2" for="ans_<?php echo $c;?>_4" id="label_ans_<?php echo $c;?>_4">4.</label><img src="images/checkbox_unchecked_icon.png" alt="Answer 4" onClick="fn_save_answer('ans4','<?php echo $c;?>','4')"  id="ans_chk_<?php echo $c;?>_4" /><img src="images/tick.png" class="imgTick" id="ans_tick_<?php echo $c;?>_4"/></td>
                                            <td style="font-size:12px" align="left"> <?php echo $sG_ques_Row["ans4"];
								 if($sG_ques_Row["ans4_img"]!=""){								 
								 ?>    <span id="q-img-1"><img src="admin/uploads/answer_4/<?php echo $sG_ques_Row["ans4_img"];?>" align="absmiddle"></span><?php }?></td>
                                        </tr>                                     
                                <tr>
                                    <td colspan="3" align="left" width="60%">
                                        <table border="0" cellpadding="3" cellspacing="0" width="100%">
                                        
            </table>
            </td>
            </tr>
            </tbody></table>
            </div>
            </td>
            </tr>
            <tr><td colspan="3"><div class="txtarea" id="qt<?php //echo $c;?>"><textarea></textarea></div></td></tr>
            <tr><td colspan="3">
                  <div class="cwe_footer">
                       <ul>
                           <li><a href="#" onClick="displayNthQuestion('<?php echo $c+1;?>','S');">Save &amp; Next</a></li>
                            <li id="markForReview_5024657"><!--<a href="#" onClick="$('#qt<?php //echo $c;?>').slideToggle('slow');">View Workspace</a>--><a href="#" onClick="displayNthQuestion('<?php echo $c+1;?>','M');">Review Later & Next</a></li>
                       </ul>
                       <ul class="right">
                           <li id="clear_5024657"><a href="#" onClick="clearAns('<?php echo $c;?>')">Clear Answer</a></li>
                       </ul>
                  </div>
            </td></tr>
            </tbody></table></a>
            <?php $c++;}?>
                            </td>
            </tr>
            </tbody></table>
            </div>
</div>
</td><td valign="top">

<div class="cwe_Right_Box">
<div id="showCalc" style="height:25px;width:100px;position:relative;display:block;margin:0 auto;"><img onClick="loadCalculator()" style="height:25px;width:100px;cursor:pointer" src="images/Calculator-button.gif"></div><div id="loadCalc" style="z-index:999;position:absolute;display:none;"></div>
<?php $sc=1;$tques=1;
$sG_sub_RSet=mysql_query("select q.subject_id,subject_name,count(ques_id) as qcount from question_master q inner join subject_master s on q.subject_id=s.subject_id where test_id=".$tid." group by q.subject_id,subject_name order by subject_name");
while($sG_sub_Row=mysql_fetch_array($sG_sub_RSet)){?>
<div <?php if($sc!=1){echo 'style="display:none"';}?> id="page_<?php echo $sc;?>">
<div class="cwe_Right_Top_text">
You are viewing <strong><?php echo $sG_sub_Row["subject_name"];?>
</strong> section Question Palette:</div>
<div class="cwe_Courses_scroll">
                <div class="cwe_Courses">
                <ul><?php $i=1; while($i<=$sG_sub_Row["qcount"]){?>
                                  <li>
                                  <a id="qi_<?php echo $tques;?>_button" href="#" onClick="displayNthQuestion('<?php echo $tques;?>');"><?php echo $tques;?></a>								  
                                  </li>
                            		<?php $i++;$tques++;}?>
                </ul>
                </div>
</div>
</div>
<?php $sc++;}?>
            <div class="legend_box">
			<table border="0" cellpadding="0" cellspacing="0" width="190">
                <tbody>
                <tr>
                    <td align="left" height="30" valign="top" width="25"><img src="images/q_bg_hover.png" height="16" width="19"></td>
                    <td align="left" valign="top" width="60">Attempted</td>
                    <td align="left" valign="top" width="25"><img src="images/rd.png" height="16" width="19"></td>
                    <td align="left" valign="top" width="80">Not Attempted</td>
                </tr>
                <tr>
                    <td align="left" height="30" valign="top" width="25"><img src="images/marked.png" height="18" width="18"></td>
                    <td align="left" valign="top" width="60">Review Later</td>
                    <td align="left" valign="top" width="25"><img src="images/q_bg.png" height="15" width="22"></td>
                    <td align="left" valign="top" width="80">Yet to Visit</td>
                </tr>
                <tr>
                    <td colspan="4" align="center" height="40" valign="middle">
				         <input value="SUBMIT" name="submit" class="btn" onClick="return fn_submit_test()" style="border:0" type="submit">
                    </td>
                </tr>
            </tbody>
			</table>
            </div>           

</td></tr>
</table>
</form>
<script>
function loadCalculator(){
	$('#loadCalc').show();
	$('#loadCalc').load('SimpleCalculator.html',function(){$('#closeButton').click(function(){$('#loadCalc').hide();$("#showCalc").show();});});
	$("#showCalc").hide();
}
function disableKeys(e){if(((e.which||e.keyCode)==116)||((e.which||e.keyCode)==123)||((e.which||e.keyCode)==17)||((e.which||e.keyCode)==13)||((e.which||e.keyCode)==8))
{return false;}};
$(document).ready(function(){$(document).bind("keydown", disableKeys);});
function displayPage(pageNo,next){
var current = document.getElementById('currentPage').value;		
if(current==pageNo || document.getElementById('gbq_' + next) == null){return;}
else{
document.getElementById('page_' + current).style.display='none';
document.getElementById('page_' + pageNo).style.display='';
document.getElementById('a_'+pageNo).className='cwe_nav_active';
document.getElementById('a_'+current).className='cwe_nav_inactive';
document.getElementById('currentPage').value=pageNo;
}
}
function displayNthQuestion(next,isMark,IsTab){
var current=document.getElementById('currentQNo').value;var ret=fn_Change_Image(current,isMark);if(ret==1){return false;}var currentPage=parseInt(document.getElementById('currentPage').value);var thisSubCount=$("#qtotalSub").val().split("-");var qtotal=$("#qtotal").val();if((next<=qtotal)&&(thisSubCount[currentPage-1]==current)&&(IsTab!='T')&&(current!=qtotal)){displayPage(currentPage+1,thisSubCount[currentPage-1]);}
if(document.getElementById('gbq_' + next)==null){alert("No question.");return;}
document.getElementById('gbq_' + current).style.display='none';
document.getElementById('tq_' + current).style.display='none';
document.getElementById('tq_' + next).style.display='';
document.getElementById('gbq_' + next).style.display='';
document.getElementById('currentQNo').value = next;
}
function fn_submit_test(){if(confirm("Submit this Test? PLEASE ENSURE that you have attempted all the sections of the test!")){return true;}else{return false;}}
function fn_Change_Image(id,isMark){if(($("#answered_"+id).val()!="")&&(isMark=="S")){$("#qi_"+id+"_button").removeClass().addClass("ans");}else if(isMark=="M"){/*if($("#answered_"+id).val()!=""){return 1;}else{*/$("#qi_"+id+"_button").removeClass().addClass("marked");/*}*/}else if(($("#answered_"+id).val()=="")&&(isMark=="S")){$("#qi_"+id+"_button").addClass("not_ans");}else if(($("#answered_"+id).val()=="")&&(isMark=="C")){$("#qi_"+id+"_button").removeClass("not_ans").removeClass("marked").removeClass("ans");}return 0;}
function clearAns(id){$("#answered_"+id).val("");$("#ans_chk_"+id+"_1").removeClass();$("#ans_chk_"+id+"_2").removeClass();$("#ans_chk_"+id+"_3").removeClass();$("#ans_chk_"+id+"_4").removeClass();$("#ans_tick_"+id+"_1").addClass("imgTick");$("#ans_tick_"+id+"_2").addClass("imgTick");$("#ans_tick_"+id+"_3").addClass("imgTick");$("#ans_tick_"+id+"_4").addClass("imgTick");fn_Change_Image(id,'C');}
function fn_save_answer(ans,id,ansid){if(ans!=""){$("#answered_"+id).val(ans);$("#ans_chk_"+id+"_1").removeClass();$("#ans_chk_"+id+"_2").removeClass();$("#ans_chk_"+id+"_3").removeClass();$("#ans_chk_"+id+"_4").removeClass();$("#ans_chk_"+id+"_"+ansid).addClass("imgCheckHide");$("#ans_tick_"+id+"_1").addClass("imgTick");$("#ans_tick_"+id+"_2").addClass("imgTick");$("#ans_tick_"+id+"_3").addClass("imgTick");$("#ans_tick_"+id+"_4").addClass("imgTick");$("#ans_tick_"+id+"_"+ansid).removeClass("imgTick");fn_Change_Image(id,'S');}else{$("#answered_"+id).val("");}}
</script>
</body>
</html>