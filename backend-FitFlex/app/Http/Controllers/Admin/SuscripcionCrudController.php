<?php

namespace App\Http\Controllers\Admin;

use App\Http\Requests\SuscripcionRequest;
use Backpack\CRUD\app\Http\Controllers\CrudController;
use Backpack\CRUD\app\Library\CrudPanel\CrudPanelFacade as CRUD;
use Illuminate\Support\Facades\Log;

/**
 * Class SuscripcionCrudController
 * @package App\Http\Controllers\Admin
 * @property-read \Backpack\CRUD\app\Library\CrudPanel\CrudPanel $crud
 */
class SuscripcionCrudController extends CrudController
{
    use \Backpack\CRUD\app\Http\Controllers\Operations\ListOperation;
    use \Backpack\CRUD\app\Http\Controllers\Operations\CreateOperation;
    use \Backpack\CRUD\app\Http\Controllers\Operations\UpdateOperation;
    use \Backpack\CRUD\app\Http\Controllers\Operations\DeleteOperation;
    use \Backpack\CRUD\app\Http\Controllers\Operations\ShowOperation;

    /**
     * Configure the CrudPanel object. Apply settings to all operations.
     * 
     * @return void
     */
    public function setup()
    {
        CRUD::setModel(\App\Models\Suscripcion::class);
        CRUD::setRoute(config('backpack.base.route_prefix') . '/suscripcion');
        CRUD::setEntityNameStrings('suscripcion', 'suscripcions');

        if (backpack_user()->hasPermissionTo('suscripciones.list')) {
            CRUD::allowAccess('list');
        }else{
            CRUD::denyAccess('list');
        }
        if (backpack_user()->hasPermissionTo('suscripciones.create')) {
            CRUD::allowAccess('create');
        }else{
            CRUD::denyAccess('create');
        }
        if (backpack_user()->hasPermissionTo('suscripciones.update')) {
            CRUD::allowAccess('update');
        }else{
            CRUD::denyAccess('update');
        }
        if (backpack_user()->hasPermissionTo('suscripciones.read')) {
            CRUD::allowAccess('read');
        }else{
            CRUD::denyAccess('read');
        }
        if (backpack_user()->hasPermissionTo('suscripciones.delete')) {
            CRUD::allowAccess('delete');
        }else{
            CRUD::denyAccess('delete');
        }
    }

    /**
     * Define what happens when the List operation is loaded.
     * 
     * @see  https://backpackforlaravel.com/docs/crud-operation-list-entries
     * @return void
     */
    protected function setupListOperation()
    {
        CRUD::column('cantidad_pagada');
        CRUD::column('fecha_ini');
        CRUD::column('fecha_fin');
        CRUD::column('periodo_contr');

        /**
         * Columns can be defined using the fluent syntax or array syntax:
         * - CRUD::column('price')->type('number');
         * - CRUD::addColumn(['name' => 'price', 'type' => 'number']); 
         */
    }

    /**
     * Define what happens when the Create operation is loaded.
     * 
     * @see https://backpackforlaravel.com/docs/crud-operation-create
     * @return void
     */
    protected function setupCreateOperation()
    {
        CRUD::setValidation(SuscripcionRequest::class);

        CRUD::field('cantidad_pagada');
        CRUD::field('fecha_ini');
        CRUD::field('fecha_fin');
        CRUD::field('periodo_contr');

        /**
         * Fields can be defined using the fluent syntax or array syntax:
         * - CRUD::field('price')->type('number');
         * - CRUD::addField(['name' => 'price', 'type' => 'number'])); 
         */
    }

    /**
     * Define what happens when the Update operation is loaded.
     * 
     * @see https://backpackforlaravel.com/docs/crud-operation-update
     * @return void
     */
    protected function setupUpdateOperation()
    {
        $this->setupCreateOperation();
    }
}
