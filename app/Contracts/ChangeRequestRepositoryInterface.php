<?php

namespace App\Contracts;

use App\Models\ChangeRequest;
use App\Models\User;

interface ChangeRequestRepositoryInterface
{
    public function getAll();
    public function getAllByUser(User $user);
    public function getNewlyData();
    public function getTotalPendingStatus();
    public function create(array $attributes);
    public function update(ChangeRequest $ChangeRequest, array $attributes);
}