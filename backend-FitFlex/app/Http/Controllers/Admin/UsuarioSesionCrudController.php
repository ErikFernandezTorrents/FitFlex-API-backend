<?php

namespace App\Http\Controllers\Admin;

use App\Http\Requests\UsuarioSesionRequest;
use Backpack\CRUD\app\Http\Controllers\CrudController;
use Backpack\CRUD\app\Library\CrudPanel\CrudPanelFacade as CRUD;
use Illuminate\Support\Facades\Log;

/**
 * Class UsuarioSesionCrudController
 * @package App\Http\Controllers\Admin
 * @property-read \Backpack\CRUD\app\Library\CrudPanel\CrudPanel $crud
 */
class UsuarioSesionCrudController extends CrudController
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
        CRUD::setModel(\App\Models\UsuarioSesion::class);
        CRUD::setRoute(config('backpack.base.route_prefix') . '/usuario-sesion');
        CRUD::setEntityNameStrings('usuario sesion', 'usuario sesions');

        if (backpack_user()->hasPermissionTo('usuario_sesiones.list')) {
            CRUD::allowAccess('list');
        }else{
            CRUD::denyAccess('list');
        }
        if (backpack_user()->hasPermissionTo('usuario_sesiones.create')) {
            CRUD::allowAccess('create');
        }else{
            CRUD::denyAccess('create');
        }
        if (backpack_user()->hasPermissionTo('usuario_sesiones.update')) {
            CRUD::allowAccess('update');
        }else{
            CRUD::denyAccess('update');
        }
        if (backpack_user()->hasPermissionTo('usuario_sesiones.read')) {
            CRUD::allowAccess('read');
        }else{
            CRUD::denyAccess('read');
        }
        if (backpack_user()->hasPermissionTo('usuario_sesiones.delete')) {
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
        CRUD::column('id_sesiones');
        CRUD::column('id_usuario');

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
        CRUD::setValidation(UsuarioSesionRequest::class);

        CRUD::field('id_sesiones');
        CRUD::field('id_usuario');

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
