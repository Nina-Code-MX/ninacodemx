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
use Illuminate\Support\Js;

class ServiceControllerV1 extends Controller
{
    public $columns = ['*'],
        $page = 1,
        $perPage = 10;

    public function __construct()
    {
        $this->checkParams(app('request'));
    }

    /**
     * Get all Services
     *   Get all Services
     * @param Request $request The request object
     * @return JsonResponse
     */
    public function getAll(Request $request): JsonResponse
    {
        try {
            $services = Service::with('translations')->simplePaginate($perPage = $this->perPage, $columns = $this->columns, $pageName = 'page', $page = $this->page);

            return Response::json(
                $services
            );
        } catch (ModelNotFoundException $e) {
            return Response::json([
                'message' => 'Service not found.',
                'errors' => [
                    'NOTFOUND' => $e->getMessage()
                ]
            ], 404);
        }
    }

    /**
     * Create a Service
     *   Create a new Service
     * @param Request $request The request object
     * @return JsonResponse
     */
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
            'image' => 'image|nullable',
            'order' => 'integer|min:1|nullable'
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

    /**
     * Get a Service
     *   Get a Service
     * @param Request $request The request object
     * @return JsonResponse
     */
    public function get(Request $request, int $service_id): JsonResponse
    {
        try {
            $service = Service::with('translations')->findOrFail($service_id);

            return Response::json([
                'success' => true,
                'data' => $service
            ]);
        } catch (ModelNotFoundException $e) {
            return Response::json([
                'message' => 'Service not found.',
                'errors' => [
                    'NOTFOUND' => $e->getMessage()
                ]
            ], 404);
        }
    }

    /**
     * Update a Service
     *  Update a Service
     * @param Request $request The request object
     * @param $service_id The service id
     * @return JsonResponse
     */
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
            'image' => 'image|nullable',
            'order' => 'integer|min:1|nullable'
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

    /**
     * Translate a Service
     *   Translate a Service
     * @param Request $request The request object
     * @param $service_id The service id
     * @param string $lang The language
     * @return JsonResponse
     */
    public function translate(Request $request, $service_id, $lang = 'en'): JsonResponse
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

            return Response::json([
                'success' => true,
                'data' => $service
            ]);
        } catch (ModelNotFoundException $e) {
            return Response::json([
                'message' => 'Service not found.',
                'errors' => [
                    'NOTFOUND' => $e->getMessage()
                ]
            ], 404);
        }
    }

    /**
     * Delete a Service
     *  Delete a Service
     * @param Request $request The request object
     * @param $service_id The service id
     * @return JsonResponse
     */
    public function delete(Request $request, $service_id): JsonResponse
    {
        try {
            $service = Service::findOrFail($service_id);
            $service->delete();

            return Response::json([
                'success' => true,
                'message' => 'Service deleted.'
            ]);
        } catch (ModelNotFoundException $e) {
            return Response::json([
                'message' => 'Service not found.',
                'errors' => [
                    'NOTFOUND' => $e->getMessage()
                ]
            ], 404);
        } catch (\Error $e) {
            return Response::json([
                'message' => 'An unknown error has occurred.',
                'errors' => [
                    'NOTFOUND' => $e->getMessage()
                ]
            ], 500);
        }
    }

    private function checkParams(Request $request)
    {
        $this->page = $request->has('page') ? $request->get('page') : $this->page;
        $this->perPage = $request->has('perPage') ? $request->get('perPage') : $this->perPage;
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
