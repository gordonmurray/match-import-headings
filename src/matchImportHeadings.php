<?php

namespace gordonmurray;

class matchImportHeadings
{
    /**
     * Iterate over the values in an array, make matches to known headings
     *
     * @param  array  $knownHeadings [pre known headings]
     * @param  array  $synonymsArray [An array of parent words and common synonyms]
     * @param  array  $headings [the users headings]
     *
     * @return array $matchedHeadings [updated headings]
     */
    public function matchHeadings($knownHeadings = array(), $synonymsArray = array(), $headings = array())
    {
        // first step, look for direct matches
        $matchedHeadings = $this->directMatch($knownHeadings, $headings);

        // second step, look for matches based on synonyms of known headings
        $matchedHeadings = $this->synonymMatch($synonymsArray, $matchedHeadings);

        // third step, look for matches based on words 'near' the heading
        // TODO

        return $matchedHeadings;
    }

    /**
     * Look for any direct matchs of the headins when compared to known headings
     *
     * @param  array  $knownHeadings [pre known headings]
     * @param  array  $headings [the users headings]
     *
     * @return array $matchedHeadings [updated headings]
     */
    public function directMatch($knownHeadings = array(), $headings = array())
    {
        $matchedHeadings = array();

        foreach ($headings as $key =>$heading) {
            $matchedHeadings[$key]['value']=$heading;

            if (in_array($heading, $knownHeadings)) {
                $matchedHeadings[$key]['match']=$heading;
            } else {
                $matchedHeadings[$key]['match']='';
            }
        }
        return $matchedHeadings;
    }

    /**
     * Look for any matches of the headings when compared to known heading synonyms
     *
     * @param  array  $synonymsArray [An array of parent words and common synonyms]
     * @param  array  $headings [the users headings]
     *
     * @return array $matchedHeadings [updated headings]
     */
    public function synonymMatch($synonymsArray = array(), $headings = array())
    {
        //$matchedHeadings = array();

        foreach ($headings as $key =>$heading) {
            if (isset($heading['match']) && $heading['match']=='') {
                foreach ($synonymsArray as $parentString => $synonyms) {
                    if (in_array($heading['value'], $synonyms)) {
                        $headings[$key]['match']=$parentString;
                        break;
                    }
                }
            }
        }
        return $headings;
    }
}
