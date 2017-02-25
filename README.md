# Match CSV Import headings 

[![Build Status](https://travis-ci.org/gordonmurray/match-import-headings.svg?branch=master)](https://travis-ci.org/gordonmurray/match-import-headings) [![Coverage Status](https://coveralls.io/repos/github/gordonmurray/match-import-headings/badge.svg?branch=master)](https://coveralls.io/github/gordonmurray/match-import-headings?branch=master)

A class to match cleaned column headings on an imported CSV to known column headings. Headings are matched based on direct text match and known synonyms.

## column headings before:

'fname','middle name','surname','birth date','position','orgname'

## column headings after:

Array
  (
      [value] => fname
      [match] => first name
  )

Array
  (
      [value] => middle name
      [match] => middle name
  )

Array
  (
      [value] => surname
      [match] => last name
  )

Array
  (
      [value] => birth date
      [match] => date of birth
  )

Array
  (
      [value] => position
      [match] => job position
  )

Array
  (
      [value] => orgname
      [match] => organisation
  )
