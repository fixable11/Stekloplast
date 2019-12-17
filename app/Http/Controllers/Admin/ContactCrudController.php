<?php

namespace App\Http\Controllers\Admin;

use App\Http\Requests\ContactRequest;
use Backpack\CRUD\app\Http\Controllers\CrudController;
use Backpack\CRUD\app\Http\Controllers\Operations\CreateOperation;
use Backpack\CRUD\app\Http\Controllers\Operations\DeleteOperation;
use Backpack\CRUD\app\Http\Controllers\Operations\ListOperation;
use Backpack\CRUD\app\Http\Controllers\Operations\ShowOperation;
use Backpack\CRUD\app\Http\Controllers\Operations\UpdateOperation;
use Backpack\CRUD\app\Library\CrudPanel\CrudPanel;
use Backpack\CRUD\app\Library\CrudPanel\CrudPanelFacade as CRUD;

/**
 * Class ContactCrudController
 * @package App\Http\Controllers\Admin
 * @property-read CrudPanel $crud
 */
class ContactCrudController extends CrudController
{
    use ListOperation;
    use CreateOperation;
    use UpdateOperation;
    use DeleteOperation;
    use ShowOperation;

    public function setup()
    {
        $this->crud->setModel('App\Models\Contact');
        $this->crud->setRoute(config('backpack.base.route_prefix') . '/contact');
        $this->crud->setEntityNameStrings('контакт', 'контакты');
    }

    protected function setupShowOperation()
    {
        $this->crud->addColumn([
            'name' => 'name',
            'type' => 'text',
            'label' => 'Название',
        ]);
        $this->crud->addColumn([
            'name' => 'description',
            'type' => 'markdown',
            'label' => 'Описание',
        ]);
    }

    protected function setupListOperation()
    {
        $this->crud->addColumn([
            'name' => "name",
            'label' => "Название", // Table column heading
            'type' => "text"
        ],);
        $this->crud->addColumn([
            'name' => "description",
            'label' => "Описание", // Table column heading
            'type' => "text"
        ],);
    }

    protected function setupCreateOperation()
    {
        $this->crud->setValidation(ContactRequest::class);

        $this->crud->addField([
            'name' => 'name',
            'type' => 'text',
            'label' => "Название вакансии"
        ]);

        $this->crud->addField([   // TinyMCE
            'name' => 'description',
            'label' => 'Описание вакансии',
            'type' => 'tinymce',
        ],);
    }

    protected function setupUpdateOperation()
    {
        $this->setupCreateOperation();
    }
}
