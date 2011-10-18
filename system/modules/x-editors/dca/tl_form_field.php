<?php if (!defined('TL_ROOT')) die('You can not access this file directly!');

/**
 * Contao Open Source CMS
 * Copyright (C) 2005-2010 Leo Feyer
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
 * @copyright  MEN AT WORK 2011 
 * @author     MEN AT WORK <cms@men-at-work.de> 
 * @package    extendedEditors
 * @license    GNU/LGPL 
 * @filesource
 */


/**
 * Table maw_tl_form_field
 */
$GLOBALS['TL_DCA']['tl_form_field']['list']['sorting']['child_record_callback'] = array('maw_tl_form_field', 'listFormFields');


/**
 * Class maw_tl_form_field
 *
 * Provide miscellaneous methods that are used by the data configuration array.
 * @copyright  MEN AT WORK 2011 
 * @author     MEN AT WORK <cms@men-at-work.de> 
 * @package    Controller
 */
class maw_tl_form_field extends tl_form_field
{

	/**
	 * Add the type of input field
	 * @param array
	 * @return string
	 */
	public function listFormFields($arrRow)
	{
		$key = $arrRow['invisible'] ? 'unpublished' : 'published';

		$strType = '
<div class="cte_type ' . $key . '">' . $GLOBALS['TL_LANG']['FFL'][$arrRow['type']][0] . ($arrRow['mandatory'] ? ' * ' : ''). ($arrRow['name'] ? ' (' . $arrRow['name'] . ')' : '') . ($arrRow['class'] ? ' [' . $arrRow['class'] . ']' : '') . '</div>
<div class="limit_height' . (!$GLOBALS['TL_CONFIG']['doNotCollapse'] ? ' h32' : '') . ' block">';

		$strClass = $GLOBALS['TL_FFL'][$arrRow['type']];

		if (!$this->classFileExists($strClass))
		{
			return '';
		}

		$objWidget = new $strClass($arrRow);

		$strWidget = $objWidget->parse();
		$strWidget = preg_replace('/ name="[^"]+"/i', '', $strWidget);
		$strWidget = str_replace('type="submit"', 'type="button"', $strWidget);

		if ($objWidget instanceof FormHidden)
		{
			return $strType . "\n" . $objWidget->value . "\n</div>\n";
		}

		return $strType . '
<table cellspacing="0" cellpadding="0" class="tl_form_field_preview" summary="Table holds a form input field">
'.$strWidget.'</table>
</div>' . "\n";
	}

}

?>