@php
    $project_id = $entry->getKey();
    $project = App\Models\Project::find($project_id);


@endphp
<span>{!!'$'. $project->totalMountByProperties() !!}</span>