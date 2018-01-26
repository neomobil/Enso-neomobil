<?php

use LaravelEnso\StructureManager\app\Classes\StructureMigration;

class CreateStructureForLocalisation extends StructureMigration
{
    protected $permissionGroup = [
        'name' => 'system.localisation', 'description' => 'Localisation permissions group',
    ];

    protected $permissions = [
        ['name' => 'system.localisation.index', 'description' => 'Localisation index', 'type' => 0, 'default' => false],
        ['name' => 'system.localisation.initTable', 'description' => 'Init table data for localisation', 'type' => 0, 'default' => false],
        ['name' => 'system.localisation.getTableData', 'description' => 'Get table data for localisation', 'type' => 0, 'default' => false],
        ['name' => 'system.localisation.exportExcel', 'description' => 'Export excel for localisation', 'type' => 0, 'default' => false],
        ['name' => 'system.localisation.create', 'description' => 'Create langugage', 'type' => 1, 'default' => false],
        ['name' => 'system.localisation.edit', 'description' => 'Edit language', 'type' => 1, 'default' => false],
        ['name' => 'system.localisation.editTexts', 'description' => 'Edit lang file', 'type' => 1, 'default' => false],
        ['name' => 'system.localisation.getLangFile', 'description' => 'Get selected lang file content', 'type' => 0, 'default' => false],
        ['name' => 'system.localisation.saveLangFile', 'description' => 'Save edited lang file', 'type' => 1, 'default' => false],
        ['name' => 'system.localisation.store', 'description' => 'Save newly created language', 'type' => 1, 'default' => false],
        ['name' => 'system.localisation.update', 'description' => 'Save edited language', 'type' => 1, 'default' => false],
        ['name' => 'system.localisation.destroy', 'description' => 'Delete language', 'type' => 1, 'default' => false],
    ];

    protected $menu = [
        'name' => 'Localisation', 'icon' => 'fa fa-fw fa-language', 'link' => 'system.localisation.index', 'has_children' => false,
    ];

    protected $parentMenu = 'System';
}
