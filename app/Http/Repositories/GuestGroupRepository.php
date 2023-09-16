<?php

namespace App\Http\Repositories;

use App\Models\GuestGroup;
use Illuminate\Http\Request;

class GuestGroupRepository {
    public function get() {
        return GuestGroup::get();
    }

    public function find(int $id): ?GuestGroup {
        return GuestGroup::find($id);
    }

    public function create(Request $request): GuestGroup {
        return GuestGroup::create([
            "name" => $request->name
        ]);
    }

    public function update(int $id, Request $request): bool {
        $guestGroup = GuestGroup::find($id);
        $guestGroup->name = $request->name;

        return $guestGroup->save();
    }

    public function delete(int $id) {
        $guestGroup = GuestGroup::find($id);
        return $guestGroup->delete();
    }
}