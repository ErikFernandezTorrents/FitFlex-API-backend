<?php

namespace App\Http\Controllers\Admin;

use App\Http\Requests\EjercicioRequest;
use Illuminate\Http\Request;
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
        CRUD::column('id')->label(__('id'));
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
        CRUD::addField([
            'name' => 'id_video',
            'label' => 'Video',
            'type' => 'upload',
            'upload' => true,
            'disk' => 'public',
            'prefix' => 'videos',
            'overwrite' => false,
            'crop' => false,
            'aspect_ratio' => 0,
            'mime_types' => 'mp4,avi,wmv',
            'store_as' => function (Request $request, $file) {
                return 'video_' . time() . '.' . $file->getClientOriginalExtension();
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
            'id_video' => 'required|mimes:mp4,avi,wmv|max:102400', // máximo 100 MB
        ]);

        // guardar el archivo de video en la store de Laravel
        $video = $request->file('id_video');
        $video_path = $video->store('public/videos');

        // crear el nuevo registro en la base de datos
        $ejercicio = new \App\Models\Ejercicio();
        $ejercicio->titulo = $request->input('titulo');
        $ejercicio->descripcion = $request->input('descripcion');
        $ejercicio->id_video = $video_path;
        $video->move(public_path('videos'), $video->getClientOriginalName());
        $ejercicio->save();

        return redirect('/admin/ejercicio');
    }
}
