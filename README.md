Voices web site
===============

This is the source of the Voices web site, in production at
http://voiceschapelhill.org.

Deploying the web site with no data
-----------------------------------

If you wanted to set up a new site, using the same configuration and theme, but
no data from the production site:

* Clone this repo somewhere, e.g. `/var/www/voices`, and check out the submodules too:

        $ cd /var/www
        $ git clone git@github.com:VoicesChapelHill/voices-site.git voices
        $ cd voices
        $ git submodule update --init --recursive

* Create a new MySQL database user and database to use for this site. If you need to create a new MySQL user and aren't familiar with that, [this post](https://codex.wordpress.org/Installing_WordPress#Using_the_MySQL_Client) may help, but here's a synopsis:

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

        define('DB_NAME', 'voiceschapelhill');
        define('DB_USER', 'voiceschapelhill');
        define('DB_PASSWORD', 'xxx');
        define('DB_HOST', 'localhost');
        define('DB_CHARSET', 'utf8');
        define('DB_COLLATE', '');
        $table_prefix  = 'wp_w9cv32_';


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
