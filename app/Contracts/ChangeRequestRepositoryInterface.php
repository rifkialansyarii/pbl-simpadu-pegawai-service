<?php

namespace App\Contracts;

use App\Models\ChangeRequest;
use App\Models\User;

interface ChangeRequestRepositoryInterface
{
    public function getAll(array $filters = []);
    public function getAllByUser(User $user, array $filters = []);
    public function getNewlyData();
    public function getTotalPendingStatus();
    public function filterData(array $filters = [], $changeRequest);
    public function create(array $attributes);
    public function update(ChangeRequest $ChangeRequest, array $attributes);
}