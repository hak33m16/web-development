<?php
include 'includes/art-config.inc.php';
?>
<html>
<body>
<h1> Domain Tester </h1>
<?php

echo '<hr/>';
echo '<h2>Test Genre</h2>';

$g1 = new Genre(Genre::getFieldNames(), false);
$g1->GenreID = 33;
$g1->GenreName = "Impressionism";
$g1->EraID = 5;
$g1->Description = "Impressionism was a 19th-century art movement that originated with a group of Paris-based artists whose independent exhibitions brought them to prominence during the 1870s and 1880s. The name of the style is derived from the title of a Claude Monet work, Impression, soleil levant (Impression, Sunrise), which provoked the critic Louis Leroy to coin the term in a satiric review published in the Parisian newspaper Le Charivari.";
$g1->Link = "http://en.wikipedia.org/wiki/Impressionism";

echo '<p>&nbsp;</p>';
$g2 = new Genre(Genre::getFieldNames(), false);
$g2->GenreID = 83;
$g2->GenreName = "Rococo";
$g2->EraID = 3;
$g2->Description = "Rococo, less commonly roccoco, also referred to as Late Baroque  , is an 18th-century artistic movement and style, which affected several aspects of the arts including painting, sculpture, architecture, interior design, decoration, literature, music and theatre. The Rococo developed in the early part of the 18th century in Paris, France as a reaction against the grandeur, symmetry and strict regulations of the Baroque, especially that of the Palace of Versailles. In such a way, Rococo artists opted for a more jocular, florid and graceful approach to Baroque art and architecture. ";
$g2->Link = "http://en.wikipedia.org/wiki/Rococo";

echo '<textarea rows="6" cols="80">';
echo $g1->getXML();
echo '</textarea><br/>';
echo '<textarea rows="6" cols="80">';
echo $g2->getXML();
echo '</textarea><br/>';



echo '<hr/>';
echo '<h2>Test Artist</h2>';

$a1 = new Artist(Artist::getFieldNames(), false);
$a1->ArtistID = 1;
$a1->FirstName = "Pablo";
$a1->LastName = "Picasso";
$a1->Nationality = "Spain";
$a1->YearOfBirth = 1881;
$a1->YearOfDeath = 1973;
$a1->Details = "He is widely known for co-founding the Cubist movement and for the wide variety of styles that he helped develop and explore. Among his most famous works are the proto-Cubist Les Demoiselles d'Avignon (1907) and Guernica (1937), a portrayal of the German bombing of Guernica during the Spanish Civil War.";
$a1->ArtistLink = "http://en.wikipedia.org/wiki/Picasso";

$a2 = new Artist(Artist::getFieldNames(), false);
$a2->ArtistID = 99;
$a2->FirstName = " ";
$a2->LastName = "Raphael";
$a2->Nationality = "Italy";
$a2->YearOfBirth = 1483;
$a2->YearOfDeath = 1520;
$a2->Details = "Raffaello Sanzio da Urbino, better known simply as <strong>Raphael</strong>, was an Italian painter and architect of the High Renaissance. His work is admired for its clarity of form and ease of composition and for its visual achievement of the Neoplatonic ideal of human grandeur. Together with Michelangelo and Leonardo da Vinci, he forms the traditional trinity of great masters of that period.";
$a2->ArtistLink = "http://en.wikipedia.org/wiki/Raphael";

echo '<textarea rows="6" cols="80">';
echo $a1->getXML();
echo '</textarea><br/>';
echo '<textarea rows="6" cols="80">';
echo $a2->getXML();
echo '</textarea><br/>';


echo '<hr/>';
echo '<h2>Test Painting</h2>';
$w1 = new Painting(Painting::getFieldNames(), false);
$w1->PaintingID = 12;
$w1->ArtistID = 1;
$w1->ImageFileName = "01150";
$w1->Title = "Portrait of Gertrude Stein";
$w1->Description = "By 1905 Picasso became a favorite of the American art collectors Leo and Gertrude Stein. Their older brother Michael Stein and his wife Sarah also became collectors of his work. Picasso painted portraits of both Gertrude Stein and her nephew Allan Stein. Gertrude Stein became Picasso's principal patron, acquiring his drawings and paintings and exhibiting them in her informal Salon at her home in Paris.    ";
$w1->Excerpt = "By 1905 Picasso became a favorite of the American art collectors Leo and Gertrude Stein. Their older brother Michael Stein and his wife Sarah also became collectors of his work. Picasso painted portraits of both Gertrude Stein and her nephew Allan Stein.";
$w1->YearOfWork = 1907;
$w1->Width = 100;
$w1->Height = 81;
$w1->Medium = "oil on canvas";
$w1->GalleryName = "The Met, New York City";
$w1->GalleryID = 6;
$w1->Cost = 220;
$w1->MSRP = 300;
$w1->WikiLink = "http://www.metmuseum.org/Collections/search-the-collections/210008443";
$w1->GoogleLink = "";

$w2 = new Painting(Painting::getFieldNames(), false);
$w2->PaintingID = 60;
$w2->ArtistID = 19;
$w2->ImageFileName = "19050";
$w2->Title = "Sunflowers";
$w2->Description = "Sunflowers (original title, in French: Tournesols) are the subject of two series of still life paintings by the Dutch painter Vincent van Gogh. The earlier series executed in Paris in 1887 gives the flowers lying on the ground, while the second set executed a year later in Arles shows bouquets of sunflowers in a vase. In the artist's mind both sets were linked by the name of his friend Paul Gauguin, who acquired two of the Paris versions. About eight months later Van Gogh hoped to welcome and to impress Gauguin again with Sunflowers, now part of the painted d�coration he prepared for the guestroom of his Yellow House where Gauguin was supposed to stay in Arles. After Gauguin's departure, Van Gogh imagined the two major versions as wings of the Berceuse Triptych, and finally he included them in his exhibit at Les XX in Bruxelles. ";
$w2->Excerpt = "Sunflowers (original title, in French: Tournesols) are the subject of two series of still life paintings by the Dutch painter Vincent van Gogh. The earlier series executed in Paris in 1887 gives the flowers lying on the ground, while the second set executed a year later in Arles shows bouquets of sunflowers in a vase.";
$w2->ArtWorkType = 1;
$w2->YearOfWork = 1888;
$w2->Width = 92;
$w2->Height = 73;
$w2->Medium = "oil on canvas";
$w2->GalleryName = "National Gallery, London";
$w2->GalleryID = 5;
$w2->Cost = 340;
$w2->MSRP = 400;
$w2->WikiLink = "http://en.wikipedia.org/wiki/Sunflowers_(painting)";
$w2->GoogleLink = "http://www.googleartproject.com/museums/vangogh/sunflowers-24";

echo '<textarea rows="6" cols="80">';
echo $w1->getXML();
echo '</textarea><br/>';
echo '<textarea rows="6" cols="80">';
echo $w2->getXML();
echo '</textarea><br/>';



echo '<hr/>';
echo '<h2>Test Subject</h2>';

$s1 = new Subject(Subject::getFieldNames(), false);
$s1->SubjectID = 1;
$s1->SubjectName = "Animals";

$s2 = new Subject(Subject::getFieldNames(), false);
$s2->SubjectID = 14;
$s2->SubjectName = "History";

echo '<textarea rows="2" cols="60">';
echo $s1->getXML();
echo '</textarea><br/>';
echo '<textarea rows="2" cols="60">';
echo $s2->getXML();
echo '</textarea><br/>';



?>