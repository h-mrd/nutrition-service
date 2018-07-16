<?php
$studentID = 1;
//$studentID = $_SESSION['user_id'];
//$servername = "localhost";
	$servername = "db_service_host:3306";
	$dbname = "cc_project_database";
	$username = "auth_service_user";
	//$password = "";
	$password = "Auth_service@1397";
// Create connection
$conn = mysqli_connect($servername, $username, $password, $dbname);
// Check connection
if (!$conn) {
    die("Connection failed: " . mysqli_connect_error());
}
?>

<!doctype html>
<html>
    <head>
        <title>رزرو غذا</title>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <link href="..//source/bootstrap.min.css" type="text/css" rel="stylesheet"/>
        <link href="..//source/main-style.css" rel="stylesheet" type="text/css"/>
        <script src="..//source/bootstrap/js/bootstrap.min.js"></script>

        <style>
            th {
                text-align: center;
            }
            td {
                direction: rtl;
            }
			.red{color:red;}
			.green{color:green;}
        </style>

    </head>

    <body>
	<p class="title-tbl">لیست غذا</p>
<div class="col-sm-3"></div>
<div class="col-sm-6">
        <form action="food.php?type=reserve" method="post" class="form-horizontal">
            <table class="table-responsive table-bordered table-striped table-hover table-condensed" dir="rtl">
                <thead>
                    <tr>
                        <th>روز هفته</th>
                        <th>صبحانه</th>
                        <th>ناهار</th>
                        <th>شام</th>
                    </tr>
                </thead>
                <tbody>
                    <?php
		    
	           date_default_timezone_set('Europe/London');
                    $day = date('l', time());
                    $tomorrow = "";
                    $afterTomorrow = "";

                    switch ($day) {
                        case "Saturday":
                            $tomorrow = "Sunday";
                            $afterTomorrow = "Monday";
                            break;
                        case "Sunday":
                            $tomorrow = "Monday";
                            $afterTomorrow = "Tuesday";
                            break;
                        case "Monday":
                            $tomorrow = "Tuesday";
                            $afterTomorrow = "Wednesday";
                            break;
                        case "Tuesday":
                            $tomorrow = "Wednesday";
                            $afterTomorrow = "Thursday";
                            break;
                        case "Wednesday":
                            $tomorrow = "Thursday";
                            $afterTomorrow = "Friday";
                            break;
                        case "Thursday":
                            $tomorrow = "Friday";
                            $afterTomorrow = "Saturday";
                            break;
                        case "Friday":
                            $tomorrow = "Saturday";
                            $afterTomorrow = "Sunday";
                            break;
                        default:
                            echo $day;
                    }
                    $sql = "SELECT foods.*, food_student.f_id as used FROM foods
					LEFT JOIN food_student on food_student.f_id = foods.ID
					WHERE foods.DayOfWeek IN ('$day', '$tomorrow', '$afterTomorrow')";
					//$sql = "SELECT * FROM foods	WHERE DayOfWeek IN ('$day', '$tomorrow', '$afterTomorrow')";
                    $result = $conn->query($sql);
                    $firstRow="";
                        $firstRow_b="";
                        $firstRow_l="";
                        $firstRow_d="";
                    $secondRow="";
                        $secondRow_b="";
                        $secondRow_l="";
                        $secondRow_d="";
                    $thirdRow="";
                        $thirdRow_b="";
                        $thirdRow_l="";
                        $thirdRow_d="";
                    if ($result->num_rows > 0) {
                        // output data of each row
                        while ($row = $result->fetch_assoc()) {
                            if ($row['DayOfWeek'] == $day) {
                                if ($row['Meal'] == 'Breakfast') {
                                    if($firstRow_b==""){
										if(isset($row['ID'])){
											$firstRow_b = $row['Name']."<input type='checkbox' ";
											if(!empty($row['used'])){$firstRow_b.="disabled";}
											$firstRow_b.=" class='checked' name='cid[]' value='".$row['ID']."'/>".$row['Price']." ريال ";
										}
									}
                                    else {
										if(isset($row['ID'])){
											$firstRow_b.= "<br/>".$row['Name']."<input type='checkbox' ";
											if(!empty($row['used'])){$firstRow_b.="disabled";}
											$firstRow_b.=" class='checked' name='cid[]' value='".$row['ID']."'/>".$row['Price']." ريال ";
										}
									}
                                }
                                else if ($row['Meal'] == 'Lunch') {
                                    if($firstRow_l=="") {
										if(isset($row['ID'])){
											$firstRow_l = $row['Name']."<input type='checkbox' ";
											if(!empty($row['used'])){$firstRow_l.="disabled";}
											$firstRow_l.=" class='checked' name='cid[]' value='".$row['ID']."'/>".$row['Price']." ريال ";
										}
									}
                                    else {
										if(isset($row['ID'])){
											$firstRow_l.= "<br/>".$row['Name']."<input type='checkbox' ";
											if(!empty($row['used'])){$firstRow_l.="disabled";}
											$firstRow_l.=" class='checked' name='cid[]' value='".$row['ID']."'/>".$row['Price']." ريال ";
										}
									}
                                }
                                else if ($row['Meal'] == 'Dinner') {
                                    if($firstRow_d=="") {
										if(isset($row['ID'])){
											$firstRow_d = $row['Name']."<input type='checkbox' ";
											if(!empty($row['used'])){$firstRow_d.="disabled";}
											$firstRow_d.=" class='checked' name='cid[]' value='".$row['ID']."'/>".$row['Price']." ريال ";
										}
									}
                                    else {
										if(isset($row['ID'])){
											$firstRow_d.= "<br/>".$row['Name']."<input type='checkbox' ";
											if(!empty($row['used'])){$firstRow_d.="disabled";}
											$firstRow_d.=" class='checked' name='cid[]' value='".$row['ID']."'/>".$row['Price']." ريال ";
										}
									}
                                }
                            }
                            else if ($row['DayOfWeek'] == $tomorrow) {
                                if ($row['Meal'] == 'Breakfast') {
                                    if($secondRow_b=="") {
										if(isset($row['ID'])){
											$secondRow_b = $row['Name']."<input type='checkbox' ";
											if(!empty($row['used'])){$secondRow_b.="disabled";}
											$secondRow_b.=" class='checked' name='cid[]' value='".$row['ID']."'/>".$row['Price']." ريال ";
										}
									}
                                    else {
										if(isset($row['ID'])){
											$secondRow_b .= "<br/>".$row['Name']."<input type='checkbox' ";
											if(!empty($row['used'])){$secondRow_b.="disabled";}
											$secondRow_b.=" class='checked' name='cid[]' value='".$row['ID']."'/>".$row['Price']." ريال ";
										}
									}
                                }
                                else if ($row['Meal'] == 'Lunch') {
                                    if($secondRow_l=="") {
										if(isset($row['ID'])){
											$secondRow_l = $row['Name']."<input type='checkbox' ";
											if(!empty($row['used'])){$secondRow_l.="disabled";}
											$secondRow_l.=" class='checked' name='cid[]' value='".$row['ID']."'/>".$row['Price']." ريال ";
										}
									}
                                    else {
										if(isset($row['ID'])){
											$secondRow_l .= "<br/>".$row['Name']."<input type='checkbox' ";
											if(!empty($row['used'])){$secondRow_l.="disabled";}
											$secondRow_l.=" class='checked' name='cid[]' value='".$row['ID']."'/>".$row['Price']." ريال ";
										}
									}
                                }
                                else if ($row['Meal'] == 'Dinner') {
                                    if($secondRow_d=="") {
										if(isset($row['ID'])){
											$secondRow_d = $row['Name']."<input type='checkbox' ";
											if(!empty($row['used'])){$secondRow_d.="disabled";}
											$secondRow_d.=" class='checked' name='cid[]' value='".$row['ID']."'/>".$row['Price']." ريال ";
										}
									}
                                    else {
										if(isset($row['ID'])){
											$secondRow_d .= "<br/>".$row['Name']."<input type='checkbox' ";
											if(!empty($row['used'])){$secondRow_d.="disabled";}
											$secondRow_d.=" class='checked' name='cid[]' value='".$row['ID']."'/>".$row['Price']." ريال ";
										}
									}
                                }
     
                            }
                            else if ($row['DayOfWeek'] == $afterTomorrow) {
                                if ($row['Meal'] == 'Breakfast') {
                                    if($thirdRow_b=="") {
										if(isset($row['ID'])){
											$thirdRow_b = $row['Name']."<input type='checkbox' ";
											if(!empty($row['used'])){$thirdRow_b.="disabled";}
											$thirdRow_b.=" class='checked' name='cid[]' value='".$row['ID']."'/>".$row['Price']." ريال ";
										}
									}
                                    else {
										if(isset($row['ID'])){
											$thirdRow_b .= "<br/>".$row['Name']."<input type='checkbox' ";
											if(!empty($row['used'])){$thirdRow_b.="disabled";}
											$thirdRow_b.=" class='checked' name='cid[]' value='".$row['ID']."'/>".$row['Price']." ريال ";
										}
									}
                                }
                                else if ($row['Meal'] == 'Lunch') {
                                    if($thirdRow_l =="") {
										if(isset($row['ID'])){
											$thirdRow_l = $row['Name']."<input type='checkbox' ";
											if(!empty($row['used'])){$thirdRow_l.="disabled";}
											$thirdRow_l.=" class='checked' name='cid[]' value='".$row['ID']."'/>".$row['Price']." ريال ";
										}
									}
                                    else {
										if(isset($row['ID'])){
											$thirdRow_l .= "<br/>".$row['Name']."<input type='checkbox' ";
											if(!empty($row['used'])){$thirdRow_l.="disabled";}
											$thirdRow_l.=" class='checked' name='cid[]' value='".$row['ID']."'/>".$row['Price']." ريال ";
										}
									}
                                }
                                else if ($row['Meal'] == 'Dinner') {
                                    if($thirdRow_d =="") {
										if(isset($row['ID'])){
											$thirdRow_d = $row['Name']."<input type='checkbox' ";
											if(!empty($row['used'])){$thirdRow_d.="disabled";}
											$thirdRow_d.=" class='checked' name='cid[]' value='".$row['ID']."'/>".$row['Price']." ريال ";
										}
									}
                                    else {
										if(isset($row['ID'])){
											$thirdRow_d .= "<br/>".$row['Name']."<input type='checkbox' ";
											if(!empty($row['used'])){$thirdRow_d.="disabled";}
											$thirdRow_d.=" class='checked' name='cid[]' value='".$row['ID']."'/>".$row['Price']." ريال ";
										}
									}
                                }
                            }
                        }
					}
                        
                        ?>
                        <!--===========day===============-->
                        <tr>
                            <td><?php echo $day ?></td>
                            <td><!-- برای صبحانه -->
                                <?php echo $firstRow_b;?>
                            </td>
                            <td><!-- برای ناهار -->
                                <?php echo $firstRow_l;?>
                            </td>
                            <td><!-- برای شام -->
                                <?php echo $firstRow_d;?>
                            </td>
                        </tr>
                        <!--==================tomorrow======---------------->
                        <tr>
                            <td><?php echo $tomorrow ?></td>
                            <td><!-- برای صبحانه -->
                                <?php echo $secondRow_b;?>
                            </td>
                            <td><!-- برای ناهار -->
                                <?php echo $secondRow_l;?>
                            </td>
                            <td><!-- برای شام -->
                                <?php echo $secondRow_d;?>
                            </td>
                        </tr>
                        <!--=============afterTomorrow--------------------------->
                        <tr>
                            <td><?php echo $afterTomorrow ?></td>
                            <td><!-- برای صبحانه -->
                                <?php echo $thirdRow_b;?>
                            </td>
                            <td><!-- برای ناهار -->
                                <?php echo $thirdRow_l;?>
                            </td>
                            <td><!-- برای شام -->
                                <?php echo $thirdRow_d;?>
                            </td>
                        </tr>
                        <!--======================================-->
                      
                </tbody>
            </table>
            <div class="form-button">
                <button type="submit" name="btnres" class="btn btn-success reserve">رزرو</button>
                <button type="reset" class="btn btn-success reset">پاک کردن</button>
            </div>
            <input type="hidden" name="clientID" value="<?php echo $studentID; ?>"/>
        </form>
		</div>

