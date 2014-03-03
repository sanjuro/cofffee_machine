<?php
 

require 'Lib/CoffeeMachine.php';
require 'Lib/SmallCoffeeMachine.php';

session_start();

if(!isset($_SESSION['coffeeMachine']) || empty($_SESSION['coffeeMachine'])){
	$coffeeMachine = new SmallCoffeeMachine();
}else{
	$coffeeMachine = $_SESSION['coffeeMachine'];
}

if(isset($_GET['do'])){
 	if($_GET['do'] == 'espresso'){
 		$coffeeMachine->makeEspresso();
 	}elseif ($_GET['do'] == 'double_espresso'){
 		$coffeeMachine->makeDoubleEspresso();
 	}elseif ($_GET['do'] == 'latte'){
 		$coffeeMachine->makeLatte();
 	}elseif ($_GET['do'] == 'refill'){
 		$coffeeMachine->refill();
 		$message  = 'Refilled Machine';
 	}elseif ($_GET['do'] == 'clean'){
 		$coffeeMachine->clean();
 		$message  = 'Cleaned Machine';
 	}else{

 	}
 	
 	$_SESSION['coffeeMachine'] = $coffeeMachine;
}
print_r($_SESSION['coffeeMachine']);
?>
<!DOCTYPE HTML>

 <html lang="en">
    <head>

    </head>
    <body>
    	<h1>The Small Coffee Machine</h1>
    	<h2>
    		Status: <?php echo $coffeeMachine->getStatus(); ?>

			<?php if ($coffeeMachine->getStatus() == 'Add coffee'): ?>
    			<a href="makecoffee.php?do=refill">Add.</a>
			<?php elseif ($coffeeMachine->getStatus() == 'Add water'): ?>
    			<a href="makecoffee.php?do=refill">Add .</a>
			<?php elseif ($coffeeMachine->getStatus() == 'Add milk'): ?>
    			<a href="makecoffee.php?do=refill">Add.</a>
			<?php elseif ($coffeeMachine->getStatus() == 'Please Clean me'): ?>
    			<a href="makecoffee.php?do=clean">Clean.</a>
    		<?php endif; ?>

    	</h2>
    	<?php if (!empty($message)): ?>
    		<h3><?php echo $message ?></h3>
    	<?php endif; ?>
    	<p>
    		Cups Made: <?php echo $coffeeMachine->usageLevel ?><br>
    		Coffee Level: <?php echo $coffeeMachine->coffeeLevel ?> shots<br>
    		Water Level: <?php echo $coffeeMachine->waterLevel ?> litres<br>
    		Milk Level: <?php echo $coffeeMachine->milkLevel ?> litres<br>
    	</p>
    	<p>
    		<h2>What would you like?</h2>
    		<?php foreach ($coffeeMachine->getDrinks() as $drink ): ?>
    			<h3>
    			<?php if ($drink == 'espresso'): ?>
	    			<a href="makecoffee.php?do=espresso">I would like an Espresso.</a>
    			<?php elseif ($drink == 'double_espresso'): ?>
	    			<a href="makecoffee.php?do=double_espresso">I would like a Double Espresso.</a>
    			<?php elseif ($drink == 'latte'): ?>
	    			<a href="makecoffee.php?do=latte">I would like a Latte.</a>
	    		<?php endif; ?>
    			</h3>
    		<?php endforeach; ?>
    	</p>
    </body>
</html>