<?php 
session_start();
if(isset($_POST['dealership'])) {
try {
$db_user = 'localca4_james';
$db_pass = 'rescue123';
  $conn = new PDO('mysql:host=localhost;dbname=localca4_bdctest', $db_user, $db_pass);
  $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
  $stmt = $conn->prepare('SELECT * FROM bdc_client WHERE dealership = :dealership');
  $stmt->execute(array('dealership' => $_POST['dealership']));
 
  $result = $stmt->fetchAll();
 
  if ( count($result) ) { 
    echo $_POST['dealership'] . " is already in the Dealer List.";
  } else {
    try {
$db_user = 'localca4_james';
$db_pass = 'rescue123';
  $pdo = new PDO('mysql:host=localhost;dbname=localca4_bdctest', $db_user, $db_pass);
  $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
 
 $best_contact_number = $_POST['best_contact_number'];
 
  $stmt = $pdo->prepare('INSERT INTO bdc_client VALUES(:id,:dealership,:address,:website,:startdate,:enddate,:emails,:best_contact,:best_contact_number,:notes)');
  $stmt->execute(array(
    ':id' => '', ':dealership' => $_POST['dealership'], ':address' => $_POST['address'], ':website' => $_POST['website'], ':startdate' => $_POST['startdate'], ':enddate' => $_POST['enddate'], ':emails' => $_POST['emails'], ':best_contact' => $_POST['best_contact'], ':best_contact_number' => $best_contact_number, ':notes' => $_POST['notes']
  ));

} catch(PDOException $e) {
  echo 'Error: ' . $e->getMessage();
  }
  }
} catch(PDOException $e) {
    echo 'ERROR: ' . $e->getMessage();
}
}

if (isset($_POST['updatename'])) {
$dealerid = $_POST['dealerid'];
$dealership = $_POST['updatename'];
try {
$db_user = 'localca4_james';
$db_pass = 'rescue123';
  $pdo = new PDO('mysql:host=localhost;dbname=localca4_bdctest', $db_user, $db_pass);
  $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
  $stmt = $pdo->prepare('UPDATE bdc_client SET dealership = :dealership WHERE id = :id');
  $stmt->execute(array(':dealership' => $dealership,':id' => $dealerid));
} catch(PDOException $e) {
  echo 'Error: ' . $e->getMessage();
}
}

if (isset($_POST['updateemail'])) {
$dealerid2 = $_POST['dealerid2'];
$email = $_POST['updateemail'];
try {
$db_user = 'localca4_james';
$db_pass = 'rescue123';
  $pdo = new PDO('mysql:host=localhost;dbname=localca4_bdctest', $db_user, $db_pass);
  $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
  $stmt = $pdo->prepare('UPDATE bdc_client SET emails = :email WHERE id = :id2');
  $stmt->execute(array(':email' => $email,':id2' => $dealerid2));
} catch(PDOException $e) {
  echo 'Error: ' . $e->getMessage();
}
}

if (isset($_POST['updatestartdate'])) {
$dealerid4 = $_POST['dealerid4'];
$startdate = $_POST['updatestartdate'];
try {
$db_user = 'localca4_james';
$db_pass = 'rescue123';
  $pdo = new PDO('mysql:host=localhost;dbname=localca4_bdctest', $db_user, $db_pass);
  $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
  $stmt = $pdo->prepare('UPDATE bdc_client SET startdate = :startdate WHERE id = :id4');
  $stmt->execute(array(':startdate' => $startdate,':id4' => $dealerid4));
} catch(PDOException $e) {
  echo 'Error: ' . $e->getMessage();
}
}

if (isset($_POST['updateenddate'])) {
$dealerid5 = $_POST['dealerid5'];
$enddate = $_POST['updateenddate'];
try {
$db_user = 'localca4_james';
$db_pass = 'rescue123';
  $pdo = new PDO('mysql:host=localhost;dbname=localca4_bdctest', $db_user, $db_pass);
  $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
  $stmt = $pdo->prepare('UPDATE bdc_client SET enddate = :enddate WHERE id = :id5');
  $stmt->execute(array(':enddate' => $enddate,':id5' => $dealerid5));
} catch(PDOException $e) {
  echo 'Error: ' . $e->getMessage();
}
}

