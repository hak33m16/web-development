<?php
include 'includes/art-config.inc.php';
?>
<html>
<body>
<h1> Table Gateways Tester </h1>
<?php

echo '<hr/>';
echo '<h2>Test GenreTableGateway</h2>';
echo '<h3>Test findAll()</h3>';
$gate = new GenreTableGateway($dbAdapter);
$result = $gate->findAll();
foreach ($result as $row)
{
   echo $row->GenreID . " - " . $row->GenreName . "<br/>";
}

echo '<h3>Test findAllSorted(false)</h3>';
$gate = new GenreTableGateway($dbAdapter);
$result = $gate->findAllSorted(false);
foreach ($result as $row)
{
   echo '<img src="images/art/genres/square-medium/' . $row->GenreID . '.jpg" />';
   echo '<img src="images/art/genres/square-thumbs/' . $row->GenreID . '.jpg" />';   
   echo $row->GenreName . "<br/>";
}

echo '<h3>Test findById(35)</h3>';
$result = $gate->findById(35);
//print_r($result);
echo $result->GenreID . " - " . $result->GenreName . "<br/>";

echo '<h3>Test findBy(x,y)</h3>';
$result = $gate->findBy('GenreID=? or GenreName Like ?', Array(35,'S%'));
foreach ($result as $row)
{
   echo $row->GenreID . " - " . $row->GenreName . "<br/>";
}

echo '<hr/>';
echo '<h2>Test SubjectTableGateway</h2>';
echo '<h3>Test findAll()</h3>';
$gate = new SubjectTableGateway($dbAdapter);
$result = $gate->findAll();
foreach ($result as $row)
{
   echo '<img src="images/art/subjects/square-medium/' . $row->SubjectID . '.jpg" />';
   echo '<img src="images/art/subjects/square-thumbs/' . $row->SubjectID . '.jpg" />'; 
   echo $row->SubjectID . " - " . $row->SubjectName . "<br/>";
}
echo '<h3>Test findForPainting(376)</h3>';
$result2 = $gate->findForPainting(376);
foreach ($result2 as $row)
{
   echo '<img src="images/art/subjects/square-medium/' . $row->SubjectID . '.jpg" />';
   echo '<img src="images/art/subjects/square-thumbs/' . $row->SubjectID . '.jpg" />'; 
   echo $row->SubjectID . " - " . $row->SubjectName . "<br/>";
}

echo '<hr/>';
echo '<h2>Test ArtistTableGateway</h2>';
echo '<h3>Test findAllSorted()</h3>';
$gate = new ArtistTableGateway($dbAdapter);
$result = $gate->findAllSorted(true);
foreach ($result as $row)
{
   echo '<img src="images/art/artists/square-medium/' . $row->ArtistID . '.jpg" />';
   echo '<img src="images/art/artists/square-thumb/' . $row->ArtistID . '.jpg" />';   
   echo $row->ArtistID . " - " . $row->getFullName(false) . " - " . $row->Nationality . "<br/>";
}



echo '<hr/>';
echo '<h2>Test PaintingTableGateway</h2>';
$gate = new PaintingTableGateway($dbAdapter);

/*
echo '<h3>Test findAll()</h3>';
$result = $gate->findAll();
foreach ($result as $row)
{
   echo '<img src="../images/art/works/large/' . $row->ImageFileName . '.jpg" />';
   echo '<img src="../images/art/works/medium/' . $row->ImageFileName . '.jpg" />';  
   echo '<img src="../images/art/works/small/' . $row->ImageFileName . '.jpg" />';
   echo '<img src="../images/art/works/thumb/' . $row->ImageFileName . '.jpg" />';  
   echo '<img src="../images/art/works/square-medium/' . $row->ImageFileName . '.jpg" />';
   echo '<img src="../images/art/works/square-thumbs/' . $row->ImageFileName . '.jpg" />';
   echo ' By <a href="artist.php?id=' . $row->ArtistID . '">' . $row->LastName . '</a><br/>';
   echo $row->Title . " - " . $row->YearOfWork . "<br/>";
}

*/

echo '<h3>Test findByID(590)</h3>';
$result = $gate->findByID(590);

//print_r($result);

echo '<img src="images/art/works/square-medium/' . $result->ImageFileName . '.jpg" />';
echo ' By <a href="artist.php?id=' . $result->ArtistID . '">' . $result->LastName . '</a> ';
echo $result->Title . " - " . $result->YearOfWork . "<br/>";


echo '<h3>Test findByArtist(99)</h3>';
$result = $gate->getAllByArtist(99);
foreach ($result as $row)
{
   //print_r($row);
   echo '<img src="images/art/works/square-medium/' . $row->ImageFileName . '.jpg" />';
   echo ' By <a href="artist.php?id=' . $row->ArtistID . '">' . $row->LastName . '</a> ';
   echo $row->Title . " - " . $row->YearOfWork . "<br/>";
}
   
   
echo '<h3>Test findByGallery(20)</h3>';
$result = $gate->getAllByGallery(20);
foreach ($result as $row)
{
   echo '<img src="images/art/works/square-medium/' . $row->ImageFileName . '.jpg" />';
   echo ' By <a href="artist.php?id=' . $row->ArtistID . '">' . $row->LastName . '</a> ';
   echo $row->Title . " - " . $row->YearOfWork . "<br/>";
}


echo '<h3>Test findByShape(5)</h3>';
$result = $gate->getAllByShape(5);
foreach ($result as $row)
{
   echo '<img src="images/art/works/medium/' . $row->ImageFileName . '.jpg" />';  
   echo ' By <a href="artist.php?id=' . $row->ArtistID . '">' . $row->LastName . '</a> ';
   echo $row->Title . " - " . $row->YearOfWork . "<br/>";
}

echo '<h3>Test getAllByGenre(83)</h3>';
$result = $gate->getAllByGenre(83);
foreach ($result as $row)
{
   echo '<img src="images/art/works/square-medium/' . $row->ImageFileName . '.jpg" />';  
   echo $row->Title . "<br/>";
}

$dbAdapter->closeConnection();

?>