<?php

namespace App\Rules;

use Closure;
use DB;
use Illuminate\Contracts\Validation\ValidationRule;
use Illuminate\Translation\PotentiallyTranslatedString;

class SessionDateCollision implements ValidationRule
{
    public function __construct(private $classId, private $sessionDate, private $startTime, private $endTime) {}

    /**
     * Run the validation rule.
     *
     * @param  Closure(string, ?string=): PotentiallyTranslatedString  $fail
     */
    public function validate(string $attribute, mixed $value, Closure $fail): void
    {
        $session = DB::table('class_sessions')
            ->where('class_id', $this->classId)
            ->where('session_date', $this->sessionDate)
            ->where('start_time', $this->startTime)
            ->where('end_time', $this->endTime)
            ->count();
        
        if ($session){
            $fail('session date is collision');
        }
        
    }
}
