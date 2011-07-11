Drag times
==========

This is an application to allow users to sign up for an account. Add their car to a database. Then they can add their drag times, 60 ft, 1320 ft, reaction times etc.

The application will create some statistics of the information.

Requirements

  * Kohana 3.1 master
  * Media module
  * Database module
  * Auth module
  * ORM module


Installation

  1. git clone git://github.com/kohana/kohana.git website_name
  2. git checkout 3.1/master
  3. git rm -r application
  4. git submodule add git://github.com/birkir/drag.git application
  5. edit application/bootstrap.php for your needs
  6. chmod 0777 application/cache and application/logs
  7. git submodule --recursive --init update
