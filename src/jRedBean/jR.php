<?php

class jR
{
	/**
	 * Joomla database table prefix
	 *
	 * @var string
	 */
	static $prefix = '';

	/**
	 * Sub Prefix (commonly used for component name)
	 *
	 * @var string
	 */
	static $context = '';

	public static function create()
	{
		$writerMapping = array(
			'RedBean_QueryWriter_CUBRID'     => 'jCubridQueryWriter',
			'RedBean_QueryWriter_MySQL'      => 'jMysqlQueryWriter',
			'RedBean_QueryWriter_PostgreSQL' => 'jPostgreSqlQueryWriter',
			'RedBean_QueryWriter_SQLiteT'    => 'jSQLiteTQueryWriter'
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
