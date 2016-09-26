# LCF #

Wordpress environment

* institutional website
* 1.0
* makingsense - freerange

## Getting started

Prepare the local site:

* xampp / wamp
* mysql (optional phpmyadmin)
* generate database with the name `lcf`
* import database from `./db/lcf.sql`
* rename `./example-wp-config.php` to `./wp-config.php`
* modify the follow file `./wp-config.php`
* DB_USER: [your_local_db_user] 
* DB_PASSWORD: [your_local_db_password]

Prepare UI environment for integration (if you are using MSUIF):

* $ wp-content/themes/twentysixteen
* clone ecb-ui => TBD
* this folder wouldn't  be add to this current repo. We have a git ingore to avoid upload this code.
* to imapct the changes in the webpage, we can move manually the folders and files, or modify the grunt or gulp task to move automatically those changes.

