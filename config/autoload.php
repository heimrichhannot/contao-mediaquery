<?php

/**
 * Contao Open Source CMS
 *
 * Copyright (c) 2005-2015 Leo Feyer
 *
 * @license LGPL-3.0+
 */


/**
 * Register the namespaces
 */
ClassLoader::addNamespaces(array
(
	'HeimrichHannot',
));


/**
 * Register the classes
 */
ClassLoader::addClasses(array
(
	// Classes
	'HeimrichHannot\MediaQuery\Hooks'    => 'system/modules/mediaquery/classes/Hooks.php',
	'HeimrichHannot\MediaQuery\Viewport' => 'system/modules/mediaquery/classes/Viewport.php',
));
