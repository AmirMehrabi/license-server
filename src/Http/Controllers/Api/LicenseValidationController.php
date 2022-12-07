<?php

namespace LaravelReady\LicenseServer\Http\Controllers\Api;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Event;

use LaravelReady\LicenseServer\Models\License;
use LaravelReady\LicenseServer\Events\LicenseChecked;
use LaravelReady\LicenseServer\Http\Controllers\BaseController;

class LicenseValidationController extends BaseController
{
    /**
     * Validate given license
     *
     * @return \Illuminate\Http\Response
     */
    public function licenseValidate(Request $request, License $license)
    {
        $_license = License::where('id', auth()->user()->id)->first();

        $data = $request->input();

        Event::dispatch(new LicenseChecked($_license, $data));

        return $_license;
    }

    /**
     * Validate given license
     *
     * @return \Illuminate\Http\Response
     */
    public function checkAllowedUsers(Request $request, License $license)
    {
        $_license = License::where('id', auth()->user()->id)->first();

        $data = $request->input();

        Event::dispatch(new LicenseChecked($_license, $data));

        return $_license->allowed_users;
    }
}
