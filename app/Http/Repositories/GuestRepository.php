<?php

namespace App\Http\Repositories;

use App\Models\Guest;
use Illuminate\Http\Request;
use Illuminate\Pagination\Paginator;

class GuestRepository {
    public function get(int $page, int $perPage, ?string $name, ?int $guestGroupId, ?bool $isShowWishes) {
        $guest = Guest::query();

        if ($name != null) {
            $guest->where("name", "like", "%$name%");
        }

        if ($guestGroupId != null) {
            $guest->where("guest_group_id", $guestGroupId);
        }

        if ($isShowWishes != null) {
            $guest->where("is_show_wishes", $isShowWishes);
        }

        Paginator::currentPageResolver(function () use ($page) {
            return $page;
        });

        return $guest->with("guestGroup")->paginate($perPage);
    }

    public function find(int $id): ?Guest {
        return Guest::find($id);
    }

    public function findByToken(string $token): ?Guest {
        return Guest::where("invitation_url", $token)->first();
    }

    public function create(Request $request): Guest {
        return Guest::create([
            "name" => $request->name,
            "guest_group_id" => $request->guest_group_id,
            "invitation_url" => $request->invitation_url,
            "max_attendance" => $request->max_attendance
        ]);
    }

    public function updateByAdmin(int $id, Request $request): bool {
        $guest = Guest::find($id);
        $guest->name = $request->name;
        $guest->guest_group_id = $request->guest_group_id;
        $guest->max_attendance = $request->max_attendance;
        $guest->is_show_wishes = $request->is_show_wishes;

        return $guest->save();
    }

    public function updateByGuess(int $id, Request $request): bool {
        $guest = Guest::find($id);
        $guest->email = $request->email;
        $guest->is_attend = $request->is_attend;
        $guest->number_of_attendance = $request->number_of_attendance;
        $guest->wishes = $request->wishes;
        $guest->wishes_icon_type = $request->wishes_icon_type;

        return $guest->save();
    }

    public function delete(int $id) {
        $guest = Guest::find($id);
        return $guest->delete();
    }
}