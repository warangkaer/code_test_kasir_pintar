<?php
namespace App\DTO;

use App\Models\User;

class UserDTO{
    public static function updateUser(object $data, string $id): User
    {
        $user = User::find($id);
        $user->update([
            'name' => $data->name,
            'email' => $data->email,
            'nip' => $data->nip,
            'degree' => $data->degree,
        ]);

        if($data->password != '' || $data->password != null) $user->update(['password' => $data->password]);

        return $user;
    }
}
?>
