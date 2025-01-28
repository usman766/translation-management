<?php

namespace App\Http\Controllers;

use App\Http\Requests\TranslationRequest;
use App\Http\Resources\TranslationResource;
use App\Models\Translation;
use App\Repositories\TranslationRepository;
use Illuminate\Http\JsonResponse;
use App\Filters\TranslationFilter;
use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\AnonymousResourceCollection;

class TranslationController extends Controller
{

    /**
     * TranslationController constructor.
     *
     * @param TranslationRepository $repository 
     */
    public function __construct(private TranslationRepository $repository) {}

    /**
     * Display a list of translations with optional filters.
     *
     * @param Request $request
     * @return AnonymousResourceCollection|JsonResponse
     */
    public function index(Request $request): AnonymousResourceCollection|JsonResponse
    {
        try {
            $translations = $this->repository->index($request->only(['tag', 'key', 'content']));
            return TranslationResource::collection($translations);
        } catch (\Exception $e) {
            return jsonResponse(message: $e->getMessage(), statusCode: 500);
        }
    }

    /**
     * Store a new translation.
     *
     * @param TranslationRequest $request
     * @return JsonResponse|TranslationResource
     */
    public function store(TranslationRequest $request): JsonResponse|TranslationResource
    {
        try {
            $translation = $this->repository->create($request->validated());
            return new TranslationResource($translation);
        } catch (\Exception $e) {
            return jsonResponse(message: $e->getMessage(), statusCode: 500);
        }
    }

    /**
     * Display a specific translation.
     *
     * @param Translation $translation
     * @return JsonResponse|TranslationResource
     */
    public function show(Translation $translation): JsonResponse|TranslationResource
    {
        try {
            return new TranslationResource($translation);
        } catch (\Exception $e) {
            return jsonResponse(message: $e->getMessage(), statusCode: 500);
        }
    }

    /**
     * Update a specific translation.
     *
     * @param TranslationRequest $request
     * @param Translation $translation
     * @return TranslationResource|JsonResponse
     */
    public function update(TranslationRequest $request, Translation $translation): TranslationResource|JsonResponse
    {
        try {
            $this->repository->update($translation, $request->validated());
            return new TranslationResource($translation);
        } catch (\Exception $e) {
            return jsonResponse(message: $e->getMessage(), statusCode: 500);
        }
    }

    /**
     * Delete a specific translation.
     *
     * @param Translation $translation
     */
    public function destroy(Translation $translation): JsonResponse
    {
        try {
            $this->repository->delete($translation);
            return jsonResponse(message: __('translation.deleted'), statusCode: 200);
        } catch (\Exception $e) {
            return jsonResponse(message: $e->getMessage(), statusCode: 500);
        }
    }

    /**
     * Export translations as JSON.
     *
     * @param Request $request
     * @return JsonResponse|AnonymousResourceCollection
     */
    public function export(Request $request): JsonResponse|AnonymousResourceCollection
    {
        try {
            $translations = $this->repository->export($request->only(['tag', 'key', 'locale']));
            return TranslationResource::collection($translations);
        } catch (\Exception $e) {
            return jsonResponse(message: $e->getMessage(), statusCode: 500);
        }
    }
}
