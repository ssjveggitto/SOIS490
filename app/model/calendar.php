<?php
	session_start();
	error_reporting(E_ALL ^ E_WARNING ^ E_NOTICE);
	
		// get params
		$monthArg = $_GET['m'];
		$dateArg = $_GET['d'];

	
						// calc dates and weekdays
				if($dateArg == null || $dateArg == '')
					$dateArg = date("Y\-n\-d");
						
				if ($monthArg == null || $monthArg == '')		
					$currMonth= date("m");				
				else
					$currMonth = intval($monthArg);	
								
				$currYear = date("Y");
				$startDate = strtotime($currYear . "-" . $currMonth . "-01 00:00:01");
				$startDay= date("N", $startDate);
				$monthName = date("M",$startDate );
				
				//echo("start day=". $startDay . "<br>");

				$daysInMonth = cal_days_in_month(CAL_GREGORIAN, date("m", $startDate), date( "Y", $startDate));
				$endDate = strtotime($currYear . "-" . $currMonth . "-" .  $daysInMonth ." 00:00:01");

				//echo(date("Y", $endDate) . "-" . date("m", $endDate) . "-". date("d", $endDate));
				$endDay = date("N", $endDate);
				//echo("end day=" . $endDay . "<br>");		

				// initialize structure array matching the calendar grid
				// 6 rows and 7 columns

					// php date sunday is zero
				if ($startDay> 6)
					$startDay = 7 -$startDay;

				$currElem = 0;
				$dayCounter = 0;
				$firstDayHasCome = false;
				$arrCal = array();
				for($i = 0; $i <= 5; $i ++) {
					for($j= 0; $j <= 6; $j++) {
								// decide what to show in the cell
					    if($currElem < $startDay && !$firstDayHasCome)			
							$arrCal[$i][$j] = "";
						else if ($currElem == $startDay && !$firstDayHasCome) {
							$firstDayHasCome= true;
							$arrCal[$i][$j] = ++$dayCounter;
						}
						else if ($firstDayHasCome) {
							if ($dayCounter < $daysInMonth)
								$arrCal[$i][$j] = ++ $dayCounter; 
							else
								$arrCal[$i][$j] = "";	
						}							
				
						$currElem ++;				
					}
				}

		?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>Calendar</title>
<style>
body{
font-family:"Helvetica Neue",Arial,Helvetica,sans-serif;-webkit-text-size-adjust:none;color:#000000;font-size:14px;font-style:normal;font-weight:normal;line-height:line-height;text-decoration:none; margin:0; padding:0;
}
div.wrapper{
	display:block;
	width:100%;
	margin:0;
	text-align:left;
}

.col1{
	height:100px;
	background-color:#231f20;
	color:#FFFFFF;
	}
.col2{
	height:1950px;
	background-repeat:no-repeat;
	padding-top:30px;
	}
.col4{
	height:auto;
	background-color:#f7f7f7;
	color:#000000;
	padding-top:20px;
	padding-bottom:10px;
	border:1px solid #999999;
	}
.col5{
	height:30px;
	background-color:#060606;
	color:#FFFFFF;
	padding-top:20px;
	}
.col6{	
	height:70px;
	background-color:#231f20;
	padding-top:10px;
	color:#FFFFFF;
	}

.heading{
	font:"Times New Roman", Times, serif;
	font-weight:bold;
	font-size:20px;
	margin:10px 0 10px 0;
	}
.heading1{
	font:"Times New Roman", Times, serif;
	font-weight:bold;
	font-size:18px;
	}
.heading2{
	font:"Times New Roman", Times, serif;
	font-weight:bold;
	font-size:30px;
	text-align:center;
	color:#15a589;
	margin-bottom:10px;
	}
.closingDate{
	margin-top:40px;
	text-align:center;
	font-weight:bold;
	color:#FF0000;
	}
	
.clear{
	clear:both;
	}
.container_col2{
	width:880px;
	min-height:300px;
	height:auto;
	margin:0 auto;
	padding:40px;
	background-color:#FFFFFF;
	}
.container_comp{
	width:880px;
	height:700px;
	margin:0 auto;
	padding:20px;
	background-color:#f7f7f7;
	border:1px solid #999999;
	margin-bottom:25px;
	}
.container_calendar{
	width:840px;
	height:541px;
	margin:0 auto;
	background-color:#f7f7f7;
	border:2px solid #999999;
	margin-bottom:25px;
	}
	

.navg_month{
	height:24px;
	text-align:center;
	margin-bottom:15px;
	font-size:16px;
	word-spacing:10px;
	}
