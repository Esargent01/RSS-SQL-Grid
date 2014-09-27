<?
 
  class RSS
  {
 public function RSS()
 {
  require_once ('pathto.../mysql_connect.php');
 }
  
 public function GetFeed()
 {
  return $this->getDetails() . $this->getItems();
 }
  
 private function dbConnect()
 {
  $con = mysqli_connect("localhost","root","","rss2") or die("Error " . mysqli_error($con));

return $con;
 }
  
 private function getDetails()
 {

  $con = mysqli_connect("localhost","root","","rss2") or die("Error " . mysqli_error($con));
  $query = "SELECT * FROM feed";
  $result = mysqli_query($con, $query);
   
  while($row = mysqli_fetch_array($result))
  {
   $details = '<?xml version="1.0" encoding="ISO-8859-1" ?>
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
  
  return $details;
 }
  
 private function getItems()
 {
  $itemsTable = "feed";
  $this->dbConnect($itemsTable);
  $query = "SELECT * FROM ". $itemsTable;
  $result = mysql_db_query (DB_NAME, $query, LINK);
  $items = '';
  while($row = mysql_fetch_array($result))
  {
   $items .= '<item>
    <title>'. $row["title"] .'</title>
    <link>'. $row["link"] .'</link>
    <description><![CDATA['. $row["body"] .']]></description>
   </item>';
  }
  $items .= '</channel>
    </rss>';
  return $items;
 }
 
}
 
?>