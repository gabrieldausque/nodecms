# Method of Development MVC

## For backend side

### 1. Create the datatable(s):

Add new table(s) statement(s) in :

com_teama/sql/install.mysql.utf8.sql

Add update script in :

com_teama/sql/updates/<new version number>.sql

### 2. Add the controllers : 

Create the plurals controller : 

file in src\Controller\<Entities>Controller.php

extends BaseController class

add default_view variable with the name of the view

implements delete function

Create the single controller :

file in src\Controller\<Entity>Controller.php

extends FormController

specify the $view_list value  as the name of the plurals controller in lower case

### 3. Add the models

Add the plural models : 

Create the class file <Entities>Model

extends the TeamAListModel class

add available filters in constructor

specify the filter form name variable

Override the get list query method. Don't forget filters !

Create the model for the single extends TeamAModel
implements the validate method if needed
implements the canDelete method if needed (and it will)

Create the table for the single extends 
use same typeAlias than in the model

### 4. create the views : 

Create form file in

com_teama/administrator/forms/<entity>.xml

Create the filter xml file in :

com_teama/administrator/forms/filter_<entities>.xml

and fill in using the forms syntax (use existing example)

Create the folder com_teama\administrator\src\View\<Entities>
Create class HtmlView in com_teama\administrator\src\View\<Entities>
inherits from TeamAViewList

Add template in com_teama\administrator\src\tmpl
Create folder <entities>
Create default.php file

## Deploy

Change version of the teama.xml file

Deploy