.month{
	color:#18bc9c;
	text-decoration:none;
	}
.month:hover{
	color:#000066;
	text-decoration:none;
	}
.day{
	width:109px;
	height:25px;
	color:#330000;
	float:left;
	padding:5px;
	text-align:center;
	font:bold 16px arial;
	border-bottom:1px solid #999999;
	border-right:1px solid #999999;
	background-color:#cccccc;
	}
.date{
	width:119px;
	height:100px;
	float:left;
	border-bottom:1px solid #999999;
	border-right:1px solid #999999;
	background-color:#ffffff;
	}
.date:hover{
	background-color:#ededed;
	cursor:pointer;
	}
.date .top{
	width:118px;
	height:48px;
	/*border:1px solid red;*/
	}
.date .bottom{
	width:118px;
	height:48px;
	/*border:1px solid red;*/
	}
.date .bottom .part{
	width:37px;
	height:46px;
	float:left;
	/*border:1px solid red;*/
	}

.day{
	width:109px;
	height:25px;
	color:#000000;
	float:left;
	padding:5px;
	text-align:center;
	font:bold 16px arial;
	border-bottom:1px solid #999999;
	border-right:1px solid #999999;
	background-color:#cccccc;
	}
.date{
	width:119px;
	height:100px;
	float:left;
	border-bottom:1px solid #999999;
	border-right:1px solid #999999;
	background-color:#ffffff;
	}
.date:hover{
	background-color:#ededed;
	cursor:pointer;
	}
.date .top{
	width:118px;
	height:48px;
	/*border:1px solid red;*/
	}
.date .bottom{
	width:118px;
	height:48px;
	/*border:1px solid red;*/
	}
.date .bottom .part{
	width:37px;
	height:46px;
	float:left;
	/*border:1px solid red;*/
	}

.date_topright{
	z-index:500px;
	background-color:#333333;
	height:17px;
	width:20px;
	color:#FFFFFF;
	float:right;
	text-align:center;
	}

.seprator{
	color:#333333;
	text-shadow:#000000;
	}
	
.popup_header{
	background-color: #18bc9c;
	color:#FFFFFF;
	padding-left:5px;
	padding-right:5px;
	border: 1px solid #15a589;
	font-weight: bold;
}
	
.appointment{
	background-color: #18bc9c;
	color:#FFFFFF;
	padding-left:5px;
	padding-right:5px;
	border: 1px solid #15a589;
}

.appointment:hover{
	background-color:#15a589;
	cursor:pointer;
	}

.free_view{
	background-color: #FFF;
	padding-left:5px;
	padding-right:5px;
	border-bottom: 1px solid #bfbfbf;
	border-top: 1px solid #FFFFFF;
	border-left: 1px solid #bfbfbf;
	border-right: 1px solid #bfbfbf;
}
	
.free{
	background-color: #FFF;
	padding-left:5px;
	padding-right:5px;
	border-bottom: 1px solid #bfbfbf;
	border-top: 1px solid #FFFFFF;
	border-left: 1px solid #bfbfbf;
	border-right: 1px solid #bfbfbf;
}

.free:hover{
	background-color:#ededed;
	cursor:pointer;
	}

.free_top{
	background-color: #FFF;
	padding-left:5px;
	padding-right:5px;
	border-bottom: 1px solid #bfbfbf;
	border-top: 1px solid #bfbfbf;
	border-left: 1px solid #bfbfbf;
	border-right: 1px solid #bfbfbf;
}

.staff_header{
	background-color: #737373;
	color:#FFFFFF;
	padding-left:5px;
	padding-right:5px;
	border-bottom: 1px solid #bfbfbf;
	border-top: 1px solid #FFFFFF;
	border-left: 1px solid #bfbfbf;
	border-right: 1px solid #bfbfbf;
}

.blank{
	background-color: #FFFFFF;
	color:#FFFFFF;
	padding-left:5px;
	padding-right:5px;
	border-bottom: 1px solid #FFFFFF;
	border-top: 1px solid #FFFFFF;
	border-left: 1px solid #FFFFFF;
	border-right: 1px solid #FFFFFF;
}

.add_appointment{
	width:100%;
	height:100%;
	opacity:.95;
	top:0;
	left:0;
	display:none;
	position:fixed;
	background-color:#313131;
	overflow:auto;
}

.popupAppointment{
	position:absolute;
	left:50%;
	top:17%;
	margin-left:-202px;
}

