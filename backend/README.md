## Complaint Management System

To Run this app First run the migration

```bash
php artisan migrate
```
create admin user
```bash 
php artisan db:seed --class=AdminUserSeeder
```

in .env file add ```SANCTUM_STATEFUL_DOMAINS``` field with the frontend domain name.
example:
```bash
SANCTUM_STATEFUL_DOMAINS="http://localhost:3000"
```

Then run the app using

```bash
php artisan serve
```