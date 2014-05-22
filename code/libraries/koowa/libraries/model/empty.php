<?php
/**
 * Koowa Framework - http://developer.joomlatools.com/koowa
 *
 * @copyright	Copyright (C) 2007 - 2014 Johan Janssens and Timble CVBA. (http://www.timble.net)
 * @license		GNU GPLv3 <http://www.gnu.org/licenses/gpl.html>
 * @link		http://github.com/joomlatools/koowa for the canonical source repository
 */

/**
 * Empty Model
 *
 * @author  Johan Janssens <https://github.com/johanjanssens>
 * @package Koowa\Library\Model
 */
final class KModelEmpty extends KModelAbstract
{

    /**
     * Constructor
     *
     * @param  KObjectConfig $config    An optional ObjectConfig object with configuration options
     */
    public function __construct(KObjectConfig $config)
    {
        parent::__construct($config);

        $this->_entity = $this->getObject('lib:model.entity.immutable');
    }

    /**
     * Get the total number of entities
     *
     * @param KModelContext $context A model context object
     * @return string  The output of the view
     */
    protected function _actionCount(KModelContext $context)
    {
        return 0;
    }

    /**
     * Reset the model
     *
     * @param  string $name The state name being changed
     * @return void
     */
    protected function _actionReset(KModelContext $context)
    {

    }
}