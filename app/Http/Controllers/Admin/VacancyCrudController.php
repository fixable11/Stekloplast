<?php

namespace App\Http\Controllers\Admin;

use App\Http\Requests\VacancyRequest;
use Backpack\CRUD\app\Http\Controllers\CrudController;
use Backpack\CRUD\app\Http\Controllers\Operations\CreateOperation;
use Backpack\CRUD\app\Http\Controllers\Operations\DeleteOperation;
use Backpack\CRUD\app\Http\Controllers\Operations\ListOperation;
use Backpack\CRUD\app\Http\Controllers\Operations\ShowOperation;
use Backpack\CRUD\app\Http\Controllers\Operations\UpdateOperation;
use Backpack\CRUD\app\Library\CrudPanel\CrudPanel;
use Backpack\CRUD\app\Library\CrudPanel\CrudPanelFacade as CRUD;

/**
 * Class VacancyCrudController
 * @package App\Http\Controllers\Admin
 * @property-read CrudPanel $crud
 */
class VacancyCrudController extends CrudController
{
    use ListOperation;
    use CreateOperation;
    use UpdateOperation;
    use DeleteOperation;
    use ShowOperation;

    public function setup()
    {
        $this->crud->setModel('App\Models\Vacancy');
        $this->crud->setRoute(config('backpack.base.route_prefix') . '/vacancy');
        $this->crud->setEntityNameStrings('Вакансия', 'Вакансии');
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
        $this->crud->addColumn([
            'name' => "created_at",
            'label' => "Создано в", // Table column heading
            'type' => "datetime"
        ],);
    }

    protected function setupCreateOperation()
    {
        $this->crud->setValidation(VacancyRequest::class);

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
