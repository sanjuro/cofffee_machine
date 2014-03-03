<?php

/**
 * The CoffeeStore Unit Test
 *
 *
 * @category   CoffeeStore
 * @author     Shadley Webtzel <shad6ster@gmail.com>
 * @license    MIT
 * @version    Release: 0.1
 */
class CoffeeStoreTest extends PHPUnit_Framework_TestCase
{

  /**
   * Test creating a coffee store should have zero machines
   */
  public function testCreate()
  {
    $coffeeStore = new CoffeeStore();
    $this->assertEquals(0, $coffeeStore->getMachineTotal());
  }

  /**
   * Test creating a coffee store should have zero machines
   */
  public function testaddMachine()
  {
    $coffeeStore = new CoffeeStore();
    $coffeeStore->addMachine(new SmallCoffeeMachine());
    $this->assertEquals(1, $coffeeStore->getMachineTotal());
  }

  /**
   * Test the search function of the class
   */
  public function testSearch()
  {
    $coffeeStore = new CoffeeStore();
    $coffeeStore->addMachine(new SmallCoffeeMachine());
    $coffeeStore->addMachine(new SmallCoffeeMachine());
    $coffeeStore->addMachine(new VTCoffeeMachine());
 
    // Defining a closure that will search for a specific type of coffee machine
    $criteria =
    function ($coffeMachine)
    {   
        if(get_class($coffeMachine) == 'SmallCoffeeMachine'){
          return true;
        }else{
          return false;
        }
    };

    $search_results = $coffeeStore->search($criteria);
    $this->assertEquals(2, count($search_results));
  }

  /**
   * Test the search function of the class with no results
   */
  public function testSearchNoResults()
  {
    $coffeeStore = new CoffeeStore();
    $coffeeStore->addMachine(new VTCoffeeMachine());
    $coffeeStore->addMachine(new BCFMCoffeeMachine());
    $coffeeStore->addMachine(new VTCoffeeMachine());
 
    // Defining a closure that will search for a specific type of coffee machine
    $criteria =
    function ($coffeMachine)
    {   
        if(get_class($coffeMachine) == 'SmallCoffeeMachine'){
          return true;
        }else{
          return false;
        }
    };

    $search_results = $coffeeStore->search($criteria);
    $this->assertEquals(0, count($search_results));
  }

}