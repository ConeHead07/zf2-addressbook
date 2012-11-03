zf2-addressbook
===============

A simple address book on zf2 based on the [akrabat tutorial](http://akrabat.com/zend-framework-2-tutorial/ "Getting started with Zend Framework 2 beta"). Updated to ZF2 beta5

This is now obsolete. It was based on ZF2 beta 5 and a lot has changed since then. I may update this in future.


Database
--------

  CREATE TABLE 'contact' (
    'id' int(11) unsigned NOT NULL AUTO_INCREMENT,
    'forename' varchar(255) CHARACTER SET utf8 COLLATE utf8_unicode_ci DEFAULT NULL,
    'surname' varchar(255) CHARACTER SET utf8 COLLATE utf8_unicode_ci DEFAULT NULL,
    'nickname' varchar(255) CHARACTER SET utf8 COLLATE utf8_unicode_ci DEFAULT NULL,
    'category' varchar(255) CHARACTER SET utf8 COLLATE utf8_unicode_ci DEFAULT NULL,
    PRIMARY KEY ('id')
  ) ENGINE=InnoDB AUTO_INCREMENT=3 DEFAULT CHARSET=latin1


