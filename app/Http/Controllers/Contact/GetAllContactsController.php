<?php

namespace App\Http\Controllers\Contact;

use App\DTO\GetAllContactDTO;
use App\Http\Controllers\Controller;
use App\Http\Requests\GetAllContactForm;

use App\Services\GetAllContactsService;


class GetAllContactsController extends Controller
{
    public function __construct(private GetAllContactsService $getAllContactsService)
    {}

    public function __invoke(GetAllContactForm $request)
    {
        $request->validated();
        
        $dto = new GetAllContactDTO(
            $request->input('page') ,
            $request->input('per_page'),
            $request->input('field'),
            $request->input('value'),
        );
        
        $contacts = $this->getAllContactsService->execute($dto);

        return response()->json($contacts);
    }
}
