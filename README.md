<!--
 * @Author: @vedatbozkurt
 * @Email: info@wedat.org
 * @Date: 2020-12-08 00:41:58
 * @LastEditors: @vedatbozkurt
 * @LastEditTime: 2021-01-05 00:26:38
-->
# Shipment and Courier Management

Shipment and Courier Management application is based on Laravel and VueJs. Restful api and multi guard scope features are provided by Laravel Passport.



## Features
![](https://raw.githubusercontent.com/vedatbozkurt/wshipping/main/screenshots/admin-dash.png?token=ADJKC5IGT4SEGEBR47O62HC76OEBC)
### Laravel
* Eloquent Relationships, Scopes, Soft Deletes ...
* Restful Api 
* Passport OAuth2 authentication (bearer token)
* Passport Multi Auth Guards
* Route files for each modules
* API client for each modules
* Authorization scopes
* Activity Logs
* ...


### VueJs

* Modules; Admin, Branch, Courier, User (Client)
* Dashboard for each modules (admin-lte)
* Multi Language (i18n)
* Restful Api (axios)
* vue router
* state management (vuex)
* Additional packages: chart.js, pagination, sweetalert2, multiselect, moment
* ...

The application consists of 4 main modules.
1. User:
- register, login, and edit profile
- create, edit, delete addresses
- create task(shipment)
- Listing and tracking task received
- Listing and tracking task sent

2. Courier
- register, login, and edit profile
- Determining the work area based on the selected cities and districts
- listing and accepting tasks in the work area
- change the status of the tasks it accepts

3. Branch
- only admin can create, edit, or delete branches.
- view, edit and delete tasks, couriers, users and addresses according to the city and district where its responsible.
- edit all tasks of the user. (address must be under the authority of a branch)
- edit all the courier's tasks. (address must be under the authority of a branch)
- edit shipments, users, couriers and addresses of the person under responsibility.
- edit the shipments, users, courier and addresses of a district or a city which it is responsible for.

4.Admin
- create,edit,delete cities and districts.
- edit Branch, Courier, User and addresses.
- create branches and edit its cities and districts to be responsible.
- edit couriers, users, addresses and shipments of a branch.
- edit tasks belonging to a courier.
- edit tasks and addresses of a user.
- edit city or district branches, couriers, users, shipments and addresses.

### More details 
For more details please check screenshoots folder.

## Installation

#### Backend
* You can install the backend packages via composer:

```bash
composer install
```

* Edit .env file:

```bash
DB_DATABASE=DB_Name
DB_USERNAME=DB_User
DB_PASSWORD=DB_Password
```

* Next step, run below command to create db tables:
```
php artisan migrate 
//or setup with initial data (also, you can install sample sql file which i attached in repo)
php artisan migrate --seed
```

* Then, you have install passport client:
```
php artisan passport:install
```

#### Frontend

* For each modules run below commands:
```php
npm install
npm run serve
```

* To use modules for production do not forget to edit url addresses on .env.local files:
You have to edit each module as below.

```php
// frontend/admin/.env.local
VUE_APP_API_URL=http://127.0.0.1:8000/api/v1/admin/
VUE_APP_URL=http://127.0.0.1:8000/
```

## Contributing
Pull requests are welcome. For major changes, please open an issue first to discuss what you would like to change.

Please make sure to update tests as appropriate.


## Security Vulnerabilities

If you would like to report an error, ask a question or offer a suggestion, please e-mail me at [info@wedat.org](info@wedat.org). All security vulnerabilities will be promptly addressed.

## License
This project is open-sourced software licensed under the [MIT license](https://opensource.org/licenses/MIT).