if (isset($_POST['dealerid3'])) {
$id3 = $_POST['dealerid3'];
try {
$db_user = 'localca4_james';
$db_pass = 'rescue123';
  $pdo = new PDO('mysql:host=localhost;dbname=localca4_bdctest', $db_user, $db_pass);
  $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
 
  $stmt = $pdo->prepare('DELETE FROM bdc_client WHERE id = :id3');
  $stmt->bindParam(':id3', $id3); // this time, we'll use the bindParam method
  $stmt->execute();
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
	
			
			<div class="four-columns six-columns-tablet twelve-columns-mobile">

<a href="index.php">Return</a>
<form action="" method="POST">
<p class="button-height inline-label">
							<label class="label">Dealership:</label>
							<input type="text" name="dealership" class="input full-width" autocomplete="off" required>
</p>
<p class="button-height inline-label">
							<label class="label">Address:</label>
							<input type="text" name="address" class="input full-width" autocomplete="off" required>
</p>
<p class="button-height inline-label">
							<label class="label">Website:</label>
							<input type="text" name="website" class="input full-width" autocomplete="off" required>
</p>
<p class="button-height inline-label">
<label class="label">Start Date:</label><input type="date" name="startdate"/></select>
</p>
<p class="button-height inline-label">
<label class="label">End Date:</label><input type="date" name="enddate"/></select>
</p>
<p class="button-height inline-label">
							<label class="label">Sale Hours and Notes:</label>
							<textarea name="notes" class="input full-width"></textarea>
</p>
<p class="button-height inline-label">
							<label class="label">Emails: <span class="info-spot">
							<span class="icon-info-round"></span>
							<span class="info-bubble">
								Enter emails with commas to separate: example@tkmkt.com,example2@tkmkt.com
							</span>
						</span></label>
							<input type="text" name="emails" class="input full-width" autocomplete="off" required>
</p>
<p class="button-height inline-label">
							<label class="label">Best Contact:</label>
							<input type="text" name="best_contact" class="input full-width" autocomplete="off" required>
</p>
<p class="button-height inline-label">
							<label class="label">Best Contact's Number:</label>
							<span id="sprytextfield3"><input type="text" id="phone" type="text" name="best_contact_number" id="phone" /><span class="textfieldInvalidFormatMsg">000-000-0000</span><span class="textfieldRequiredMsg">!</span></span>
</p>
<p class="button-height">
<input class="button icon-download" type="submit" name="add" value="Add Client" />
</p>
</form>
</div>
<div class="with-padding">
<?php 
try {
$db_user = 'localca4_james';
$db_pass = 'rescue123';
  $conn = new PDO('mysql:host=localhost;dbname=localca4_bdctest', $db_user, $db_pass);
  $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
  $stmt = $conn->prepare('SELECT * FROM bdc_client');
  $stmt->execute();
 
  $result = $stmt->fetchAll();
 
  if ( count($result) ) { 
  print '
  <h4>Dealership List</h4>

			<table class="simple-table responsive-table" id="sorting-example2">

				<thead>
					<tr>
						<th scope="col" width="15%">Dealership</th>
						<th scope="col" class="hide-on-mobile">Emails</th>
						<th scope="col" width="15%" class="hide-on-mobile-portrait">Start Date</th>
						<th scope="col" width="15%" class="hide-on-mobile-portrait">End Date</th>
						<th scope="col" width="10%" class="align-right">Actions</th>
					</tr>
				</thead>
  <tfoot><tr><td colspan="5">'.count($result).' entries found</td></tr></tfoot>
	<tbody>';
    foreach($result as $row) {
      print "<tr><td><form action='' method='POST'><input type='hidden' name='dealerid' value='". $row['0'] . "'/><input type='text' name='updatename' value='". $row['1'] . "' onchange='this.form.submit()' style='border:none;'></form></td><td><form action='' method='POST'><input type='hidden' name='dealerid2' value='". $row['0'] ."'/><input type='text' name='updateemail' value='". $row['6'] ."' onchange='this.form.submit()' style='border:none;width:100%;'></form></td><td><form action='' method='POST'><input type='hidden' name='dealerid4' value='". $row['0'] . "'/><input type='text' name='updatestartdate' value='". $row['4'] . "' onchange='this.form.submit()' style='border:none;width:100%;'></form></td>
      <td><form action='' method='POST'><input type='hidden' name='dealerid5' value='". $row['0'] . "'/><input type='text' name='updateenddate' value='". $row['5'] . "' onchange='this.form.submit()' style='border:none;width:100%;'></form></td>
      <td class='align-right vertical-center'>
							<span class='button-group compact'>
								<form action='' method='POST'><input type='hidden' name='dealerid3' value='". $row['0'] . "'/><input type='submit' name='deletedealer' value='delete'/></form>
							</span>
			</td></tr>";
    }  
    print '</tbody></table>'; 
  } else {
    echo "Please enter a dealership.";
  }
} catch(PDOException $e) {
    echo 'ERROR: ' . $e->getMessage();
}
?>
</div>

<div class="with-padding">

<p id="alertClient"></p>

			
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
				5: { sorter: false }
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