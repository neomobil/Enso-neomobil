<!--h-->
# Permission Manager
[![Codacy Badge](https://api.codacy.com/project/badge/Grade/4ec2d18588a64875aa432c9a827a1849)](https://www.codacy.com/app/laravel-enso/PermissionManager?utm_source=github.com&utm_medium=referral&utm_content=laravel-enso/PermissionManager&utm_campaign=badger)
[![StyleCI](https://styleci.io/repos/94779938/shield?branch=master)](https://styleci.io/repos/94779938)
[![License](https://poser.pugx.org/laravel-enso/permissionmanager/license)](https://https://packagist.org/packages/laravel-enso/permissionmanager)
[![Total Downloads](https://poser.pugx.org/laravel-enso/permissionmanager/downloads)](https://packagist.org/packages/laravel-enso/permissionmanager)
[![Latest Stable Version](https://poser.pugx.org/laravel-enso/permissionmanager/version)](https://packagist.org/packages/laravel-enso/permissionmanager)
<!--/h-->

Permission Manager dependency for [Laravel Enso](https://github.com/laravel-enso/Enso)

[![Screenshot](https://laravel-enso.github.io/permissionsmanager/screenshots/bulma_029_thumb.png)](https://laravel-enso.github.io/permissionsmanager/screenshots/bulma_029.png)

### Features

- permissions are managed based on the user role
- allows creating, updating and deleting of permissions for each route
- permits the one step creation of permissions for a resource type of route
- has the `access-route` policy which can be used to check if the a user is authorized on a given route
- comes with the `VerifyRouteAccess` middleware that checks against unauthorized access

### Under the Hood

- inside `web.php` there is a route for each action within the application, and each route has the `name` attribute defined
- for each route where we need to have authorization checks, we must define a permission, permission which needs to have the same name as the route
- routes and groups are nested, the resulting name looking something like `group1.group2...route`
- for each request we check the existence of the link between the user's role and the permission for the request's route
- permissions' attributes:
     - name: see above
     - description - is human readable and is used when displaying a user's action history (on his profile page)
     - type - may be `read` or `write` and is an informative flag
     - default - flag which lets us know if a permission needs to be automatically allotted to any new role we create
- for routes where we don't need to have authorization checks, permissions are not mandatory, **BUT**
- if we want to log and display the users' actions, permissions become necessary, as they're used when displaying statistics
- permissions are grouped together in groups, which have mainly a descriptive purpose
- when naming them, the same name convention is used as in the case of permissions  e.g. `group1.group2`
- permission groups are not linked directly to any other entity - with the obvious exception of permissions - nor are they used directly

### Notes

The [Laravel Enso Core](https://github.com/laravel-enso/Core) package comes with this package included.

Depends on:
 - [Datatable](https://github.com/laravel-enso/Datatable) for displaying the list of permissions
 - [DbSyncMigrations](https://github.com/laravel-enso/DbSyncMigrations) for offering the possibility to generate migrations for the changes you make locally
 - [FormBuilder](https://github.com/laravel-enso/FormBuilder) for creating the forms when managing permissions
 - [Helpers](https://github.com/laravel-enso/Helpers) for utility classes and traits
 - [RoleManager](https://github.com/laravel-enso/RoleManager) for the integration with roles 
 - [StructureManager](https://github.com/laravel-enso/StructureManager) for the migrations
 - [TutorialManager](https://github.com/laravel-enso/TutorialManager) for the relationship with tutorials


<!--h-->
### Contributions

are welcome. Pull requests are great, but issues are good too.

### License

This package is released under the MIT license.
<!--/h-->