.appointment_form{
	max-width:300px;
	min-width:250px;
	padding:10px 50px;
	border:2px solid gray;
	border-radius:10px;
	background-color:#fff
}

</style>
<script src="../../config/libraries/jquery/dist/jquery.min.js"></script>
<script src="calendar.js"></script>
<!--<script src="../includes/jquery/jquery-1.4.2.js"></script>-->

<script>
	$(document).ready(function() {

		$('.date').click(function(){
			var url = window.location.href;
			if(url.indexOf("&d=") > -1)
			{
				url = url.substring(0,url.indexOf("&d="));
				window.location.replace(url + "&d=" + $(this).attr('id'));
			} else if (url.indexOf("?d=") > -1) {
				url = url.substring(0,url.indexOf("?d="));
				window.location.replace(url + "?d=" + $(this).attr('id'));				
			} else {
				if(window.location.href.contains("?m")) {
					window.location.replace(url + "&d=" + $(this).attr('id'));
				} else {
					window.location.replace(url + "?d=" + $(this).attr('id'));
				}
			}
		});
		
		$('.free').click(function() {			
			div_show();
			delete_hide();
			document.getElementById('sql_action').value = "Insert";
			document.getElementById('appointment_id').value = "";
			$("div#popup_header_text").text("Create Appointment");
						
			var str = $(this).attr('id');
			var res = str.split("_");
			var staff_id_str = res[0];
			var time_iterator_str = res[1];
			
			//Change Drop Down Values
			var staff_select = document.getElementById('staff_id');
			var staff_ops = staff_select.options;
			for(var opt, i = 0; opt = staff_ops[i]; i++)
			{
				//console.log(opt.value);
				if(opt.value == staff_id_str) {
					staff_select.selectedIndex = i;
					break;
				}
			}
			
			//Set Times
			var s_time = new Date(2016,3,15,7,00);
			s_time = new Date(s_time.getTime() + ((time_iterator_str - 1) * 15 * 60000));
			
			var e_time = new Date(s_time.getTime() + (45 * 60000));
			
			$('#appointment_duration .start').timepicker('setTime', s_time);
			$('#appointment_duration .end').timepicker('setTime', e_time);
			timeOnlyDatepair.refresh();			
		});
		
		$('.appointment').click(function() {
			div_show();
			delete_show();
			document.getElementById('sql_action').value = "Update";
			$("div#popup_header_text").text("Update Appointment");
						
			var str = $(this).attr('id');
			var res = str.split("_");
			var staff_id_str = res[0];
			var time_iterator_str = res[1];
			var appointment_id_str = res[2];
			var stime = $(this).attr('stime'); //Format: 2016-03-15 07:30:00
			var etime = $(this).attr('etime');	
			var c_id = $(this).attr('c_id');
			var serv_id = $(this).attr('serv_id');
			var pro_id = $(this).attr('pro_id');

			document.getElementById('appointment_id').value = appointment_id_str;			
			
			//Change Drop Down Values
			//Staff_Id
			var staff_select = document.getElementById('staff_id');
			var staff_ops = staff_select.options;
			for(var opt, i = 0; opt = staff_ops[i]; i++)
			{
				//console.log(opt.value);
				if(opt.value == staff_id_str) {
					staff_select.selectedIndex = i;
					break;
				}
			}
			
			//Customer_Id
			var customer_select = document.getElementById('customer_id');
			var customer_ops = customer_select.options;
			for(var opt, i = 0; opt = customer_ops[i]; i++)
			{
				if(opt.value == c_id) {
					customer_select.selectedIndex = i;
					break;
				}
			}
			
			//Service_Id
			var service_select = document.getElementById('service_id');
			service_ops = service_select.options;
			for(var opt, i = 0; opt = service_ops[i]; i++)
			{
				if(opt.value == serv_id) {
					service_select.selectedIndex = i;
					break;
				}
			}
			
			//Promotion_Id
			var promotion_select = document.getElementById('promotion_id');
			promotion_ops = promotion_select.options;
			for(var opt, i = 0; opt = promotion_ops[i]; i++)
			{
				if(opt.value == pro_id) {
					promotion_select.selectedIndex = i;
					break;
				}
			}
			
			//Resources
			//document.getElementById('resources').value = $(this).attr('reso');
			
			//Set Times
			//Date Object Formats: 2016-03-15 07:30:00
			var stime_array = stime.split(" ");
			var stime_date = stime_array[0];
			var stime_date_array = stime_date.split("-");
			var stime_time = stime_array[1];
			var stime_time_array = stime_time.split(":");
			
			var s_time = new Date(stime_date_array[0],stime_date_array[1]-1,stime_date_array[2],stime_time_array[0],stime_time_array[1]);
			
			
			
			var etime_array = etime.split(" ");
			var etime_date = etime_array[0];
			var etime_date_array = etime_date.split("-");
			var etime_time = etime_array[1];
			var etime_time_array = etime_time.split(":");
			
			var e_time = new Date(etime_date_array[0],etime_date_array[1]-1,etime_date_array[2],etime_time_array[0],etime_time_array[1]);
			
			$('#appointment_duration .start').timepicker('setTime', s_time);
			$('#appointment_duration .end').timepicker('setTime', e_time);
			timeOnlyDatepair.refresh();	
		});
	});
