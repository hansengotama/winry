<?php

namespace App\Http\Controllers;

use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use App\Helpers\ApiHelper;
use App\Http\Repositories\GuestGroupRepository;
use Illuminate\Support\Facades\Validator;
use App\Models\GuestGroup;

class GuestGroupController extends Controller
{
    private $apiHelper;

    private $repo;

    public function __construct(ApiHelper $apiHelper, GuestGroupRepository $repo)
    {
        $this->apiHelper = $apiHelper;
        $this->repo = $repo;
    }

    public function get(): JsonResponse {
        try {
            $guestGroup = $this->repo->get();
            return $this->apiHelper->getResponse(200, $guestGroup);
        }catch (\Exception $e) {
            return $this->apiHelper->getErrorResponse(500, "Error on get guest group", $e->getMessage());
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
            $guestGroup = $this->repo->create($request);
            return $this->apiHelper->getResponse(201, $guestGroup);
        }catch (\Exception $e) {
            return $this->apiHelper->getErrorResponse(500, "Error on create guest group", $e->getMessage());
        }
    }

    public function update(int $id, Request $request): JsonResponse {
        $validator = Validator::make($request->all(), [
            'name' => 'required'
        ]);

        if ($validator->fails()) {
            return $this->apiHelper->getErrorResponse(422, "Error Validation", $validator->errors());
        }

        $guestGroup = $this->repo->find($id);
        if ($guestGroup == null) {
            return $this->apiHelper->getErrorResponse(404, "Guest group not found", null);
        }

        try {
            $this->repo->update($id, $request);
            return $this->apiHelper->getResponse(200, null);
        }catch (\Exception $e) {
            return $this->apiHelper->getErrorResponse(500, "Error on create guest group", $e->getMessage());
        }
    }

    public function delete(int $id) {
        $guestGroup = $this->repo->find($id);
        if ($guestGroup == null) {
            return $this->apiHelper->getErrorResponse(404, "Guest group not found", null);
        }

        try {
            $this->repo->delete($id);
            return $this->apiHelper->getResponse(200, null);
        }catch (\Exception $e) {
            return $this->apiHelper->getErrorResponse(500, "Error on delete guest group", $e->getMessage());
        }
    }
}
