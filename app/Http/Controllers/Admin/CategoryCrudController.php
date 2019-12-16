<?php

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
    use ShowOperation;

    /**
     * @throws Exception
     */
    public function setup()
    {
        $this->crud->setModel('App\Models\Category');
        $this->crud->setRoute(config('backpack.base.route_prefix') . '/category');
        $this->crud->setEntityNameStrings('category', 'categories');
    }

    protected function setupListOperation()
    {
        $this->crud->setColumns(['name']);
        $this->crud->addColumn([
            'name' => 'parent_id',
            'type' => 'select',
            'label' => 'Parent category',
            'entity' => 'parent',
            'attribute' => "name",
            'model' => Category::class,
        ]);
    }

    protected function setupCreateOperation()
    {
        $this->crud->setValidation(CategoryRequest::class);

        $this->crud->addField([
            'name' => 'name',
            'type' => 'text',
            'label' => "Category name"
        ]);
        $this->crud->addField([
            'label' => "Parent category",
            'type' => 'select',
            'name' => 'parent_id',
            'entity' => 'parent',
            'attribute' => 'name',
            'model' => Category::class,
        ]);


    }

    protected function setupUpdateOperation()
    {
        $this->setupCreateOperation();
    }
}
