<?php

namespace App\Rules;

use Closure;
use DB;
use Illuminate\Contracts\Validation\ValidationRule;
use Illuminate\Translation\PotentiallyTranslatedString;

class CourseQuotaLimit implements ValidationRule
{
    public function __construct(private $classId, private $className, private $courseCode) {}

    /**
     * Run the validation rule.
     *
     * @param  Closure(string, ?string=): PotentiallyTranslatedString  $fail
     */
    public function validate(string $attribute, mixed $value, Closure $fail): void
    {
        $totalData = DB::table('class_sessions')
            ->where('class_id', $this->classId)
            ->where('class_name', $this->className)
            ->where('course_code', $this->courseCode)
            ->where('course_name', $value)
            ->count();
        
        if ($totalData >= 16){
            $fail('class sessions have been added');
        }
        
    }
}
