<?php
session_start();
if ($_SESSION['logged_in'] != 1) {
header('Location: login.php');
}
$_SESSION['thisclient'] = $_POST['thisclient'];
if (isset($_POST['add'])) {

$client = $_POST['client'];
$name = $_POST['name'];
$phone = $_POST['phone'];
$email = $_POST['email'];
$zip = $_POST['zip'];
$source = $_POST['source'];
$alert = $_POST['alert'];
$zip = $_POST['zip'];
$source = $_POST['source'];
$alert = $_POST['alert'];
if ($alert === 'hp') {
$alert = 'Hot Prospect';
} elseif ($alert === 'ni') {
$alert = 'Not Interested';
} elseif ($alert === 'appt') {
$alert = 'Appointment';
} elseif ($alert === 'transfer') {
$alert = 'Transfer';
}
if(isset($_POST['transfer'])) {
$transfer = $_POST['transfer'];
} else {
$transfer = '';
}
if(isset($_POST['appt'])) {
$appt = $_POST['appt'];
} else {
$appt = '';
}
if(isset($_POST['appttime'])) {
$appttime = $_POST['appttime'];
} else {
$appttime = '';
}
$notes = $_POST['notes'];
date_default_timezone_set('America/Los_Angeles');
$date = date('Y-m-d');
$created_by = $_SESSION['bdc_user'];
$db_user = 'localca4_james';
$db_pass = 'rescue123';
try {
  $pdo = new PDO('mysql:host=localhost;dbname=localca4_bdctest', $db_user, $db_pass);
  $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
 
  $stmt = $pdo->prepare('INSERT INTO bdc VALUES(:id,:client,:name,:phone,:email,:zip,:source,:alert,:transfer,:appt,:appttime,:notes,:date,:created_by)');
  $stmt->execute(array(
    ':id'=>'',':client'=>$client,':name'=>$name,':phone'=>$phone,':email'=>$email,':zip'=>$zip,'source'=>$source,'alert'=>$alert,'zip'=>$zip,'source'=>$source,'alert'=>$alert,'transfer'=>$transfer,'appt'=>$appt,'appttime'=>$appttime,'notes'=>$notes,'date'=>$date,'created_by'=>$created_by
  ));

// multiple recipients
$dealership = $client;
$db_user = 'localca4_james';
$db_pass = 'rescue123';
try {
  $conn = new PDO('mysql:host=localhost;dbname=localca4_bdctest', $db_user, $db_pass);
  $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
  $stmt = $conn->prepare('SELECT * FROM bdc_client WHERE dealership = :dealership');
  $stmt->execute(array('dealership' => $dealership));
 
  $result = $stmt->fetchAll();
 
  if ( count($result) ) { 
    foreach($result as $row) {
      $to = $row[6];
    }   
  } else {
    echo "The client you tried to data to has not been found.";
  }
} catch(PDOException $e) {
    echo 'ERROR: ' . $e->getMessage();
}

// subject
$subject = ''.$alert.' - '.$client.'';

if ($alert === 'Appointment') {
$message = '
<html>
<head>
  <title>'.$alert.' - '.$client.'</title>
</head>
<body>
    <table>
    <tr>
      <th>Name</th><th>Phone</th><th>Email</th><th>Appointment</th><th>Notes</th> 
    </tr>
    <tr>
      <td>'.$name.'</td><td>'.$phone.'</td><td>'.$email.'</td><td>'.$appt.' - '.$appttime.'</td><td>'.$notes.'</td>
    </tr>
  </table>
</body>
</html>
';
}
elseif ($alert === 'Transfer') {
$message = '
<html>
<head>
  <title>'.$alert.' - '.$client.'</title>
</head>
<body>
    <table>
    <tr>
      <th>Name</th><th>Phone</th><th>Email</th><th>Transferred To</th><th>Notes</th> 
    </tr>
    <tr>
      <td>'.$name.'</td><td>'.$phone.'</td><td>'.$email.'</td><td>'.$transfer.'</td><td>'.$notes.'</td>
    </tr>
  </table>
</body>
</html>
';
}
elseif ($alert === 'Hot Prospect') {
$message = '
<html>
<head>
  <title>'.$alert.' - '.$client.'</title>
</head>
<body>
    <table>
    <tr>
      <th>Name</th><th>Phone</th><th>Email</th><th>Notes</th> 
    </tr>
    <tr>
      <td>'.$name.'</td><td>'.$phone.'</td><td>'.$email.'</td><td>'.$notes.'</td>
    </tr>
  </table>
</body>
</html>
';
}

// To send HTML mail, the Content-type header must be set
$headers  = 'MIME-Version: 1.0' . "\r\n";
$headers .= 'Content-type: text/html; charset=iso-8859-1' . "\r\n";
$headers .= 'From: TKMKT <bdc@tkmkt.com>';

// Mail it
mail($to, $subject, $message, $headers);
 
 
  # Affected Rows?
  echo $name ." inserted into " . $client . ".";
} catch(PDOException $e) {
  echo 'Error: ' . $e->getMessage();
  }
  
}
?>
<!DOCTYPE html>

