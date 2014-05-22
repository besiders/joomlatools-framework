<?php
/**
 * Koowa Framework - http://developer.joomlatools.com/koowa
 *
 * @copyright	Copyright (C) 2007 - 2014 Johan Janssens and Timble CVBA. (http://www.timble.net)
 * @license		GNU GPLv3 <http://www.gnu.org/licenses/gpl.html>
 * @link		http://github.com/joomlatools/koowa for the canonical source repository
 */

/**
 * Forbidden Http Exception
 *
 * The server refused to fulfill the request, for reasons other than invalid user credentials.
 *
 * @author  Johan Janssens <https://github.com/johanjanssens>
 * @package Koowa\Library\Http
 */
class KHttpExceptionForbidden extends KHttpExceptionAbstract
{
    protected $code = KHttpResponse::FORBIDDEN;
}