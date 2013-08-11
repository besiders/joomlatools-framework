<?php
/**
 * Koowa Framework - http://developer.joomlatools.com/koowa
 *
 * @copyright	Copyright (C) 2007 - 2013 Johan Janssens and Timble CVBA. (http://www.timble.net)
 * @license		GNU GPLv3 <http://www.gnu.org/licenses/gpl.html>
 * @link		http://github.com/joomlatools/koowa for the canonical source repository
 */

/**
 * Digit filter
 *
 * Checks if all of the characters in the provided string are numerical
 *
 * @author      Johan Janssens <johan@nooku.org>
 * @package     Koowa_Filter
 */
class KFilterDigit extends KFilterAbstract
{
    /**
     * Validate a value
     *
     * @param   scalar  Value to be validated
     * @return  bool    True when the variable is valid
     */
    protected function _validate($value)
    {
        return empty($value) || ctype_digit($value);
    }

    /**
     * Sanitize a value
     *
     * @param   mixed   Value to be sanitized
     * @return  int
     */
    protected function _sanitize($value)
    {
        $value = trim($value);
        $pattern ='/[^0-9]*/';
        return preg_replace($pattern, '', $value);
    }
}

