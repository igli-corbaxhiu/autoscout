Instructions to install the application:

1. Execute: cp .env.example .env
2. In .env file change the database credentials
3. Execute: php artisan key:generate
4. Execute: composer install (install dependencies)
5. Execute: npm install and npm run dev (leave npm run dev running to reflect changes in frontend directly)
6. php artisan migrate --seed (to create the database and to seed some data into database)
7. Admin is created automatically with these credentials 
   Email: admin@gmail.com Password: 11111111
8. php artisan serve (to open the application in browser)