<?php

/* Startup :fixme It should be in separate file */

error_reporting( E_ALL ^E_WARNING ^E_NOTICE );
define( 'TIMER', microtime( true ) );
define( 'PROJECT_PATH', substr( __file__, 0, strlen( __file__ ) - 18 ) );
define( 'INCLUDE_PATH', '/var/www/include' );

require_once( INCLUDE_PATH .'/class/Config.class.php' );

spl_autoload_register( 'autoload' );

function autoload( $name )
{
	$path_array = array(
		'class/',
		'entity/',
		'controllers/',
		INCLUDE_PATH .'/class/'
	);

	foreach( $path_array as $path )
	{
		if( file_exists( $path . $name .'.class.php' ) )
		{
			include_once( $path . $name .'.class.php' );
			return true;
		}
	}
}

/* configuration begins */

define( 'PROJECT_NAME', 'shop' );

define( 'CACHE_TYPE', 'memcache' );
define( 'CACHE_HOST', '127.0.0.1' );
define( 'CACHE_PORT', 11211 );
define( 'CACHE_LIFETIME', 12000 ); // in seconds
define( 'CACHE_PREFIX', 'C4DEVELOPMENT' );

define( 'PAGE_CACHE_DIR', '/tmp/shop/page_cache' ); // compiled pages cache

define( 'CURRENCY_SIGN', '&pound;' );
define( 'SALES_TAX_NAME', 'VAT' );
define( 'VAT_DISPLAY', true );

define( 'SMARTY_DIR', INCLUDE_PATH .'/Smarty-3.0.6/libs/' );
define( 'SMARTY_TEMPLATES_DIR', PROJECT_PATH ."/templates/gray/" );
define( 'SMARTY_DEFAULT_TEMPLATES_DIR', PROJECT_PATH ."/templates/default/" );
define( 'PRODUCTION', false );

define( 'LOG_DIRECTORY', PROJECT_PATH .'/log' );

if( PRODUCTION )
{
	define( 'ADMIN_EMAIL', 'marek@dajnowski.net' );
	define( 'SMARTY_COMPILE_DIR', '/tmp/shop' );
	define( 'ASSETS_PATH', '/home/fornve/assets/shop' );
	define( 'PAYPAL_ACCOUNT_EMAIL', 'fornve@yahoo.co.uk' );
}
else
{
	define( 'ADMIN_EMAIL', 'tigi@sunforum.co.uk' );
	define( 'SMARTY_COMPILE_DIR', '/tmp/shop' );
	define( 'ASSETS_PATH', '/var/assets/shop' );
	define( 'PAYPAL_ACCOUNT_EMAIL', 'dummy_1244752696_biz@dajnowski.net' );
}

require_once( 'database.php' );

/* end of configuration */

if( !file_exists( INCLUDE_PATH .'/class/Entity.class.php' ) )
{
	die('LiteEntityLib not found. Please install https://github.com/fornve/LiteEntityLib to '. INCLUDE_PATH );
}

if( !file_exists( SMARTY_COMPILE_DIR ) )
{
	mkdir( SMARTY_COMPILE_DIR );
}

require_once( SMARTY_DIR .'Smarty.class.php' );


