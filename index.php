<!DOCTYPE html>

<?php
$x = 0;

$con = mysqli_connect("localhost","root","root","rss") or die("Error " . mysqli_error($con));

  $query = "SELECT * FROM feed";
  $result = mysqli_query($con, $query);
   
  while($row = mysqli_fetch_array($result))
  {
  	$data[$row['id']]['title'] = $row['title'];
  	$data[$row['id']]['link'] = $row['link'];
  	$data[$row['id']]['image_url'] = $row['image_url'];
       $details[$row['id']] = '<?xml version="1.0" encoding="ISO-8859-1" ?>
    <rss version="2.0">
     <channel>
      <title>'. $row['title'] .'</title>
      <link>'. $row['link'] .'</link>
      <description>'. $row['body'] .'</description>
      <image>
       <title>'. $row['image_title'] .'</title>
       <url>'. $row['image_url'] .'</url>
      </image>';
  }

?>

<html>
<link rel="stylesheet" type="text/css" href="style.css">
<body>
	<?php
	require('rss_fetch.inc');
	$url = ('http://www.worldcar.com/feed/');
	$rss = fetch_rss($url);
?>
<div class="grid">
	<?php 
for ($x=1; $x<=6; $x++) {
  echo '<a href="'.$rss->items[$x]['link'].'"><div class="tile" style="background: url('.$data[$x]['image_url'].') no-repeat; background-size: cover;">
  <div class="title">'.$rss->items[$x]['title'].'</div>
  </div></a>';
} 
?>

</div>

<?php
  header("Content-Type: application/xml; charset=ISO-8859-1");
  include("RSS.class.php");
  $rss = new RSS();
  print $rss->getDetails();
?>
</body>
</html>