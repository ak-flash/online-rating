<?php

namespace App\Actions\Fortify;

use App\Helper\Helper;
use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Support\Facades\File;
use Illuminate\Support\Facades\Validator;
use Illuminate\Validation\Rule;
use Intervention\Image\Facades\Image;
use Laravel\Fortify\Contracts\UpdatesUserProfileInformation;

class UpdateUserProfileInformation implements UpdatesUserProfileInformation
{

    /**
     * Validate and update the given user's profile information.
     *
     * @param  mixed  $user
     * @param  array  $input
     * @return void
     */
    public function update($user, array $input)
    {
        $input['phone'] = Helper::clearMask($input['phone']);

        Validator::make($input, [
            'name' => ['required', 'string', 'max:255'],
            'email' => ['required', 'email', 'max:255', Rule::unique('users')->ignore($user->id)],
            'phone' => ['nullable', 'numeric', 'digits_between:3,18', Rule::unique('users')->ignore($user->id)],
            'position_id' => ['nullable', 'numeric', 'max:15'],
            'photo' => ['nullable', 'image', 'max:1024'],
        ])->validateWithBag('updateProfileInformation');


        if (isset($input['photo'])) {
            $user->updateProfilePhoto($input['photo']);

            $studentPhotoName = explode('/', $user->profile_photo_path);

            $photoThumbnailPath = 'storage/profile-photos/thumbnails/';
            if(!File::exists($photoThumbnailPath)) {

                File::makeDirectory($photoThumbnailPath, 0755, true, true);
            }

            $studentPhotoThumbnail = Image::make($input['photo'])->fit(200)->save($photoThumbnailPath.$studentPhotoName[1]);
        }

        if ($input['email'] !== $user->email &&
            $user instanceof MustVerifyEmail) {
            $this->updateVerifiedUser($user, $input);
        } else {

            $user->forceFill([
                'name' => $input['name'],
                'email' => $input['email'],
                'phone' => $input['phone'],
                'show_phone' => $input['show_phone'],
                'position_id' => $input['position_id'],
            ])->save();
        }
    }

    /**
     * Update the given verified user's profile information.
     *
     * @param  mixed  $user
     * @param  array  $input
     * @return void
     */
    protected function updateVerifiedUser($user, array $input)
    {
        $user->forceFill([
            'name' => $input['name'],
            'email' => $input['email'],
            'email_verified_at' => null,
        ])->save();

        $user->sendEmailVerificationNotification();
    }

}
