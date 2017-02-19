<?php

require __DIR__ . '/vendor/autoload.php';

use gordonmurray\matchImportHeadings;

$matchImportHeadings = new matchImportHeadings();

$knownHeadings = array('first name','middle name','last name','gender','date of birth','city','post code','country','place of work','job');

$synonyms = array(
    'first name'=>array('fname','firstname','name','given name','fore name','forename','christian name'),
    'middle name'=>array('mname','middle name','middle names'),
    'last name'=>array('lastname','lname','surname','family name'),
    'gender'=>array('sex'),
    'date of birth'=>array('dob','birth date','birthday'),
    'city'=>array('location'),
    'post code'=>array('postcode','eircode','eir code'),
    'place of work'=>array('organisation','org','orgname'),
    'job' => array('position')

);

$fieldNamesArray = array('id','import id','title','first name','middle name','surname','maiden name','birth date','position','orgname','addrline','addrline2','addrline3','addrline4','addrline5','city','postcode','county','contrylongdscription','email','email2','0 degree','0 class of','02 degree','02 class of','03 degree','03 class of','04 degree','04 class of','05 degree','05 class of','06 degree','06 class of','cnprbs position','cnprbs org name','cnprbs relation code','position','orgname','addrline','addrline2','addrline3','addrline4','addrline5','city','postcode','county','contrylongdscription','cnprbsadrph  0 phone number','acme club soty','acme club soty 3');

$matched = $matchImportHeadings->matchHeadings($knownHeadings, $synonyms, $fieldNamesArray);

print_r($fieldNamesArray);

print_r($matched);
