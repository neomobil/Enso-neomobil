<?php

use LaravelEnso\StructureManager\app\Classes\StructureMigration;

class CreateStructureForPermissionGroups extends StructureMigration
{
    protected $permissionGroup = [
        'name' => 'system.permissionGroups', 'description' => 'Permission groups group',
    ];

    protected $permissions = [
        ['name' => 'system.permissionGroups.index', 'description' => 'Permission groups index', 'type' => 0, 'default' => false],
        ['name' => 'system.permissionGroups.create', 'description' => 'Create permission group', 'type' => 1, 'default' => false],
        ['name' => 'system.permissionGroups.edit', 'description' => 'Edit existing permission group', 'type' => 1, 'default' => false],
        ['name' => 'system.permissionGroups.store', 'description' => 'Save edited permission group', 'type' => 1, 'default' => false],
        ['name' => 'system.permissionGroups.update', 'description' => 'Update permission group', 'type' => 1, 'default' => false],
        ['name' => 'system.permissionGroups.destroy', 'description' => 'Delete permission group', 'type' => 1, 'default' => false],
        ['name' => 'system.permissionGroups.getTableData', 'description' => 'Get table data for permission groups', 'type' => 0, 'default' => false],
        ['name' => 'system.permissionGroups.exportExcel', 'description' => 'Export excel for permission groups', 'type' => 0, 'default' => false],
        ['name' => 'system.permissionGroups.initTable', 'description' => 'Init table data for permission groups', 'type' => 0, 'default' => false],
    ];

    protected $menu = [
        'name' => 'Permission Groups', 'icon' => 'fa fa-fw fa-object-group', 'link' => 'system.permissionGroups.index', 'has_children' => false,
    ];

    protected $parentMenu = 'System';
}
