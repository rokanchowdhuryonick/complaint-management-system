## Complaint Management System

To Run this app First run the migration

```bash
php artisan migrate
```
create admin user
```bash 
php artisan db:seed --class=AdminUserSeeder
```

Then run the app using

```bash
php artisan serve
```