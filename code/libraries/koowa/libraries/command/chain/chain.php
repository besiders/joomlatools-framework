<?php
/**
 * Koowa Framework - http://developer.joomlatools.com/koowa
 *
 * @copyright	Copyright (C) 2007 - 2013 Johan Janssens and Timble CVBA. (http://www.timble.net)
 * @license		GNU GPLv3 <http://www.gnu.org/licenses/gpl.html>
 * @link		http://github.com/joomlatools/koowa for the canonical source repository
 */

/**
 * Command Chain
 *
 * The command queue implements a double linked list. The command handle is used as the key. Each command can have a
 * priority, default priority is 3 The queue is ordered by priority, commands with a higher priority are called first.
 *
 * @author  Johan Janssens <https://github.com/johanjanssens>
 * @package Koowa\Library\Command
 */
class KCommandChain extends KObjectQueue implements KCommandChainInterface
{
    /**
     * Enabled status of the chain
     *
     * @var boolean
     */
    protected $_enabled = true;

    /**
     * The chain's break condition
     *
     * @see run()
     * @var boolean
     */
    protected $_break_condition = false;

    /**
     * The command context object
     *
     * @var KCommandContext
     */
    protected $_context = null;

    /**
     * The chain stack
     *
     * @var    KObjectStack
     */
    protected $_stack;

    /**
     * Constructor
     *
     * @param KObjectConfig|null $config  An optional KObjectConfig object with configuration options
     * @return KCommandChain
     */
    public function __construct(KObjectConfig $config = null)
    {
		//If no config is passed create it
        if(!isset($config)) $config = new KObjectConfig();
    	
        parent::__construct($config);

        $this->_break_condition = (boolean)$config->break_condition;
        $this->_enabled = (boolean)$config->enabled;
        $this->_context = $config->context;
        $this->_stack   = $config->stack;
    }

    /**
     * Initializes the options for the object
     *
     * Called from {@link __construct()} as a first step of object instantiation.
     *
     * @param   KObjectConfig $config Configuration options
     * @return  void
     */
    protected function _initialize(KObjectConfig $config)
    {
        $config->append(array(
            'stack'     => $this->getObject('koowa:object.stack'),
            'context'   => new KCommandContext(),
            'enabled'   => true,
            'break_condition' => false,
        ));

        parent::_initialize($config);
    }

    /**
     * Attach a command to the chain
     *
     * The priority parameter can be used to override the command priority while enqueueing the command.
     *
     * @param   KObjectHandlable   $command
     * @param   integer            $priority The command priority, usually between 1 (high priority) and 5 (lowest),
     *                                        default is 3. If no priority is set, the command priority will be used
     *                                        instead.
     * @return KCommandChain
     * @throws \InvalidArgumentException if the object does not implement KCommandInterface
     */
    public function enqueue(KObjectHandlable $command, $priority = null)
    {
        if (!$command instanceof KCommandInterface) {
            throw new InvalidArgumentException('Command needs to implement KCommandInterface');
        }

        $priority = is_int($priority) ? $priority : $command->getPriority();
        return parent::enqueue($command, $priority);
    }

    /**
     * Removes a command from the queue
     *
     * @param   KObjectHandlable $command
     * @return  boolean    TRUE on success FALSE on failure
     * @throws  \InvalidArgumentException if the object does not implement KCommandInterface
     */
    public function dequeue(KObjectHandlable $command)
    {
        if (!$command instanceof KCommandInterface) {
            throw new InvalidArgumentException('Command needs to implement KCommandInterface');
        }

        return parent::dequeue($command);
    }

    /**
     * Check if the queue does contain a given object
     *
     * @param  KObjectHandlable $command
     * @return bool
     * @throws  \InvalidArgumentException if the object does not implement KCommandInterface
     */
    public function contains(KObjectHandlable $command)
    {
        if (!$command instanceof KCommandInterface) {
            throw new InvalidArgumentException('Command needs to implement KCommandInterface');
        }

        return parent::contains($command);
    }

    /**
     * Run the commands in the chain
     *
     * If a command returns the 'break condition' the executing is halted.
     *
     * @param   string          $name
     * @param   KCommandContext $context
     * @return  void|boolean    If the chain breaks, returns the break condition. Default returns void.
     */
    public function run($name, KCommandContext $context)
    {
        if ($this->_enabled)
        {
            $this->getStack()->push(clone $this);

            foreach ($this->getStack()->top() as $command)
            {
                if ($command->execute($name, $context) === $this->_break_condition)
                {
                    $this->getStack()->pop();
                    return $this->_break_condition;
                }
            }

            $this->getStack()->pop();
        }
    }

    /**
     * Enable the chain
     *
     * @return  KCommandChain
     */
    public function enable()
    {
        $this->_enabled = true;

        return $this;
    }

    /**
     * Disable the chain
     *
     * If the chain is disabled running the chain will always return TRUE
     *
     * @return  KCommandChain
     */
    public function disable()
    {
        $this->_enabled = false;

        return $this;
    }

    /**
     * Set the priority of a command
     *
     * @param KObjectHandlable  $command
     * @param integer           $priority
     * @return KCommandChain
     * @throws \InvalidArgumentException if the object doesn't implement KCommandInterface
     */
    public function setPriority(KObjectHandlable $command, $priority)
    {
        if (!$command instanceof KCommandInterface) {
            throw new InvalidArgumentException('Command needs to implement KCommandInterface');
        }

        return parent::setPriority($command, $priority);
    }

    /**
     * Get the priority of a command
     *
     * @param  KObjectHandlable $command
     * @return integer The command priority
     * @throws \InvalidArgumentException if the object doesn't implement KCommandInterface
     */
    public function getPriority(KObjectHandlable $command)
    {
        if (!$command instanceof KCommandInterface) {
            throw new InvalidArgumentException('Command needs to implement KCommandInterface');
        }

        return parent::getPriority($command);
    }

    /**
     * Factory method for a command context.
     *
     * @return  KCommandContext
     */
    public function getContext()
    {
        return clone $this->_context;
    }

    /**
     * Get the chain object stack
     *
     * @return     KObjectStack
     */
    public function getStack()
    {
        return $this->_stack;
    }
}