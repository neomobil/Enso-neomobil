<?php

use LaravelEnso\StructureManager\app\Classes\StructureMigration;

class CreateStructureForUsers extends StructureMigration
{
    protected $permissionGroup = [
        'name' => 'administration.users', 'description' => 'Users permissions group',
    ];

    protected $permissions = [
        ['name' => 'administration.users.initTable', 'description' => 'Init table for users', 'type' => 0, 'default' => false],
        ['name' => 'administration.users.getTableData', 'description' => 'Get table data for users', 'type' => 0, 'default' => false],
        ['name' => 'administration.users.exportExcel', 'description' => 'Export excel for users', 'type' => 0, 'default' => false],
        ['name' => 'administration.users.getOptionList', 'description' => 'Get options for vue-select', 'type' => 0, 'default' => false],
        ['name' => 'administration.users.create', 'description' => 'Create user', 'type' => 1, 'default' => false],
        ['name' => 'administration.users.edit', 'description' => 'Edit existing user', 'type' => 1, 'default' => false],
        ['name' => 'administration.users.index', 'description' => 'Show users', 'type' => 0, 'default' => false],
        ['name' => 'administration.users.show', 'description' => 'Display user information', 'type' => 0, 'default' => true],
        ['name' => 'administration.users.store', 'description' => 'Store newly created user', 'type' => 1, 'default' => false],
        ['name' => 'administration.users.update', 'description' => 'Update edited user', 'type' => 1, 'default' => false],
        ['name' => 'administration.users.destroy', 'description' => 'Delete user', 'type' => 1, 'default' => false],
    ];

    protected $menu = [
        'name' => 'Users', 'icon' => 'fa fa-fw fa-users', 'link' => 'administration.users.index', 'has_children' => false,
    ];

    protected $parentMenu = 'Administration';
}
