#Prequire site

install mariadb

```
sudo apt install mariadb-server
```

configure a super user :

``` SQL
CREATE USER 'admin'@'%' IDENTIFIED BY 'YourSecuredPassword';
GRANT ALL PRIVILEGES ON *.* TO 'admin' WITH GRANT OPTION;
FLUSH PRIVILEGES;
EXIT;
```

configure a db using your database IDE, or directly the cli and a useradmin on this DB

``` SQL
CREATE DATABASE teama;
CREATE USER 'admin_teama'@'%' IDENTIFIED VIA mysql_native_password USING 'ipaQSzkOXdo99BNInyiq';
GRANT USAGE ON *.* TO 'admin_teama'@'%' REQUIRE NONE WITH MAX_QUERIES_PER_HOUR 0 MAX_CONNECTIONS_PER_HOUR 0 MAX_UPDATES_PER_HOUR 0 MAX_USER_CONNECTIONS 0;
GRANT ALL PRIVILEGES ON `teama`.* TO 'admin_teama'@'%';
```

apache installation
php module + phpmysql module

```
sudo apt install php php-mysql libapache2-mod-php
```

configure a new website for the wordpress instance by creating a conf file with following content : 

``` apacheconf
<IfModule mod_ssl.c>
        <VirtualHost teama.myhost.domain:443>
                    ServerAdmin webmaster@localhost
                    ServerName teama.myhost.domain
                    DocumentRoot /data/workspaces/nodecms/PHP/teama

                    Loglevel alert rewrite:trace6 proxy:trace6
                    ErrorLog ${APACHE_LOG_DIR}/team-error.log
                    CustomLog ${APACHE_LOG_DIR}/team-access.log combined

                    SSLEngine on

                    SSLCertificateFile      /etc/ssl/certs/server.crt
                    SSLCertificateKeyFile /etc/ssl/private/server.key

                    RewriteEngine on

                    <Directory /data/workspaces/nodecms/PHP/teama>
                        AllowOverride all
                        Require all granted
                        Options +FollowSymlinks -Indexes
                    </Directory>
                    <FilesMatch "\.(cgi|shtml|phtml|php)$">
                            SSLOptions +StdEnvVars
                    </FilesMatch>

                    <Directory /usr/lib/cgi-bin>
                            SSLOptions +StdEnvVars
                    </Directory>

            </VirtualHost>
</IfModule>
```

Check that the server name is accessible from a simple ping command, and if not, modify your host file

Install and Activate BuddyPress if needed



