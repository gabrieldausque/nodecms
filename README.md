# BEFORE DEV

## Install docker 

See [https://docs.docker.com/engine/install/ubuntu/](https://docs.docker.com/engine/install/ubuntu/)

## Install docker compose

## Install mongo client 

## Install mongodb with docker compose

cf backend docker_mongodbbackend.yaml

## Create uploads directory

Create uploads directory under <project root>\packages\backend.

## etc/host modification

add/modify this line in /etc/hosts
127.0.1.1       <your localhost name> frontend.myhost.domain:

## Apache configuration : 

### activate modules

```
a2enmod ssl rewrite proxy proxy_http proxy_wstunnel  
```

### create a certificate : 

in ~/ssl

create private key 
sudo openssl genrsa -out privkey.pem 4096
sudo openssl rsa -in privkey.pem -out new.cert.key

create conf file cert-request.conf for csr
```
[ req ]
prompt = no
distinguished_name = dn
req_extensions = req_ext

[ dn ]
CN = myhost.domain
emailAddress = gabrieldausque.pro@gmail.com
O = gabriel.dausque
OU = Ile de France
L = Soisy
ST = France 
C = FR

[req_ext]
subjectAltName = DNS:frontend.myhost.domain , DNS:backend.myhost.domain , IP:127.0.0.1
```

sudo openssl req -new -key new.cert.key -out new.cert.csr -config cert-request.conf

create a file for alternative name : 
subjectAltName = DNS:*.myhost.domain, IP:127.0.0.1

create the certificate 
sudo openssl x509 -req -days 10000 -in new.cert.csr -signkey new.cert.key -out server.crt -extfile altname.ext

copy the certificate to trusted certificate and trust it
sudo mkdir /usr/local/share/ca-certificates/myhost.domain
sudo cp server.crt /usr/local/share/ca-certificates//myhost.domain/
sudo chmod 755 /usr/local/share/ca-certificates/myhost.domain/
sudo chmod 644 /usr/local/share/ca-certificates/myhost.domain/server.crt
sudo update-ca-certificates

copy certificate to a etc/ssl/certs
sudo cp server.crt /etc/ssl/certs

copy new.cert.key to /etc/ssl/private server.key
sudo cp new.cert.key /etc/ssl/private/server.key

### create apache conf file

```
<IfModule mod_ssl.c>
	<VirtualHost frontend.myhost.domain:443>
                    ServerAdmin webmaster@localhost
    
                    DocumentRoot /var/www/html
    
                    Loglevel alert rewrite:trace6 proxy:trace6
                    ErrorLog ${APACHE_LOG_DIR}/error.log
                    CustomLog ${APACHE_LOG_DIR}/access.log combined
    
                    SSLEngine on
    
                    SSLCertificateFile      /etc/ssl/certs/server.crt
                    SSLCertificateKeyFile /etc/ssl/private/server.key
    
                    RewriteEngine on
                    
                    <Location ~ "/api/.*">

                        RewriteRule (.+)/api/(.+) $1/$2
                        ProxyPass "http://127.0.0.1:3030"
                        ProxyPassReverse "http://127.0.0.1:3030"
                        ProxyPassReverseCookiePath / /api

                    </Location>
                
                    <Location ~ "/documents/.+">
                        RewriteRule (.+)/documents/(.+) /?documentKey=$2 [R]
                    </Location>
                
                    <Location ~ "/socket.io/*>
                        ProxyPass "ws://127.0.0.1:3030"
                    </Location>
                
                    ProxyPass "/" "http://127.0.0.1:5000/"
                    ProxyPassReverse "/" "http://127.0.0.1:5000/"
            
                    <FilesMatch "\.(cgi|shtml|phtml|php)$">
                            SSLOptions +StdEnvVars
                    </FilesMatch>

                    <Directory /usr/lib/cgi-bin>
                            SSLOptions +StdEnvVars
                    </Directory>
    
            </VirtualHost>
</IfModule>
```

### restart apache 
```
sudo systemctl restart apache2
```









