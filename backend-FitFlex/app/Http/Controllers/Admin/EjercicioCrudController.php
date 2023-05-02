<?php

namespace App\Http\Controllers\Admin;

use App\Http\Requests\EjercicioRequest;
use Backpack\CRUD\app\Http\Controllers\CrudController;
use Backpack\CRUD\app\Library\CrudPanel\CrudPanelFacade as CRUD;

/**
 * Class EjercicioCrudController
 * @package App\Http\Controllers\Admin
 * @property-read \Backpack\CRUD\app\Library\CrudPanel\CrudPanel $crud
 */
class EjercicioCrudController extends CrudController
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
        CRUD::setModel(\App\Models\Ejercicio::class);
        CRUD::setRoute(config('backpack.base.route_prefix') . '/ejercicio');
        CRUD::setEntityNameStrings('ejercicio', 'ejercicios');

        if (backpack_user()->hasPermissionTo('ejercicios.list')) {
            CRUD::allowAccess('list');
        }else{
            CRUD::denyAccess('list');
        }
        if (backpack_user()->hasPermissionTo('ejercicios.create')) {
            CRUD::allowAccess('create');
        }else{
            CRUD::denyAccess('create');
        }
        if (backpack_user()->hasPermissionTo('ejercicios.update')) {
            CRUD::allowAccess('update');
        }else{
            CRUD::denyAccess('update');
        }
        if (backpack_user()->hasPermissionTo('ejercicios.read')) {
            CRUD::allowAccess('read');
        }else{
            CRUD::denyAccess('read');
        }
        if (backpack_user()->hasPermissionTo('ejercicios.delete')) {
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
        CRUD::column('titulo');
        CRUD::column('descripcion');
        CRUD::column('id_video');

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
        CRUD::setValidation(EjercicioRequest::class);

        CRUD::field('titulo');
        CRUD::field('descripcion');
        CRUD::field('id_video');

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
