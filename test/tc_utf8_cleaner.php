<?php
class TcUtf8Cleaner extends TcBase {

	function test(){
		$invalid = chr(200);

		$this->assertEquals('',\Yarri\Utf8Cleaner::Clean(''));

		$this->assertEquals("Příliš žluťoučký kůň úpěl ďábelské ódy",\Yarri\Utf8Cleaner::Clean("Příliš žluťoučký kůň úpěl ďábelské ódy"));
	
		$src = "{$invalid}Příliš{$invalid} žl{$invalid}uťoučký kůň úpěl ďábelské ódy{$invalid}";
		$this->assertFalse(Translate::CheckEncoding($src,"UTF-8"));

		$out = \Yarri\Utf8Cleaner::Clean($src);
		$this->assertEquals("�Příliš� žl�uťoučký kůň úpěl ďábelské ódy�",$out);
		$this->assertTrue(Translate::CheckEncoding($out,"UTF-8"));

		$out = \Yarri\Utf8Cleaner::Clean($src,array("replacement" => "?"));
		$this->assertEquals("?Příliš? žl?uťoučký kůň úpěl ďábelské ódy?",$out);
		$this->assertTrue(Translate::CheckEncoding($out,"UTF-8"));

		$out = \Yarri\Utf8Cleaner::Clean($src,"▒");
		$this->assertEquals("▒Příliš▒ žl▒uťoučký kůň úpěl ďábelské ódy▒",$out);
		$this->assertTrue(Translate::CheckEncoding($out,"UTF-8"));
	}
}
