<?php

namespace App\Repositories;

use App\Contracts\ClassSessionRepositoryInterface;
use App\Models\ClassSession;
use Arr;

class ClassSessionRepository implements ClassSessionRepositoryInterface
{
    public function getAll()
    {
        $classSession = ClassSession::select([
            'id',
            'pengampu_id',
            'lecturer_id',
            'session_number',
            'class_id',
            'class_name',
            'course_code',
            'course_name',
            'topic',
            'session_date',
            'start_time',
            'end_time',
            'status',
            'is_already_opened',
        ])->paginate(10);

        $classSession->load(['lecturer', 'learningMaterials']);

        return $classSession;
    }

    public function getAllByLecturer(string $lecturerId)
    {
        $classSession = ClassSession::select([
            'id',
            'pengampu_id',
            'lecturer_id',
            'session_number',
            'class_id',
            'class_name',
            'course_code',
            'course_name',
            'topic',
            'session_date',
            'start_time',
            'end_time',
            'status',
            'is_already_opened',
        ])->where('lecturer_id', $lecturerId)->paginate(10);

        $classSession->load(['lecturer', 'learningMaterials']);

        return $classSession;
    }

    public function getAllByClass(string $classId)
    {
        $classSession = ClassSession::select([
            'id',
            'pengampu_id',
            'lecturer_id',
            'session_number',
            'class_id',
            'class_name',
            'course_code',
            'course_name',
            'topic',
            'session_date',
            'start_time',
            'end_time',
            'status',
            'is_already_opened',
        ])->where('class_id', $classId)->paginate(10);

        $classSession->load(['lecturer', 'learningMaterials']);

        return $classSession;
    }

    public function getById(ClassSession $classSession)
    {
        $classSession->select([
            'id',
            'pengampu_id',
            'lecturer_id',
            'session_number',
            'class_id',
            'class_name',
            'course_code',
            'course_name',
            'topic',
            'session_date',
            'start_time',
            'end_time',
            'status',
            'is_already_opened',
        ]);

        $classSession->load(['lecturer', 'learningMaterials']);

        return $classSession;
    }

    public function generate(array $data, $sessionAmount)
    {
        // $chunks = array_chunk($data, 1000);

        // foreach ($chunks as $chunk) {
        //     Product::fillAndInsert($chunk);
        // }

        ClassSession::fillAndInsert($data);

        $classSession = ClassSession::latest()->take($sessionAmount)->paginate(10);
        $classSession->load(['lecturer', 'learningMaterials']);

        return $classSession;
    }

    public function update(ClassSession $classSession, array $data)
    {
        $classSession->update($data);

        $classSession = $classSession->refresh()->load(['lecturer']);

        if ($classSession->status === 'opened') {
            $classSession->update([
                'is_already_opened' => true,
            ]);
        }

        return $classSession;
    }

    public function bulkDelete(array $data)
    {
        ClassSession::destroy($data);
    }

    public function createSessionMaterial(ClassSession $classSession, array $data)
    {
        $classSession->learningMaterials()->syncWithoutDetaching($data);

        $classSession->load(['lecturer', 'learningMaterials']);

        return $classSession;
    }

    public function deleteSessionMaterial(ClassSession $classSession, array $data)
    {
        $classSession->learningMaterials()->detach($data);
    }

    public function createStudentAssignment(ClassSession $classSession, array $data)
    {
        $assignment = $classSession->studentAssignments()->updateOrCreate(Arr::except($data, ['file_upload_id']));

        if (!empty($data['file_upload_id'])) {
            $assignment->fileUploads()->sync($data['file_upload_id']);
        }

        $classSession->load(['lecturer', 'studentAssignments.fileUploads']);

        return $classSession;
    }

    public function deleteStudentAssignment(ClassSession $classSession, array $data)
    {
        $classSession->studentAssignments()->detach($data);
    }
}