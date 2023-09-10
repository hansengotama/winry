<?php

namespace App\Http\Controllers;

use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use App\Helpers\ApiHelper;
use App\Http\Repositories\GuessGroupRepository;
use Illuminate\Support\Facades\Validator;
use App\Models\GuessGroup;

class GuessGroupController extends Controller
{
    private $apiHelper;

    private $repo;

    public function __construct(ApiHelper $apiHelper, GuessGroupRepository $repo)
    {
        $this->apiHelper = $apiHelper;
        $this->repo = $repo;
    }

    public function get(): JsonResponse {
        try {
            $guessGroup = $this->repo->get();
            return $this->apiHelper->getResponse(200, $guessGroup);
        }catch (\Exception $e) {
            return $this->apiHelper->getErrorResponse(500, "Error on get guess group", $e->getMessage());
        }
    }

    public function create(Request $request): JsonResponse {
        $validator = Validator::make($request->all(), [
            'name' => 'required'
        ]);

        if ($validator->fails()) {
            return $this->apiHelper->getErrorResponse(422, "Error Validation", $validator->errors());
        }

        try {
            $guessGroup = $this->repo->create($request);
            return $this->apiHelper->getResponse(201, $guessGroup);
        }catch (\Exception $e) {
            return $this->apiHelper->getErrorResponse(500, "Error on create guess group", $e->getMessage());
        }
    }

    public function update(int $id, Request $request): JsonResponse {
        $validator = Validator::make($request->all(), [
            'name' => 'required'
        ]);

        if ($validator->fails()) {
            return $this->apiHelper->getErrorResponse(422, "Error Validation", $validator->errors());
        }

        $guessGroup = $this->repo->find($id);
        if ($guessGroup == null) {
            return $this->apiHelper->getErrorResponse(400, "Guess group not found", null);
        }

        try {
            $this->repo->update($id, $request);
            return $this->apiHelper->getResponse(200, null);
        }catch (\Exception $e) {
            return $this->apiHelper->getErrorResponse(500, "Error on create guess group", $e->getMessage());
        }
    }
}
