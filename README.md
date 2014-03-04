Cofffee Machine
===============

Introduction
------------
This is a simple coffee machine. 

Answers 1 - 6 of the PHP / OOP sections are found in the Lib folder and the makecoffee.php file.

Ansers to the DB questions are in the file named database_questions.php.

Assumptions
------------

 1. All machines need to be cleaned once they have made 500 cups of any drink.
 2. When a Coffee Machine is refilled all its ingredients are filled to their respective 100% Capacities.
 3. As no Milk Capacity was given for the VT-1100, based on the milk capacity of the other machines I am 
    assuming a useage of 1.67. As this machine can make a Latte it will need to store milk.

 Also see the Errors.md file for further errors picked up.

Installation
------------

    git clone git://github.com/sanjuro/cofffee_machine
    cd cofffee_machine
    Run php -S 127.0.0.1:8000
    Open a Browser and goto http://127.0.0.1:8000/makecoffee.php