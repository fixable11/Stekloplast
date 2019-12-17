<?php

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

    public function setup()
    {
        $this->crud->setModel('App\Models\Portfolio');
        $this->crud->setRoute(config('backpack.base.route_prefix') . '/portfolio');
        $this->crud->setEntityNameStrings('проект', 'проекты');
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
    }

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

    protected function setupCreateOperation()
    {
        $this->crud->setValidation(PortfolioRequest::class);

        $this->crud->addField([
            'name' => 'name',
            'type' => 'text',
            'label' => "Название"
        ]);
        $this->crud->addField([   // TinyMCE
            'name' => 'description',
            'label' => 'Описание',
            'type' => 'tinymce',
        ],);
        $this->crud->addField([
            'name' => 'coordinates',
            'type' => 'googlemap',
            'default' => '{
                "lat": 10,
                "lng": -10
            }',
            'label' => "Отметка на карте"
        ]);
    }

    protected function setupUpdateOperation()
    {
        $this->setupCreateOperation();
    }
}
