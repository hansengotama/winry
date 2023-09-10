<?php

namespace App\Http\Repositories;

use App\Models\Guess;
use Illuminate\Http\Request;

class GuessRepository {
    public function get(?string $name, ?int $guessGroupId, ?boolean $isShowWishes) {
        $guess = Guess::query();

        if ($name != null) {
            $guess->where("name", "like", "%$name%");
        }

        if ($guessGroupId != null) {
            $guess->where("guess_group_id", $guessGroupId);
        }

        if ($isShowWishes != null) {
            $guess->where("is_show_wishes", $isShowWishes);
        }

        return $guess->with("guessGroup")->get();
    }

    public function find(int $id): ?Guess {
        return Guess::find($id);
    }

    public function create(Request $request): Guess {
        return Guess::create([
            "name" => $request->name,
            "guess_group_id" => $request->guess_group_id,
            "invitation_url" => $request->invitation_url,
            "max_attendance" => $request->max_attendance
        ]);
    }

    public function updateByAdmin(int $id, Request $request): bool {
        $guess = Guess::find($id);
        $guess->name = $request->name;
        $guess->guess_group_id = $request->guess_group_id;
        $guess->max_attendance = $request->max_attendance;

        return $guess->save();
    }
}