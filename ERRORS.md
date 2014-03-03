Errors
===============

PHP/OOP
------------

1. The capacity list for the VT­1100 Machine is incorrect, this machine can make Lattes and so will require milk
capactiy. It is stated as not having a milk capacity.

Databaes
------------

1. In the product table, the values are incorrectly set. If you refer to the base specification, you will see that:

Espresso - 1 Coffee, 0.05l water, 0.0L milk 
Double Espresso - 2 Coffee, 0.1l water, 0.0L milk 
Late - 2 Coffee, 0.1l water, 0.3L milk 

Also if a single espresso takes 0,05l water to make then a double espresso should theoritically need twice as much water and twice as much coffee.

2. In the CoffeeMachineModels table the milk_cap value is incorrect as it is null, as stated in a previous pooint this machine can make Lattes and so will need to store milk.