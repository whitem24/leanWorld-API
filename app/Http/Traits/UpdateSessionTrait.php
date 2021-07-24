<?php

namespace App\Http\Traits;
use App\Models\User;

trait UpdateSessionTrait {

    public function update($request) {
        // Fetch the user.
            $user = User::with(['roles.permissions.menu' => function($query) {
                $query->orderBy('order', 'ASC');
            },])->where('id', $request->user_id)->first();
        return $user;
    }
}