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

## Create Roles and Permissions Pages | Spatie Laravel Role and Permission
      https://spatie.be/docs/laravel-permission/v5/basic-usage/role-permissions
      https://play.tailwindcss.com/cGTQRwjsz8
      
    We're going to create the roles and permissions pages.
    Create Permission Controller
        php artisan make:controller Admin/PermissionController
        php artisan make:model Admin/Permission -a  
    Create Role Controller
        php artisan make:controller Admin/RoleController
        php artisan make:model Admin/Role -a 

    Add the routes to the routes/web.php
        Route::middleware(['auth', 'role:admin'])->name('admin.')->prefix('admin')->group(function () {
        Route::resource('users', 'Admin\UsersController');
        Route::resource('permissions', 'Admin\PermissionsController');
        Route::resource('roles', 'Admin\RolesController');
});

    Create the UI for roles  to display the index page
    Create the UI for permissions  to display the index page
    
## Display Roles and Permissions | Spatie Laravel Role and Permission
    Display the roles and permissions  table
    Call the varoables in the view
        $roles = Role::all();
        $permissions = Permission::all();
        
 ## Create Roles and Permissions | Spatie Role and Permission | Laravel 9 Tutorial   
    To create the roles and permissions we're going to use the Spatie package.
    Create the UI for roles  to display the  create page
    Add the functionality  to create and store the roles ,paermissions in controller

## Update Spatie Roles and Permissions in Laravel 
    Add the button for edit and include the style for the button with tailwindcss
    Add the route ()
    Add the edit page for  permissions
    create the function edit into permission controller
    create the function update into permission controller
    Repeat the same prodecure for roles as you did for permissions

## Delete Roles and Permissions | Spatie Role and Permission | Laravel 9 Tutorial   
    We need  to hide the role of admin with spatie package
       With Eloquent  in the documentation 
          $roles = whereNotIn('name', ['admin'])->get(); put into index function
    To show the banners when we make changes in the admin layout  
  
    Add the button for delete and include the style for the button with tailwindcss
    Add the route ()
    Add the delete page for  permissions
    create the function delete into permission controller
    create the function destroy into permission controller
    Repeat the same prodecure for roles as you did for permissions

## Assign Permissions to Role | Laravel Permission
      https://spatie.be/docs/laravel-permission/v5/basic-usage/role-permissions
      https://play.tailwindcss.com/w1aqeaHYI0
    Display all the permissions in the edit UI of the roles
    Add the functionality to assign the permissions to the roles (RoleController)
    Form to assign the permissions to the role
    Add the web route to  givepermission and removepermission
    Add the function to givepermission and removepermission
    public function removePermission( Role $role,Permission $permission)
    {
        if($role->hasPermissionTo($permission)){
            $role->revokePermissionTo($permission);
            return back()->with('success', 'Permission revoked successfully');
        }
        return back()->with('success', 'Permission not eexist');
    }
## Assign Roles to Permission | Spatie Laravel Permission
    Display all the roles in the edit UI of the permissions
    Add the functionality to assign the roles to the permissions (PermissionController)
    Form to assign the roles to the permission
    Add the web route to  givepermission and removepermission
    Add the function to givepermission and removepermission
    public function givePermission( Permission $permission,Role $role)
    {
        if($role->hasPermissionTo($permission)){
            $role->givePermissionTo($permission);
            return back()->with('success', 'Permission assigned successfully');
        }
        return back()->with('success', 'Permission not eexist');
    }
