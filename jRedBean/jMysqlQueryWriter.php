<?php

class jMysqlQueryWriter
{
	public function safeTable( $name, $noQuotes=false )
	{
		return parent::safeTable( jR::prefixed($name), $noQuotes );
	}
}
