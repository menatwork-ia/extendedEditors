<?php

/**
 * Contao Open Source CMS
 *
 * @copyright  MEN AT WORK 2014
 * @package    extendedEditors
 * @license    GNU/LGPL 
 * @filesource
 */

/**
 * Class mawExtendedInsertTags
 *
 * @copyright  MEN AT WORK 2014
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
            case 'comments':
                return $this->countComments($arrSplit[1], $arrSplit[2]);
                break;
            case 'download':
                $objFile = \FilesModel::findByUuid($arrSplit[1]);
                return '<a title="' . $arrSplit[2] . '" href="' . $objFile->path . '" >' . $arrSplit[2] . '</a>';
                break;
        }


        return false;
    }

    protected function countComments($strParentTable, $intParentId)
    {
        if (empty($strParentTable) || empty($intParentId))
        {
            return false;
        }
 
        $objResult = \Database::getInstance()
                ->prepare('SELECT COUNT(*) as mycount FROM tl_comments WHERE source=? AND parent=?')
                ->execute($strParentTable, $intParentId);
 
        return $objResult->mycount;
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