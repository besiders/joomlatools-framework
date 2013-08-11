<?php
/**
 * Koowa Framework - http://developer.joomlatools.com/koowa
 *
 * @copyright	Copyright (C) 2007 - 2013 Johan Janssens and Timble CVBA. (http://www.timble.net)
 * @license		GNU GPLv3 <http://www.gnu.org/licenses/gpl.html>
 * @link		http://github.com/joomlatools/koowa for the canonical source repository
 */

/**
 * Default Template
 *
 * @author      Johan Janssens <johan@nooku.org>
 * @package     Nooku_Components
 * @subpackage  Default
 */
class ComKoowaTemplateDefault extends ComKoowaTemplateAbstract
{
    /**
     * Load a template helper
     *
     * This function merges the elements of the attached view model state with the parameters passed to the helper
     * so that the values of one are appended to the end of the previous one.
     *
     * If the view state have the same string keys, then the parameter value for that key will overwrite the state.
     *
     * @param   string  Name of the helper, dot separated including the helper function to call
     * @param   mixed   Parameters to be passed to the helper
     * @return  string  Helper output
     */
    public function renderHelper($identifier, $params = array())
    {
        $view = $this->getView();

        if(KInflector::isPlural($view->getName()))
        {
            if($state = $view->getModel()->getState()) {
                $params = array_merge( $state->getData(), $params);
            }
        }
        else
        {
            if($item = $view->getModel()->getItem()) {
                $params = array_merge( $item->getData(), $params);
            }
        }

        return parent::renderHelper($identifier, $params);
    }
}
