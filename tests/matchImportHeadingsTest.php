<?php

require __DIR__ . '/../vendor/autoload.php';

use gordonmurray\matchImportHeadings;

class cleanMatchHeadingsTest extends PHPUnit_Framework_TestCase
{
    public function testDirectMatch()
    {
        $matchImportHeadings = new matchImportHeadings();

        $knownHeadings = array('first name','last name');

        $headings  = array('first name','middle name','last name');

        $expectedResponse = array(
            array('value'=>'first name','match'=>'first name'),
            array('value'=>'middle name','match'=>''),
            array('value'=>'last name', 'match'=>'last name')
        );

        $response = $matchImportHeadings->directMatch($knownHeadings, $headings);

        $this->assertEquals($expectedResponse, $response);
    }

    public function testSynonymMatch()
    {
        $matchImportHeadings = new matchImportHeadings();

        $knownHeadings = array('first name','middle name','last name','gender','date of birth','city','post code','country','place of work','job');

        $headings  = array(
            array('value'=>'first name','match'=>'first name'),
            array('value'=>'middle name','match'=>''),
            array('value'=>'last name', 'match'=>'last name'),
            array('value'=>'org', 'match'=>'')
        );

        $synonyms = array(
            'place of work'=>array('organisation','org','orgname'),
        );

        $expectedResponse = array(
            array('value'=>'first name','match'=>'first name'),
            array('value'=>'middle name','match'=>''),
            array('value'=>'last name', 'match'=>'last name'),
            array('value'=>'org', 'match'=>'place of work')
        );

        $response = $matchImportHeadings->synonymMatch($synonyms, $headings);

        $this->assertEquals($expectedResponse, $response);
    }
}
