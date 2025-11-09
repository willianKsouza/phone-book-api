<?php

namespace App\Http\Controllers\Contact;

use App\Http\Controllers\Controller;
use App\Services\DeleteContactService;
use Illuminate\Http\Request;

class DeleteContactController extends Controller
{
    public function __construct(
        private DeleteContactService $deleteContactService,
    ) {}

    /**
     * Handle the incoming request.
     */
    public function __invoke(Request $request, string $id)
    {
        $this->deleteContactService->execute($id);

        return response()->noContent();
    }
}
