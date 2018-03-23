<?PHP
include 'includes/art-config.inc.php';

?>
<html>
<body>

<h1> Data Adapter Tester </h1>


<?php

echo '<hr/>';
echo '<h2>Test runQuery</h2>';
$sql = "select * from Artists order by LastName";
$result = $dbAdapter->runQuery($sql);
foreach ($result as $row)
{
   echo $row[0] . " - " . $row[1] . " - " . $row[2] . " - " . $row[3] . "<br/>";
}

echo '<hr/>';
echo '<h2>Test runQuery with two parameters</h2>';
$sql = 'select ArtistID, LastName from Artists where ArtistID=:id or LastName Like :pattern';
$parameters = Array(':id' => 5, ':pattern' => 'S%');
$result = $dbAdapter->runQuery($sql, $parameters);
foreach ($result as $row)
{
   echo $row[0] . " - " . $row[1] . "<br/>";
}

echo '<hr/>';
echo '<h2>Test fetchRow </h2>';
$sql = "select ArtistID, LastName from Artists where ArtistID = :id";
$result = $dbAdapter->fetchRow($sql, Array(':id' => 5) );
echo $result['ArtistID'] . " - " . $result['LastName'] . "<br/>";


echo '<hr/>';
echo '<h2>Test fetchAsArray </h2>';
$sql = "select * from Artists order by LastName";
$values = $dbAdapter->fetchAsArray($sql); 
foreach ($values as $row)
{
   echo $row['ArtistID'] . " - " . $row['LastName'] . "<br/>";
}

echo '<hr/>';
echo '<h2>Test fetchField </h2>';
$sql = 'select LastName from Artists where ArtistID=5';
$scalar = $dbAdapter->fetchField($sql);
echo 'Scalar=' . $scalar;



echo '<hr/>';

   

   
$dbAdapter->closeConnection();

?>