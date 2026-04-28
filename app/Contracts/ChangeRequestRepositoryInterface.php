<?php

namespace App\Contracts;

use App\Models\ChangeRequest;

interface ChangeRequestRepositoryInterface
{
    public function getAllChangeRequests();
    public function getChangeRequestById(ChangeRequest $ChangeRequest);
    public function deleteChangeRequest(ChangeRequest $ChangeRequest);
    public function createChangeRequest(array $attributes);
    public function updateChangeRequest(ChangeRequest $ChangeRequest, array $attributes);
}