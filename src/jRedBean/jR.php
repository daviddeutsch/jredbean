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
			'mysql'      => 'jMysqlQueryWriter',
			'mysqli'     => 'jMysqlQueryWriter',
			'postgresql' => 'jPostgreSqlQueryWriter',
			'sqlite'     => 'jSQLiteTQueryWriter'
		);

		$app = JFactory::getApplication();

		$class = $writerMapping[$app->getCfg('dbtype')];

		R::addDatabase(
			'joomla',
			'mysql:host=' . $app->getCfg('host') . ';'
			. 'dbname=' . $app->getCfg('db'),
			$app->getCfg('user'),
			$app->getCfg('password')
		);

		R::selectDatabase('joomla');

		$jWriter = new $class(R::$adapter);

		R::configureFacadeWithToolbox(
			new RedBean_ToolBox(R::$redbean, R::$adapter, $jWriter)
		);

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
