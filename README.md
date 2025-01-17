# Currency Exchange System

## Objective
Creating a system that lets users add amounts and get the exchange rate of it against other currencies.

## Important Note
Creation of auth (login and logout) is not important and not counted in the task, so use any pre-made UI kit like Laravel Breeze or Laravel UI and do not put any effort into it.

## Objectives
1. **User can add exchange rates of currencies manually from their dashboard.**
   - The data will be added in the config file in the root of the project, not in the table in the database.
   - Users can view all the data of the config file, update its value, and add new values to it.

2. **User can add records of amounts in the database and when viewing the list of it, they can see the exchange value (amount * config exchange rate).**

## Tasks
1. Add new currency in the config file.
2. Update values of the config file.
3. Delete values from the config file.
4. View the list of values in the configuration.
5. The user can view the list of their amount records.
6. The user can add a new amount.
7. The user can update the values of the amounts.
8. The user can delete the amount.

## Note
Make sure that the config file is not added to GitHub (add it in .gitignore file).

## Setup Instructions

### 1. Clone the repository
```bash
git clone <repository-url>
cd currency_exchange_task
composer install
cp .env.example .env.
php artisan key:generate.
php artisan migrate.
php artisan serve.

