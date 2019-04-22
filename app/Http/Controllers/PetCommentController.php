<?php

namespace App\Http\Controllers;

use App\PetComment;
use Illuminate\Http\Request;
use App\Services\PetService;

class PetCommentController extends Controller
{
    private $petService;

    public function __construct(PetService $petService)
    {
        $this->petService = $petService;
    }

    public function index()
    {
        return response(PetComment::get());
    }

    public function store(Request $request)
    {
        $savedPet = $this->petService->saveComment($request);
        return response($savedPet);
    }
}
