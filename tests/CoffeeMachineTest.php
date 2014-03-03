<?php

/**
 * The Coffee Machine Unit Test
 *
 *
 * @category   CoffeeMachine
 * @author     Shadley Webtzel <shad6ster@gmail.com>
 * @license    MIT
 * @version    Release: 0.1
 */
class CoffeeMachineTest extends PHPUnit_Framework_TestCase
{

  /**
   * Test creating a small coffee machine with a 100 cup cleaning level
   */
  public function testCreate(){
    $coffeeMachine = new SmallCoffeeMachine();
    $cleaningLevel = 500;

    $this->assertEquals($cleaningLevel, $coffeeMachine->getCleaningLevel());

    return $coffeeMachine;
  }

  /**
   * Test to check the Make Latte function, as this machine can't make Lattes it should return 
   * a message stating that.
   * 
   * @depends testCreate
   */
  public function testRefill(CoffeeMachine $coffeeMachine) {
    $coffeeMachine->refill();

    $this->assertEquals($coffeeMachine->getCoffeeCapacity(), $coffeeMachine->coffeeLevel);
    $this->assertEquals($coffeeMachine->getWaterCapacity(), $coffeeMachine->waterLevel);
    $this->assertEquals($coffeeMachine->getMilkCapacity(), $coffeeMachine->milkLevel);
  }

  /**
   * Test to check the how manc cups of coffee a machine can make given that all ingredients are full
   * 
   * @depends testCreate
   */
  public function testHowManyCoffeesLeftFull(CoffeeMachine $coffeeMachine) {
    $this->assertEquals($coffeeMachine->getCoffeeCapacity(), $coffeeMachine->howManyCoffeesLeft());
  }

  /**
   * Test to check the how manc cups of coffee a machine can make given that all ingredients are at 50%
   * 
   * @depends testCreate
   */
  public function testHowManyCoffeesLeftHalf(CoffeeMachine $coffeeMachine) {
    $coffeeMachine->clean();
    $halfLevel = floor($coffeeMachine->howManyCoffeesLeft() / 2);

    // Make coffess so that all ingredients are at 50% levels
    for($i=0;$i<$halfLevel;$i++){
      $coffeeMachine->makeEspresso();
    }
     
    $this->assertEquals($halfLevel, $coffeeMachine->howManyCoffeesLeft());
  }

  /**
   * Test to check the status of a Coffee Machine when all the ingredients are at full levels
   * 
   * @depends testCreate
   */
  public function testStatusFull(CoffeeMachine $coffeeMachine) {
    $coffeeMachine->clean();
    $coffeeMachine->refill();

    $howManyCoffeesLeft = $coffeeMachine->howManyCoffeesLeft();
    $this->assertEquals("ready, I can make $howManyCoffeesLeft more cup(s)", $coffeeMachine->getStatus());
  }

  /**
   * Test to check the status of a Coffee Machine when it is dirty, we make a cup and then refill it
   * for testing purposes.
   *
   * @depends testCreate
   */
  public function testStatusDirty(CoffeeMachine $coffeeMachine) {
    for($i=1;$i<$coffeeMachine->getCleaningLevel() + 1;$i++){
      $coffeeMachine->makeEspresso();
      $coffeeMachine->refill();
    }

    $this->assertEquals("Please Clean me", $coffeeMachine->getStatus());
  }

  /**
   * Test to check the status of a Coffee Machine when there is not enough Water
   *
   * @depends testCreate
   */
  public function testStatusNoWater(CoffeeMachine $coffeeMachine) {
    $coffeeMachine->clean();
    $coffeeMachine->refill();
    $coffeeMachine->waterLevel = 0;

    $this->assertEquals("Add water", $coffeeMachine->getStatus());
  }

  /**
   * Test to check the status of a Coffee Machine when the water level is at less thatn 10%
   *
   * @depends testCreate
   */
  public function testStatusWaterLevelLow(CoffeeMachine $coffeeMachine) {
    $coffeeMachine->clean();
    $coffeeMachine->refill();
    $coffeeMachine->waterLevel = (10 * $coffeeMachine->waterCapacity) / 100 ;
    $howManyCoffeesLeft = $coffeeMachine->howManyCoffeesLeft();
    $this->assertEquals("Water is low, I can make $howManyCoffeesLeft more cup(s)", $coffeeMachine->getStatus());
  }

  /**
   * Test to check the status of a Coffee Machine when there is not enough Coffee
   *
   * @depends testCreate
   */
  public function testStatusNoCoffee(CoffeeMachine $coffeeMachine) {
    $coffeeMachine->clean();
    $coffeeMachine->refill();
    $coffeeMachine->coffeeLevel = 0;

    $this->assertEquals("Add coffee", $coffeeMachine->getStatus());
  }

  /**
   * Test to check the status of a Coffee Machine when the coffee level is at less thatn 10%
   *
   * @depends testCreate
   */
  public function testStatusCoffeeLevelLow(CoffeeMachine $coffeeMachine) {
    $coffeeMachine->clean();
    $coffeeMachine->refill();
    $coffeeMachine->coffeeLevel = 10 * $coffeeMachine->coffeeLevel / 100;
    $howManyCoffeesLeft = $coffeeMachine->howManyCoffeesLeft();
    $this->assertEquals("Coffee is low, I can make $howManyCoffeesLeft more cup(s)", $coffeeMachine->getStatus());
  }

}