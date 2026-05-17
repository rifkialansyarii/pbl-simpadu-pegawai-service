<?php

namespace App\Services;

use App\Contracts\ClassSessionRepositoryInterface;
use App\Http\Requests\UpdateClassSessionRequest;
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

    public function getAllClassSessions(User $user)
    {
        if ($user->role === 'admin-pegawai' || $user->role === 'super-admin') {
            return $this->repository->getAll();
        } else if ($user->role === 'dosen') {
            return $this->repository->getAllByLecturer($user->id);
        } else {
            return $this->repository->getAllByClass($user->class_id);
        }
    }

    public function getClassSessionById(ClassSession $classSession)
    {
        return $this->repository->getById($classSession);
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
                "class_id" => $attributes['class_id'],
                "class_name" => $attributes['class_name'],
                "course_name" => $attributes['course_name'],
                "session_date" => $sessionDate,
                "start_time" => $attributes['start_time'],
                "end_time" => $attributes['end_time'],
            ]);

            $sessionDate = Carbon::parse($sessionDate)->addDays(7)->toDateString();
        }

        try {
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
        } catch (Exception $e) {
            return response()->json([
                'success' => false,
                'message' => 'Unprocessable Content',
                'code' => 422,
                'errrors' => $e->getMessage()
            ], 422);
        }
    }

    public function updateClassSession(array $attributes, ClassSession $classSession)
    {
        return $this->repository->update($classSession, $attributes);
    }


    public function deleteClassSession(array $attributes)
    {
        try {
            return DB::transaction(function () use ($attributes) {
                return $this->repository->bulkDelete($attributes);
            });
        } catch (Exception $e) {
            return response()->json([
                'success' => false,
                'message' => 'Unprocessable Content',
                'code' => 422,
                'errrors' => $e->getMessage()
            ]);
        }

    }

}