<?php  

/**
 * The Coffee Machine Class
 *
 * This the main abstract parent class and all coffee machines will extend off this 
 * class
 *
 * Assumptions:
 * 1. All machines need to be cleaned once they have made 500 cups of any drink.
 * 2. When a Coffee Machine is refilled all its ingredients are filled to their respective 100% Capacities.
 * 
 *
 * @category   CoffeeMachine
 * @author     Shadley Webtzel <shad6ster@gmail.com>
 * @license    MIT
 * @version    Release: 0.1
 */

class NeedCoffeeException extends Exception {}
class NeedWaterException extends Exception {}
class NeedMilkException extends Exception {}

abstract class CoffeeMachine
{
    protected $drinks;
    protected $description;

    protected $isDirty = false;

    public $coffeeCapacity;
    public $waterCapacity;  
    public $milkCapacity;
	public $coffeeLevel;
	public $waterLevel;	
	public $milkLevel;
	public $cleaningLevel = 500;
    public $usageLevel = 0;

    /**
     * Abstract Function to refill any one of the containers of a coffee machine
     *
     *
     * @return string $message
     */
    abstract function refill();

    /**
     * Abstract Function to return the number of coffees the machine can make given
     * the amount of ingredients left.
     *
     *
     * @return boolean If the machine needs to be cleaned
     */
    abstract function howManyCoffeesLeft();

    /**
     * Function to return the coffee capacity of a machine
     *
     *
     * @return int Coffee Capacity
     * @access public
     */
    public function getCoffeeCapacity(){
        return $this->coffeeCapacity;
    }

    /**
     * Function to return the Water capacity of a machine
     *
     *
     * @return int Coffee Capacity
     * @access public
     */
    public function getWaterCapacity(){
        return $this->waterCapacity;
    }

    /**
     * Function to return the Milk capacity of a machine
     *
     *
     * @return float Milk Capacity
     * @access public
     */
    public function getMilkCapacity(){
        return $this->milkCapacity;
    } 

    /**
     * Function to return all the drinks a specific machine can make
     *
     *
     * @return array All the drinks a machine can make
     * @access public
     */
    public function getDrinks(){
        return $this->drinks;
    } 

    /**
     * Function to check if a machine needs to be cleaned
     *
     *
     * @return boolean If the machine needs to be cleaned
     * @access public
     */
    public function doIsDirty(){
    	return ($this->usageLevel >= $this->cleaningLevel) || $this->isDirty ? true : false;
    }

    /**
     * Function to clean the coffee machine
     *
     * @access public
     * @return int Zero as no cups have been made
     */
    public function clean(){
        $this->isDirty = false;
    	$this->usageLevel = 0;
    	return $this->usageLevel;
    }

    /**
     * Function to return the number of cups left before the machine needs to be cleaned
     *
     * 
     * @return int The number of cups before this machine needs to be cleaned
     * @access public
     */
    public function getCleaningLevel(){
    	return $this->cleaningLevel;
    }

    /**
     * Function to return the number of cups left before the machine needs to be cleaned
     *
     * @param int The amount of cups before this machine needs to be cleaned
     * @return int The number of cups before this machine needs to be cleaned
     * @access public
     */
    public function setCleaningLevel($cleaningLevel){
        return $this->cleaningLevel = $cleaningLevel;
    }

    /**
     * Function to return the status of a coffee machine
     *
     *
     * @return string If succesful with return Ready and the amount of coffees that can be made. Else it returns
     *         any missing ingredients
     * @access public
     */
    public function getStatus(){
        if($this->isDirty) {
            return 'Please Clean me';
        }

        $results = array();

        if($this->coffeeLevel <= 0){
            $results[] =  'Add coffee';
        }

        if($this->waterLevel <= 0){
            $results[] =  'Add water';
        }

        if($this->milkCapacity > 0 && $this->milkCapacity <= 0){
            $results[] =  'Add milk';
        }

        if($this->coffeeLevel > 0 && $this->coffeeLevel <= (10 * $this->coffeeCapacity / 100 )) {
            $coffeesLeft = $this->howManyCoffeesLeft();
            $results[] =  "Coffee is low, I can make $coffeesLeft more cup(s)";
        }
   
        if($this->waterLevel > 0 && $this->waterLevel <= (10 * $this->waterCapacity / 100 )) {
            $coffeesLeft = $this->howManyCoffeesLeft();
            $results[] =  "Water is low, I can make $coffeesLeft more cup(s)";
        }

        if( $this->milkCapacity > 0 && ($this->milkLevel <= 0 && $this->milkLevel < (10 * $this->milkCapacity / 100 ))) {
            $coffeesLeft = $this->howManyCoffeesLeft();
            $results[] =  "Milk is low, I can make $coffeesLeft more cup(s)";
        }   

        if (count($results) == 0){
            $coffeesLeft = $this->howManyCoffeesLeft();
            return "ready, I can make $coffeesLeft more cup(s)"; 
        }else{
            return implode(" ", $results);;
        }
    }

    /**
     * Function to make to brew a coffee, this is sued
     * by all the underlying coffee types
     *
     * 
     * @return string $message If the drink was made
     * @access public
     */
    public function brew($coffeeUsed, $waterUsed, $milkUsed = 0){
    	
        if($this->coffeeLevel - $coffeeUsed < 0) {
            return  'The machine needs more coffee, please refill.';
        }

        if($this->waterLevel - $waterUsed < 0) {
            return  'The machine needs more water, please refill.';
        }

        if($this->milkLevel - $milkUsed < 0) {
            return  'The machine needs more milk, please refill.';
        }
        
        $this->coffeeLevel -= $coffeeUsed;
        $this->waterLevel -= $waterUsed;
        $this->milkLevel -= $milkUsed;

        // Increase the amount of cups made for the machine
    	$this->usageLevel += 1;  
        
    	// Check how dirty the machine is
    	if ($this->usageLevel >= $this->cleaningLevel){
    		$this->isDirty = true;
    	}

    	return $this->howManyCoffeesLeft();   
    }

    /**
     * Function to make an latte it uses the brew function with specfic variables
     * to make the required drink
     *
     * 
     * @return string The type of drink made
     * @access public
     */
    public function makeLatte(){

        if(!in_array('latte', $this->drinks)){
            return "I can't make Lattes, please choose another drink.";
        }

    	$howManyCupsLeft = $this->brew(2,0.1,0.3);
    	return "I made a Latte and you can make $howManyCupsLeft more";
    }

    /**
     * Function to make an esspresso it uses the brew function with specfic variables
     * to make the required drink
     *
     * 
     * @return string The type of drink made
     * @access public
     */
    public function makeEspresso(){

        if(!in_array('espresso', $this->drinks)){
            return "I can't make Espressos, please choose another drink.";
        }

    	$howManyCupsLeft = $this->brew(1,0.05);
    	return "I made a Espresso and you can make $howManyCupsLeft more";
    }

    /**
     * Function to make a double esspresso, it uses the brew function with specfic variables
     * to make the required drink
     *
     *
     * @return string The type of drink made
     * @access public
     */
    public function makeDoubleEspresso(){

        if(!in_array('double_espresso', $this->drinks)){
            return "I can't make Double Espressos, please choose another drink.";
        }

    	$howManyCupsLeft = $this->brew(2,0.1);
    	return "I made a Double Espresso and you can make $howManyCupsLeft more";
    }
}