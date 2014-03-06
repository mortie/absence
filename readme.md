Absence
=======

This is a web service for logging who is adsent from meetings.

Installation
============

To install Absence, simply do this command on any system with git installed:

`git clone github.com/mortie/absence.git`

Absence is intended to be installed to a directory inaccessible from the outside. For instance, you may install it to /var/www/absence, but make sure that directory is not inaccessible. If `/var/www/absence` is accessible from the outside, *your server will be jeopardized*.

The `public` directory should be accessible, however. If you install Absence to /var/www/absence, make sure /var/www/absence/public is accessible, and the root web directory. This is easy to achieve in most web servers. In Apache for instance, you should use VirtualHosts to direct a domain (or subdomain) to Absence's `public` directory.

To update, simply go to the directory you installed Absence to and run:

`git pull`

TL;DR
-----

`cd [directory]; git clone github.com/mortie/absence.git` to install Absence.

Make sure `[directory]` is inaccessible from the outside, and `[directory]/public` is accessible. Otherwise your server will die.

Dependencies
============

Absence has these dependencies:

 * PHP (with MySQLi)
 * MySQL
 * A web server which can use PHP
