jRedBean
===========

A simple way to use RedBean ORM in your Joomla application.

Before using the R Facade, simple call up:

    jR::create();

Which sets up your database with joomla $app credentials. After that, use

    jR::context('componentname');

To switch the database to use the database prefix plus an underscore and your component name.

Then, simply use the R Facade as you're used - making sure to switch contexts should you switch between components.
