<?php
if (!defined('TL_ROOT')) die('You can not access this file directly!');

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
 * @copyright  MEN AT WORK 2012
 * @package    extendedEditors
 * @license    GNU/LGPL 
 * @filesource
 */

/**
 * Class mawExtendedInsertTags
 *
 * @copyright  MEN AT WORK 2012
 * @package    Frontend
 */
class mawExtendedInsertTags extends Controller
{

    public function mawReplaceInsertTags($strTag)
    {
        $arrSplit = explode('::', $strTag);

        // Replace tag
        switch (strtolower($arrSplit[0]))
        {
            case 'http':
            case 'cache_http':
            case 'https':
            case 'cache_https':
                if (isset($arrSplit[1]))
                {
                    $strReturn = '<a ';
                    $strReturn .= ($arrSplit[2] == 'blank') ? "onclick='window.open(this.href); return false;' " : "";
                    $strReturn .= 'href="' . (str_replace('cache_', '', $arrSplit[0])) . '://' . $arrSplit[1] . '">';
                    if (isset($arrSplit[3]))
                    {
                        $strReturn .= $arrSplit[3];
                    }
                    elseif (isset($arrSplit[2]))
                    {
                        $strReturn .= ($arrSplit[2] == 'blank') ? $arrSplit[1] : $arrSplit[2];
                    }
                    else
                    {
                        $strReturn .= $arrSplit[1];
                    }
                    $strReturn .= '</a>';
                    return $strReturn;
                }
                else
                {
                    return false;
                }
                break;

            case 'anchor':
                return '<a href="'.$this->Environment->request.'#'.$arrSplit[1].'">'.$arrSplit[2].'</a>';
                break;
            case 'anchor_open':
                return '<a href="'.$this->Environment->request.'#'.$arrSplit[1].'">';
                break;
            case 'anchor_close':
                return '</a>';
                break;
        }


        return false;
    }

    public function mawReplaceLanguageTags($strTag)
    {
        if ($strTag == 'actlang')
        {
            return $GLOBALS['TL_LANGUAGE'];
        }
        else
        {
            return false;
        }
    }

}

?>
