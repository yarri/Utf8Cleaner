Utf8Cleaner
===========

[![Build Status](https://travis-ci.com/yarri/Utf8Cleaner.svg?branch=master)](https://travis-ci.com/yarri/Utf8Cleaner)

Removes invalid UTF-8 byte sequences from the given text.

Utf8Cleaner is inspired by https://stackoverflow.com/questions/1401317/remove-non-utf8-characters-from-string

Usage
-----

Consider you have a string with an illegal UTF-8 byte sequence.

    $invalid_char = chr(200).chr(200); // invalid byte sequence for UTF-8
    $malformed_text = "Příliš žluťoučk$invalid_char kůň";

    $text = \Yarri\Utf8Cleaner::Clean($malformed_text);

By default, each invalid byte sequence is replaced with � (i.e. a black diamond with a white question mark - REPLACEMENT CHARACTER used to replace an unknown, unrecognized or unrepresentable character, U+FFFD).

    echo $text; // "Příliš žluťoučk� kůň"

The default replacement can be overridden by an option.

    $text = \Yarri\Utf8Cleaner::Clean($malformed_text,["replacement" => "?"]);
    // or
    $text = \Yarri\Utf8Cleaner::Clean($malformed_text,"?");

    echo $text; // "Příliš žluťoučk? kůň"

Installation
------------

The best way how to install Utf8Cleaner is to use the Composer:

    composer require yarri/utf8-cleaner

Testing
-------

    composer update --dev
    ./vendor/bin/run_unit_tests test/

License
-------

Utf8Cleaner is free software distributed [under the terms of the MIT license](http://www.opensource.org/licenses/mit-license)
