<html>
	<?php 
	extract($_POST);
	if(isset($submit)){
		$link=mysqli_connect(hostname:"localhost", username:"root", password:"", database:"project");
		$qry="insert into std_details(s_fname, s_lname, s_email, s_phone, s_pass) values ('$f_name', '$l_name', '$email', $tel, '$pass1')";
		$result=mysqli_query($link, $qry);
		if($result){
			$qry = "SELECT * FROM std_details WHERE s_email='$email'";
			$resultset = mysqli_query($link, $qry);
			$r = mysqli_fetch_assoc($resultset);
			$nm = $r["s_name"];
			$id = $r["s_id"];
			session_start();
			$_SESSION["name"] = $nm;
			$_SESSION["id"] = $id;
			header("location: ./HomePage.php");
		}
		mysqli_close($link);
	}
	?>
	<head>
		<!-- <script src="http://thecodeplayer.com/uploads/js/jquery-1.9.1.min.js" type="text/javascript"></script> -->
		<!-- jQuery easing plugin -->
		<!-- <script src="http://thecodeplayer.com/uploads/js/jquery.easing.min.js" type="text/javascript"></script> -->

		<link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.6.2/dist/css/bootstrap.min.css" integrity="sha384-xOolHFLEh07PJGoPkLv1IbcEPTNtaed2xpHsD9ESMhqIYd0nLMwNLD69Npy4HI+N" crossorigin="anonymous">

		<link rel="preconnect" href="https://fonts.googleapis.com">
    	<link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    	<link href="https://fonts.googleapis.com/css2?family=Dancing+Script:wght@500&family=Taprom&display=swap" rel="stylesheet">

		<style>
			
			* {
    			font-family: 'Lucida Sans', 'Lucida Sans Regular', 'Lucida Grande', 'Lucida Sans Unicode', Geneva, Verdana, sans-serif;
			}
			body {
				background-image: linear-gradient(to right, #4D32F7 20%, #17c9fc 80%);
			}
			#msform {
				position: relative;
			}
			#msform fieldset {
				border-radius: 10px;
				box-shadow: 0 0 15px 1px rgba(0, 0, 0, 0.4);
				box-sizing: border-box;
				width: 80%;
				margin: 0 10%;
				position: absolute;
			}
			/*Hide all except first fieldset*/
			#msform fieldset:not(:first-of-type) {
				display: none;
			}
			/*inputs*/
			#msform input, #msform textarea {
				padding: 15px;
				border: 1px solid #ccc;
				border-radius: 5px;
				margin-bottom: 10px;
				width: 100%;
				box-sizing: border-box;
				color: #2C3E50;
				
			}
			/*buttons*/
			#msform .action-button {
				width: 100px;
				background-image: linear-gradient(to right, #4D32F7 0%, #17c9fc 100%);
				font-weight: bold;
				color: white;
				border: 0 none;
				border-radius: 7px;
				cursor: pointer;
				padding: 10px 5px;
				margin: 10px 5px;
			}
			#msform .action-button:hover, #msform .action-button:focus {
				box-shadow: 0 0 5px 0 #17c9fc, 0 0 5px 0 #17c9fc;
			}
			/*headings*/
			.fs-title {
				/* font-size: 15px; */
				text-transform: uppercase;
				color: #2C3E50;
				margin-bottom: 10px;
			}
			.fs-subtitle {
				font-weight: normal;
				/* font-size: 13px; */
				color: #666;
				margin-bottom: 20px;
			}
			/*progressbar*/
			#progressbar {
				margin-bottom: 30px;
				overflow: hidden;
				/*CSS counters to number the steps*/
				counter-reset: step;
			}
			#progressbar li {
				list-style-type: none;
				color: white;
				text-transform: uppercase;
				/* font-size: 9px; */
				width: 20%;
				float: left;
				position: relative;
			}
			#progressbar li:before {
				content: counter(step);
				counter-increment: step;
				width: 20px;
				line-height: 20px;
				display: block;
				font-size: 10px;
				color: #333;
				background: white;
				border-radius: 3px;
				margin: 0 auto 5px auto;
			}
			/*progressbar connectors*/
			#progressbar li:after {
				content: '';
				width: 100%;
				height: 2px;
				background: white;
				position: absolute;
				left: -50%;
				top: 9px;
				z-index: -1; /*put it behind the numbers*/
			}
			#progressbar li:first-child:after {
				/*connector not needed before the first step*/
				content: none; 
			}
			/*marking active/completed steps green*/
			/*The number of the step and the connector before it = green*/
			#progressbar li.active:before,  #progressbar li.active:after{
				background: #151a61;
				color: white;
				transition: 0.9s;
			}
		</style>
	</head>

