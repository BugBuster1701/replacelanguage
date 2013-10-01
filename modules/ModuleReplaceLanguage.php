<?php 

/**
 * Contao Open Source CMS, Copyright (C) 2005-2013 Leo Feyer
 *
 * Contao Module "Replace Language"
 *
 * @copyright  Glen Langer 2011..2013 <http://www.contao.glen-langer.de>
 * @author     Glen Langer (BugBuster)
 * @package    ReplaceLanguage
 * @license    LGPL
 * @filesource
 * @see	       https://github.com/BugBuster1701/replacelanguage
 */

/**
 * Run in a custom namespace, so the class can be replaced
 */
namespace BugBuster\ReplaceLanguage;

/**
 * Class ModuleReplaceLanguage 
 *
 * @copyright  Glen Langer 2011..2013 <http://www.contao.glen-langer.de>
 * @author     Glen Langer <BugBuster> 
 * @package    ReplaceLanguage
 */
class ModuleReplaceLanguage 
{
	protected static $search_engine = '';
	protected static $old_language  = '';
	protected static $new_language  = '';
	
	/**
	 * Reset all properties
	 */
	protected static function reset() 
	{
		if (!isset($GLOBALS['TL_CONFIG']['rl_language'])) 
		{
			$GLOBALS['TL_CONFIG']['rl_language'] = 'de'; //default
		}
		self::$old_language  = $_SERVER['HTTP_ACCEPT_LANGUAGE'];
		self::$new_language  = $GLOBALS['TL_CONFIG']['rl_language'];
		self::$search_engine = false;
		
		// Import Helperclass ModuleBotDetection
		if (file_exists(TL_ROOT . '/system/modules/botdetection/modules/ModuleBotDetection.php')) 
		{
			$BT = new \BotDetection\ModuleBotDetection();
			//Call BD_CheckBotAgent
		    $test01 = $BT->BD_CheckBotAgent(); // Agent
		    //Call BD_CheckBotIP
		    $test02 = $BT->BD_CheckBotIP(); // IP
		    if ($test01 || $test02) 
		    {
		    	self::$search_engine = true;
		    }
		    unset($BT);
		} 
		else 
		{
			//botdetection Modul fehlt, Abbruch
			\System::log('BotDetection extension required!', 'ModuleReplaceLanguage reset', TL_ERROR);
		}
	}
	
	/**
	 * Check and Set Language
	 * 
	 * Using: ModuleReplaceLanguage::check();
	 */
	public static function check()
	{
		if (TL_MODE == 'FE') 
		{
			self::reset();
		    if (self::$search_engine === true) 
		    {
		    	$_SERVER['HTTP_ACCEPT_LANGUAGE'] = self::$new_language;
		    }
		}
	}
	
	/**
	 * Debug output in file debug.log
	 * 
	 * Using: ModuleReplaceLanguage::debug();
	 */
	public static function debug() 
	{
		if (self::$search_engine === '') 
		{
			self::reset();
		}
		$se = (self::$search_engine) ? "Yes" : "No";
		$strMessage = "\nEngine Old Language : {".self::$old_language."}\n" 
		            . "Engine New Language : {".self::$new_language."} if search engine\n"
		            . "Search Engine ? : ".$se."\n";
		error_log(sprintf('PHP Debug: in ModuleReplaceLanguage %s', $strMessage)
		                 ."\n", 3, TL_ROOT . '/system/logs/debug.log');
	}
	
}
