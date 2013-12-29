<?php

class jMysqlQueryWriter extends RedBean_QueryWriter_MySQL
{
	public function safeTable( $name, $noQuotes=false )
	{
		return parent::safeTable( jR::prefixed($name), $noQuotes );
	}
}
