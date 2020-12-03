# Mongodb 

## Pre require site:

having mongodb client installed and an instance of mongodb.

## Mongodb initialization 

Connect with shell :

mongo "mongodb://localhost:27017/admin" -u "<username>" -p "<password>" --authenticationDatabase <auth database : default is admin>

Create the database :
use teama
db.teama.insert({"value":"deleteme"})

Create the admin user :
use admin
db.createUser({user:"admin_teama",pwd:"<your-secured-password>",roles:\[],passwordDigestor:"server"})

**NB :** For the demo and dev station, password is admin. Not secured at all

Reference of the node clients :
https://docs.mongodb.com/drivers/node
 




