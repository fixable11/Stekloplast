<?php

declare(strict_types=1);

namespace App\Http\Controllers\Admin;

use App\Http\Requests\ProductRequest;
use App\Models\Category;
use App\Models\Product;
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
 * Class ProductCrudController
 * @package App\Http\Controllers\Admin
 * @property-read CrudPanel $crud
 */
class ProductCrudController extends CrudController
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
    public function setup()
    {
        $this->crud->setModel('App\Models\Product');
        $this->crud->setRoute(config('backpack.base.route_prefix') . '/product');
        $this->crud->setEntityNameStrings('продукт', 'продукты');
    }

    /**
     * Show the specific item.
     *
     * @return void
     */
    protected function setupShowOperation(): void
    {
        $this->crud->addColumn([
            'name' => 'name',
            'type' => 'text',
            'label' => 'Наименование',
        ]);
        $this->crud->addColumn([
            'name' => 'category_id',
            'type' => 'select',
            'label' => 'Категория',
            'entity' => 'category',
            'attribute' => "name",
            'model' => Category::class,
        ]);
        $this->crud->addColumn([
            'name' => 'photos',
            'label' => 'Фотографии',
            'type' => 'upload_multiple',
            'disk' => 'public'
        ]);
        $this->crud->addColumn([
            'name' => 'attributes',
            'label' => 'Атрибуты',
            'type' => 'attributes',
            'entity_singular' => 'атрибут',
            'columns' => [
                'name' => 'Название атрибута',
                'value' => 'Значение',
            ],
            'min' => 0,
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
            'name' => 'name',
            'type' => 'test',
            'label' => 'Название',
        ]);
        $this->crud->addColumn([
            'name' => 'category_id',
            'type' => 'select',
            'label' => 'Категория',
            'entity' => 'category',
            'attribute' => "name",
            'model' => Category::class,
        ]);
    }

    /**
     * Create item operation.
     *
     * @return void
     */
    protected function setupCreateOperation()
    {
        $this->crud->setValidation(ProductRequest::class);

        $this->crud->addField([
            'name' => 'name',
            'type' => 'text',
            'label' => "Название продукта"
        ]);

        $this->crud->addField([
            'label' => "Категория",
            'type' => 'select',
            'name' => 'category_id',
            'entity' => 'category',
            'attribute' => 'name',
            'model' => Category::class,
        ]);

        $this->crud->addField([
            'name' => 'photos',
            'label' => 'Фотографии',
            'type' => 'upload_multiple',
            'upload' => true,
            'disk' => 'public'
        ]);

        $this->crud->addField([   // Table
            'name' => 'attributes',
            'label' => 'Атрибуты',
            'type' => 'attributes',
            'entity_singular' => 'атрибут', // used on the "Add X" button
            'columns' => [
                'name' => 'Название атрибута',
                'values' => 'Значения',
            ],
            'min' => 0, // minimum rows allowed in the table
        ]);
    }

    /**
     * Update item operation.
     *
     * @return void
     */
    protected function setupUpdateOperation()
    {
        $this->setupCreateOperation();
    }
}
