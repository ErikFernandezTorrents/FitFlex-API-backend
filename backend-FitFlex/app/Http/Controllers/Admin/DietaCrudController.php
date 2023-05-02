<?php

namespace App\Http\Controllers\Admin;

use App\Http\Requests\DietaRequest;
use Illuminate\Http\Request;
use Backpack\CRUD\app\Http\Controllers\CrudController;
use Backpack\CRUD\app\Library\CrudPanel\CrudPanelFacade as CRUD;

/**
 * Class DietaCrudController
 * @package App\Http\Controllers\Admin
 * @property-read \Backpack\CRUD\app\Library\CrudPanel\CrudPanel $crud
 */
class DietaCrudController extends CrudController
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
        CRUD::setModel(\App\Models\Dieta::class);
        CRUD::setRoute(config('backpack.base.route_prefix') . '/dieta');
        CRUD::setEntityNameStrings('dieta', 'dietas');

        if (backpack_user()->hasPermissionTo('dietas.list')) {
            CRUD::allowAccess('list');
        }else{
            CRUD::denyAccess('list');
        }
        if (backpack_user()->hasPermissionTo('dietas.create')) {
            CRUD::allowAccess('create');
        }else{
            CRUD::denyAccess('create');
        }
        if (backpack_user()->hasPermissionTo('dietas.update')) {
            CRUD::allowAccess('update');
        }else{
            CRUD::denyAccess('update');
        }
        if (backpack_user()->hasPermissionTo('dietas.read')) {
            CRUD::allowAccess('read');
        }else{
            CRUD::denyAccess('read');
        }
        if (backpack_user()->hasPermissionTo('dietas.delete')) {
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
         CRUD::column('id')->label(__('id'));
        CRUD::column('name');
        CRUD::column('descripcion');
        CRUD::column('filepath');

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
        CRUD::setValidation(DietaRequest::class);

        CRUD::field('name');
        CRUD::field('descripcion');
        CRUD::addField([
            'name' => 'filepath',
            'label' => 'Archivo',
            'type' => 'upload',
            'upload' => true,
            'disk' => 'public',
            'prefix' => 'filepath',
            'overwrite' => false,
            'crop' => false,
            'aspect_ratio' => 0,
            'mime_types' => 'png,jpg,pdf',
            'store_as' => function (Request $request, $file) {
                return 'imagen_' . time() . '.' . $file->getClientOriginalExtension();
            },
        ]);
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
    public function store(Request $request)
    {
        $this->validate($request, [
            'name' => 'required',
            'descripcion' => 'required',
            'filepath' => 'required|mimes:png,jpg,pdf|max:1024',
        ]);

        // guardar el archivo de video en la store de Laravel
        $filepath = $request->file('filepath');
        $filepath_path = $filepath->store('public/dietas');

        // crear el nuevo registro en la base de datos
        $dieta = new \App\Models\Dieta();
        $dieta->name = $request->input('name');
        $dieta->descripcion = $request->input('descripcion');
        $filepath->move(public_path('dietas'), $filepath->getClientOriginalName());
        $dieta->filepath = $filepath_path;
        $dieta->timestamps = false;
        $dieta->save();

        return redirect('/admin/dieta');
    }
}
