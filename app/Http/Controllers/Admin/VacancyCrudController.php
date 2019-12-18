<?php

declare(strict_types=1);

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
use Exception;

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

    /**
     * Setup crud controller.
     *
     * @throws Exception Exception.
     *
     * @return void
     */
    public function setup(): void
    {
        $this->crud->setModel('App\Models\Vacancy');
        $this->crud->setRoute(config('backpack.base.route_prefix') . '/vacancy');
        $this->crud->setEntityNameStrings('вакансию', 'вакансии');
    }

    /**
     * Show the specific item.
     *
     * @return void
     */
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

    /**
     * List of items action.
     *
     * @return void
     */
    protected function setupListOperation()
    {
        $this->crud->addColumn([
            'name' => "name",
            'label' => "Название",
            'type' => "text"
        ]);
        $this->crud->addColumn([
            'name' => "description",
            'label' => "Описание",
            'type' => "text"
        ]);
        $this->crud->addColumn([
            'name' => "created_at",
            'label' => "Создано в",
            'type' => "datetime"
        ]);
    }

    /**
     * Create item action.
     *
     * @return void
     */
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
        ]);
    }

    /**
     * Update item action.
     *
     * @return void
     */
    protected function setupUpdateOperation()
    {
        $this->setupCreateOperation();
    }
}
