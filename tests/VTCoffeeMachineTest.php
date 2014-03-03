<?php

/**
 * The Small Coffee Machine Unit Test
 *
 *
 * @category   CoffeeMachine
 * @author     Shadley Webtzel <shad6ster@gmail.com>
 * @license    MIT
 * @version    Release: 0.1
 */
class VTCoffeeMachineTest extends PHPUnit_Framework_TestCase
{
  /**
   * Test creating a small coffee machine with a 100 cup cleaning level
   *
   */
  public function testCreate() {
    $coffeeMachine = new VTCoffeeMachine();
    $this->assertEquals(500, $coffeeMachine->getCleaningLevel());

    return $coffeeMachine;
  }

  /**
   * Test to check the Make Espresso function, as this machine can't make Lattes it should return 
   * a message stating that.
   *
   * @depends testCreate
   */
  public function testMakeEspresso(CoffeeMachine $coffeeMachine) {
    $machineMessage = $coffeeMachine->makeEspresso();
    $cupsLeft = $coffeeMachine->howManyCoffeesLeft();

    $this->assertEquals("I made a Espresso and you can make $cupsLeft more", $machineMessage);
  } 

  /**
   * Test to check the Make Double Espresso function, as this machine can't make Lattes it should return 
   * a message stating that.
   *
   * @depends testCreate
   */
  public function testMakeDoubleEspresso(CoffeeMachine $coffeeMachine) {
    $machineMessage = $coffeeMachine->makeDoubleEspresso();

    $this->assertEquals("I can't make Double Espressos, please choose another drink.", $machineMessage);
  } 

  /**
   * Test to check the Make Latte function, as this machine can't make Lattes it should return 
   * a message stating that.
   *
   * @depends testCreate
   */
  public function testMakeLatte(CoffeeMachine $coffeeMachine) {
    $machineMessage = $coffeeMachine->makeLatte();
    $cupsLeft = $coffeeMachine->howManyCoffeesLeft();

    $this->assertEquals("I made a Latte and you can make $cupsLeft more", $machineMessage);
  } 
}