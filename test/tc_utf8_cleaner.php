<?php
class TcUtf8Cleaner extends TcBase {

	function test(){
		$invalid = chr(200);

		$this->assertEquals('',\Yarri\Utf8Cleaner::Clean(''));

		$this->assertEquals("Příliš žluťoučký kůň úpěl ďábelské ódy",\Yarri\Utf8Cleaner::Clean("Příliš žluťoučký kůň úpěl ďábelské ódy"));
		$this->assertEquals("_Příliš_ žl_uťoučký kůň úpěl ďábelské ódy_",\Yarri\Utf8Cleaner::Clean("{$invalid}Příliš{$invalid} žl{$invalid}uťoučký kůň úpěl ďábelské ódy{$invalid}"));
		$this->assertEquals("?Příliš? žl_uťoučký kůň úpěl ďábelské ódy?",\Yarri\Utf8Cleaner::Clean("{$invalid}Příliš{$invalid} žl{$invalid}uťoučký kůň úpěl ďábelské ódy{$invalid}",array("replacement" => "?")));
		$this->assertEquals("▒Příliš▒ žl▒uťoučký kůň úpěl ďábelské ódy▒",\Yarri\Utf8Cleaner::Clean("{$invalid}Příliš{$invalid} žl{$invalid}uťoučký kůň úpěl ďábelské ódy{$invalid}","▒"));
	}
}