<div class="col-sm-3"></div>
		<div class="clearfix"></div>
		<div class="clearfix"></div>
		<div class="clearfix"></div>
		<div class="col-sm-3"></div>
<div class="col-sm-6">
		<form action="food.php?type=cancel" method="post" class="form-horizontal">
			<?php
			$day = date('l', time());
			$tomorrow = "";
			$afterTomorrow = "";

			switch ($day) {
				case "Saturday":
					$tomorrow = "Sunday";
					$afterTomorrow = "Monday";
					break;
				case "Sunday":
					$tomorrow = "Monday";
					$afterTomorrow = "Tuesday";
					break;
				case "Monday":
					$tomorrow = "Tuesday";
					$afterTomorrow = "Wednesday";
					break;
				case "Tuesday":
					$tomorrow = "Wednesday";
					$afterTomorrow = "Thursday";
					break;
				case "Wednesday":
					$tomorrow = "Thursday";
					$afterTomorrow = "Friday";
					break;
				case "Thursday":
					$tomorrow = "Friday";
					$afterTomorrow = "Saturday";
					break;
				case "Friday":
					$tomorrow = "Saturday";
					$afterTomorrow = "Sunday";
					break;
				default:
					echo $day;
			}
			$student_food = "SELECT food_student.fs_id, food_student.fs_status,	foods.Number, foods.DayOfWeek,
			foods.Name, foods.Meal, foods.Price 
			From food_student 
			INNER JOIN foods on foods.ID = food_student.f_id
			WHERE food_student.s_id = '".$studentID."'";
			$result = $conn->query($student_food);
			$firstRow="";
				$firstRow_b="";
				$firstRow_l="";
				$firstRow_d="";
			$secondRow="";
				$secondRow_b="";
				$secondRow_l="";
				$secondRow_d="";
			$thirdRow="";
				$thirdRow_b="";
				$thirdRow_l="";
				$thirdRow_d="";
			if ($result->num_rows > 0) {
			?>
			<table class="table-responsive table-bordered table-striped table-hover table-condensed" style="direction:rtl;">
				<thead>
                    <tr>
                        <th>روز هفته</th>
                        <th>صبحانه</th>
                        <th>ناهار</th>
                        <th>شام</th>
                    </tr>
                </thead>
				<tbody>
					<?php
					while ($row = $result->fetch_assoc()) {
						if ($row['DayOfWeek'] == $day) {
							if ($row['Meal'] == 'Breakfast') {
								if($firstRow_b=="") {
									$firstRow_b = $row['Name']."<input type='checkbox' class='checked' name='ckid[]' value='".$row['fs_id']."'/>".$row['Price']." ريال ";
									if($row['fs_status'] == '0') {
										$firstRow_b .= "<span class='red'>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;لغو شده</span>";
									} else if($row['fs_status'] == '1') {
										$firstRow_b .= "<span class='green'>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;رزرو شده</span>";
									}
								} else {
									$firstRow_b .="<br/>".$row['Name']."<input type='checkbox' class='checked' name='ckid[]' value='".$row['fs_id']."'/>".$row['Price']." ريال ";
									if($row['fs_status'] == '0') {
										$firstRow_b .= "<span class='red'>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;لغو شده</span>";
									} else if($row['fs_status'] == '1') {
										$firstRow_b .= "<span class='green'>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;رزرو شده</span>";
									}
								}
							}
							else if ($row['Meal'] == 'Lunch') {
								if($firstRow_l=="")
								{
									$firstRow_l = $row['Name']."<input type='checkbox' class='checked' name='ckid[]' value='".$row['fs_id']."'/>".$row['Price']." ريال ";
									if($row['fs_status'] == '0') {
										$firstRow_l .= "<span class='red'>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;لغو شده</span>";
									} else if($row['fs_status'] == '1') {
										$firstRow_l .= "<span class='green'>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;رزرو شده</span>";
									}
								} else {
									$firstRow_l .="<br/>".$row['Name']."<input type='checkbox' class='checked' name='ckid[]' value='".$row['fs_id']."'/>".$row['Price']." ريال ";
									if($row['fs_status'] == '0') {
										$firstRow_l .= "<span class='red'>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;لغو شده</span>";
									} else {
										$firstRow_l .= "<span class='green'>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;رزرو شده</span>";
									}
								}
							}
							else if ($row['Meal'] == 'Dinner') {
								if($firstRow_d=="") {
									$firstRow_d =$row['Name']."<input type='checkbox' class='checked' name='ckid[]' value='".$row['fs_id']."'/>".$row['Price']." ريال ";
									if($row['fs_status'] == '0') {
										$firstRow_d .= "<span class='red'>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;لغو شده</span>";
									} else {
										$firstRow_d .= "<span class='green'>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;رزرو شده</span>";
									}
								} else {
									$firstRow_d .="<br/>".$row['Name']."<input type='checkbox' class='checked' name='ckid[]' value='".$row['fs_id']."'/>".$row['Price']." ريال ";
									if($row['fs_status'] == '0') {
										$firstRow_d .= "<span class='red'>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;لغو شده</span>";
									} else {
										$firstRow_d .= "<span class='green'>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;رزرو شده</span>";
									}
								}
							}
						}
						else if ($row['DayOfWeek'] == $tomorrow) {
							if ($row['Meal'] == 'Breakfast') {
								if($secondRow_b == "") {
									$secondRow_b =$row['Name']."<input type='checkbox' class='checked' name='ckid[]' value='".$row['fs_id']."'/>".$row['Price']." ريال ";
									if($row['fs_status'] == '0') {
										$secondRow_b .= "<span class='red'>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;لغو شده</span>";
									} else if($row['fs_status'] == '1') {
										$secondRow_b .= "<span class='green'>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;رزرو شده</span>";
									}
								} else {
									$secondRow_b .="<br/>".$row['Name']."<input type='checkbox' class='checked' name='ckid[]' value='".$row['fs_id']."'/>".$row['Price']." ريال ";
									if($row['fs_status'] == '0') {
										$secondRow_b .= "<span class='red'>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;لغو شده</span>";
									} else if($row['fs_status'] == '1') {
										$secondRow_b .= "<span class='green'>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;رزرو شده</span>";
									}
								}
							}
							else if ($row['Meal'] == 'Lunch') {
								if($secondRow_l=="") {
									$secondRow_l =$row['Name']."<input type='checkbox' class='checked' name='ckid[]' value='".$row['fs_id']."'/>".$row['Price']." ريال ";
									if($row['fs_status'] == '0') {
										$secondRow_l .= "<span class='red'>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;لغو شده</span>";
									} else if($row['fs_status'] == '1') {
										$secondRow_l .= "<span class='green'>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;رزرو شده</span>";
									}
								} else {
									$secondRow_l .="<br/>".$row['Name']."<input type='checkbox' class='checked' name='ckid[]' value='".$row['fs_id']."'/>".$row['Price']." ريال ";
									if($row['fs_status'] == '0') {
										$secondRow_l .= "<span class='red'>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;لغو شده</span>";
									} else if($row['fs_status'] == '1') {
										$secondRow_l .= "<span class='green'>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;رزرو شده</span>";
									}
								}
							}
							else if ($row['Meal'] == 'Dinner') {
								if($secondRow_d=="") {
									$secondRow_d =$row['Name']."<input type='checkbox' class='checked' name='ckid[]' value='".$row['fs_id']."'/>".$row['Price']." ريال ";
									if($row['fs_status'] == '0') {
										$secondRow_d .= "<span class='red'>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;لغو شده</span>";
									} else if($row['fs_status'] == '1') {
										$secondRow_d .= "<span class='green'>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;رزرو شده</span>";
									}
								} else {
									$secondRow_d .="<br/>".$row['Name']."<input type='checkbox' class='checked' name='ckid[]' value='".$row['fs_id']."'/>".$row['Price']." ريال ";
									if($row['fs_status'] == '0') {
										$secondRow_d .= "<span class='red'>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;لغو شده</span>";
									} else if($row['fs_status'] == '1') {
										$secondRow_d .= "<span class='green'>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;رزرو شده</span>";
									}
								}
							}

						}
						else if ($row['DayOfWeek'] == $afterTomorrow) {
							if ($row['Meal'] == 'Breakfast') {
								if($thirdRow_b == "") {
									$thirdRow_b =$row['Name']."<input type='checkbox' class='checked' name='ckid[]' value='".$row['fs_id']."'/>".$row['Price']." ريال ";
									if($row['fs_status'] == '0') {
										$thirdRow_b .= "<span class='red'>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;لغو شده</span>";
									} else if($row['fs_status'] == '1') {
										$thirdRow_b .= "<span class='green'>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;رزرو شده</span>";
									}
								} else {
									$thirdRow_b .="<br/>".$row['Name']."<input type='checkbox' class='checked' name='ckid[]' value='".$row['fs_id']."'/>".$row['Price']." ريال ";
									if($row['fs_status'] == '0') {
										$thirdRow_b .= "<span class='red'>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;لغو شده</span>";
									} else if($row['fs_status'] == '1') {
										$thirdRow_b .= "<span class='green'>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;رزرو شده</span>";
									}
								}
							}
							else if ($row['Meal'] == 'Lunch') {
								if($thirdRow_l == "") {
									$thirdRow_l =$row['Name']."<input type='checkbox' class='checked' name='ckid[]' value='".$row['fs_id']."'/>".$row['Price']." ريال ";
									if($row['fs_status'] == '0') {
										$thirdRow_l .= "<span class='red'>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;لغو شده</span>";
									} else if($row['fs_status'] == '1') {
										$thirdRow_l .= "<span class='green'>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;رزرو شده</span>";
									}
								} else {
									$thirdRow_l .="<br/>".$row['Name']."<input type='checkbox' class='checked' name='ckid[]' value='".$row['fs_id']."'/>".$row['Price']." ريال ";
									if($row['fs_status'] == '0') {
										$thirdRow_l .= "<span class='red'>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;لغو شده</span>";
									} else if($row['fs_status'] == '1') {
										$thirdRow_l .= "<span class='green'>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;رزرو شده</span>";
									}
								}
							}
							else if ($row['Meal'] == 'Dinner') {
								if($thirdRow_d == "") {
									$thirdRow_d = $row['Name']."<input type='checkbox' class='checked' name='ckid[]' value='".$row['fs_id']."'/>".$row['Price']." ريال ";
									if($row['fs_status'] == '0') {
										$thirdRow_d .= "<span class='red'>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;لغو شده</span>";
									} else if($row['fs_status'] == '1') {
										$thirdRow_d .= "<span class='green'>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;رزرو شده</span>";
									}
								} else {
									$thirdRow_d .="<br/>".$row['Name']."<input type='checkbox' class='checked' name='ckid[]' value='".$row['fs_id']."'/>".$row['Price']." ريال ";
									if($row['fs_status'] == '0') {
										$thirdRow_d .= "<span class='red'>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;لغو شده</span>";
									} else if($row['fs_status'] == '1') {
										$thirdRow_d .= "<span class='green'>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;رزرو شده</span>";
									}
								}
							}
						}
					}
					?>
					<!--===========day===============-->
					<tr>
						<td><?php echo $day ?></td>
						<td><!-- برای صبحانه -->
							<?php echo $firstRow_b;?>
						</td>
						<td><!-- برای ناهار -->
							<?php echo $firstRow_l;?>
						</td>
						<td><!-- برای شام -->
							<?php echo $firstRow_d;?>
						</td>
					</tr>
					<!--==================tomorrow======---------------->
					<tr>
						<td><?php echo $tomorrow ?></td>
						<td><!-- برای صبحانه -->
							<?php echo $secondRow_b;?>
						</td>
						<td><!-- برای ناهار -->
							<?php echo $secondRow_l;?>
						</td>
						<td><!-- برای شام -->
							<?php echo $secondRow_d;?>
						</td>
					</tr>
					<!--=============afterTomorrow--------------------------->
					<tr>
						<td><?php echo $afterTomorrow ?></td>
						<td><!-- برای صبحانه -->
							<?php echo $thirdRow_b;?>
						</td>
						<td><!-- برای ناهار -->
							<?php echo $thirdRow_l;?>
						</td>
						<td><!-- برای شام -->
							<?php echo $thirdRow_d;?>
						</td>
					</tr>
					<!--======================================-->
				</tbody>
			</table>
			<div class="form-button">
				<button type="submit" name="btncancel" class="btn btn-success cancel">لغو رزرو</button>
				<button type="reset" class="btn btn-success reset">پاک کردن</button>
			</div>
			<input type="hidden" name="clientID" value="<?php echo $studentID; ?>"/>
		</form>
		<?php } ?>
		<div class="link-back">
<a class="" href="http://172.100.100.120:80/main.html">بازگشت</a>
</div>
		</div>

<div class="col-sm-3"></div>
		
    </body>
</html>
<?php $conn->close(); ?>
