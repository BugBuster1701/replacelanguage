<?php if (!defined('TL_ROOT')) die('You can not access this file directly!');

/**
 * Contao Open Source CMS
 * Copyright (C) 2005-2011 Leo Feyer
 *
 * Formerly known as TYPOlight Open Source CMS.
 *
 * This program is free software: you can redistribute it and/or
 * modify it under the terms of the GNU Lesser General Public
 * License as published by the Free Software Foundation, either
 * version 3 of the License, or (at your option) any later version.
 * 
 * This program is distributed in the hope that it will be useful,
 * but WITHOUT ANY WARRANTY; without even the implied warranty of
 * MERCHANTABILITY or FITNESS FOR A PARTICULAR PURPOSE. See the GNU
 * Lesser General Public License for more details.
 * 
 * You should have received a copy of the GNU Lesser General Public
 * License along with this program. If not, please visit the Free
 * Software Foundation website at <http://www.gnu.org/licenses/>.
 *
 * PHP version 5
 * @copyright  Glen Langer 2011 
 * @author     Glen Langer <BugBuster> 
 * @package    ReplaceLanguage 
 * @license    LGPL 
 * @filesource
 */


/**
 * Class ModuleReplaceLanguage 
 *
 * @copyright  Glen Langer 2011 
 * @author     Glen Langer <BugBuster> 
 * @package    Controller
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
		if (!isset($GLOBALS['TL_CONFIG']['rl_language'])) {
			$GLOBALS['TL_CONFIG']['rl_language'] = 'de'; //default
		}
		self::$old_language  = $_SERVER['HTTP_ACCEPT_LANGUAGE'];
		self::$new_language  = $GLOBALS['TL_CONFIG']['rl_language'];
		self::$search_engine = false;
		
		// Import Helperclass ModuleBotDetection
		if (file_exists(TL_ROOT . '/system/modules/botdetection/ModuleBotDetection.php')) {
			require(TL_ROOT . '/system/modules/botdetection/ModuleBotDetection.php');
			$BT = new ModuleBotDetection();
			//Call BD_CheckBotAgent
		    $test01 = $BT->BD_CheckBotAgent(); // Agent
		    //Call BD_CheckBotIP
		    $test02 = $BT->BD_CheckBotIP(); // IP
		    if ($test01 || $test02) {
		    	self::$search_engine = true;
		    }
		    unset($BT);
		} else {
			//botdetection Modul fehlt, Abbruch
			$this->log('BotDetection extension required!', 'ModuleReplaceLanguage reset', TL_ERROR);
		}
	}
	
	/**
	 * Check and Set Language
	 */
	public static function check()
	{
		if (TL_MODE == 'FE') {
			self::reset();
		    if (self::$search_engine === true) {
		    	$_SERVER['HTTP_ACCEPT_LANGUAGE'] = self::$new_language;
		    }
		}
	}
	
	/**
	 * Debug output
	 * 
	 * Using: ModuleReplaceLanguage::check();
	 */
	public static function debug() 
	{
		if (self::$search_engine === '') {
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

?>