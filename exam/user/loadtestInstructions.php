<?php require_once 'admin/db_inc.php';$test=mysql_fetch_array(mysql_query("SELECT test_name,test_duration,negative_marks FROM test_master t where isVisible is null and test_id=".$_POST["tid"]));?>
<p class="headDiv" style="font-size:17px;"><b><u>Test</u> : </b><?php echo $test["test_name"];?>
<p><b>Marking : </b>As per question and -<?php echo $test["negative_marks"];?> for incorrect answer.</p>
<p><b>Test Duration : </b><?php echo $test["test_duration"];?> min</p>
<p><b>Sections : </b></p>
<?php $sres=mysql_query("SELECT subject_name,negative_marks FROM test_subject_relation_master tsm inner join subject_master s on tsm.subject_id=s.subject_id where test_id=".$_POST["tid"]) or die ('er');while($srow=mysql_fetch_array($sres)){echo "<p>".$srow["subject_name"];if($srow["negative_marks"]!=""){echo ":&ensp;-".$srow["negative_marks"]." for incorrect answers in this section.";}echo "</p>";}?>
<p class="gins" style="font-size:15px;">General Instructions</p>	
<p><img src="images/arrow.png"/>Once the test has started, do not press the refresh button (or F5 on your keyboard)</p>	
<p><img src="images/arrow.png"/>You do not need to be net connected during the complete duration.</p>	
<p><img src="images/arrow.png"/>Once the test time is over, the test will automatically submit.</p>
<p class="pbold ppad">Ensure you are internet connected when submitting.</p>
<p>Now you can start the test:&emsp;<img src="images/start.jpg" onclick="fn_start_test('<?php echo $_POST["tid"];?>')" style="width:80px;cursor:pointer;vertical-align: middle;"/></p>