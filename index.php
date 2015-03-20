<?php
	include('Net/SSH2.php');
	include('Crypt/RSA.php');
	include('functions.php');
?>
<html>
<head>
	<title>Monitor</title>
	<meta http-equiv="refresh" content="15">
</head>
<body>
	<font size="6"><b>Monitor Status</b></font><br />
	<font size="2">[Refreshing every 15 seconds...]</font><br /><br />
	
	<table border="1">
		<tr><?php
				$gs01 = getData('10.10.0.11');
				$gs02 = getData('10.10.0.12');
				$gs03 = getData('10.10.0.13');
			?>
			<td>GS01 - <?php echo $gs01[1]; ?></td><td>GS02 - <?php echo $gs02[1]; ?></td><td>GS03 - <?php echo $gs03[1]; ?></td>
		</tr>
		<tr>
			<td valign="top"><pre>
			<?php print_r(array_slice($gs01,2,count($gs01))); ?>
			</pre></td>
			<td valign="top"><pre>
			<?php print_r(array_slice($gs02,2,count($gs02))); ?>
			</pre></td>
			<td valign="top"><pre>
			<?php print_r(array_slice($gs03,2,count($gs03))); ?>
			</pre></td>
		</tr>
</body>
</html>