Cofffee Machine
===============

Introduction
------------
This is a simple coffee machine

Assumptions
------------

 1. All machines need to be cleaned once they have made 500 cups of any drink.
 2. When a Coffee Machine is refilled all its ingredients are filled to their respective 100% Capacities.
 3. As no Milk Capacity was given for the VT-1100, based on the milk capacity of the other machines I am 
    assuming a useage of 1.67. As this machine can make a Latte it will need to store milk.

 Also see the Errors.md file for further errors picked up.

Installation
------------

    cd my/project/dir
    git clone git://github.com/sanjuro/ambition
    cd ambition
    php composer.phar self-update
    php composer.phar install
    Run the data/ambition_2014-02-26.sql, this will setup your DB.
    Update the ZF install and up the configs with your DB credentials.


Web Server Setup
----------------

### PHP CLI Server


	cd my/project/ <-- must be in this directory
    php -S 127.0.0.1:8000

This will start the cli-server on port 8000, and bind it to all network
interfaces.


Open a Browser and goto http://127.0.0.1:8000/makecoffee.php