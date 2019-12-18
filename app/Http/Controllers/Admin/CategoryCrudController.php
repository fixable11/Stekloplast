<?php

declare(strict_types=1);

namespace App\Http\Controllers\Admin;

use App\Http\Requests\CategoryRequest;
use App\Models\Category;
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
 * Class CategoryCrudController
 * @package App\Http\Controllers\Admin
 * @property-read CrudPanel $crud
 */
class CategoryCrudController extends CrudController
{
    use ListOperation;
    use CreateOperation;
    use UpdateOperation;
    use DeleteOperation;
    //use ShowOperation;

    /**
     * Setup crud controller.
     *
     * @throws Exception Exception.
     *
     * @return void
     */
    public function setup()
    {
        $this->crud->setModel('App\Models\Category');
        $this->crud->setRoute(config('backpack.base.route_prefix') . '/category');
        $this->crud->setEntityNameStrings('категорию', 'категории');
    }

    /**
     * List of items.
     *
     * @return void
     */
    protected function setupListOperation(): void
    {
        $this->crud->addColumn([
            'name' => 'name',
            'type' => 'test',
            'label' => 'Название',
        ]);
        $this->crud->addColumn([
            'name' => 'parent_id',
            'type' => 'select',
            'label' => 'Родительская категория',
            'entity' => 'parent',
            'attribute' => "name",
            'model' => Category::class,
        ]);
    }

    /**
     * Create operation.
     *
     * @return void
     */
    protected function setupCreateOperation(): void
    {
        $this->crud->setValidation(CategoryRequest::class);

        $this->crud->addField([
            'name' => 'name',
            'type' => 'text',
            'label' => "Название категории"
        ]);
        $this->crud->addField([
            'label' => "Родительская категория",
            'type' => 'select',
            'name' => 'parent_id',
            'entity' => 'parent',
            'attribute' => 'name',
            'model' => Category::class,
        ]);
    }

    /**
     * Update operation.
     *
     * @return void
     */
    protected function setupUpdateOperation(): void
    {
        $this->setupCreateOperation();
    }
}
