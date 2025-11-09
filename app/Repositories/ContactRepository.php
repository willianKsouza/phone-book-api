<?php

namespace App\Repositories;

use App\DTO\CreateContactDTO;
use App\DTO\GetAllContactDTO;
use App\DTO\UpdateContactDTO;
use App\Interfaces\ContactRepositoryInterface;
use App\Models\Contact;
use Illuminate\Contracts\Pagination\LengthAwarePaginator;
use Illuminate\Support\Facades\Auth;

class ContactRepository implements ContactRepositoryInterface
{
    public function create(CreateContactDTO $dto): Contact
    {
        $contact = Contact::create([
            'name' => $dto->name,
            'phone' => $dto->phone,
            'email' => $dto->email,
            'avatar' => $dto->avatar,
            'user_id' => Auth::user()->id,
        ]);

        return $contact;
    }

    public function find(string $id): Contact
    {
        $contact = Contact::findOrFail($id);

        return $contact;
    }

    public function update(UpdateContactDTO $dto): Contact
    {
        $contact = $this->find($dto->contact_id);

        $data = array_filter((array) $dto, fn ($value) => ! is_null($value));

        unset($data['contact_id']);

        $contact->update($data);

        return $contact;
    }

    public function getAll(GetAllContactDTO $dto): LengthAwarePaginator
    {
        $query = Contact::where('user_id', Auth::user()->id);

        if ($dto->field && $dto->value) {
            $query->where($dto->field, 'like', '%'.$dto->value.'%');
        }

        $contacts = $query->orderBy('created_at', 'desc')
            ->paginate($dto->per_page, ['*'], 'page', $dto->page);

        return $contacts;
    }

    public function delete(string $id): Contact
    {
        $contact = $this->find($id);

        $contact->delete();

        return $contact;
    }
}
