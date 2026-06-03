<?php

namespace App\Services;

use App\Contracts\ClassSessionRepositoryInterface;
use App\Models\ClassSession;
use App\Models\User;
use Arr;
use Carbon\Carbon;
use DB;
use Exception;

final class ClassSessionService
{
    public function __construct(
        private ClassSessionRepositoryInterface $repository,
    ) {
    }

    public function getAllClassSessions(User $user, array $filters = [])
    {
        if ($user->role === 'admin-pegawai' || $user->role === 'super-admin') {
            return $this->repository->getAll($filters);
        } else if ($user->role === 'dosen') {
            return $this->repository->getAllByLecturer($user->detail_id, $filters);
        } else {
            return $this->repository->getAllByClass($user->class_id, $filters);
        }
    }

    public function getClassSessionById(ClassSession $classSession)
    {
        return $this->repository->getById($classSession);
    }

    public function getClassSessionByPengampu(string $pengampuId)
    {
        return $this->repository->getByPengampu($pengampuId);
    }

    public function generateClassSession(array $attributes)
    {
        $data = array();

        $sessionAmount = 16;

        $sessionDate = $attributes['start_date'];

        for ($i = 0; $i < $sessionAmount; $i++) {

            array_push($data, [
                "pengampu_id" => $attributes['pengampu_id'],
                "lecturer_id" => $attributes['lecturer_id'],
                'session_number' => $i + 1,
                "class_id" => $attributes['class_id'],
                "class_name" => $attributes['class_name'],
                "course_code" => $attributes['course_code'],
                "course_name" => $attributes['course_name'],
                "session_date" => $sessionDate,
                "start_time" => $attributes['start_time'],
                "end_time" => $attributes['end_time'],
            ]);

            $sessionDate = Carbon::parse($sessionDate)->addDays(7)->toDateString();
        }

        return DB::transaction(function () use ($data, $sessionAmount, $attributes) {

            $totalData = DB::table('class_sessions')
                ->where('class_name', $attributes['class_name'])
                ->where('course_name', $attributes['course_name'])
                ->lockForUpdate()
                ->count();

            if ($totalData >= 16) {
                throw new Exception("class sessions have been added");

            }

            return $this->repository->generate($data, $sessionAmount);
        });
    }

    public function updateClassSession(array $attributes, ClassSession $classSession)
    {
        if ($classSession->is_already_opened) {
            throw new Exception("class session has been opened");

        }
        return $this->repository->update($classSession, $attributes);
    }


    public function deleteClassSession(array $attributes)
    {
        return DB::transaction(function () use ($attributes) {
            return $this->repository->bulkDelete($attributes);
        });

    }

    public function addSessionMaterial(ClassSession $classSession, array $attributes)
    {
        return DB::transaction(function () use ($classSession, $attributes) {
            return $this->repository->createSessionMaterial($classSession, $attributes);
        });
    }

    public function deleteSessionMaterial(ClassSession $classSession, array $attributes)
    {
        return DB::transaction(function () use ($classSession, $attributes) {
            return $this->repository->deleteSessionMaterial($classSession, $attributes);
        });
    }

}