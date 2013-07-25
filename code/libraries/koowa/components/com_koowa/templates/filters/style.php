<?php
/**
 * @package     Nooku_Components
 * @subpackage  Default
 * @copyright   Copyright (C) 2007 - 2012 Johan Janssens. All rights reserved.
 * @license     GNU GPLv3 <http://www.gnu.org/licenses/gpl.html>
 * @link        http://www.nooku.org
 */

/**
 * Style Filter
 *
 * @author      Johan Janssens <johan@nooku.org>
 * @package     Nooku_Components
 * @subpackage  Default
 */
class ComKoowaTemplateFilterStyle extends KTemplateFilterStyle
{
    /**
     * Render style information
     *
     * @param string    The style information
     * @param boolean   True, if the style information is a URL
     * @param array     Associative array of attributes
     * @return string
     */
    protected function _renderStyle($style, $link, $attribs = array())
    {
        if(KRequest::type() == 'AJAX') {
            return parent::_renderStyle($style, $link, $attribs);
        }

        $document = JFactory::getDocument();

        if($link) {
            $document->addStyleSheet($style, 'text/css', null, $attribs);
        } else {
            $document->addStyleDeclaration($style);
        }
    }
}