<!--[if IEMobile 7]><html class="no-js iem7 oldie"><![endif]-->
<!--[if (IE 7)&!(IEMobile)]><html class="no-js ie7 oldie" lang="en"><![endif]-->
<!--[if (IE 8)&!(IEMobile)]><html class="no-js ie8 oldie" lang="en"><![endif]-->
<!--[if (IE 9)&!(IEMobile)]><html class="no-js ie9" lang="en"><![endif]-->
<!--[if (gt IE 9)|(gt IEMobile 7)]><!--><html class="no-js" lang="en"><!--<![endif]-->

<head>
	<meta charset="utf-8">
	<meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1">

	<title>BDC Manager</title>
	<meta name="description" content="">
	<meta name="author" content="">

	<!-- http://davidbcalhoun.com/2010/viewport-metatag -->
	<meta name="HandheldFriendly" content="True">
	<meta name="MobileOptimized" content="320">

	<!-- http://www.kylejlarson.com/blog/2012/iphone-5-web-design/ and http://darkforge.blogspot.fr/2010/05/customize-android-browser-scaling-with.html -->
	<meta name="viewport" content="user-scalable=0, initial-scale=1.0, target-densitydpi=115">

	<!-- For all browsers -->
	<link rel="stylesheet" href="css/reset.css?v=1">
	<link rel="stylesheet" href="css/style.css?v=1">
	<link rel="stylesheet" href="css/colors.css?v=1">
	<link rel="stylesheet" media="print" href="css/print.css?v=1">
	<!-- For progressively larger displays -->
	<link rel="stylesheet" media="only all and (min-width: 480px)" href="css/480.css?v=1">
	<link rel="stylesheet" media="only all and (min-width: 768px)" href="css/768.css?v=1">
	<link rel="stylesheet" media="only all and (min-width: 992px)" href="css/992.css?v=1">
	<link rel="stylesheet" media="only all and (min-width: 1200px)" href="css/1200.css?v=1">
	<!-- For Retina displays -->
	<link rel="stylesheet" media="only all and (-webkit-min-device-pixel-ratio: 1.5), only screen and (-o-min-device-pixel-ratio: 3/2), only screen and (min-device-pixel-ratio: 1.5)" href="css/2x.css?v=1">

	<!-- Webfonts -->
	<link href='http://fonts.googleapis.com/css?family=Open+Sans:300' rel='stylesheet' type='text/css'>

	<!-- Additional styles -->
	<link rel="stylesheet" href="css/styles/agenda.css?v=1">
	<link rel="stylesheet" href="css/styles/dashboard.css?v=1">
	<link rel="stylesheet" href="css/styles/form.css?v=1">
	<link rel="stylesheet" href="css/styles/modal.css?v=1">
	<link rel="stylesheet" href="css/styles/progress-slider.css?v=1">
	<link rel="stylesheet" href="css/styles/switches.css?v=1">
	<link rel="stylesheet" href="css/styles/table.css?v=1">

	<!-- DataTables -->
	<link rel="stylesheet" href="js/libs/DataTables/jquery.dataTables.css?v=1">

	<!-- JavaScript at bottom except for Modernizr -->
	<script src="js/libs/modernizr.custom.js"></script>

	<!-- For Modern Browsers -->
	<link rel="shortcut icon" href="img/favicons/favicon.png">
	<!-- For everything else -->
	<link rel="shortcut icon" href="img/favicons/favicon.ico">

	<!-- iOS web-app metas -->
	<meta name="apple-mobile-web-app-capable" content="yes">
	<meta name="apple-mobile-web-app-status-bar-style" content="black">

	<!-- iPhone ICON -->
	<link rel="apple-touch-icon" href="img/favicons/apple-touch-icon.png" sizes="57x57">
	<!-- iPad ICON -->
	<link rel="apple-touch-icon" href="img/favicons/apple-touch-icon-ipad.png" sizes="72x72">
	<!-- iPhone (Retina) ICON -->
	<link rel="apple-touch-icon" href="img/favicons/apple-touch-icon-retina.png" sizes="114x114">
	<!-- iPad (Retina) ICON -->
	<link rel="apple-touch-icon" href="img/favicons/apple-touch-icon-ipad-retina.png" sizes="144x144">

	<!-- iPhone SPLASHSCREEN (320x460) -->
	<link rel="apple-touch-startup-image" href="img/splash/iphone.png" media="(device-width: 320px)">
	<!-- iPhone (Retina) SPLASHSCREEN (640x960) -->
	<link rel="apple-touch-startup-image" href="img/splash/iphone-retina.png" media="(device-width: 320px) and (-webkit-device-pixel-ratio: 2)">
	<!-- iPhone 5 SPLASHSCREEN (640×1096) -->
	<link rel="apple-touch-startup-image" href="img/splash/iphone5.png" media="(device-height: 568px) and (-webkit-device-pixel-ratio: 2)">
	<!-- iPad (portrait) SPLASHSCREEN (748x1024) -->
	<link rel="apple-touch-startup-image" href="img/splash/ipad-portrait.png" media="(device-width: 768px) and (orientation: portrait)">
	<!-- iPad (landscape) SPLASHSCREEN (768x1004) -->
	<link rel="apple-touch-startup-image" href="img/splash/ipad-landscape.png" media="(device-width: 768px) and (orientation: landscape)">
	<!-- iPad (Retina, portrait) SPLASHSCREEN (2048x1496) -->
	<link rel="apple-touch-startup-image" href="img/splash/ipad-portrait-retina.png" media="(device-width: 1536px) and (orientation: portrait) and (-webkit-min-device-pixel-ratio: 2)">
	<!-- iPad (Retina, landscape) SPLASHSCREEN (1536x2008) -->
	<link rel="apple-touch-startup-image" href="img/splash/ipad-landscape-retina.png" media="(device-width: 1536px)  and (orientation: landscape) and (-webkit-min-device-pixel-ratio: 2)">

	<!-- Microsoft clear type rendering -->
	<meta http-equiv="cleartype" content="on">

	<!-- IE9 Pinned Sites: http://msdn.microsoft.com/en-us/library/gg131029.aspx -->
	<meta name="application-name" content="Developr Admin Skin">
	<meta name="msapplication-tooltip" content="Cross-platform admin template.">
	<meta name="msapplication-starturl" content="http://www.display-inline.fr/demo/developr">
	<!-- These custom tasks are examples, you need to edit them to show actual pages -->
	<meta name="msapplication-task" content="name=Agenda;action-uri=http://www.display-inline.fr/demo/developr/agenda.html;icon-uri=http://www.display-inline.fr/demo/developr/img/favicons/favicon.ico">
	<meta name="msapplication-task" content="name=My profile;action-uri=http://www.display-inline.fr/demo/developr/profile.html;icon-uri=http://www.display-inline.fr/demo/developr/img/favicons/favicon.ico">
	
	<link href="SpryAssets/SpryValidationTextField.css" rel="stylesheet" type="text/css" />
	<style>
	#phone {
	width: 100%;
	}
	#phone, input[type="date"] {
