<?php

class jPostgreSqlQueryWriter extends RedBean_QueryWriter_PostgreSQL
{
	public function safeTable( $name, $noQuotes=false )
	{
		return parent::safeTable( jR::prefixed($name), $noQuotes );
	}
}
