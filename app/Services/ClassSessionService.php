<?php

namespace App\Services;

use App\Contracts\ClassSessionRepositoryInterface;
use App\Http\Requests\UpdateClassSessionRequest;
use App\Models\ClassSession;
use Arr;

final class ClassSessionService
{
    public function __construct(
        private ClassSessionRepositoryInterface $repository,
    ) {
    }

    public function getAllClassSessions()
    {
        return $this->repository->getAll();
    }

    public function getClassSessionById(ClassSession $ClassSession)
    {
        return $this->repository->getById($ClassSession);
    }

    public function createClassSession(array $attributes)
    {
        return $this->repository->create($attributes);
    }

    public function updateClassSession(UpdateClassSessionRequest $request, ClassSession $ClassSession)
    {
        $attributes = Arr::except($request->validated(), ['nip', 'nik', 'ClassSession_name']);
        return $this->repository->update($ClassSession, $attributes);
    }


    public function deleteClassSession(ClassSession $ClassSession)
    {
        $this->repository->delete($ClassSession);
    }


    public function getTotalClassSession()
    {
        return $this->repository->getTotal();
    }
}