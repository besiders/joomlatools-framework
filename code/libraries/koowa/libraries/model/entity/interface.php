<?php
/**
 * Koowa Framework - http://developer.joomlatools.com/koowa
 *
 * @copyright	Copyright (C) 2007 - 2014 Johan Janssens and Timble CVBA. (http://www.timble.net)
 * @license		GNU GPLv3 <http://www.gnu.org/licenses/gpl.html>
 * @link		http://github.com/joomlatools/koowa for the canonical source repository
 */

/**
 * Model Entity Interface
 *
 * @author  Johan Janssens <https://github.com/johanjanssens>
 * @package Koowa\Library\Model
 */
interface KModelEntityInterface extends IteratorAggregate, ArrayAccess, Serializable, Countable
{
    /**
     * Entity States
     */
    const STATUS_LOADED   = 'loaded';
    const STATUS_DELETED  = 'deleted';
    const STATUS_CREATED  = 'created';
    const STATUS_UPDATED  = 'updated';
    const STATUS_FAILED   = 'failed';

    /**
     * Saves the to the data store
     *
     * This performs an intelligent insert/update and reloads the properties
     * with fresh data from the table on success.
     *
     * @return KModelEntityInterface
     */
    //public function save();

    /**
     * Deletes the entity form the data store
     *
     * @return KModelEntityInterface
     */
    //public function delete();

    /**
     * Resets to the entity to it's default properties
     *
     * @return KModelEntityInterface
     */
    //public function reset();

    /**
     * Get the entity key
     *
     * @return string
     */
    public function getIdentityKey();

    /**
     * Get a property
     *
     * @param   string  $name The property name.
     * @return  mixed   The property value.
     */
    //public function getProperty($name);

    /**
     * Set a property
     *
     * If the value is the same as the current value and the entity is loaded from the data store the value will not be
     * reset. If the entity is new the value will be (re)set and marked as modified
     *
     * @param   string  $name       The property name.
     * @param   mixed   $value      The property value.
     * @param   boolean $modified   If TRUE, update the modified information for the property
     *
     * @return  KModelEntityInterface
     */
    //public function setProperty($name, $value, $modified = true);

    /**
     * Test existence of a property
     *
     * @param  string  $name The property name.
     * @return boolean
     */
    //public function hasProperty($name);

    /**
     * Remove a property
     *
     * @param   string  $name The property name.
     * @return  KModelEntityInterface
     */
    //public function removeProperty($name);

    /**
     * Get the properties
     *
     * @param   boolean  $modified If TRUE, only return the modified data.
     * @return  array   An associative array of entity properties
     */
    //public function getProperties($modified = false);

    /**
     * Set the properties
     *
     * @param   mixed   $properties  Either and associative array, an object or a KModelEntityInterface
     * @param   boolean $modified    If TRUE, update the modified information for each column being set.
     * @return  KModelEntityInterface
     */
    //public function setProperties($properties, $modified = true);

    /**
     * Get a list of the computed properties
     *
     * @return array An array
     */
    //public function getComputedProperties();

    /**
     * Returns the status.
     *
     * @return string The status value.
     */
    //public function getStatus();
    
    /**
     * Set the status
     *
     * @param   string|null $status The status value or NULL to reset the status
     * @return  KModelEntityInterface
     */
    //public function setStatus($status);
    
    /**
     * Returns the status message
     *
     * @return string The status message
     */
    //public function getStatusMessage();
    
    /**
     * Set the status message
     *
     * @param   string $message The status message
     * @return  KModelEntityInterface
     */
    //public function setStatusMessage($message);

    /**
     * Checks if the entity is new or not
     *
     * @return bool
     */
    //public function isNew();

    /**
     * Check if the entity or specific entity property has been modified.
     *
     * If a specific property name is giving method will return TRUE only if this property was modified.
     *
     * @param   string $property The property name
     * @return  boolean
     */
    //public function isModified($property = null);

	/**
	 * Test if the entity is connected to a data store
	 *
	 * @return	bool
	 */
    //public function isConnected();
}