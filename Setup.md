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
        'role' => \Spatie\Permission\Middlewares\RoleMiddleware::class,
        'permission' => \Spatie\Permission\Middlewares\PermissionMiddleware::class,
        'role_or_permission' => \Spatie\Permission\Middlewares\RoleOrPermissionMiddleware::class,

## ATTACH THE ADMIN ROLE TO THE USER
    - Attach the admin role to the user
        $user->assignRole('admin'); 
    - CREATE a seeder
        php artisan make:seeder AdminSeeder
        php artisan make:seeder RoleSeeder
    - Create  a role in the roleSeeder
       https://spatie.be/docs/laravel-permission/v5/basic-usage/basic-usage
        Role::create(['name' => 'admin']);
        Role::create(['name' => 'writer']);
        Role::create(['name' => 'user']);
    - Create a user in the AdminSeeder
        Copy from the User Factory and edit       
    -Assign Role to the user
        https://spatie.be/docs/laravel-permission/v5/basic-usage/role-permissions
        $user->assignRole('writer', 'admin');
    - Call two seeders into the database Seeders
       
    -Artisan migrate
        php artisan migrate:fresh --seed

## Create Admin Layout | Spatie Laravel Role and Permission
    - createe a route for admin in web 
        admin.index

## Add Tailwind CSS Sidebar to the Admin Layout | Spatie Laravel Role and Permission
    To change the admin Layout use https://www.alpinetoolbox.com/
         https://github.com/jan-heise/responsive-navbar-with-dropdown
    Go to nav example and select sidebar and paste to admin
    Change the dark-mode to  dark 

