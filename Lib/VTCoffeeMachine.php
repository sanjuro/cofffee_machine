<?php  

/**
 * The VT-1100 Machine Class extends the main CoffeeMachine and represents a specific type of
 * coffee machine and it doesn't make double espressos.
 *
 * 1. As no Milk Capacity was given for the VT-1100, based on the milk capacity of the other machines I am 
 *    assuming a useage of 1.67. As this machine can make a Latte it will need to store milk.
 *
 * @category   CoffeeMachine
 * @author     Shadley Webtzel <shad6ster@gmail.com>
 * @license    MIT
 * @version    Release: 0.1
 */
class VTCoffeeMachine extends CoffeeMachine {

    /**
     * Constructor function for a small coffee machine, sets up the machine and sets the capacties
     *
     *
     * @access public
     */
    public function __construct() {
      $this->coffeeCapacity = 30;
      $this->waterCapacity = 2.0; 
      $this->milkCapacity = 1.67; 

      // Set all ingredients level to capacity level, assunming when a new machine is created its filled
      $this->coffeeLevel = 30;
      $this->waterLevel = 2.0; 
      $this->milkLevel = 1.67;

      $this->description = "VT-1100";
      $this->drinks = array('espresso', 'latte');
    }

    /**
     * Function to refill all ingredients
     *
     *
     * @return boolean Returns true if the refill was successful
     * @access public
     */
    public function refill(){
      $this->coffeeLevel = $this->coffeeCapacity;
      $this->waterLevel = $this->waterCapacity; 
      $this->milkLevel = $this->milkCapacity; 

      return true;
    }

    /**
     * Function to estimate how many coffees left, this is based on the average 
     * use of ingredients per cup on the lowest consuming item and is machine specific.
     *
     *
     * @return int The number of cups a machine can make based on the amount of ingredients it has left
     * @access public
     */
    public function howManyCoffeesLeft(){
      $averageMilkUsed = 0.0;

      $averageWaterUsed = floor($averageBasedonWater = $this->waterLevel / 0.05);
      $averageCoffeeUsed = $this->coffeeLevel;

      return min($averageWaterUsed, $averageCoffeeUsed);
    }
}