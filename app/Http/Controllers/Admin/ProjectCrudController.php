<?php

namespace App\Http\Controllers\Admin;

use App\Providers\AuthServiceProvider;
use Backpack\CRUD\app\Http\Controllers\CrudController;
use App\Models\User;
use App\Models\Project;

// VALIDATION: change the requests to match your own file names if you need form validation
use App\Http\Requests\ProjectRequest as StoreRequest;
use App\Http\Requests\ProjectRequest as UpdateRequest;
use Illuminate\Support\Facades\Auth;

/**
 * Class ProjectCrudController
 * @package App\Http\Controllers\Admin
 * @property-read CrudPanel $crud
 */
class ProjectCrudController extends CrudController
{
    const LINE = 'line';
    const TOP = 'top';
    const BEGINNING = 'beginning';
    const END = 'end';
    const LENGTHPANEL = 10;

    private $user_id;
    public function setup()
    {
        /*
        |--------------------------------------------------------------------------
        | CrudPanel Basic Information
        |--------------------------------------------------------------------------
        */
        $this->crud->setModel('App\Models\Project');
        $this->crud->setRoute(config('backpack.base.route_prefix') . '/project');
        $this->crud->setEntityNameStrings('project', 'projects');
        $this->user_id = Auth::user()->id;

        /*
        |--------------------------------------------------------------------------
        | CrudPanel Configuration
        |--------------------------------------------------------------------------
        */


        // ------ CRUD FIELDS
        $this->crud->addField(
            [
                'name' => 'name',
                'label' => "Name",
                'type' => 'text',
            ]
        );

        $this->crud->addField(
            [
                'name' => 'city',
                'label' => "City",
                'type' => 'text',
            ]
        );

        // ------ CRUD COLUMNS
        $this->crud->addColumn(
            [
                'name' => 'name',
                'label' => "Name",
                'type' => 'text',
            ]
        );
        $this->crud->addColumn(
            [
                'name' => 'city',
                'label' => "City",
                'type' => 'text',
            ]
        );

        $this->crud->addColumn(
            [
                'label' => "Sold",
                'type' => "soldTotalProperties",
                'priority' => 2,
            ]
        );

        $this->crud->addColumn(
            [
                'label' => "Separated",
                'type' => "separatedTotalProperties",
                'priority' => 2,
            ]
        );

        $this->crud->addColumn(
            [
                'label' => "Available",
                'type' => "availableTotalProperties",
                'priority' => 2,
            ]
        );

        // ------ ADVANCED QUERIES
        $this->crud->addClause('where', 'user_id', '=', $this->user_id);

        // add asterisk for fields that are required in ProjectRequest
        $this->crud->setRequiredFields(StoreRequest::class, 'create');
        $this->crud->setRequiredFields(UpdateRequest::class, 'edit');

        // ------ CRUD BUTTONS
        $this->crud->addButtonFromView(self::LINE, 'propertiesButton', 'properties_button', self::END);
    }

    public function store(StoreRequest $request)
    {
        $user_id = $request->user()->id;
        $user = User::find($user_id );

        if($user) {
            $request->merge(['user_id' => $user->id ]);
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
