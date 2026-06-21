<?php

namespace App\Imports;

use App\Models\StudentSubmission;
use App\Models\User;
use App\Services\GradeService;
use App\Services\StudentSubmissionService;
use Illuminate\Support\Collection;
use Illuminate\Support\Str;
use Maatwebsite\Excel\Concerns\ToCollection;
use Maatwebsite\Excel\Concerns\WithCalculatedFormulas;
use Maatwebsite\Excel\Concerns\WithHeadingRow;

class GradeTemplateImport implements ToCollection, WithHeadingRow, WithCalculatedFormulas
{
    public function __construct(private User $user, protected array $validated, private GradeService $gradeService, private StudentSubmissionService $submissionService, private $assignments) {
    }

    /**
    * @param Collection $rows
    */
    public function collection(Collection $rows)
    {

        foreach ($rows as $row) {
            
            if(!isset($row['id_mahasiswa']) || empty($row['id_mahasiswa'])){
                continue;
            }

            $attributes = [
                'student_id' => $row['id_mahasiswa'],
                'nim' => $row['nim'],
                'student_name' => $row['nama'],
                'class_id' => $this->validated['class_id'],
                'class_name' => $this->validated['class_name'],
                'course_code' => $this->validated['course_code'],
                'course_name' => $this->validated['course_name'],
                'assignment_score' => $row['tugas'],
                'uts_score' => $row['uts'] ?? 0,
                'uas_score' => $row['uas'] ?? 0,
                'final_score' => $row['nilai_akhir'] ?? 0,
            ];

            $this->gradeService->storeGrade($this->user, $attributes);

        }

        foreach ($this->assignments as $assignment) {
            $excelKey = Str::slug($assignment->title, '_');

            if(isset($row[$excelKey]))
            {
                $this->submissionService->addScore([
                    'student_id' => $row['id_mahasiswa'],
                    'assignment_id' => $assignment->id,
                    'score' => $row[$excelKey] ?: 0,
                ]);
            }
        }
    }
}
