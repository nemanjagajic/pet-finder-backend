<?php

namespace App\Http\Controllers;

use App\Pet;
use App\Services\PetService;
use Illuminate\Http\Request;

class PetController extends Controller
{
    private $petService;

    public function __construct(PetService $petService)
    {
        $this->petService = $petService;
    }

    public function index()
    {
        return response(Pet::get());
    }


    public function store(Request $request)
    {
        $pet = $this->petService->savePet($request);

        if ($pet !== null) {
            return response($pet, 200);
        }
    }

    public function getComments($id)
    {
        $comments = Pet::find($id)->comments;
        return response($comments);
    }
}