<body>
	<div class="container-fluid m-0 p-0 text-xl-center">
		<div class="row pt-5 mt-5">
			<div class="col-lg-3"></div>
			<div class="col-lg-6">
				<form id="msform" method="post" enctype="multipart/form-data">
				<!-- progressbar -->
				<ul id="progressbar">
					<li class="active">PERSONAL</li>
					<li>E-MAIL ID</li>
					<li>CONTACT</li>
					<li>PASSWORD</li>
					<li>CONFIRM PASSWORD</li>
				</ul>
				<!-- fieldsets -->
				<fieldset class="bg-light border-0 p-4">
					<h2 class="fs-title">PERSONAL</h2>
					<h5 class="fs-subtitle">This is step 1</h5>
					<input type="text" name="f_name" placeholder="First Name?" required>
					<input type="text" name="l_name" placeholder="Last Name?">
					<input type="button" name="next" class="next action-button" value="Next" />
				</fieldset>
				<fieldset class="bg-light border-0 p-4">
					<h2 class="fs-title">E-MAIL ID</h2>
					<h5 class="fs-subtitle">This is step 2</h5>
					<input type="email" name="email" placeholder="acbxyz@email.com"required>
					<input type="button" name="previous" class="previous action-button" value="Previous" />
					<input type="button" name="next" class="next action-button" value="Next" />
				</fieldset>
				<fieldset class="bg-light border-0 p-4">
					<h2 class="fs-title">CONTACT</h2>
					<h5 class="fs-subtitle">This is step 3</h5>
					<input type="tel" name="tel" placeholder="1000-200-300" required>
					<input type="button" name="previous" class="previous action-button" value="Previous" />
					<input type="button" name="next" class="next action-button" value="Next" />
				</fieldset>
				<fieldset class="bg-light border-0 p-4">
					<h2 class="fs-title">PASSWORD</h2>
					<h5 class="fs-subtitle">This is step 4</h5>
					<input type="password" name="pass1" placeholder="Abcxyz@1234" required>
					<input type="button" name="previous" class="previous action-button" value="Previous" />
					<input type="button" name="next" class="next action-button" value="Next" />
				</fieldset>
				<fieldset class="bg-light border-0 p-4">
					<h2 class="fs-title">CONFIRM PASSWORD</h2>
					<h5 class="fs-subtitle">This is step 5</h5>
					<input type="password" name="pass2" placeholder="Abcxyz@1234" required>
					<input type="button" name="previous" class="previous action-button" value="Previous" />
					<input type="submit" name="submit" class="submit action-button" value="Sign Up" />
				</fieldset>
				</form>
			</div>
			<div class="col-lg-3"></div>
		</div>
	</div>



<script src="https://cdn.jsdelivr.net/npm/jquery@3.5.1/dist/jquery.slim.min.js" integrity="sha384-DfXdz2htPH0lsSSs5nCTpuj/zy4C+OGpamoFVy38MVBnE+IbbVYUew+OrCXaRkfj" crossorigin="anonymous"></script>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@4.6.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-Fy6S3B9q64WdZWQUiU+q4/2Lc9npb8tCaSX9FK7E8HnRr0Jz8D6OP9dO5Vg3Q9ct" crossorigin="anonymous"></script>

<script src="http://thecodeplayer.com/uploads/js/jquery-1.9.1.min.js" type="text/javascript"></script>
<!-- jQuery easing plugin -->
<script src="http://thecodeplayer.com/uploads/js/jquery.easing.min.js" type="text/javascript"></script>

<script>
	
	//jQuery time
	var current_fs, next_fs, previous_fs; //fieldsets
	var left, opacity, scale; //fieldset properties which we will animate
	var animating; //flag to prevent quick multi-click glitches

	$(".next").click(function(){
		if(animating) return false;
		animating = true;
		
		current_fs = $(this).parent();
		next_fs = $(this).parent().next();
		
		//activate next step on progressbar using the index of next_fs
		$("#progressbar li").eq($("fieldset").index(next_fs)).addClass("active");
		
		//show the next fieldset
		next_fs.show(); 
		//hide the current fieldset with style
		current_fs.animate({opacity: 0}, {
			step: function(now, mx) {
				//as the opacity of current_fs reduces to 0 - stored in "now"
				//1. scale current_fs down to 80%
				scale = 1 - (1 - now) * 0.2;
				//2. bring next_fs from the right(50%)
				left = (now * 50)+"%";
				//3. increase opacity of next_fs to 1 as it moves in
				opacity = 1 - now;
				current_fs.css({'transform': 'scale('+scale+')'});
				next_fs.css({'left': left, 'opacity': opacity});
			}, 
			duration: 800, 
			complete: function(){
				current_fs.hide();
				animating = false;
			}, 
			//this comes from the custom easing plugin
			easing: 'easeInOutBack'
		});
	});

	$(".previous").click(function(){
		if(animating) return false;
		animating = true;
		
		current_fs = $(this).parent();
		previous_fs = $(this).parent().prev();
		
		//de-activate current step on progressbar
		$("#progressbar li").eq($("fieldset").index(current_fs)).removeClass("active");
		
		//show the previous fieldset
		previous_fs.show(); 
		//hide the current fieldset with style
		current_fs.animate({opacity: 0}, {
			step: function(now, mx) {
				//as the opacity of current_fs reduces to 0 - stored in "now"
				//1. scale previous_fs from 80% to 100%
				scale = 0.8 + (1 - now) * 0.2;
				//2. take current_fs to the right(50%) - from 0%
				left = ((1-now) * 50)+"%";
				//3. increase opacity of previous_fs to 1 as it moves in
				opacity = 1 - now;
				current_fs.css({'left': left});
				previous_fs.css({'transform': 'scale('+scale+')', 'opacity': opacity});
			}, 
			duration: 800, 
			complete: function(){
				current_fs.hide();
				animating = false;
			}, 
			//this comes from the custom easing plugin
			easing: 'easeInOutBack'
		});
	});
</script>
</body>
</html>