<?php

use Laravel\Nova\Nova;
use Illuminate\Support\Arr;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

Route::put('/{resourceName}/{resourceId}', function ($resourceName, $resourceId, Request $request) {

    $resource = Nova::resourceForKey($resourceName);
    $model = $resource::newModel()->findOrFail($resourceId);

    $model->{$request->attribute} = Arr::get($request, $request->attribute);
    $model->save();

    return response()->json([
        'saved' => true,
        'data' => $model->fresh()->toArray(),
    ]);
});
