# Getting started

## Installation

Please check the official laravel installation guide for server requirements before you start. [Official Documentation](https://laravel.com/docs/5.4/installation#installation)

Clone the repository

    git clone https://github.com/DHARUNRAJ57/Cartrabbit-Credit-Application-final.git
Switch to the repo folder

    cd Cartrabbit-Credit-Application-final

Install all the dependencies using composer

    composer install

Copy the example env file and make the required configuration changes in the .env file

    cp .env.example .env
    Start XAMPP:
Open XAMPP Control Panel and start the Apache and MySQL services.

Access phpMyAdmin:
Open your web browser and go to http://localhost/phpmyadmin or click on the "Admin" button for MySQL in the XAMPP Control Panel. This will open the phpMyAdmin interface.

Create the Database:
Once in phpMyAdmin:

Click on the "Databases" tab.

In the "Create database" field, enter mirco4.

Choose the collation if needed (default is usually fine).

Click on the "Create" button to create the mirco4 database.

Verification:
After creating the database, you can verify its creation by checking the list of databases in phpMyAdmin.
You should see mirco4 listed among the databases.

Run the database migrations (**Set the database connection in .env before migrating**)

    php artisan migrate
    php artisan key:generate

Start the local development server

    php artisan serve

