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
  3. git submodule init
  4. git submodule update
  5. git rm -r application
  6. git submodule add git://github.com/birkir/drag.git application
  7. cd application
  8. git submodule init && git submodule update
  9. edit bootstrap.php for your needs
  10. chmod 0777 cache and logs
