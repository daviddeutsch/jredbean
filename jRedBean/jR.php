<?php

class jR
{
	static $context;
	static $ready = false;

	public static function create()
	{
		if ( self::$ready ) {
			return null;
		}

		$writerMapping = array(
			'RedBean_QueryWriter_CUBRID' => 'jCubridQueryWriter',
			'RedBean_QueryWriter_MySQL' => 'jMysqlQueryWriter',
			'RedBean_QueryWriter_PostgreSQL' => 'jPostgreSqlQueryWriter',
			'RedBean_QueryWriter_SQLiteT' => 'jSQLiteTQueryWriter'
		);

		$class = $writerMapping[get_class(R::$writer)];
		$writer = new $class(R::$adapter);

		R::configureFacadeWithToolbox(
			new RedBean_ToolBox(R::$redbean, R::$adapter, $writer)
		);

		$app = JFactory::getApplication();

		R::addDatabase(
			'joomla',
			'mysql:host='.$app->getCfg('host').';'
			.'dbname='.$app->getCfg('db'),
			$app->getCfg('user'),
			$app->getCfg('password')
		);

		R::selectDatabase( 'joomla' );

		return true;
	}

	public static function context( $context )
	{
		self::$context = $context;
	}

	public static function prefixed( $name )
	{
		$app = JFactory::getApplication();

		return $app->getCfg('dbprefix').self::$context.'_'.$name;
	}
}
