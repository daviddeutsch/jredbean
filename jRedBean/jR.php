<?php

class jR
{
	static $ready = false;
	static $prefix = '';
	static $context = '';

	public static function create()
	{
		if (self::$ready) {
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

		R::selectDatabase('joomla');

		self::$prefix = $app->getCfg('dbprefix');

		return true;
	}

	public static function context( $context )
	{
		self::$context = $context.'_';
	}

	public static function prefixed( $name )
	{
		return self::$prefix.self::$context.$name;
	}
}
