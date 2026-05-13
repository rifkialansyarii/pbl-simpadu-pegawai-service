<?php

namespace App\Services;

use App\Contracts\ClassSessionRepositoryInterface;
use App\Http\Requests\UpdateClassSessionRequest;
use App\Models\ClassSession;
use Arr;
use Carbon\Carbon;
use DB;

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

    public function generateClassSession(array $attributes)
    {
        $data = array();

        $sessionAmount = $attributes['session_amount'];

        $sessionDate = Carbon::createFromFormat('d/m/Y', $attributes['start_date'])->format('Y-m-d');

        for ($i = 0; $i < $sessionAmount; $i++) {

            array_push($data, [
                "pengampu_id" => $attributes['pengampu_id'],
                "lecturer_id" => $attributes['lecturer_id'],
                "class_id" => $attributes['class_id'],
                "class_name" => $attributes['class_name'],
                "course_name" => $attributes['course_name'],
                "session_date" => $sessionDate,
                "start_time" => $attributes['start_time'],
                "end_time" => $attributes['end_time'],
            ]);

            $sessionDate = Carbon::parse($sessionDate)->addDays(7)->toDateString();
        }

        return DB::transaction(function () use ($data, $sessionAmount) {
            return $this->repository->generate($data, $sessionAmount);
        });
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