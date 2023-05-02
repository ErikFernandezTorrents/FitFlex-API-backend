<?php

namespace App\Http\Controllers\Admin;
use Illuminate\Http\Request;
use App\Http\Requests\CursoRequest;
use Backpack\CRUD\app\Http\Controllers\CrudController;
use Backpack\CRUD\app\Library\CrudPanel\CrudPanelFacade as CRUD;

/**
 * Class CursoCrudController
 * @package App\Http\Controllers\Admin
 * @property-read \Backpack\CRUD\app\Library\CrudPanel\CrudPanel $crud
 */
class CursoCrudController extends CrudController
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
        CRUD::setModel(\App\Models\Curso::class);
        CRUD::setRoute(config('backpack.base.route_prefix') . '/curso');
        CRUD::setEntityNameStrings('curso', 'cursos');

        if (backpack_user()->hasPermissionTo('cursos.list')) {
            CRUD::allowAccess('list');
        }else{
            CRUD::denyAccess('list');
        }
        if (backpack_user()->hasPermissionTo('cursos.create')) {
            CRUD::allowAccess('create');
        }else{
            CRUD::denyAccess('create');
        }
        if (backpack_user()->hasPermissionTo('cursos.update')) {
            CRUD::allowAccess('update');
        }else{
            CRUD::denyAccess('update');
        }
        if (backpack_user()->hasPermissionTo('cursos.read')) {
            CRUD::allowAccess('read');
        }else{
            CRUD::denyAccess('read');
        }
        if (backpack_user()->hasPermissionTo('cursos.delete')) {
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
        CRUD::column('titulo');
        CRUD::column('descripcion');
        CRUD::column('modalidad');
        CRUD::column('duracion');
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
        CRUD::setValidation(CursoRequest::class);

        CRUD::field('titulo');
        CRUD::field('descripcion');
        CRUD::field('modalidad');
        CRUD::field('duracion');
        CRUD::addField([
            'name' => 'filepath',
            'label' => 'Imagen',
            'type' => 'upload',
            'upload' => true,
            'disk' => 'public',
            'prefix' => 'filepath',
            'overwrite' => false,
            'crop' => false,
            'aspect_ratio' => 0,
            'mime_types' => 'png,jpg',
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
            'titulo' => 'required',
            'descripcion' => 'required',
            'modalidad' => 'required',
            'duracion' => 'required',
            'filepath' => 'required|mimes:png,jpg|max:1024',
        ]);

        // guardar el archivo de video en la store de Laravel
        $filepath = $request->file('filepath');
        $filepath_path = $filepath->store('public/imagenes');

        // crear el nuevo registro en la base de datos
        $curso = new \App\Models\Curso();
        $curso->titulo = $request->input('titulo');
        $curso->descripcion = $request->input('descripcion');
        $curso->modalidad = $request->input('modalidad');
        $curso->duracion = $request->input('duracion');
        $filepath->move(public_path('imagenes'), $filepath->getClientOriginalName());
        $curso->filepath = $filepath_path;
        $curso->timestamps = false;
        $curso->save();

        return redirect('/admin/curso');
    }
}
