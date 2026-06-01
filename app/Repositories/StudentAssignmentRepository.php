<?php

namespace App\Repositories;

use App\Contracts\StudentAssignmentRepositoryInterface;
use App\Models\ClassSession;
use App\Models\StudentAssignment;
use Arr;

class StudentAssignmentRepository implements StudentAssignmentRepositoryInterface
{
    public function createStudentAssignment(ClassSession $classSession, array $data)
    {
        $assignment = $classSession->studentAssignments()->updateOrCreate(Arr::except($data, ['file_upload_id']));

        if (!empty($data['file_upload_id'])) {
            $assignment->fileUploads()->sync($data['file_upload_id']);
        }

        $classSession->load(['lecturer', 'studentAssignments.fileUploads']);

        return $classSession;
    }

    public function deleteStudentAssignment(array $data)
    {
        StudentAssignment::destroy($data);
    }
}