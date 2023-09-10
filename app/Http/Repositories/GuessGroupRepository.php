<?php

namespace App\Http\Repositories;

use App\Models\GuessGroup;
use Illuminate\Http\Request;

class GuessGroupRepository {
    public function get() {
        return GuessGroup::get();
    }

    public function find(int $id): ?GuessGroup {
        return GuessGroup::find($id);
    }

    public function create(Request $request): GuessGroup {
        return GuessGroup::create([
            "name" => $request->name
        ]);
    }

    public function update(int $id, Request $request): bool {
        $guessGroup = GuessGroup::find($id);
        $guessGroup->name = $request->name;

        return $guessGroup->save();
    }
}