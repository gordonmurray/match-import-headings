<?php

require __DIR__ . '/../vendor/autoload.php';

use gordonmurray\matchImportHeadings;

class cleanMatchHeadingsTest extends PHPUnit_Framework_TestCase
{
    public function testBasicClean()
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
}
