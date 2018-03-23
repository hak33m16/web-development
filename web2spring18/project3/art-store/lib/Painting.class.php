<?php
/*
   Represents a single row for the Subject table. 
   
   This a concrete implementation of the Domain Model pattern.
 */
class Painting extends DomainObject
{  
   
   static function getFieldNames() {
      return array('PaintingID', 'ArtistID', 'GalleryID', 'ImageFileName',
	  'Title', 'ShapeID', 'MuseumLink', 'AccessionNumber', 'CopyrightText',
	  'Description', 'Excerpt', 'YearOfWork', 'Width', 'Height', 'Medium',
	  'Cost', 'MSRP', 'GoogleLink', 'GoogleDescription', 'WikiLink');
   }

   public function __construct(array $data, $generateExc)
   {
      parent::__construct($data, $generateExc);
   }
   
   // implement any setters that need input checking/validation
}

?>