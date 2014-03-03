<?php  

/**
 * The BCFM-9000 Machine Class extends the main CoffeeMachine and represents a specific type of
 * coffee machine and it makes all three drinks.
 *
 *
 * @category   CoffeeMachine
 * @author     Shadley Webtzel <shad6ster@gmail.com>
 * @license    MIT
 * @version    Release: 0.1
 */
class BCFMCoffeeMachine extends CoffeeMachine {

    /**
     * Constructor function for a small coffee machine, sets up the machine and sets the capacties
     *
     * @access public
     */
    public function __construct() {
      $this->coffeeCapacity = 100;
      $this->waterCapacity = 5.0; 
      $this->milkCapacity = 5.0;  

      // Set all ingredients level to capacity level, assunming when a new machine is created its filled
      $this->coffeeLevel = 100;
      $this->waterLevel = 5.0; 
      $this->milkLevel = 5.0;

      $this->description = "BCFM-9000";
      $this->drinks = array('espresso', 'double_espresso', 'latte');
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