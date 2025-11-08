<?php

namespace App\Actions\Fortify;

use App\Models\User;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;
use Illuminate\Validation\Rule;
use Laravel\Fortify\Contracts\CreatesNewUsers;

class CreateNewUser implements CreatesNewUsers
{
    use PasswordValidationRules;

    /**
     * Validate and create a newly registered user.
     *
     * @param  array<string, string>  $input
     */
    public function create(array $input): User
    {
        Validator::make($input, [
            'name' => ['required', 'string', 'max:255'],
            'email' => [
                'required',
                'string',
                'email',
                'max:255',
                Rule::unique(User::class),
            ],
            'password'  => ['required', 'confirmed',$this->passwordRules()],
            'gender'    => ['required', 'in:Pria,Wanita'],
            'image'     => ['required', 'file', 'image', 'mimes:jpeg,png,jpg,gif', 'max:2048'],
            'address'   => ['nullable', 'string'],
            'whatsapp_number'   => ['required', 'string', 'max:15'],
        ])->validate();

        // upload image
        if(isset($input['image']) && $input['image'] instanceof \Illuminate\Http\UploadedFile){
            $image = $input['image'];
            $imageName =$image->hashName();
            $image->storeAs('users', $imageName, 'public');
            $input['image'] = $imageName;
        }

        // save
        return User::create([
            'name' => $input['name'],
            'email' => $input['email'],
            'password' => Hash::make($input['password']),
            'gender' => $input['gender'],
            'image' => $input['image'] ?? null,
            'address' => $input['address'] ?? null,
            'whatsapp_number' => $input['whatsapp_number'] ?? null,
        ]);
    }
}
