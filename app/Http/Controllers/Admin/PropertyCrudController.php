<?php

namespace App\Http\Controllers\Admin;

use App\Models\Project;
use Backpack\CRUD\app\Http\Controllers\CrudController;

// VALIDATION: change the requests to match your own file names if you need form validation
use App\Http\Requests\PropertyRequest as StoreRequest;
use App\Http\Requests\PropertyRequest as UpdateRequest;

/**
 * Class PropertyCrudController
 * @package App\Http\Controllers\Admin
 * @property-read CrudPanel $crud
 */
class PropertyCrudController extends CrudController
{
    protected $project_id;
    public function setup()
    {
        $this->project_id = \Route::current()->parameter('project_id');


        /*
        |--------------------------------------------------------------------------
        | CrudPanel Basic Information
        |--------------------------------------------------------------------------
        */
        $this->crud->setModel('App\Models\Property');
        $this->crud->setRoute($this->project_id . '/properties');
        $this->crud->setEntityNameStrings('property', 'properties');


        /*
        |--------------------------------------------------------------------------
        | CrudPanel Configuration
        |--------------------------------------------------------------------------
        */


        // ------ CRUD FIELDS
        $this->crud->addField(
            [
                'name' => 'sku',
                'label' => "SKU",
                'type' => 'text',
            ]
        );

        $this->crud->addField(
            [
                'name' => 'description',
                'label' => "Description",
                'type' => 'text',
            ]
        );

        $this->crud->addField(
            [
                'name' => 'description',
                'label' => "Description",
                'type' => 'text',
            ]
        );

        $this->crud->addField(
            [   // Enum
                'name' => 'status',
                'label' => 'Status',
                'type' => 'enum'
            ]
        );

        $this->crud->addField(
            [   // Enum
                'name' => 'type',
                'label' => 'Type',
                'type' => 'enum'
            ]
        );

        $this->crud->addField(
            [
                'name' => 'price',
                'label' => 'Price',
                'type' => 'number',
                'prefix' => "$",
                'attributes' => ["step" => "any"], // allow decimals
            ]
        );

//        $this->crud->addField(
//            [   // Upload
//                'name' => 'photo',
//                'label' => 'Image',
//                'type' => 'upload',
//                'upload' => true,
//                'disk' => 'public' // if you store files in the /public folder, please ommit this; if you store them in /storage or S3, please specify it;
//            ]
//        );
        $this->crud->addField([ // base64_image
            'label' => "Profile Image",
            'name' => "photo",
            'filename' => "image_filename", // set to null if not needed
            'type' => 'base64_image',
            'aspect_ratio' => 1, // set to 0 to allow any aspect ratio
            'crop' => true, // set to true to allow cropping, false to disable
            'src' => NULL, // null to read straight from DB, otherwise set to model accessor function
        ]);


        $this->crud->addColumn(
            [
                'name' => 'sku',
                'label' => "Sku",
                'type' => 'text',
            ]
        );

        $this->crud->addColumn(
            [
                'name' => 'photo', // The db column name
                'label' => "image", // Table column heading
                'type' => 'image',
//                 'prefix' => 'properties/',
                // optional width/height if 25px is not ok with you
                // 'height' => '30px',
                // 'width' => '30px',
            ]
        );

        $this->crud->addColumn(
            [
                'name' => 'price',
                'label' => "Price",
                'type' => 'text',
            ]
        );

        $this->crud->addColumn(
            [
                'name' => 'type',
                'label' => "Type",
                'type' => 'text',
            ]
        );

        $this->crud->addColumn(
            [
                'name' => 'status',
                'label' => "Status",
                'type' => 'text',
            ]
        );

        // ------ ADVANCED QUERIES
        $this->crud->addClause('where', 'project_id', '=', $this->project_id);

        // add asterisk for fields that are required in PropertyRequest
        $this->crud->setRequiredFields(StoreRequest::class, 'create');
        $this->crud->setRequiredFields(UpdateRequest::class, 'edit');
    }

    public function store(StoreRequest $request)
    {
        $project = Project::find(\Route::current()->parameter('project_id'));

        if($project) {
            $request->merge(['project_id' => $project->id ]);
        }
        else{
            return abort(404);
        }

        // your additional operations before save here
        $redirect_location = parent::storeCrud($request);
        // your additional operations after save here
        // use $this->data['entry'] or $this->crud->entry
        return $redirect_location;
    }

    public function update(UpdateRequest $request)
    {
        // your additional operations before save here
        $redirect_location = parent::updateCrud($request);
        // your additional operations after save here
        // use $this->data['entry'] or $this->crud->entry
        return $redirect_location;
    }
}
