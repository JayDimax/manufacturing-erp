<?php

namespace Modules\BusinessPartner\Services;

use Modules\BusinessPartner\Models\ContactPerson;
use Modules\BusinessPartner\Repositories\ContactPersonRepository;

class ContactPersonService
{
    public function __construct(
        protected ContactPersonRepository $contactPersonRepository,
    ) {}

    public function getByPartner(int $partnerId)
    {
        return $this->contactPersonRepository->findByPartner($partnerId);
    }

    public function findById(int $id): ?ContactPerson
    {
        return $this->contactPersonRepository->find($id);
    }

    public function create(int $partnerId, array $data): ContactPerson
    {
        $data['business_partner_id'] = $partnerId;
        return $this->contactPersonRepository->create($data);
    }

    public function update(ContactPerson $contactPerson, array $data): bool
    {
        return $this->contactPersonRepository->update($contactPerson, $data);
    }

    public function delete(ContactPerson $contactPerson): bool
    {
        return $this->contactPersonRepository->delete($contactPerson);
    }
}
