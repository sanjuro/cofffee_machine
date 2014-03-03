<?php

/**
 * The Coffee Store, this class stores can store a group of Coffee Machine Objects and
 * provides funcitons to utilize this store be it for searching or otherwise.
 *
 *
 * @category   CoffeeMachine, CoffeeStore
 * @author     Shadley Webtzel <shad6ster@gmail.com>
 * @license    MIT
 * @version    Release: 0.1
 */
class CoffeeStore {

    public $coffeeMachines = array();
    private $machineTotal;

    /**
     * Constructor function for a small coffee machine, sets up the machine and sets the capacties
     *
     *
     * @access public
     */
    public function __construct() {
      $this->machineTotal = 0;
    }

    /**
     * Function to return the amount of Coffee Machines in the Store
     *
     * @return int $machineTotal the amount of machines in the store
     * @access public
     */
    public function getMachineTotal() {
      return $this->machineTotal;
    }

    /**
     * Function to set the amount of Coffee Machines in the Store
     *
     * @param int $machineTotal the new total of coffee machines
     * @return 
     * @access public
     */
    public function setMachineTotal($machineTotal) {
      $this->machineTotal = $machineTotal;
    }

    /**
     * Function to add a CoffeeMachine object to the Coffee Store
     *
     * @param CoffeeMachine $coffeeMachine the coffee mchaine object to store
     * @return int Total count of Coffee Machines in the Coffee Store
     * @access public
     */
    public function addMachine(CoffeeMachine $coffeeMachine) {
      $this->setMachineTotal($this->getMachineTotal() + 1);
      $this->coffeeMachines[$this->getMachineTotal()] = $coffeeMachine;
      return $this->getMachineTotal();
    }

    /**
     * Function to search a store of Coffee Machines using a defined function
     *
     * @param closure $callback a caller defined function that will be used to search the machines
     * @return CoffeeStore Returns a CoffeeStore of all the machines with in 
     *         the parent CoffeeStore object that match the criteria
     * @access public
     */
    public function search($criteria) {   

        $results = array();
        foreach($this->coffeeMachines as $coffeeMachine){
            if ($criteria($coffeeMachine)){
                $results[] = $coffeeMachine;
            }       
        } 

        return $results;
    }

}