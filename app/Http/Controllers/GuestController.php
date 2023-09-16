<?php

namespace App\Http\Controllers;

use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use App\Helpers\ApiHelper;
use App\Http\Repositories\GuestRepository;
use App\Http\Repositories\GuestGroupRepository;
use Illuminate\Support\Facades\Validator;
use App\Models\Guest;
use Illuminate\Support\Str;


class GuestController extends Controller
{
    private $apiHelper;

    private $repo;

    private $guestGroupRepo;

    public function __construct(ApiHelper $apiHelper, GuestRepository $repo, GuestGroupRepository $guestGroupRepo)
    {
        $this->apiHelper = $apiHelper;
        $this->repo = $repo;
        $this->guestGroupRepo = $guestGroupRepo;
    }

    public function get(Request $request): JsonResponse {
        $name = $request->get('name');
        $guestGroupId = $request->get('guest_group_id');
        if ($guestGroupId != null) {
            $guestGroupId = (int) $guestGroupId;
        }

        try {
            $guest = $this->repo->get($name, $guestGroupId, null);
            return $this->apiHelper->getResponse(200, $guest);
        }catch (\Exception $e) {
            return $this->apiHelper->getErrorResponse(500, "Error on get guest", $e->getMessage());
        }
    }

    public function create(Request $request): JsonResponse {
        $validator = Validator::make($request->all(), [
            'name' => 'required',
            'guest_group_id' => 'required',
            'max_attendance' => 'required'
        ]);

        $request->invitation_url = Str::random(8);

        if ($validator->fails()) {
            return $this->apiHelper->getErrorResponse(422, "Error Validation", $validator->errors());
        }

        $guestGroup = $this->guestGroupRepo->find($request->guest_group_id);
        if ($guestGroup == null) {
            return $this->apiHelper->getErrorResponse(404, "Guest group not found", null);
        }

        try {
            $guest = $this->repo->create($request);
            return $this->apiHelper->getResponse(201, $guest);
        }catch (\Exception $e) {
            return $this->apiHelper->getErrorResponse(500, "Error on create guest", $e->getMessage());
        }
    }

    public function update(int $id, Request $request): JsonResponse {
        $validator = Validator::make($request->all(), [
            'name' => 'required',
            'guest_group_id' => 'required',
            'max_attendance' => 'required',
            'is_show_wishes' => 'required'
        ]);

        if ($validator->fails()) {
            return $this->apiHelper->getErrorResponse(422, "Error Validation", $validator->errors());
        }

        $guest = $this->repo->find($id);
        if ($guest == null) {
            return $this->apiHelper->getErrorResponse(404, "Guest not found", null);
        }

        $guestGroup = $this->guestGroupRepo->find($request->guest_group_id);
        if ($guestGroup == null) {
            return $this->apiHelper->getErrorResponse(404, "Guest group not found", null);
        }

        try {
            $this->repo->updateByAdmin($id, $request);
            return $this->apiHelper->getResponse(200, null);
        }catch (\Exception $e) {
            return $this->apiHelper->getErrorResponse(500, "Error on create guest", $e->getMessage());
        }
    }

    public function getByGuest(string $token) {
        try {
            $guest = $this->repo->findByToken($token);
            return $this->apiHelper->getResponse(200, [
                "token"=> $guest->invitation_url,
                "name"=> $guest->name,
                "max_attendance" => $guest->max_attendance
            ]);
        }catch (\Exception $e) {
            return $this->apiHelper->getErrorResponse(404, "Invitation not found");
        }
    }

    public function delete(int $id) {
        $guest = $this->repo->find($id);
        if ($guest == null) {
            return $this->apiHelper->getErrorResponse(404, "Guest not found", null);
        }
        
        try {
            $this->repo->delete($id);
            return $this->apiHelper->getResponse(200, null);
        }catch (\Exception $e) {
            return $this->apiHelper->getErrorResponse(500, "Error on delete guest", $e->getMessage());
        }
    }
}
