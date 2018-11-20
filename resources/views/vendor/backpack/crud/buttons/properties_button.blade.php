@if($crud->hasAccess('list'))

    <a href="{{ '/'.$entry->getKey() }}/properties" class="btn btn-xs btn-default ">
        <i class="fa fa-files-o"></i> Properties
    </a>
@endif