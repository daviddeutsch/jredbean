<?php

class jSQLiteTQueryWriter extends RedBean_QueryWriter_SQLiteT
{
	public function safeTable( $name, $noQuotes=false )
	{
		return parent::safeTable( jR::prefixed($name), $noQuotes );
	}
}
