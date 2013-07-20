<?php

class jCubridQueryWriter
{
	public function safeTable( $name, $noQuotes=false )
	{
		return parent::safeTable( jR::prefixed($name), $noQuotes );
	}
}
