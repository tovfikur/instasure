<?php

namespace App\Services;

use App\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\File;

class UserService
{
    /**
     * Create new user
     * @param $request
     * @return User $user
     */
    public function create($request)
    {
        $user                = new User();
        $user->name          = $request->name;
        if ($request->email) {
            $user->email     = $request->email ?? null;
        }
        $user->phone         = $request->phone;
        $user->password      = bcrypt($request->password);
        $user->user_type     = 'customer';
        $user->banned        = 1;
        $user->save();
        return $user;
    }



    /**
     * Update user
     * @param Illuminate\Http\Request $request
     * @param App\User $user
     * @return App\User $user
     */
    public function update(Request $request, $user)
    {

        $user->name = $request->name ?? $user->name;
        $user->phone = $request->phone ?? $user->phone;
        $user->email = $request->email ??  $user->email;
        $user->address = $request->address ??  $user->address;
        $user->dob = $request->dob ?? $user->dob;
        $user->passport_number = $request->passport_number ?? $user->passport_number;
        $user->passport_expire_till = $request->passport_expire_till ?? $user->passport_expire_till;

        ## Avatar image upload
        if ($request->hasFile('avatar_original')) {
            ## Delete existing image
            $image_path = public_path('/') . $user->avatar_original;
            $this->delete_file($image_path);
            ## Upload new image
            $user->avatar_original = $request->avatar_original->store('uploads/profile');
        }

        ## Passport images upload
        if ($request->hasFile('passport')) {
            $passportImages = array();

            ## Delete existing image
            $existing_passport_images = json_decode($user->passport);
            if ($existing_passport_images) {
                foreach (json_decode($user->passport) as $value) {
                    $image_path = public_path('/') . $value;
                    $this->delete_file($image_path);
                }
            }


            ## Upload new passport images
            foreach ($request->passport as $key => $passport) {
                $path = $passport->store('uploads/passport');
                array_push($passportImages, $path);
            }
            $user->passport = json_encode($passportImages);
        }

        ## NID images upload
        if ($request->hasFile('nid')) {
            $nidImages = array();

            ## Delete existing image
            $existing_nid_images = json_decode($user->nid);
            if ($existing_nid_images) {
                foreach (json_decode($user->nid) as $value) {
                    $image_path = public_path('/') . $value;
                    $this->delete_file($image_path);
                }
            }

            ## Upload nid images
            foreach ($request->nid as $key => $nid) {
                $path = $nid->store('uploads/nid');
                array_push($nidImages, $path);
            }
            $user->nid = json_encode($nidImages);
        }

        ## Driving licence image upload
        if ($request->hasFile('driving_licence')) {

            ## Delete existing image
            if ($user->driving_licence) {
                $image_path = public_path('/') . $user->driving_licence;
                $this->delete_file($image_path);
            }

            ## Upload driving licence images
            $user->driving_licence = $request->driving_licence->store('uploads/driving_licence');
        }

        ## Birth certificate image upload
        if ($request->hasFile('birth_certificate')) {
            ## Delete existing image
            if ($user->birth_certificate) {
                $image_path = public_path('/') . $user->birth_certificate;
                $this->delete_file($image_path);
            }
            ## Upload birth_certificate image
            $user->birth_certificate = $request->birth_certificate->store('uploads/birth_certificate');
        }
        $user->save();
        return $user;
    }

    /**
     * Delete exist file if exist
     * @param File $image_path
     * @return boolean true|false
     */
    public function delete_file($image_path)
    {
        if (File::exists($image_path)) {
            File::delete($image_path);
        }
    }
}