</script>
</head>

<body>
	<div class="wrapper">


        <div class="col2" style="height:850px">
        	<div class="container_comp">
            	<div class="heading2"><?php echo($monthName. "&nbsp;" . $currYear);?></div>
                <div class="navg_month">
                	    <a href="calendar.php?m=1" class="month">Jan</a>
                        <span class="seprator">|</span>
                        <a href="calendar.php?m=2" class="month">Feb</a>
                        <span class="seprator">|</span>
                        <a href="calendar.php?m=3" class="month">Mar</a>
                        <span class="seprator">|</span>
                        <a href="calendar.php?m=4" class="month">Apr</a>
                        <span class="seprator">|</span>
                        <a href="calendar.php?m=5" class="month">May</a>
                        <span class="seprator">|</span>
                        <a href="calendar.php?m=6" class="month">Jun</a>
                        <span class="seprator">|</span>
                        <a href="calendar.php?m=7" class="month">Jul</a>
                        <span class="seprator">|</span>
                        <a href="calendar.php?m=8" class="month">Aug</a>
                        <span class="seprator">|</span>
                        <a href="calendar.php?m=9" class="month">Sep</a>
                        <span class="seprator">|</span>
                        <a href="calendar.php?m=10" class="month">Oct</a>
                        <span class="seprator">|</span>
                        <a href="calendar.php?m=11" class="month">Nov</a>
                        <span class="seprator">|</span>
                        <a href="calendar.php?m=12" class="month">Dec</a>
				</div>
            	<div class="container_calendar">
                	<div>
                    	<div class="day">Sunday</div>
                        <div class="day">Monday</div>
                        <div class="day">Tuesday</div>
                        <div class="day">Wednesday</div>
                        <div class="day">Thursday</div>
                        <div class="day">Friday</div>
                        <div class="day">Saturday</div>
                        <div class="clear"></div>
                    </div>

					<?php
						$currElem = 0;
						$dayCounter = 0;
						$firstDayHasCome = false;
						$lowerLeftCorner= "";
						$lowerRightCorner= "";
						$rows_done = false;
	
						for($i = 0; $i <= 5; $i ++) {
							if(!$rows_done)
							{
								echo("<div>\r\n");
								for($j= 0; $j <= 6; $j++) {
									
									$divId = $currYear . "-";
									$divId .= $currMonth . "-";
									if(intval($arrCal[$i][$j]) < 10)
										$divId .= "0";
									$divId .= $arrCal[$i][$j];

									$leftCorner = "";
									$rightCorner = "";
									if ($i == 5 && $j ==0)
										$leftCorner = $lowerLeftCorner;

									if ($i == 5 && $j == 6)
										$leftCorner = $lowerRightCorner;

									// decide what to show in the cell
									if($currElem < $startDay && !$firstDayHasCome)	{		
										echo("<div class=\"date\"". $leftCorner .">\r\n");
										echo("</div>\r\n");

									}
									else if ($currElem == $startDay && !$firstDayHasCome) {
										$firstDayHasCome= true;
										echo("<div id=" . $divId . " class=\"date\"". $leftCorner .">\r\n");
										echo("<div class=\"top\">\r\n");
										echo("<div class=\"date_topright\">" . $arrCal[$i][$j] ."</div>\r\n");
										echo("</div>\r\n");
										echo("<div class=\"bottom\">\r\n");
										echo("<div class=\"part\"></div>\r\n");
										echo("<div class=\"part\"></div>\r\n");
										echo("<div class=\"part\"></div>\r\n");
										echo("</div>\r\n");
										echo("</div>\r\n");
										$dayCounter ++;

									}
									else if ($firstDayHasCome) {
										if ($dayCounter < $daysInMonth) {
											echo("<div id=". $divId . " class=\"date\"". $leftCorner . ">\r\n");
											echo("<div class=\"top\">\r\n");
											echo("<div class=\"date_topright\">" . $arrCal[$i][$j] ."</div>\r\n");
											echo("</div>\r\n");
											echo("<div class=\"bottom\">\r\n");
											echo("<div class=\"part\"></div>\r\n");
											echo("<div class=\"part\"></div>\r\n");
											echo("<div class=\"part\"></div>\r\n");
											echo("</div>\r\n");
											echo("</div>\r\n");
											$dayCounter ++;
										}	
										else {
											echo("<div class=\"date\"". $leftCorner . ">\r\n");
											echo("</div>\r\n");
											$rows_done = true;
										}
									}								
					
								$currElem ++;				
								}
								echo("</div>\r\n");
							}
						}
						
					?>
                 </div>
				 
            </div>
        <div class="col4">
        	<div class="container_col4" align="center"><div class="heading2"><?php echo $dateArg ?></div></div>
        </div>
		<br>
			<div id="add_appointment" class="add_appointment">
				<div id="popupAppointment" class="popupAppointment">
					<form id="appointment_form" class="appointment_form" method="post" name="form" action="process.php">
						<input type="hidden" name="sql_action" id="sql_action" value="">
						<input type="hidden" name="appointment_id" id="appointment_id" value="">
						<div class="popup_header" width="100%" align="center">
							<div id="popup_header_text"></div>
						</div>
						<br>
						<?php
							$db_path = '../../config/db/db.php';
							if(file_exists($db_path)) {
								require($db_path);
								echo '<script>console.log("database connected");</script>';
							} else {
								echo '<script>console.log("database is not connected in the model");</script>';
							}
							
							$database = DB::getInstance();
							
							echo '<input type="hidden" name="date_value" value="'.$dateArg.'">';
							echo '<input type="hidden" name="redirect_string" value="">';
							
							//Staff
							$staff_query = "select first, last, staff_id from staff order by last, first;";
							$staff_results = $database->get_results($staff_query);
							
							echo 'Staff:<br>';
							echo '<select name="staff_id" id="staff_id">';
							
							foreach($staff_results as $staff_row)
							{
								echo '<option value="'.$staff_row["staff_id"].'">'.$staff_row["first"] .' '. $staff_row["last"].'</option>';
							}
							
							echo '</select>';
							
							//Customer
							echo '<br><br>';
							$customer_query = "select first, last, customer_id from customer order by last, first;";
							$customer_results = $database->get_results($customer_query);
							
							echo 'Customer:<br>';
							echo '<select name="customer_id" id="customer_id">';
							
							foreach($customer_results as $customer_row)
							{
								echo '<option value="'.$customer_row["customer_id"].'">'.$customer_row["first"] .' '. $customer_row["last"].'</option>';
							}
							
							echo '</select>';
							
							//Service
							echo '<br><br>';
							$service_query = "select name, service_id from service order by service_id;";
							$service_results = $database->get_results($service_query);
							
							echo 'Service:<br>';
							echo '<select name="service_id" id="service_id">';
							
							//echo '<option value="null">None</option>';
							
							foreach($service_results as $service_row)
							{
								echo '<option value="'.$service_row["service_id"].'">'.$service_row["name"] .'</option>';
							}
							
							echo '</select>';
						?>					
						<br>
						<br>
						Time:
						<br>
						<div id="appointment_duration">
							<input type="text" class="time start" name="time_start" /> to
							<input type="text" class="time end" name="time_end" />
						</div>
						<br>
						<link rel="stylesheet" type="text/css" href="timepicker/jquery.timepicker.css" />
						<link rel="stylesheet" type="text/css" href="timepicker/lib/bootstrap-datepicker.css" />
						<script type="text/javascript" src="timepicker/lib/bootstrap-datepicker.js"></script>
						<script type="text/javascript" src="timepicker/jquery.timepicker.js"></script>
						<script type="text/javascript" src="datepair/dist/datepair.js"></script>
						<script>
							$('#appointment_duration .time').timepicker({
								'showDuration': true,
								'timeFormat': 'g:ia',
								'step' : 15,
								'disableTimeRanges' : [['12am', '7am'],['10pm','11:59pm']]
							});							

							var timeOnlyExampleEl = document.getElementById('appointment_duration');
							var timeOnlyDatepair = new Datepair(timeOnlyExampleEl);
						</script>
						<?php
							$promotion_query = "select description, promotion_id from promotion where ifnull(start_date,'1/1/1970') < CURDATE() and CURDATE() < ifnull(end_date,'1/1/3000') order by start_date, end_date;";
							$promotion_results = $database->get_results($promotion_query);
							
							echo 'Promotion:<br>';
							echo '<select name="promotion_id" id="promotion_id">';
							echo '<option value="null">None</option>';
							foreach($promotion_results as $promotion_row)
							{
								echo '<option value="'.$promotion_row["promotion_id"].'">'.$promotion_row["description"].'</option>';
							}
							
							echo '</select>';
							echo '<br><br>';
						?>	
						<!--Resources:
						<br>
						<input id="resources" name="resources" placeholder="1,2,3" type="text">	-->
						
						<div id="delete_div" class="delete_div">
						Delete Record:
						<br>
						<input id="delete" name="delete" value="Delete" type="submit">
						</div>
						<hr>	
						<div align="right">
						<input id="cancel" name="cancel" value="Cancel" type="button" onclick="div_hide()">
						<input id="ok" name="ok" value="Done" type="submit">
						</div>						
					</form>
				</div>
			</div>
		<br>
		<table width="100%" align="center">
			<tr>
				<td>
					<table cellspacing="0" width="100px">
						<tr>
							<td class="blank">
								&nbsp; <!--Staff Name Row-->
							</td>
						</tr>						
						<tr>
							<td class="free_top">
								<div>7:00 AM</div>
							</td>
						</tr>
						<tr>
							<td class="free_view">
								<div>&nbsp;</div>
							</td>
						</tr>
						<tr>
							<td class="free_view">
								<div>7:30 AM</div>
							</td>
						</tr>
						<tr>
							<td class="free_view">
								<div>&nbsp;</div>
							</td>
						</tr>
						<tr>
							<td class="free_view">
								<div>8:00 AM</div>
							</td>
						</tr>
						<tr>
							<td class="free_view">
								<div>&nbsp;</div>
							</td>
						</tr>
						<tr>
							<td class="free_view">
								<div>8:30 AM</div>
							</td>
						</tr>
						<tr>
							<td class="free_view">
								<div>&nbsp;</div>
							</td>
						</tr>
						<tr>
							<td class="free_view">
								<div>9:00 AM</div>
							</td>
						</tr>
						<tr>
							<td class="free_view">
								<div>&nbsp;</div>
							</td>
						</tr>
						<tr>
							<td class="free_view">
								<div>9:30 AM</div>
							</td>
						</tr>
						<tr>
							<td class="free_view">
								<div>&nbsp;</div>
							</td>
						</tr>
						<tr>
							<td class="free_view">
								<div>10:00 AM</div>
							</td>
						</tr>
						<tr>
							<td class="free_view">
								<div>&nbsp;</div>
							</td>
						</tr>
						<tr>
							<td class="free_view">
								<div>10:30 AM</div>
							</td>
						</tr>
						<tr>
							<td class="free_view">
								<div>&nbsp;</div>
							</td>
						</tr>
						<tr>
							<td class="free_view">
								<div>11:00 AM</div>
							</td>
						</tr>
						<tr>
							<td class="free_view">
								<div>&nbsp;</div>
							</td>
						</tr>
						<tr>
							<td class="free_view">
								<div>11:30 AM</div>
							</td>
						</tr>
						<tr>
							<td class="free_view">
								<div>&nbsp;</div>
							</td>
						</tr>
						<tr>
							<td class="free_view">
								<div>12:00 PM</div>
							</td>
						</tr>	
						<tr>
							<td class="free_view">
								<div>&nbsp;</div>
							</td>
						</tr>
						<tr>
							<td class="free_view">
								<div>12:30 PM</div>
							</td>
						</tr>
						<tr>
							<td class="free_view">
								<div>&nbsp;</div>
							</td>
						</tr>
						<tr>
							<td class="free_view">
								<div>1:00 PM</div>
							</td>
						</tr>
						<tr>
							<td class="free_view">
								<div>&nbsp;</div>
							</td>
						</tr>
						<tr>
							<td class="free_view">
								<div>1:30 PM</div>
							</td>
						</tr>
						<tr>
							<td class="free_view">
								<div>&nbsp;</div>
							</td>
						</tr>
						<tr>
							<td class="free_view">
								<div>2:00 PM</div>
							</td>
						</tr>
						<tr>
							<td class="free_view">
								<div>&nbsp;</div>
							</td>
						</tr>
						<tr>
							<td class="free_view">
								<div>2:30 PM</div>
							</td>
						</tr>
						<tr>
							<td class="free_view">
								<div>&nbsp;</div>
							</td>
						</tr>
						<tr>
							<td class="free_view">
								<div>3:00 PM</div>
							</td>
						</tr>
						<tr>
							<td class="free_view">
								<div>&nbsp;</div>
							</td>
						</tr>
						<tr>
							<td class="free_view">
								<div>3:30 PM</div>
							</td>
						</tr>
						<tr>
							<td class="free_view">
								<div>&nbsp;</div>
							</td>
						</tr>
						<tr>
							<td class="free_view">
								<div>4:00 PM</div>
							</td>
						</tr>
						<tr>
							<td class="free_view">
								<div>&nbsp;</div>
							</td>
						</tr>
						<tr>
							<td class="free_view">
								<div>4:30 PM</div>
							</td>
						</tr>
						<tr>
							<td class="free_view">
								<div>&nbsp;</div>
							</td>
						</tr>
						<tr>
							<td class="free_view">
								<div>5:00 PM</div>
							</td>
						</tr>
						<tr>
							<td class="free_view">
								<div>&nbsp;</div>
							</td>
						</tr>
						<tr>
							<td class="free_view">
								<div>5:30 PM</div>
							</td>
						</tr>
						<tr>
							<td class="free_view">
								<div>&nbsp;</div>
							</td>
						</tr>
						<tr>
							<td class="free_view">
								<div>6:00 PM</div>
							</td>
						</tr>
						<tr>
							<td class="free_view">
								<div>&nbsp;</div>
							</td>
						</tr>
						<tr>
							<td class="free_view">
								<div>6:30 PM</div>
							</td>
						</tr>
						<tr>
							<td class="free_view">
								<div>&nbsp;</div>
							</td>
						</tr>
						<tr>
							<td class="free_view">
								<div>7:00 PM</div>
							</td>
						</tr>
						<tr>
							<td class="free_view">
								<div>&nbsp;</div>
							</td>
						</tr>
						<tr>
							<td class="free_view">
								<div>7:30 PM</div>
							</td>
						</tr>
						<tr>
							<td class="free_view">
								<div>&nbsp;</div>
							</td>
						</tr>
						<tr>
							<td class="free_view">
								<div>8:00 PM</div>
							</td>
						</tr>
						<tr>
							<td class="free_view">
								<div>&nbsp;</div>
							</td>
						</tr>
						<tr>
							<td class="free_view">
								<div>8:30 PM</div>
							</td>
						</tr>
						<tr>
							<td class="free_view">
								<div>&nbsp;</div>
							</td>
						</tr>
						<tr>
							<td class="free_view">
								<div>9:00 PM</div>
							</td>
						</tr>
						<tr>
							<td class="free_view">
								<div>&nbsp;</div>
							</td>
						</tr>
						<tr>
							<td class="free_view">
								<div>9:30 PM</div>
							</td>
						</tr>
						<tr>
							<td class="free_view">
								<div>&nbsp;</div>
							</td>
						</tr>						
					</table>
				</td>
				<!--Data goes here-->
				<?php
					/*$db_path = '../../config/db/db.php';
					if(file_exists($db_path)) {
						require($db_path);
						echo '<script>console.log("database connected");</script>';
					} else {
						echo '<script>console.log("database is not connected in the model");</script>';
					}
					
					$database = DB::getInstance();*/
					
					$staff_query = "select first, last, staff_id from staff order by last, first;";
					$staff_results = $database->get_results($staff_query);
					foreach($staff_results as $staff_row)
					{
						$time_iter = 0;
						
						echo '<td>
								<table cellspacing="0" width="200px">
									<tr>
										<td class="staff_header"><b>' . $staff_row['first'] . ' ' . $staff_row['last'] . '</b></td>
									</tr>';
									
						$appointment_query = "select TIMESTAMPDIFF(MINUTE, start_timestamp, end_timestamp) as 'duration', appointment_id, check_in, a.customer_id, end_timestamp, a.notes, promotion_id, a.resources, a.service_id, staff_id, start_timestamp, a.status_code, DATE_FORMAT(start_timestamp,'%r') as 'start_time', DATE_FORMAT(end_timestamp,'%r') as 'end_time', c.first, c.last, s.name from appointment a, customer c, service s where staff_id = ". $staff_row['staff_id'] ." and DATE(start_timestamp) = DATE('". $dateArg ."') and a.customer_id = c.customer_id and a.service_id = s.service_id order by start_timestamp;";
						echo '<script>console.log("query:'.$appointment_query.'");</script>';
						$appointment_results = $database->get_results($appointment_query);
						$last_time = StrToTime ($dateArg. " 07:00");						
						foreach($appointment_results as $appointment_row)
						{
							echo '<script>console.log("last_time:'.$last_time.' start_timestamp:'.$appointment_row["start_timestamp"].'");</script>';
							if($last_time <= StrToTime ($appointment_row["start_timestamp"]))
							{
								//First find the difference in time between last_time and the next appointment
								$hours = (StrToTime ($appointment_row["start_timestamp"]) - $last_time) / (60 * 60);
								//Since our schedule is in 15 minute intervals, there should be 4 times as many iterations as hours
								$iter = 4 * $hours;
								
								for($i = 0; $i < $iter; $i++)
								{
									$time_iter = $time_iter + 1;
									echo '<tr>
											<td class="free" id="'.$staff_row["staff_id"] .'_'. $time_iter .'">&nbsp;</td>
										  </tr>';
								}
								
								$time_iter = $time_iter + 1;
								echo '<tr>
										<td class="appointment" id="'.$staff_row["staff_id"] .'_'. $time_iter .'_'. $appointment_row["appointment_id"] .'" stime="'. $appointment_row["start_timestamp"] .'" etime="'. $appointment_row["end_timestamp"] .'" c_id="'. $appointment_row["customer_id"] .'" serv_id="'. $appointment_row["service_id"] .'" pro_id="'. $appointment_row["promotion_id"] .'" reso="' . $appointment_row['resources'] . '"><b>'. $appointment_row['start_time'] . '-' . $appointment_row['end_time'] . '</b></td>
									  </tr>';
								
								$iter = (($appointment_row['duration'] / 15) - 1);
								for($i = 0; $i < $iter; $i++)
								{
									$time_iter = $time_iter + 1;
									if($i == 0) {
										echo '<tr>
												<td class="appointment" id="'.$staff_row["staff_id"] .'_'. $time_iter .'_'. $appointment_row["appointment_id"] .'" stime="'. $appointment_row["start_timestamp"] .'" etime="'. $appointment_row["end_timestamp"] .'" c_id="'. $appointment_row["customer_id"] .'" serv_id="'. $appointment_row["service_id"] .'" pro_id="'. $appointment_row["promotion_id"] .'" reso="' . $appointment_row['resources'] . '">'. $appointment_row['first'] .' '. $appointment_row['last'] .'</td>
											  </tr>';
									} else if($i == 1) {
										echo '<tr>
												<td class="appointment" id="'.$staff_row["staff_id"] .'_'. $time_iter .'_'. $appointment_row["appointment_id"] .'" stime="'. $appointment_row["start_timestamp"] .'" etime="'. $appointment_row["end_timestamp"] .'" c_id="'. $appointment_row["customer_id"] .'" serv_id="'. $appointment_row["service_id"] .'" pro_id="'. $appointment_row["promotion_id"] .'" reso="' . $appointment_row['resources'] . '">'. $appointment_row['name'] .'</td>
											  </tr>';
									} else {										
										echo '<tr>
												<td class="appointment" id="'.$staff_row["staff_id"] .'_'. $time_iter .'_'. $appointment_row["appointment_id"] .'" stime="'. $appointment_row["start_timestamp"] .'" etime="'. $appointment_row["end_timestamp"] .'" c_id="'. $appointment_row["customer_id"] .'" serv_id="'. $appointment_row["service_id"] .'" pro_id="'. $appointment_row["promotion_id"] .'" reso="' . $appointment_row['resources'] . '">&nbsp;</td>
											  </tr>';
									}
								}
								
								$last_time = StrToTime ($appointment_row['end_timestamp']);
							}
						}
						
						$remaining_hours = (StrToTime($dateArg. " 22:00") - $last_time) / (60 * 60);
						echo '<script>console.log("last_time:'.$last_time.' remaining_hours:'.$remaining_hours.'");</script>';
						$remaining_iter = 4 * $remaining_hours;
						
						for($i = 0; $i < $remaining_iter; $i++)
						{
							$time_iter = $time_iter + 1;
							echo '<tr>
									<td class="free" id="'.$staff_row["staff_id"] .'_'. $time_iter .'">&nbsp;</td>
								  </tr>';
						}
						
						echo '	</table>
							  </td>';
					}
				?>
			</tr>
		</table>
    </div>  <!-- wrapper close -->
</body>
</html>
