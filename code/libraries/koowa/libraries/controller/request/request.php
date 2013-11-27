<?php
/**
 * Koowa Framework - http://developer.joomlatools.com/koowa
 *
 * @copyright	Copyright (C) 2007 - 2013 Johan Janssens and Timble CVBA. (http://www.timble.net)
 * @license		GNU GPLv3 <http://www.gnu.org/licenses/gpl.html>
 * @link		http://github.com/joomlatools/koowa for the canonical source repository
 */

/**
 * Controller Request
 *
 * @author  Johan Janssens <https://github.com/johanjanssens>
 * @package Koowa\Library\Controller
 */
class KControllerRequest extends KHttpRequest implements KControllerRequestInterface
{
    /**
     * The request query
     *
     * @var KHttpMessageParameters
     */
    protected $_query;

    /**
     * The request data
     *
     * @var KHttpMessageParameters
     */
    protected $_data;

    /**
     * Constructor
     *
     * @param KObjectConfig|null $config  An optional ObjectConfig object with configuration options
     * @return HttpResponse
     */
    public function __construct(KObjectConfig $config)
    {
        parent::__construct($config);

        //Set query parameters
        $this->setQuery($config->query);

        //Set data parameters
        $this->setData($config->data);
    }

    /**
     * Initializes the default configuration for the object
     *
     * Called from {@link __construct()} as a first step of object instantiation.
     *
     * @param  KObjectConfig $config  An optional ObjectConfig object with configuration options.
     * @return void
     */
    protected function _initialize(KObjectConfig $config)
    {
        $config->append(array(
            'query' => array(),
            'data'  => array(),
        ));

        parent::_initialize($config);
    }

    /**
     * Set the request query
     *
     * @param  array $parameters
     * @return KControllerRequest
     */
    public function setQuery($parameters)
    {
        $this->_query = $this->getObject('koowa:http.message.parameters', array('parameters' => $parameters));
        return $this;
    }

    /**
     * Get the request query
     *
     * @return KHttpMessageParameters
     */
    public function getQuery()
    {
        return $this->_query;
    }

    /**
     * Set the request data
     *
     * @param  array $parameters
     * @return KControllerRequest
     */
    public function setData($parameters)
    {
        $this->_data = $this->getObject('koowa:http.message.parameters', array('parameters' => $parameters));
        return $this;
    }

    /**
     * Get the request query
     *
     * @return KHttpMessageParameters
     */
    public function getData()
    {
        return $this->_data;
    }

    /**
     * Return the request format
     *
     * @param   string  $format The default format
     * @return  string  The request format
     */
    public function getFormat($format = 'html')
    {
        if($this->_query->has('format')) {
            $format = $this->_query->get('format', 'alpha');
        }

        return $format;
    }

    /**
     * Set the request format
     *
     * @param $format
     * @return KControllerRequest
     */
    public function setFormat($format)
    {
        $this->_query->set('format', $format);
        return $this;
    }

    /**
     * Implement a virtual 'headers', 'query' and 'data class property to return their respective objects.
     *
     * @param   string $name  The property name.
     * @return  mixed The property value.
     */
    public function __get($name)
    {
        $result = null;
        if($name == 'headers') {
            $result = $this->getHeaders();
        }

        if($name == 'query') {
            $result = $this->getQuery();
        }

        if($name == 'data') {
            $result =  $this->getData();
        }

        return $result;
    }

    /**
     * Deep clone of this instance
     *
     * @return void
     */
    public function __clone()
    {
        parent::__clone();

        $this->_data  = clone $this->_data;
        $this->_query = clone $this->_query;
    }
}