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

define('TL_MODE', 'FE');
require __DIR__.'/../../../initialize.php';

// Serialization of 'Closure' is not allowed
unset($GLOBALS['TL_EASY_THEMES_MODULES']['imageSizes']['appendIf']);

class ViewportTest extends \PHPUnit_Framework_TestCase
{
	public function testMatchQueryWidthHeightCorrect()
	{
		\Input::setcookie('TL_VIEWPORT', '1200:800');

		$strQuery = '(width: 1200px), (height: 800px)';

		$this->assertEquals(true, Viewport::matchQuery($strQuery));
	}

	public function testMatchQueryMinAndMaxWidthInverseCorrect()
	{
		\Input::setcookie('TL_VIEWPORT', '1200:800');

		$strQuery = '(max-width: 1300px and min-width: 800px)';

		$this->assertEquals(true, Viewport::matchQuery($strQuery));
	}

	public function testMatchQueryMinAndMaxWidthInverseWrong()
	{
		\Input::setcookie('TL_VIEWPORT', '799:800');

		$strQuery = '(max-width: 1300px and min-width: 800px)';

		$this->assertEquals(false, Viewport::matchQuery($strQuery));
	}

	public function testMatchQueryMinAndMaxWidthCorrect()
	{
		\Input::setcookie('TL_VIEWPORT', '1200:800');

		$strQuery = '(min-width: 800px and max-width: 1300px)';

		$this->assertEquals(true, Viewport::matchQuery($strQuery));
	}

	public function testMatchQueryMinAndMaxWidthWrong()
	{
		\Input::setcookie('TL_VIEWPORT', '799:800');

		$strQuery = '(min-width: 800px and max-width: 1300px)';

		$this->assertEquals(false, Viewport::matchQuery($strQuery));
	}

	public function testMatchQueryMaxWidthCorrect()
	{
		\Input::setcookie('TL_VIEWPORT', '1200:800');

		$strQuery = '(max-width: 1200px)';

		$this->assertEquals(true, Viewport::matchQuery($strQuery));
	}

	public function testMatchQueryMaxWidthWrong()
	{
		\Input::setcookie('TL_VIEWPORT', '1201:800');

		$strQuery = '(max-width: 1200px)';

		$this->assertEquals(false, Viewport::matchQuery($strQuery));
	}

	public function testMatchQueryMinWidthCorrect()
	{
		\Input::setcookie('TL_VIEWPORT', '1201:800');

		$strQuery = '(min-width: 1200px)';

		$this->assertEquals(true, Viewport::matchQuery($strQuery));
	}

	public function testMatchQueryMinWidthWrong()
	{
		\Input::setcookie('TL_VIEWPORT', '1199:800');

		$strQuery = '(min-width: 1200px)';

		$this->assertEquals(false, Viewport::matchQuery($strQuery));
	}

	public function testMatchQueryHeightCorrect()
	{
		\Input::setcookie('TL_VIEWPORT', '1200:800');

		$strQuery = '(height: 800px)';

		$this->assertEquals(true, Viewport::matchQuery($strQuery));
	}

	public function testMatchQueryHeightWrong()
	{
		\Input::setcookie('TL_VIEWPORT', '1200:801');

		$strQuery = '(height: 800px)';

		$this->assertEquals(false, Viewport::matchQuery($strQuery));
	}

	public function testMatchQueryWidthCorrect()
	{
		\Input::setcookie('TL_VIEWPORT', '1200:800');
		
		$strQuery = '(width: 1200px)';

		$this->assertEquals(true, Viewport::matchQuery($strQuery));
	}

	public function testMatchQueryWidthWrong()
	{
		\Input::setcookie('TL_VIEWPORT', '1201:800');

		$strQuery = '(width: 1200px)';

		$this->assertEquals(false, Viewport::matchQuery($strQuery));
	}
}