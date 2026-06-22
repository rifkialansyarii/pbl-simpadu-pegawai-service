<?php

namespace App\Exports;

use Maatwebsite\Excel\Concerns\FromArray;
use Maatwebsite\Excel\Concerns\WithEvents;
use Maatwebsite\Excel\Concerns\WithHeadings;
use Maatwebsite\Excel\Concerns\WithMapping;
use Maatwebsite\Excel\Events\AfterSheet;
use PhpOffice\PhpSpreadsheet\Cell\Coordinate;

class GradeTemplateExport implements FromArray, WithHeadings, WithMapping, WithEvents
{
    protected $rowNumber = 2;
    public function __construct(protected $students, protected $assignments, protected $setting)
    {
    }

    protected function getWeight(): array
    {
        $assignmentWeight = $this->setting->assignment;
        $utsWeight = $this->setting->uts;
        $uasWeight = $this->setting->uas;

        return [
            'assignment' => $assignmentWeight, 
            'uts' => $utsWeight, 
            'uas' => $uasWeight
        ];
    }
  


    public function array(): array
    {
        return $this->students;
    }

    public function headings(): array
    {
        $headings = [
            'NO',
            'ID Mahasiswa',
            'NIM',
            'Nama',
        ];

        foreach ($this->assignments as $assignment) {
            $headings[] = $assignment->title;
        }


        $headings[] = "Tugas";
        $headings[] = "UTS";
        $headings[] = 'UAS';
        $headings[] = 'Nilai Akhir';

        return $headings;
    }


    public function map($student): array
    {
        $AssignmentTotal = $this->assignments->count();
        $row = $this->rowNumber;

        $startAssignmentLetter = 'E';

        $endAssignmentIndex = 4 + $AssignmentTotal;

        $endAssignmentLetter = Coordinate::stringFromColumnIndex($endAssignmentIndex);
        Coordinate::stringFromColumnIndex($endAssignmentIndex + 1);
        $utsLetter = Coordinate::stringFromColumnIndex($endAssignmentIndex + 2);
        $uasLetter = Coordinate::stringFromColumnIndex($endAssignmentIndex + 3);

        $assignmentFormula = "ROUND((IFERROR(AVERAGE({$startAssignmentLetter}{$row}:{$endAssignmentLetter}{$row}), 0) * ({$this->getWeight()['assignment']}/100)), 5)";
        $utsFormula = "ROUND(({$utsLetter}{$row} * ({$this->getWeight()["uts"]}/100)), 5)";
        $uasFormula = "ROUND(({$uasLetter}{$row} * ({$this->getWeight()["uas"]}/100)), 5)";

        $gradeTotalFormula = "=ROUND({$assignmentFormula} + {$utsFormula} + {$uasFormula}, 2)";

        $rowData = [
            $row - 1,
            $student['student_id'],
            $student['nim'],
            $student['name'],
        ];


        foreach($this->assignments as $assignment) {
            $score = $student['assignment_scores'][$assignment->id] ?? '';
            $rowData[] = $score; 
        }

        $rowData[] = '=' . $assignmentFormula;
        $rowData[] = $student['uts_score'];
        $rowData[] = $student['uas_score'];
        $rowData[] = $gradeTotalFormula;

        $this->rowNumber++;
        return $rowData;

    }

    public function registerEvents(): array
    {
        return [
            AfterSheet::class => function (AfterSheet $event){
                $event->sheet->getDelegate()->getColumnDimension('B')->setVisible(false);
            }
        ];
    }
}

