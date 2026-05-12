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

    public function getClassSessionById(ClassSession $classSession)
    {
        return $this->repository->getById($classSession);
    }

    public function createClassSession(array $attributes)
    {
        return $this->repository->create($attributes);
    }

    public function updateClassSession(UpdateClassSessionRequest $request, ClassSession $classSession)
    {
        $attributes = Arr::except($request->validated(), ['nip', 'nik', 'ClassSession_name']);
        return $this->repository->update($classSession, $attributes);
    }


    public function deleteClassSession(ClassSession $classSession)
    {
        $this->repository->delete($classSession);
    }


    public function getTotalClassSession()
    {
        return $this->repository->getTotal();
    }
}