display: inline-block;
text-align: left;
text-indent: 6px;
line-height: 30px;
border: 0;
vertical-align: baseline;
-webkit-background-clip: padding-box;
-webkit-border-radius: 4px;
-moz-border-radius: 4px;
border-radius: 4px;
-webkit-transition: -webkit-box-shadow 400ms;
-moz-transition: -moz-box-shadow 400ms;
-ms-transition: box-shadow 400ms;
-o-transition: box-shadow 400ms;
transition: box-shadow 400ms;
-webkit-box-shadow: inset 0 0 0 1px rgba(51, 153, 255, 0), inset 0 2px 5px rgba(0, 0, 0, 0.35), 0 1px 1px rgba(255, 255, 255, 0.5), 0 0 0 rgba(51, 153, 255, 0);
-moz-box-shadow: inset 0 0 0 1px rgba(51, 153, 255, 0), inset 0 2px 5px rgba(0, 0, 0, 0.35), 0 1px 1px rgba(255, 255, 255, 0.5), 0 0 0 rgba(51, 153, 255, 0);
box-shadow: inset 0 0 0 1px rgba(51, 153, 255, 0), inset 0 2px 5px rgba(0, 0, 0, 0.35), 0 1px 1px rgba(255, 255, 255, 0.5), 0 0 0 rgba(51, 153, 255, 0);
-webkit-background-size: 100% 100%;
-moz-background-size: 100% 100%;
-o-background-size: 100% 100%;
background-size: 100% 100%;
background: -webkit-linear-gradient(top, white, #e6e6e6);
background: -moz-linear-gradient(top, white, #e6e6e6);
background: -ms-linear-gradient(top, white, #e6e6e6);
background: -o-linear-gradient(top, white, #e6e6e6);
border-color: #cccccc;
color: #666666;
	}
	td {
margin-bottom: 3px;
font-weight: bold;
line-height: 16px;
	}
	</style>
</head>

<body class="clearfix with-menu with-shortcuts">

	<!-- Prompt IE 6 users to install Chrome Frame -->
	<!--[if lt IE 7]><p class="message red-gradient simpler">Your browser is <em>ancient!</em> <a href="http://browsehappy.com/">Upgrade to a different browser</a> or <a href="http://www.google.com/chromeframe/?redirect=true">install Google Chrome Frame</a> to experience this site.</p><![endif]-->

	<!-- Title bar -->
	<header role="banner" id="title-bar">
		<h2>BDC Manager</h2>
	</header>

	<!-- Button to open/hide shortcuts -->
	<a href="#" id="open-shortcuts"><span class="icon-thumbs"></span></a>

	<!-- Main content -->
	<section role="main" id="main" style="margin-right:0px;">

		<noscript class="message black-gradient simpler">Your browser does not support JavaScript! Some features won't work as expected...</noscript>

		<hgroup id="main-title" class="thin">
			<h1>BDC Manager</h1>
			<h2><?php echo date('M'); ?> <strong><?php echo date('d'); ?></strong></h2>
		</hgroup>

		<div class="with-padding">

<p class="wrapped left-icon icon-info-round">Welcome, <?php echo $_SESSION['bdc_user']; ?>. <i>Your session is now being recorded.</i> <a href="logout.php">Logout</a></p>

			<div class="columns">
			
			<!--
			<?php echo date('Y-m-d'); ?>
			<br>
			<?php
			echo date('Y-m-d', strtotime("+1 week"));
			?>
			<br>
			<?php
			if (date('Y-m-d') === '2014-07-24') {
			echo 'yes';
			} 
			if (date('Y-m-d', strtotime("+1 week")) === '2014-07-31') {
			echo 'yes';
			}
			?>
			-->
			
			
			<div class="six-columns six-columns-tablet twelve-columns-mobile">
			
<form action="" method="POST">
<select name="thisclient" class="select blue-gradient" onchange="this.form.submit()">
<option>Select Client</option>
<?php 
$db_user = 'localca4_james';
$db_pass = 'rescue123';
try {
  $conn = new PDO('mysql:host=localhost;dbname=localca4_bdctest', $db_user, $db_pass);
  $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
  $stmt = $conn->prepare('SELECT * FROM bdc_client');
  $stmt->execute();
 
  $result = $stmt->fetchAll();
 
  if ( count($result) ) { 
    foreach($result as $row) {
      print "<option value='".$row[1]."'>".$row[1]."</option>";
    }   
  } else {
    echo "No rows returned.";
  }
} catch(PDOException $e) {
    echo 'ERROR: ' . $e->getMessage();
}
?> 
</select> <a href="add_client.php">Add Client</a>
</form>
<br>
<form action="" method="POST">
<!--
<p class="button-height inline-label">
							<label for="input-3" class="label">Client:</label>
							<input type="text" name="client" id="input-3" size="9" class="input full-width" placeholder="Client's Name" value="<?php echo $_SESSION['thisclient']; ?>" readonly>
</p>
-->
<p class="button-height inline-label">
							<label for="input-3" class="label">Name:</label>
							<input type="text" name="name" id="input-3" size="9" class="input full-width" placeholder="Prospect's Name" autocomplete="off" required>
</p>
<p class="button-height inline-label">
							<label for="validation-email" class="label">Phone:</label>
							<span id="sprytextfield3"><input type="text" id="phone" type="text" name="phone" id="phone" /><span class="textfieldInvalidFormatMsg">000-000-0000</span><span class="textfieldRequiredMsg">!</span></span>
						</p>
<p class="button-height inline-label">
							<label for="validation-email" class="label">Email:</label>
							<input type="email" name="email" placeholder="Enter Valid Email" id="validation-email" class="input validate[required,custom[email]] full-width" autocomplete="off">
						</p>
						<p class="button-height inline-label">
							<label for="validation-length" class="label">Zip Code:</label>
							<input type="number" name="zip" class="input full-width" placeholder="Enter Zip Code" autocomplete="off" required>
						</p>
						<p class="button-height inline-label">
							<label for="validation-length" class="label">Source:</label>
							<input type="radio" name="source" value="phone" class="radio mid-margin-left">Phone<input type="radio" name="source" value="website" class="radio mid-margin-left">Website
						</p>
<p class="button-height">
<label for="input-3" class="label">Alert Type:</label>
<select id="alert" name="alert" class="select blue-gradient check-list" onchange="selectAlert()">
<option>Select Alert</option>
<option value="appt">Appointment</option>
<option value="hp">Hot Prospect</option>
<option value="transfer">Transfer</option>
<!--
<option value="ni">Not Interested</option>
-->
</select>
</p>
<p id="alertChange" class="button-height inline-label"></p>
<p class="button-height">
<textarea name="notes" class="input full-width autoexpanding" id="alertChange2"></textarea>
</p>
<p class="button-height">
<input class="button icon-download" type="submit" name="add" value="Add Lead" />
					</p>
</form>

</div>

<div class="six-columns six-columns-tablet twelve-columns-mobile">
<?php 
if (isset($_POST['thisclient']) OR isset($_SESSION['thisclient'])) {
//select
if (isset($_POST['thisclient'])) {
$client = $_POST['thisclient'];
} elseif (isset($_SESSION['thisclient'])) {
$client = $_SESSION['thisclient'];
}

$id = 1;
$db_user = 'localca4_james';
$db_pass = 'rescue123';
try {
  $pdo = new PDO('mysql:host=localhost;dbname=localca4_bdctest', $db_user, $db_pass);
  $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
  $stmt = $pdo->prepare('SELECT * FROM bdc_client WHERE dealership = :dealership');
  $stmt->execute(array('dealership' => $client));
 
  $result = $stmt->fetchAll();
 /*
  if ( count($result) ) { 
  echo "<table class='label'>";
    foreach($result as $row) {
      print "<tr><td style='text-decoration:underline;'>Dealership:</td><td style='text-indent: 10px;color:red;'>".$row[1] . "</td>";
      print "<tr><td style='text-decoration:underline;'>Address:</td><td style='text-indent: 10px;'>".$row[2] . "</td>";
      print "<tr><td style='text-decoration:underline;'>Website:</td><td style='text-indent: 10px;'><a href='".$row[3]."' target='_blank'>".$row[3]."</a></td>";
      print "<tr><td style='text-decoration:underline;'>Start Date - End Date:</td><td style='text-indent: 10px;'>".$row[4] . " - " . $row[5] . "</td>";
      print "<tr><td style='text-decoration:underline;'>Best Contact:</td><td style='text-indent: 10px;color:#004795'>".$row[7] . "</td>";
      print "<tr><td style='text-decoration:underline;'>Best Contact Number:</td><td style='text-indent: 10px;color:#004795'>".$row[8] . "</td>";
      print "<tr><td style='text-decoration:underline;'>Notes:</td><td style='text-indent: 10px;color:#000;'>".$row[9] . "</td>";
    }  
    echo "</table>"; 
    */
     if ( count($result) ) { 
  echo "<table class='label'>";
    foreach($result as $row) {
      print "<tr><td style='text-decoration:underline;'>Dealership:</td><td style='text-indent: 10px;color:red;'>".$row[1] . "</td>";
      print "<tr><td style='text-decoration:underline;'>Address:</td><td style='text-indent: 10px;'>".$row[2] . "</td>";
      print "<tr><td style='text-decoration:underline;'>Website:</td><td style='text-indent: 10px;'><a href='".$row[3]."' target='_blank'>".$row[3]."</a></td>";
      print "<tr><td style='text-decoration:underline;'>Start Date - End Date:</td><td style='text-indent: 10px;'>".$row[4] . " - " . $row[5] . "</td>";
      print "<tr><td style='text-decoration:underline;'>Best Contact:</td><td style='text-indent: 10px;color:#004795'>".$row[7] . "</td>";
      print "<tr><td style='text-decoration:underline;'>Best Contact Number:</td><td style='text-indent: 10px;color:#004795'>".$row[8] . "</td>";
      print "<tr><td style='text-decoration:underline;'>Notes:</td><td style='text-indent: 10px;color:#000;'>".$row[9] . "</td>";
    }  
    echo "</table>"; 
  } else {
    echo "No rows returned.";
  }
} catch(PDOException $e) {
    echo 'ERROR: ' . $e->getMessage();
}

}
?> 
</div>
<br style="clear:both;" />
<div class="with-padding">

<p id="alertClient"></p>


<?php 
if (isset($_POST['thisclient']) OR isset($_SESSION['thisclient'])) {
//select
if (isset($_POST['thisclient'])) {
$client = $_POST['thisclient'];
} elseif (isset($_SESSION['thisclient'])) {
$client = $_SESSION['thisclient'];
}
$db_user = 'localca4_james';
$db_pass = 'rescue123';
try {
  $conn = new PDO('mysql:host=localhost;dbname=localca4_bdctest', $db_user, $db_pass);
  $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
  $stmt = $conn->prepare('SELECT * FROM bdc WHERE client = :client');
  $stmt->execute(array('client'=>$client));
 
  $result = $stmt->fetchAll();
 
  if ( count($result) ) { 
  echo '
  <h4>'.$client.'</h4>

<table class="simple-table responsive-table" id="sorting-example2">
<thead>
					<tr>
						<th scope="col" width="15%" class="hide-on-mobile">Date</th>
						<th scope="col" width="15%">Created By</th>
						<th scope="col" width="15%" class="hide-on-mobile-portrait">Type</th>
						<th scope="col" width="15%" class="">Name</th>
						<th scope="col" width="15%" class="">Appt Time/Date</th>
						<th scope="col" class="align-right">Notes</th>
					</tr>
				</thead>
  				<tfoot>
					<tr>
						<td colspan="5">
							'.count($result).' entries found
						</td>
					</tr>
				</tfoot>
				<tbody>';
      foreach($result as $row) {
      print "<tr><td>" . $row['date'] . "</td><th scope='row'>" . $row['created_by'] . "</th><td><small class='tag'>" . $row['alert'] . "</small></td><td>" . $row['name'] . "</td><td><small class='tag'>" . $row['appt'] . "</small> <small class='tag green-bg'>" . $row['appttime'] . "</small></td><td>" . $row['notes'] . "</td></tr>";
    } 
    echo '</tbody>
</table>';  
  } else {
    echo "No prospective customers have been added to this dealership.";
  }
} catch(PDOException $e) {
    echo 'ERROR: ' . $e->getMessage();
}
}
?>
<?php if ($_SESSION['thisclient']) { ?>
<a href="excel.php" class="button icon-download">Export</a>
<?php } ?>
</div>
			
			</div>

			</div>

		</div>

	</section>
	<!-- End main content -->

	<!-- Side tabs shortcuts -->
	<ul id="shortcuts" role="complementary" class="children-tooltip tooltip-right">
		<li class="current"><a href="./" class="shortcut-contacts" title="Dashboard">Dashboard</a></li>
	</ul>

	<!-- JavaScript at the bottom for fast page loading -->

	<!-- Scripts -->
	<script src="js/libs/jquery-1.10.2.min.js"></script>
	<script src="SpryAssets/SpryValidationTextField.js" type="text/javascript"></script>
<script src="jquery.maskedinput.js" type="text/javascript"></script>
	<script src="js/setup.js"></script>

	<!-- Template functions -->
	<script src="js/developr.input.js"></script>
	<script src="js/developr.message.js"></script>
	<script src="js/developr.modal.js"></script>
	<script src="js/developr.navigable.js"></script>
	<script src="js/developr.notify.js"></script>
	<script src="js/developr.scroll.js"></script>
	<script src="js/developr.progress-slider.js"></script>
	<script src="js/developr.tooltip.js"></script>
	<script src="js/developr.confirm.js"></script>
	<script src="js/developr.agenda.js"></script>
	<script src="js/developr.table.js"></script>
	<script src="js/developr.tabs.js"></script>		<!-- Must be loaded last -->

	<!-- Plugins -->
	<script src="js/libs/jquery.tablesorter.min.js"></script>
	<script src="js/libs/DataTables/jquery.dataTables.min.js"></script>

	<!-- Tinycon -->
	<script src="js/libs/tinycon.min.js"></script>

<script type="text/javascript">
var sprytextfield1 = new Spry.Widget.ValidationTextField("sprytextfield1", "custom");
var sprytextfield2 = new Spry.Widget.ValidationTextField("sprytextfield2", "custom");
var sprytextfield3 = new Spry.Widget.ValidationTextField("sprytextfield3", "phone_number");
var sprytextfield4 = new Spry.Widget.ValidationTextField("sprytextfield4", "email");

</script>

<script>
jQuery(function($){
   $("#date").mask("99/99/9999");
   $("#phone").mask("(999) 999-9999");
   $("#tin").mask("99-9999999");
   $("#ssn").mask("999-99-9999");
});
</script>

	<script>

		// Call template init (optional, but faster if called manually)
		$.template.init();

		// Favicon count
		Tinycon.setBubble(2);

		// If the browser support the Notification API, ask user for permission (with a little delay)
		if (notify.hasNotificationAPI() && !notify.isNotificationPermissionSet())
		{
			setTimeout(function()
			{
				notify.showNotificationPermission('Your browser supports desktop notification, click here to enable them.', function()
				{
					// Confirmation message
					if (notify.hasNotificationPermission())
					{
						notify('Notifications API enabled!', 'You can now see notifications even when the application is in background', {
							icon: 'img/demo/icon.png',
							system: true
						});
					}
					else
					{
						notify('Notifications API disabled!', 'Desktop notifications will not be used.', {
							icon: 'img/demo/icon.png'
						});
					}
				});

			}, 2000);
		}

		/*
		 * Handling of 'other actions' menu
		 */

		var otherActions = $('#otherActions'),
			current = false;

		// Other actions
		$('.list .button-group a:nth-child(2)').menuTooltip('Loading...', {

			classes: ['with-mid-padding'],
			ajax: 'ajax-demo/tooltip-content.html',

			onShow: function(target)
			{
				// Remove auto-hide class
				target.parent().removeClass('show-on-parent-hover');
			},

			onRemove: function(target)
			{
				// Restore auto-hide class
				target.parent().addClass('show-on-parent-hover');
			}
		});

		// Delete button
		$('.list .button-group a:last-child').data('confirm-options', {

			onShow: function()
			{
				// Remove auto-hide class
				$(this).parent().removeClass('show-on-parent-hover');
			},

			onConfirm: function()
			{
				// Remove element
				$(this).closest('li').fadeAndRemove();

				// Prevent default link behavior
				return false;
			},

			onRemove: function()
			{
				// Restore auto-hide class
				$(this).parent().addClass('show-on-parent-hover');
			}

		});

		// Demo modal
		function openModal()
		{
			$.modal({
				content: '<p>This is an example of modal window. You can open several at the same time (click links below!), move them and resize them.</p>'+
						  '<p>The plugin provides several other functions to control them, try below:</p>'+
						  '<ul class="simple-list with-icon">'+
						  '    <li><a href="javascript:void(0)" onclick="openModal()">Open new blocking modal</a></li>'+
						  '    <li><a href="javascript:void(0)" onclick="$.modal.alert(\'This is a non-blocking modal, you can switch between me and the other modal\', { blocker: false })">Open non-blocking modal</a></li>'+
						  '    <li><a href="javascript:void(0)" onclick="$(this).getModalWindow().setModalTitle(\'\')">Remove title</a></li>'+
						  '    <li><a href="javascript:void(0)" onclick="$(this).getModalWindow().setModalTitle(\'New title\')">Change title</a></li>'+
						  '    <li><a href="javascript:void(0)" onclick="$(this).getModalWindow().loadModalContent(\'ajax-demo/auto-setup.html\')">Load Ajax content</a></li>'+
						  '</ul>',
				title: 'Example modal window',
				width: 300,
				scrolling: false,
				actions: {
					'Close' : {
						color: 'red',
						click: function(win) { win.closeModal(); }
					},
					'Center' : {
						color: 'green',
						click: function(win) { win.centerModal(true); }
					},
					'Refresh' : {
						color: 'blue',
						click: function(win) { win.closeModal(); }
					},
					'Abort' : {
						color: 'orange',
						click: function(win) { win.closeModal(); }
					}
				},
				buttons: {
					'Close': {
						classes:	'huge blue-gradient glossy full-width',
						click:		function(win) { win.closeModal(); }
					}
				},
				buttonsLowPadding: true
			});
		};

		// Demo alert
		function openAlert()
		{
			$.modal.alert('This is an alert message', {
				buttons: {
					'Thanks, captain obvious': {
						classes:	'huge blue-gradient glossy full-width',
						click:		function(win) { win.closeModal(); }
					}
				}
			});
		};

		// Demo prompt
		function openPrompt()
		{
			var cancelled = false;

			$.modal.prompt('Please enter a value between 5 and 10:', function(value)
			{
				value = parseInt(value);
				if (isNaN(value) || value < 5 || value > 10)
				{
					$(this).getModalContentBlock().message('Please enter a correct value', { append: false, classes: ['red-gradient'] });
					return false;
				}

				$.modal.alert('Value: <strong>'+value+'</strong>');

			}, function()
			{
				if (!cancelled)
				{
					$.modal.alert('Oh, come on....');
					cancelled = true;
					return false;
				}
			});
		};

		// Demo confirm
		function openConfirm()
		{
			$.modal.confirm('Challenge accepted?', function()
			{
				$.modal.alert('Me gusta!');

			}, function()
			{
				$.modal.alert('Meh.');
			});
		};

		/*
		 * Agenda scrolling
		 * This example shows how to remotely control an agenda. most of the time, the built-in controls
		 * using headers work just fine
		 */

			// Days
		var daysName = ['Sunday', 'Monday', 'Tuesday', 'Wednesday', 'Thursday', 'Friday', 'Saturday'],

			// Name display
			agendaDay = $('#agenda-day'),

			// Agenda scrolling
			agenda = $('#agenda').scrollAgenda({
				first: 2,
				onRangeChange: function(start, end)
				{
					if (start != end)
					{
						agendaDay.text(daysName[start].substr(0, 3)+' - '+daysName[end].substr(0, 3));
					}
					else
					{
						agendaDay.text(daysName[start]);
					}
				}
			});

		// Remote controls
		$('#agenda-previous').click(function(event)
		{
			event.preventDefault();
			agenda.scrollAgendaToPrevious();
		});
		$('#agenda-today').click(function(event)
		{
			event.preventDefault();
			agenda.scrollAgendaFirstColumn(2);
		});
		$('#agenda-next').click(function(event)
		{
			event.preventDefault();
			agenda.scrollAgendaToNext();
		});

		// Demo loading modal
		function openLoadingModal()
		{
			var timeout;

			$.modal({
				contentAlign: 'center',
				width: 240,
				title: 'Loading',
				content: '<div style="line-height: 25px; padding: 0 0 10px"><span id="modal-status">Contacting server...</span><br><span id="modal-progress">0%</span></div>',
				buttons: {},
				scrolling: false,
				actions: {
					'Cancel': {
						color:	'red',
						click:	function(win) { win.closeModal(); }
					}
				},
				onOpen: function()
				{
						// Progress bar
					var progress = $('#modal-progress').progress(100, {
							size: 200,
							style: 'large',
							barClasses: ['anthracite-gradient', 'glossy'],
							stripes: true,
							darkStripes: false,
							showValue: false
						}),

						// Loading state
						loaded = 0,

						// Window
						win = $(this),

						// Status text
						status = $('#modal-status'),

						// Function to simulate loading
						simulateLoading = function()
						{
							++loaded;
							progress.setProgressValue(loaded+'%', true);
							if (loaded === 100)
							{
								progress.hideProgressStripes().changeProgressBarColor('green-gradient');
								status.text('Done!');
								/*win.getModalContentBlock().message('Content loaded!', {
									classes: ['green-gradient', 'align-center'],
									arrow: 'bottom'
								});*/
								setTimeout(function() { win.closeModal(); }, 1500);
							}
							else
							{
								if (loaded === 1)
								{
									status.text('Loading data...');
									progress.changeProgressBarColor('blue-gradient');
								}
								else if (loaded === 25)
								{
									status.text('Loading assets (1/3)...');
								}
								else if (loaded === 45)
								{
									status.text('Loading assets (2/3)...');
								}
								else if (loaded === 85)
								{
									status.text('Loading assets (3/3)...');
								}
								else if (loaded === 92)
								{
									status.text('Initializing...');
								}
								timeout = setTimeout(simulateLoading, 50);
							}
						};

					// Start
					timeout = setTimeout(simulateLoading, 2000);
				},
				onClose: function()
				{
					// Stop simulated loading if needed
					clearTimeout(timeout);
				}
			});
		};
		
		// Table sort - simple
	    $('#sorting-example2').tablesorter({
			headers: {
				6: { sorter: false }
			}
		});

	</script>
		<script>
var $ = function (id) {
return document.getElementById(id); 
}

function selectClient () {

var rate=$('client').value;

$('alertClient').innerHTML = rate;
}
window.onload = function () {
$('client').onchange = selectClient;
}
var $ = function (id) {
return document.getElementById(id); 
}

function selectAlert () {

var rate="";
    if ($('alert').value == 'appt') {
    rate = '<label class="label">Appointment Date/Time:</label><input type="date" name="appt"/><select name="appttime" class="select blue-gradient"><option value="800AM">8:00 AM</option><option value="815AM">8:15 AM</option><option value="830AM">8:30 AM</option><option value="845AM">8:45 AM</option><option value="900AM">9:00 AM</option><option value="915AM">9:15 AM</option><option value="930AM">9:30 AM</option><option value="945AM">9:45 AM</option><option value="1000AM">10:00 AM</option><option value="1015AM">10:15 AM</option><option value="1030AM">10:30 AM</option><option value="1045AM">10:45 AM</option><option value="1100AM">11:00 AM</option><option value="1115AM">11:15 AM</option><option value="1130AM">11:30 AM</option><option value="1145AM">11:45 AM</option><option value="1200PM">12:00 PM</option><option value="1215PM">12:15 PM</option><option value="1230PM">12:30 PM</option><option value="1245PM">12:45 PM</option><option value="100PM">1:00 PM</option><option value="115PM">1:15 PM</option><option value="130PM">1:30 PM</option><option value="145PM">1:45 PM</option><option value="200PM">2:00 PM</option><option value="215PM">2:15 PM</option><option value="230PM">2:30 PM</option><option value="245PM">2:45 PM</option><option value="300PM">3:00 PM</option><option value="315PM">3:15 PM</option><option value="330PM">3:30 PM</option><option value="345PM">3:45 PM</option><option value="400PM">4:00 PM</option><option value="415PM">4:15 PM</option><option value="430PM">4:30 PM</option><option value="445PM">4:45 PM</option><option value="500PM">5:00 PM</option><option value="515PM">5:15 PM</option><option value="530PM">5:30 PM</option><option value="545PM">5:45 PM</option><option value="600PM">6:00 PM</option><option value="615PM">6:15 PM</option><option value="630PM">6:30 PM</option><option value="645PM">6:45 PM</option><option value="700PM">7:00 PM</option><option value="715PM">7:15 PM</option><option value="730PM">7:30 PM</option><option value="745PM">7:45 PM</option><option value="800PM">8:00 PM</option><option value="815PM">8:15 PM</option><option value="830PM">8:30 PM</option><option value="845PM">8:45 PM</option><option value="900PM">9:00 PM</option><option value="915PM">9:15 PM</option><option value="930PM">9:30 PM</option><option value="945PM">9:45 PM</option><option value="1000PM">10:00 PM</option><option value="1015PM">10:15 PM</option><option value="1030PM">10:30 PM</option><option value="1045PM">10:45 PM</option><option value="1100PM">11:00 PM</option><option value="1115PM">11:15 PM</option><option value="1130PM">11:30 PM</option><option value="1145PM">11:45 PM</option><option value="1200AM">12:00 AM</option></select>';
    }
    if ($('alert').value == 'hp') {
    rate = '';
    }

    if ($('alert').value == 'transfer') {
    rate = 'Transferring to:<br><input type="text" name="transfer" required/>';
    }

    if ($('alert').value == 'ni') {
    rate = '';
    }
var rate2="";
	if ($('alert').value == 'transfer') {
    rate2 = 'Transferred';
    }
$('alertChange2').innerHTML = rate2;
$('alertChange').innerHTML = rate;
}
window.onload = function () {
$('alert').onchange = selectAlert;
}
</script>
</body>
</html>