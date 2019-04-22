<?php

namespace App\Http\Controllers;
use App\PetAdComment;
use App\Services\PetAdService;

use Illuminate\Http\Request;

class PetAdCommentController extends Controller
{
    private $petAdService;

    public function __construct(PetAdService $petAdService)
    {
        $this->petAdService = $petAdService;
    }

    public function index()
    {
        return response(PetAdComment::get());
    }

    public function store(Request $request)
    {
        $savedPet = $this->petAdService->saveComment($request);
        return response($savedPet);
    }
}
