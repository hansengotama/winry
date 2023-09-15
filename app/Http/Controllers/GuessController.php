<?php

namespace App\Http\Controllers;

use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use App\Helpers\ApiHelper;
use App\Http\Repositories\GuessRepository;
use App\Http\Repositories\GuessGroupRepository;
use Illuminate\Support\Facades\Validator;
use App\Models\Guess;
use Illuminate\Support\Str;


class GuessController extends Controller
{
    private $apiHelper;

    private $repo;

    private $guessGroupRepo;

    public function __construct(ApiHelper $apiHelper, GuessRepository $repo, GuessGroupRepository $guessGroupRepo)
    {
        $this->apiHelper = $apiHelper;
        $this->repo = $repo;
        $this->guessGroupRepo = $guessGroupRepo;
    }

    public function get(Request $request): JsonResponse {
        $name = $request->get('name');
        $guessGroupId = $request->get('guess_group_id');
        if ($guessGroupId != null) {
            $guessGroupId = (int) $guessGroupId;
        }

        try {
            $guess = $this->repo->get($name, $guessGroupId, null);
            return $this->apiHelper->getResponse(200, $guess);
        }catch (\Exception $e) {
            return $this->apiHelper->getErrorResponse(500, "Error on get guess", $e->getMessage());
        }
    }

    public function create(Request $request): JsonResponse {
        $validator = Validator::make($request->all(), [
            'name' => 'required',
            'guess_group_id' => 'required',
            'max_attendance' => 'required'
        ]);

        $request->invitation_url = Str::random(18);

        if ($validator->fails()) {
            return $this->apiHelper->getErrorResponse(422, "Error Validation", $validator->errors());
        }

        $guessGroup = $this->guessGroupRepo->find($request->guess_group_id);
        if ($guessGroup == null) {
            return $this->apiHelper->getErrorResponse(404, "Guess group not found", null);
        }

        try {
            $guess = $this->repo->create($request);
            return $this->apiHelper->getResponse(201, $guess);
        }catch (\Exception $e) {
            return $this->apiHelper->getErrorResponse(500, "Error on create guess", $e->getMessage());
        }
    }

    public function update(int $id, Request $request): JsonResponse {
        $validator = Validator::make($request->all(), [
            'name' => 'required',
            'guess_group_id' => 'required',
            'max_attendance' => 'required'
        ]);

        if ($validator->fails()) {
            return $this->apiHelper->getErrorResponse(422, "Error Validation", $validator->errors());
        }

        $guess = $this->repo->find($id);
        if ($guess == null) {
            return $this->apiHelper->getErrorResponse(404, "Guess not found", null);
        }

        $guessGroup = $this->guessGroupRepo->find($request->guess_group_id);
        if ($guessGroup == null) {
            return $this->apiHelper->getErrorResponse(404, "Guess group not found", null);
        }

        try {
            $this->repo->updateByAdmin($id, $request);
            return $this->apiHelper->getResponse(200, null);
        }catch (\Exception $e) {
            return $this->apiHelper->getErrorResponse(500, "Error on create guess", $e->getMessage());
        }
    }
}
