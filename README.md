Voices web site
===============

This was a proposed new way to deploy the Voices web site
(http://voiceschapelhill.org). It was never used in
production.

I still think switching to this approach would be a good
idea.

Overview
--------

This is a WordPress site, with a custom theme, deployed a little differently
than the most common approach of just copying the WordPress code into the
site directory.

In this case, our site directory is under git version control, and the
WordPress code is in a subdirectory of that. There are also
some edits to the default `index.php` and `wp-config.php` so that this
layout will work, and also so that we can move the source and database
to sites with other hostnames (e.g. for testing and local development)
and not break due to WordPress typically embedding the site hostname in
its internal data.

Deploying the web site with no data
-----------------------------------

If you wanted to set up a new site, using the same configuration and theme, but
no data from the production site:

* Clone this repo somewhere - and please read these instructions carefully even
  if you're familiar with _git_ because these are not the standard way to do it.

  We want an uncommon thing:

  * Keep the git files outside the working tree, to make sure that no
    web server misconfiguration can accidentally expose our entire repo.

  So if you want to put the site files at `/var/www/voices`, do this:

        $ cd /var/www
        $ git clone --separate-git-dir=voices.git git@github.com:VoicesChapelHill/voices-site.git voices

  That will put the files that normally live under `.git` in your working tree
  at `voices.git` in the parent directory instead.

* Change into the new 'voices' directory

* Run './update.sh'.

  This will download the version of wordpress we're currently using (configured
  in the WORDPRESS.VERSION file) and unpack it under the voices directory.

* Create a new MySQL database user and database to use for this site. If you're on a hosting site like Dreamhost,  you can probably do that using their control panel. If you need to create a new MySQL user yourself and aren't familiar with that, [this post](https://codex.wordpress.org/Installing_WordPress#Using_the_MySQL_Client) may help, but here's a synopsis:

        $ mysql -u root -p
        Enter password:
        mysql> CREATE DATABASE voicesdb;
        mysql> CREATE USER 'username'@'localhost' IDENTIFIED BY 'plaintextpassword';
        mysql> GRANT ALL PRIVILEGES ON voicesdb.* TO "username"@"hostname";
        mysql> FLUSH PRIVILEGES;

* Create a file in the parent dir of the git working directory, named `hostname.secrets.php`,
  where `hostname` is the hostname your site will be accessed with. E.g. if you're going
  to run it at `local.voiceschapelhill.org` and it's at `/var/www/voices`, create
  `/var/www/local.voiceschapelhill.org.secrets.php`
* The file should contain something like:

        <?php

        define('DB_NAME', 'voiceschapelhill');  /* change to your database name */
        define('DB_USER', 'voiceschapelhill');  /* change to your database user */
        define('DB_PASSWORD', 'xxx');   /* change to your database user's password */
        define('DB_HOST', 'localhost');
        define('DB_CHARSET', 'utf8');
        define('DB_COLLATE', '');
        $table_prefix  = 'wp_w9cv32_';  /* this can be anything */


        /**#@+
         * Authentication Unique Keys and Salts.
         *
         * Change these to different unique phrases!
         * You can generate these using the {@link https://api.wordpress.org/secret-key/1.1/salt/ WordPress.org secret-key service}
         * You can change these at any point in time to invalidate all existing cookies. This will force all users to have to log in again.
         *
         * @since 2.6.0
         */
        define('AUTH_KEY',         'xxx');
        define('SECURE_AUTH_KEY',  'xxx');
        define('LOGGED_IN_KEY',    'xxx');
        define('NONCE_KEY',        'xxx');
        define('AUTH_SALT',        'xxx');
        define('SECURE_AUTH_SALT', 'xxx');
        define('LOGGED_IN_SALT',   'xxx');
        define('NONCE_SALT',       'xxx');

* Arrange for `/var/www/voices` to be served as a PHP site, including making sure the whole tree
  is readable by the web server.
* Now visit the site, and WordPress should prompt you to finish the installation
  and setup.

Cloning an existing site
------------------------

If you want to set up a new site with the same data from an existing site.

* Follow the instructions above, with a few changes:
* Make sure `$table_prefix` in your secrets file is set the same as from
  the site you're cloning.
* After cloning the git repo, populate `wp-content/uploads` with the contents
  of the same directory from the existing site.
* After creating the database, restore a backup of the database from the
  existing site into your new database. Something like this:

        $ bunzip2 <voices-YYYYMMDD.sql.bz2 | mysql -u username -p voicesdb

* That ought to do it.

Upgrading WordPress
-------------------

* Make a fresh backup of your database! If the upgrade goes wrong, you can
  easily backoff the source changes, but if they've made changes to your
  database, the only way to recover will be restoring a backup.  So make
  sure you have a fresh one.
* Edit 'WORDPRESS.VERSION' and change it to the new version number.
* Run './update.sh'
* commit the changes and push

        $ git add wordpress
        $ git commit -am "Upgrade wordpress to 3.9.1"
        $ git push

* Visit the wordpress admin. If any database migrations are needed, it'll
  walk you through them.

* If anything doesn't work, you can always backup to a working version
  of wordpress. If the upgrade changed your database, you'll have to restore
  your database backup. Which you made at the beginning of doing this, right? :-)
