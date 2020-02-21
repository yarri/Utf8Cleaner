<?php
namespace Yarri;

class Utf8Cleaner {

	static function Clean($text,$options = array()){
		if(is_string($options)){
			$options = array("replacement" => $options);
		}

		$options += array(
			"replacement" => "�", // U+FFFD REPLACEMENT CHARACTER used to replace an unknown, unrecognized or unrepresentable character
		);

		$replacement = $options["replacement"];

		// https://stackoverflow.com/questions/1401317/remove-non-utf8-characters-from-string
		$regex = <<<'END'
/
  (
    (?: [\x00-\x7F]               # single-byte sequences   0xxxxxxx
    |   [\xC0-\xDF][\x80-\xBF]    # double-byte sequences   110xxxxx 10xxxxxx
    |   [\xE0-\xEF][\x80-\xBF]{2} # triple-byte sequences   1110xxxx 10xxxxxx * 2
    |   [\xF0-\xF7][\x80-\xBF]{3} # quadruple-byte sequence 11110xxx 10xxxxxx * 3 
    ){1,100}                      # ...one or more times
  )
| ( [\x80-\xBF] )                 # invalid byte in range 10000000 - 10111111
| ( [\xC0-\xFF] )                 # invalid byte in range 11000000 - 11111111
/x
END;
			$replacer = function($captures) use ($replacement) {
				if ($captures[1] != "") {
					// Valid byte sequence. Return unmodified.
					return $captures[1];
				}
				elseif ($captures[2] != "") {
					// Invalid byte of the form 10xxxxxx.
					// Encode as 11000010 10xxxxxx.
					//return "\xC2".$captures[2];
					return $replacement;
				}
				else {
					// Invalid byte of the form 11xxxxxx.
					// Encode as 11000011 10xxxxxx.
					//return "\xC3".chr(ord($captures[3])-64);
					return $replacement;
				}
			};
			$text = preg_replace_callback($regex, $replacer, $text);
			return $text;
	}
}
