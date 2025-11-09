<?php

namespace App\Http\Controllers\Contact;

use App\DTO\CreateContactDTO;
use App\DTO\UploadContactAvatarDTO;
use App\Http\Controllers\Controller;
use App\Http\Requests\CreateContactForm;
use App\Services\CreateContactService;
use App\Services\UploadContactAvatarService;

class CreateContactController extends Controller
{
    public function __construct(private CreateContactService $createContactService, private UploadContactAvatarService $uploadContactAvatarService) {}

    public function __invoke(CreateContactForm $request)
    {
        $request->validated();

        $avatar_dto = new UploadContactAvatarDTO(
            'avatars',
            $request->file('avatar'),
        );

        $img_name = $this->uploadContactAvatarService->execute($avatar_dto);

        $contact_dto = new CreateContactDTO(
            $request->input('name'),
            $request->input('phone'),
            $request->input('email'),
            $img_name,
        );

        $contact = $this->createContactService->execute($contact_dto);

        return response()->json($contact, 201);
    }
}
