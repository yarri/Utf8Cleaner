Utf8Cleaner
===========

Removes invalid UTF-8 characters from the given text.

Usage
-----

    $text = \Yarri\Utf8Cleaner::Clean($text);

By default, each invalid character is replacing with underscore symbol.

The default replacement can be overridden by an option.

    $text = \Yarri\Utf8Cleaner::Clean($text,["replacement" => "▒"]);
    // or
    $text = \Yarri\Utf8Cleaner::Clean($text,"▒");

Installation
------------

The best way how to install Utf8Cleaner is to use a Composer:

    composer require yarri/utf8-cleaner

Testing
-------

    composer update --dev
    ./vendor/bin/run_unit_tests test/

License
-------

Utf8Cleaner is free software distributed [under the terms of the MIT license](http://www.opensource.org/licenses/mit-license)
