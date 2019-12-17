<?php

namespace App\Http\Controllers\Admin;

use App\Http\Requests\PhoneRequest;
use Backpack\CRUD\app\Http\Controllers\CrudController;
use Backpack\CRUD\app\Http\Controllers\Operations\CreateOperation;
use Backpack\CRUD\app\Http\Controllers\Operations\DeleteOperation;
use Backpack\CRUD\app\Http\Controllers\Operations\ListOperation;
use Backpack\CRUD\app\Http\Controllers\Operations\ShowOperation;
use Backpack\CRUD\app\Http\Controllers\Operations\UpdateOperation;
use Backpack\CRUD\app\Library\CrudPanel\CrudPanel;
use Backpack\CRUD\app\Library\CrudPanel\CrudPanelFacade as CRUD;

/**
 * Class PhoneCrudController
 * @package App\Http\Controllers\Admin
 * @property-read CrudPanel $crud
 */
class PhoneCrudController extends CrudController
{
    use ListOperation;
    use CreateOperation;
    use UpdateOperation;
    use DeleteOperation;
    use ShowOperation;

    public function setup()
    {
        $this->crud->setModel('App\Models\Phone');
        $this->crud->setRoute(config('backpack.base.route_prefix') . '/phone');
        $this->crud->setEntityNameStrings('номер', 'номера');
    }

    protected function setupListOperation()
    {
        $this->crud->addColumn([
            'name' => 'phone',
            'type' => 'text',
            'label' => 'Номер',
        ]);
    }

    protected function setupCreateOperation()
    {
        $this->crud->setValidation(PhoneRequest::class);

        $this->crud->addField([
            'name' => 'phone',
            'type' => 'phone',
            'label' => "Номер телефона"
        ]);
    }

    protected function setupUpdateOperation()
    {
        $this->setupCreateOperation();
    }
}
