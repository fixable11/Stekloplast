<?php

namespace App\Http\Controllers\Admin;

use App\Http\Requests\PostRequest;
use Backpack\CRUD\app\Http\Controllers\CrudController;
use Backpack\CRUD\app\Http\Controllers\Operations\CreateOperation;
use Backpack\CRUD\app\Http\Controllers\Operations\DeleteOperation;
use Backpack\CRUD\app\Http\Controllers\Operations\ListOperation;
use Backpack\CRUD\app\Http\Controllers\Operations\ShowOperation;
use Backpack\CRUD\app\Http\Controllers\Operations\UpdateOperation;
use Backpack\CRUD\app\Library\CrudPanel\CrudPanel;
use Backpack\CRUD\app\Library\CrudPanel\CrudPanelFacade as CRUD;

/**
 * Class PostCrudController
 * @package App\Http\Controllers\Admin
 * @property-read CrudPanel $crud
 */
class PostCrudController extends CrudController
{
    use ListOperation;
    use CreateOperation;
    use UpdateOperation;
    use DeleteOperation;
    use ShowOperation;

    public function setup()
    {
        $this->crud->setModel('App\Models\Post');
        $this->crud->setRoute(config('backpack.base.route_prefix') . '/post');
        $this->crud->setEntityNameStrings('пост', 'посты');
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
        $this->crud->setValidation(PostRequest::class);

        $this->crud->addField([
            'name' => 'name',
            'type' => 'text',
            'label' => 'Название',
        ]);
        $this->crud->addField([
            'name' => 'description',
            'type' => 'tinymce',
            'label' => 'Описание',
        ]);
    }

    protected function setupUpdateOperation()
    {
        $this->setupCreateOperation();
    }
}
