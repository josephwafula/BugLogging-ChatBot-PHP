

<p align="center"></p>
<h1>Defect Logging Chatbot</h1> 
<p>Basically this was an attempt to make mobile app defect reporting easy for beta testers.</p>

<h4>Running The Project</h4>
Now, Windows, Linux, and MacOS users can continue from the below steps.
1. Run the XAMPP or any server on your system, open PHPMYADMIN or database, create the database named with homestead type utf8_general_ci.
2. Pull or download the Laravel project from Git.
3. On the Laravel project package, you can see the .env.example file which is inside your root directory. Rename it to .env, then update it with the correct database parameters.
4. Open the console and cd to the root directory of your project.
5. Run composer install or php composer.phar install.
6. Run php artisan key:generate
7. Run php artisan migrate
8. Run php artisan db:seed run seeders, if any.
9. Run php artisan serve.

<h5>Then let the bot guide you through the process</h5>
