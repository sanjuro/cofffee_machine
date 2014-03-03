<?php  

/**
 * The Small Coffee Machine Class extends the main CoffeeMachine and represents a specific type of
 * coffee machine
 *
 *
 * @category   CoffeeMachine
 * @author     Shadley Webtzel <shad6ster@gmail.com>
 * @license    MIT
 * @version    Release: 0.1
 */
class SmallCoffeeMachine extends CoffeeMachine {

    /**
     * Constructor function for a small coffee machine, sets up the machine and sets the capacties
     *
     *
     * @return string $message
     * @access public
     */
    public function __construct() {
      $this->coffeeCapacity = 50;
      $this->waterCapacity = 3.0; 
      $this->milkCapacity = 0.0; 

      // Set all ingredients level to capacity level, assunming when a new machine is created its filled
      $this->coffeeLevel = 50;
      $this->waterLevel = 3.0; 
      $this->milkLevel = 0.0;

      $this->description = "Small Coffee Machine";
      $this->drinks = array('espresso', 'double_espresso');
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