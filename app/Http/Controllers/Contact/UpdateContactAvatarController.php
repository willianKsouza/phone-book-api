<?php

namespace App\Http\Controllers\Contact;

use App\DTO\DeleteContactAvatarDTO;
use App\DTO\UpdateContactDTO;
use App\DTO\UploadContactAvatarDTO;
use App\Http\Controllers\Controller;
use App\Http\Requests\UpdateContactAvatarRequest;
use App\Services\DeleteContactAvatarService;
use App\Services\FindContactService;
use App\Services\UpdateContactService;
use App\Services\UploadContactAvatarService;
use Illuminate\Http\Request;

class UpdateContactAvatarController extends Controller
{
    public function __construct(
        private UploadContactAvatarService $uploadContactAvatarService,
        private DeleteContactAvatarService $deleteContactAvatarService,
        private FindContactService $findContactService,
        private UpdateContactService $updateContactService,
    ) {}

    /**
     * Handle the incoming request.
     */
    public function __invoke(UpdateContactAvatarRequest $request, string $id)
    {
        $request->validated();

        $img_name = null;

        $contact = $this->findContactService->execute($id);

        $delete_dto = new DeleteContactAvatarDTO(
            'avatars',
            $contact->getRawOriginal('avatar'),
        );

        if ($this->deleteContactAvatarService->execute($delete_dto)) {
            $avatar_dto = new UploadContactAvatarDTO(
                'avatars',
                $request->file('avatar'),
            );

            $img_name = $this->uploadContactAvatarService->execute($avatar_dto);

            $update_dto = new UpdateContactDTO(
                $contact->id,
                avatar: $img_name
            );

            $contact = $this->updateContactService->execute($update_dto);

            return response()->json($contact->avatar);
        }

    }
}
