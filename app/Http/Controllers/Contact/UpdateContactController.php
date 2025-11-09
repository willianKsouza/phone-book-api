<?php

namespace App\Http\Controllers\Contact;

use App\DTO\UpdateContactDTO;
use App\Http\Controllers\Controller;
use App\Http\Requests\UpdateContactRequest;
use App\Services\UpdateContactService;
use Illuminate\Http\Request;

class UpdateContactController extends Controller
{
    public function __construct(
        private UpdateContactService $updateContactService,
    ) {}

    /**
     * Handle the incoming request.
     */
    public function __invoke(UpdateContactRequest $request, string $id)
    {
        $request->validated();

        $update_dto = new UpdateContactDTO(
            $id,
            name: $request->input('name'),
            phone: $request->input('phone'),
            email: $request->input('email'),
        );

        $contact = $this->updateContactService->execute($update_dto);

        return response()->json($contact);

    }
}
