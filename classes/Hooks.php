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


class Hooks extends \Controller
{

	public function initializeSystemHook()
	{
		$GLOBALS['TL_JAVASCRIPT']['mediaquery'] = 'system/modules/mediaquery/assets/js/mediaquery' . (!$GLOBALS['TL_CONFIG']['debugMode'] ? '.min' : '') . '.js|static';
	}

}