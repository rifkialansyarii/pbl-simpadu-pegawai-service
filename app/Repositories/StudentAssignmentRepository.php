<?php

namespace App\Repositories;

use App\Contracts\StudentAssignmentRepositoryInterface;
use App\Models\ClassSession;
use App\Models\StudentAssignment;
use App\Models\User;
use Arr;
use Carbon\Carbon;
use Illuminate\Database\Eloquent\Builder;

class StudentAssignmentRepository implements StudentAssignmentRepositoryInterface
{
    public function getPendingSubmission(User $user)
    {
        $pendingSubmissions = StudentAssignment::whereHas('classSession', function (Builder $query) use ($user) {
            $query->where('class_id', $user->class_id);
        })->whereDoesntHave('studentSubmissions', function (Builder $query) use ($user) {
            $query->where('student_id', $user->detail_id);
        })->get();

        return $pendingSubmissions;
    }

    public function createStudentAssignment(ClassSession $classSession, array $data)
    {
        if($classSession->status === 'opened')
        {
            $assignment = $classSession->studentAssignments()->updateOrCreate(Arr::except($data, ['file_upload_id']));

            if (!empty($data['file_upload_id']) || isset($data['file_upload_id'])) {
                $assignment->fileUploads()->sync($data['file_upload_id']);
            }

            $classSession->load(['lecturer', 'studentAssignments.fileUploads']);

            return $classSession;
        }

        return false;
        
    }

    public function deleteStudentAssignment(array $data)
    {
        StudentAssignment::destroy($data);
    }
}