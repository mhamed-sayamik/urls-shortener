# URL Shortener Installation Guide

## Prerequisites
- PHP installed on your system
- Composer installed on your system
- MySQL or another compatible database management system

## Installation Steps
1. Clone the application repository from GitHub:

git clone https://github.com/mhamed-sayamik/urls-shortener


2. Navigate to the project directory:

cd url-shortener


3. Install the PHP dependencies using Composer:

composer install
sql_more


4. Create a new MySQL database for the application called `url-shortener` or feel free to use whatever name just remember changing the environement variables accordingly.


5. Generate a new application key:

php artisan key:generate


6. Run your mysql server and then run the database migrations:

php artisan migrate

7. Start the development server:

php artisan serve

8. Navifate to the vue folder:
    cd vue

9. Compile the frontend assets:

npm install && npm run dev

10. test it out





## Usage
Once the installation is complete, you can access the URL shortener application by visiting the vue js app server url, it is reccommended to use the same as in the env file so everything works smoothly.

## Conclusion
By following these steps, you should be able to successfully install and make your URL shortener application functional.
