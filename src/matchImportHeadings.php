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
        $matchedHeadings = $this->matchLevenshtein($knownHeadings, $matchedHeadings);

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
     * @return array $headings [updated headings]
     */
    public function synonymMatch($synonymsArray = array(), $headings = array())
    {
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

    /**
     * Try to make a match using the levenshtein function
     *
     * @param  array  $knownHeadings [pre known headings]
     * @param  array  $headings [the users headings]
     *
     * @return array $headings [updated headings]
     */
    public function matchLevenshtein($knownHeadings = array(), $headings = array())
    {
        foreach ($headings as $key =>$heading) {
            if (isset($heading['match']) && $heading['match']=='') {
                $input = $heading['value'];

                // no shortest distance found, yet
                $shortest = -1;

                // loop through words to find the closest
                foreach ($knownHeadings as $word) {

                    // calculate the distance between the input word and the current word
                    $lev = levenshtein($input, $word);

                    // check for an exact match
                    if ($lev == 0) {

                        // closest word is this one (exact match)
                        $closest = $word;
                        $shortest = 0;

                        // break out of the loop; we've found an exact match
                        break;
                    }

                    // if this distance is less than the next found shortest
                    // distance, OR if a next shortest word has not yet been found
                    if ($lev <= $shortest || $shortest < 0) {
                        // set the closest match, and shortest distance
                        $closest  = $word;
                        $shortest = $lev;
                    }
                }

                if ($shortest == 0) {
                    $headings[$key]['match'] = $closest;
                } else {
                    $headings[$key]['potentialMatch'] = $closest;
                }
            }
        }

        return $headings;
    }
}
