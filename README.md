# Coding challenge - basic airline ticketing API

## Using PHP and MySQL

ticket.sql contains the MySQL table used to store tickets, plus some dummy data

sample_data.json gives some examples of valid JSON data that the API can accept

## How to run this locally

This presumes you have LAMP or MAMP running on your local machine.

Replace the $db_host, $db_user and $db_password variables in inc/db_open.php with the credentials from your local environment.

In your local MySQL instance, create a new database called fr24 or use this command:
CREATE DATABASE fr24 CHARACTER SET utf8 COLLATE utf8_general_ci;

Import file ticket.sql to create the MySQL table used to store tickets, plus some dummy data.

Set your machine's server root to the /fr24 directory and you will be able to access the api endpoints via the URLs

/api/create.php

/api/cancel.php

/api/change.php

For example if you're using MAMPserver locally on port 8888, the create API endpoint is accessed at http://localhost:8888/api/create.php

## Interacting with the API

I use Postman for API testing. If testing locally you will require the desktop version available at https://www.postman.com/downloads/

### Create a ticket

Post JSON data to /api/create.php using the data format supplied in sample_data.json

When a ticket is successfully created, the response will look as follows

{
    "message": "created",
    "ticket_id": 117,
    "seat": 23
}

### Cancel a ticket

Post JSON data to /api/cancel.php using the data format supplied in sample_data.json

When a ticket is successfully created, the response will look as follows

{
    "message": "cancelled",
    "ticket_id": 117,
    "seat": 23
}

### Change a ticket

Post JSON data to /api/change.php using the data format supplied in sample_data.json

When a ticket is successfully created, the response will look as follows

{
    "message": "changed",
    "ticket_id": 117,
    "seat": 23
}
