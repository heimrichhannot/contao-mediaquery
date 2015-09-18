<?php
/**
 * Contao Open Source CMS
 *
 * Copyright (c) 2015 Heimrich & Hannot GmbH
 *
 * @package mediaquery
 * @author  Rico Kaltofen <r.kaltofen@heimrich-hannot.de>
 * @license http://www.gnu.org/licences/lgpl-3.0.html LGPL
 */

namespace HeimrichHannot\MediaQuery;

define('TL_VIEWPORT_COOKIE', 'TL_VIEWPORT');
define('TL_VIEWPORT_WIDTH', '0');
define('TL_VIEWPORT_HEIGHT', '1');

class Viewport
{
	public static function getWidth()
	{
		return static::getDimension(TL_VIEWPORT_WIDTH);
	}

	public static function getHeight()
	{
		return static::getDimension(TL_VIEWPORT_HEIGHT);
	}
	
	public static function matchQuery($strMediaQuery)
	{
		if($strMediaQuery == '') return false;

		$intWidth = static::getWidth();
		$intHeight = static::getHeight();

		if($intWidth === null || $intHeight === null) return false;

		if(!preg_match_all('#(?P<prefixes>min-|min-device-|max-|max-device-)?(?P<dimensions>width|height):?\s+(?P<values>\d+)#im', $strMediaQuery, $arrParts))
		{
			return false;
		}
		
		if(!isset($arrParts['dimensions']) && !isset($arrParts['values'])) return false;

		$blnCheck = false;
		
		foreach($arrParts['dimensions'] as $i => $strDimension)
		{
			$strPrefix = $arrParts['prefixes'][$i];
			$intValue = $arrParts['values'][$i];
			$intCheck = $strDimension == 'width' ? $intWidth : $intHeight;
			
			switch(substr($strPrefix, 0, 4))
			{
				case 'min-':
					if($intCheck >= $intValue)
					{
						$blnCheck = true;
						continue 2;
					}
					else{
						$blnCheck = false;
						break 2;
					}
					break;
				case 'max-':
					if($intCheck <= $intValue)
					{
						$blnCheck = true;
						continue 2;
					}
					else{
						$blnCheck = false;
						break 2;
					}
				break;
				default:
					if($intCheck == $intValue)
					{
						$blnCheck = true;
						continue 2;
					}
					else{
						$blnCheck = false;
						break 2;
					}
				break;
			}
		}
		
		return $blnCheck;
	}

	protected function getDimension($strType)
	{
		if(!in_array($strType, array(TL_VIEWPORT_WIDTH, TL_VIEWPORT_HEIGHT))) return null;

		if(!\Input::cookie(TL_VIEWPORT_COOKIE))
		{
			return null;
		}

		$strDimension = \Input::cookie(TL_VIEWPORT_COOKIE);

		if(!preg_match('#(\d+):(\d+)#', $strDimension)) return null;

		$arrDimension = explode(':', $strDimension);

		if(!$arrDimension) return null;

		if(!isset($arrDimension[$strType]) && !is_numeric($arrDimension[$strType])) return null;

		return $arrDimension[$strType];
	}
}