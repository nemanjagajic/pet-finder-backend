<?php

namespace App\Http\Controllers;

use App\Pet;
use App\Services\PetService;
use Illuminate\Http\Request;
use App\User;

class PetController extends Controller
{
    private $petService;

    public function __construct(PetService $petService)
    {
        $this->petService = $petService;
    }

    public function index()
    {
        $pets = Pet::get();

        $petsReversed = [];
        foreach ($pets as $pet) {
            $pet->fullName = User::where('id', $pet->userId)->get()->pluck('fullName')[0];
            array_unshift($petsReversed, $pet);
        }

        return response($petsReversed);
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

        $commentsReversed = [];
        foreach ($comments as $comment) {
            $comment->fullName = User::where('id', $comment->user_id)->get()->pluck('fullName')[0];
            array_unshift($commentsReversed, $comment);
        }

        return response($commentsReversed);
    }
}
