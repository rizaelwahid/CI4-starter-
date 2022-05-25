<?php

namespace App\Controllers;

class FirstLoad extends BaseController
{
    /**
     * Instance of the main Request object added to prevent the
     * PHP Intelephense VS Code plug-in from falsely reporting
     * IncomingRequest class errors.
     *
     * @var HTTP\IncomingRequest
     */
    protected $request;
    protected $sliderModel;

    public function __construct()
    {
    }

    public function index()
    {
        return redirect()->to('/dashboard');
    }
}
