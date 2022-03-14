### ROLES AND PERMISSIONS 
    - Install the project
    - Install the Breeze Framework
            https://laravel.com/docs/9.x/starter-kits
    - Install the Spatie Package
         https://spatie.be/docs/laravel-permission/v5/installation-laravel
         php artisan vendor:publish --provider="Spatie\Permission\PermissionServiceProvider"
     -Run clear
          php artisan optimize:clear
          php artisan config:clear
## BASIC USAGE 
    https://spatie.be/docs/laravel-permission/v5/basic-usage/basic-usage
    - Add the trait to User  model
            use HasRoles;
## ADD MIDDLEWARE IN APP\Http\Kernel.php
        https://spatie.be/docs/laravel-permission/v5/basic-usage/middleware
    - Add into  middleware to the kernel
      
          
            
