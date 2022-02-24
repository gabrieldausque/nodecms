## Prerequire site :

install following php module

sudo apt install php-mysql php-xml

## Apache conf file :

``` apacheconf

<IfModule mod_ssl.c>
        <VirtualHost frontend.myhost.domain:443>
                ServerAdmin webmaster@localhost

                DocumentRoot /mnt/e/workspaces/nodecms/PHP/joomla-teama

                Loglevel alert rewrite:trace6 proxy:trace6
                ErrorLog ${APACHE_LOG_DIR}/error.log
                CustomLog ${APACHE_LOG_DIR}/access.log combined

                SSLEngine on

                SSLCertificateFile      /etc/ssl/certs/server.crt
                SSLCertificateKeyFile /etc/ssl/private/server.key

                RewriteEngine on

                <FilesMatch "\.(cgi|shtml|phtml|php)$">
                        SSLOptions +StdEnvVars
                </FilesMatch>

                <Directory /usr/lib/cgi-bin>
                        SSLOptions +StdEnvVars
                </Directory>

                <Directory /mnt/e/workspaces/nodecms/PHP/joomla-teama>
                        require all granted
                        Options -Indexes +FollowSymLinks
                        AllowOverride All
                </Directory>
            </VirtualHost>
</IfModule>

```

modification of php.ini

upload_tmp_dir=/tmp
post_max_size = 1G
upload_max_filesize = 1G


