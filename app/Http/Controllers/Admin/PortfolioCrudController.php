<?php

declare(strict_types=1);

namespace App\Http\Controllers\Admin;

use App\Http\Requests\PortfolioRequest;
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
 * Class PortfolioCrudController
 * @package App\Http\Controllers\Admin
 * @property-read CrudPanel $crud
 */
class PortfolioCrudController extends CrudController
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
        $this->crud->setModel('App\Models\Portfolio');
        $this->crud->setRoute(config('backpack.base.route_prefix') . '/portfolio');
        $this->crud->setEntityNameStrings('проект', 'проекты');
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
            'type' => 'text',
            'label' => 'Описание',
        ]);
        $this->crud->addColumn([
            'name' => 'coordinates',
            'type' => 'googlemap',
            'default' => '{
                "lat": 10,
                "lng": -10
            }',
            'label' => "Отметка на карте"
        ]);
        $this->crud->addColumn([
            'name' => 'photos',
            'label' => 'Фотографии',
            'type' => 'upload_multiple',
            'disk' => 'public'
        ]);
    }

    /**
     * List on items.
     *
     * @return void
     */
    protected function setupListOperation()
    {
        $this->crud->addColumn([
            'name' => 'name',
            'type' => 'text',
            'label' => 'Название',
        ]);
        $this->crud->addColumn([
            'name' => 'description',
            'type' => 'text',
            'label' => 'Описание',
        ]);
    }

    /**
     * Create item operation.
     *
     * @return void
     */
    protected function setupCreateOperation()
    {
        $this->crud->setValidation(PortfolioRequest::class);

        $this->crud->addField([
            'name' => 'name',
            'type' => 'text',
            'label' => "Название"
        ]);
        $this->crud->addField([
            'name' => 'description',
            'label' => 'Описание',
            'type' => 'tinymce',
        ]);
        $this->crud->addField([
            'name' => 'coordinates',
            'type' => 'googlemap',
            'default' => '{
                "lat": 10,
                "lng": -10
            }',
            'label' => "Отметка на карте"
        ]);

        $this->crud->addField([
            'name' => 'photos',
            'label' => 'Фотографии',
            'type' => 'upload_multiple',
            'upload' => true,
            'disk' => 'public'
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
