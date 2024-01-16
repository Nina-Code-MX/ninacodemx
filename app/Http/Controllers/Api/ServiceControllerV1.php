<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\Service;
use App\Models\Translation;
use Illuminate\Database\Eloquent\ModelNotFoundException;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Response;
use Illuminate\Http\JsonResponse;
use Illuminate\Support\Facades\Storage;

class ServiceControllerV1 extends Controller
{
    public function create(Request $request): JsonResponse
    {
        if (!$this->checkPermissions($request)) {
            return Response::json([
                'message' => 'Unauthorized'
            ], 403);
        }

        $serviceData = $request->validate([
            'name' => 'required|string|min:1|max:191',
            'excerpt' => 'required|string|min:1',
            'description' => 'string|min:1',
            'slug' => 'required|string|min:1|max:191',
            'image' => 'image|nullable'
        ]);

        try {
            $image_path = $request->file('image')->storeAs('assets/images', $serviceData['slug'] . '.' . $request->file('image')->extension(), 'public');
            $serviceData['image'] = $image_path;
            $service = Service::create($serviceData);
            $service->image = asset(Storage::url($service->image));
        } catch (ModelNotFoundException $e) {
            return Response::json([
                'message' => 'Service not found.',
                'errors' => [
                    'NOTFOUND' => $e->getMessage()
                ]
            ], 404);
        }

        return Response::json([
            'success' => true,
            'data' => $service
        ]);
    }

    public function update(Request $request, $service_id): JsonResponse
    {
        if (!$this->checkPermissions($request)) {
            return Response::json([
                'message' => 'Unauthorized'
            ], 403);
        }

        $serviceData = $request->validate([
            'name' => 'required|string|min:1|max:191',
            'excerpt' => 'required|string|min:1',
            'description' => 'string|min:1',
            'slug' => 'required|string|min:1|max:191',
            'image' => 'image|nullable'
        ]);

        try {
            $service = Service::findOrFail($service_id);
            $image_path = $request->file('image')->storeAs('assets/images', $serviceData['slug'] . '.' . $request->file('image')->extension(), 'public');
            $serviceData['image'] = $image_path;
            $service->update($serviceData);
            $service->image = asset(Storage::url($service->image));
        } catch (ModelNotFoundException $e) {
            return Response::json([
                'message' => 'Service not found.',
                'errors' => [
                    'NOTFOUND' => $e->getMessage()
                ]
            ], 404);
        }

        return Response::json([
            'success' => true,
            'data' => $service
        ]);
    }

    public function translate(Request $request, $service_id, $lang = 'en')
    {
        if (!$this->checkPermissions($request)) {
            return Response::json([
                'message' => 'Unauthorized'
            ], 403);
        }

        $serviceData = $request->validate([
            'name' => 'required|string|min:1|max:191',
            'excerpt' => 'required|string|min:1',
            'description' => 'string|min:1',
            'slug' => 'required|string|min:1|max:191'
        ]);

        try {
            $service = Translation::updateOrCreate([
                'model_name' => 'Service',
                'model_id' => $service_id,
                'lang' => $lang
            ],
            [
                'model_name' => 'Service',
                'model_id' => $service_id,
                'lang' => $lang,
                'value' => $serviceData
            ]);
        } catch (ModelNotFoundException $e) {
            return Response::json([
                'message' => 'Service not found.',
                'errors' => [
                    'NOTFOUND' => $e->getMessage()
                ]
            ], 404);
        }

        return Response::json([
            'success' => true,
            'data' => $service
        ]);
    }

    /**
     * Check permissions
     * @param Request $request
     * @return bool
     */
    private function checkPermissions(Request $request): bool
    {
        $token = $request->user()->tokens()->where('token', $request->user()->activeToken)->first();

        if (!$token) {
            return false;
        }

        if (!in_array('services:*', $token->abilities)) {
            return false;
        }

        return true;
    }
}
