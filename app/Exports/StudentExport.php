<?php

namespace App\Exports;

use App\Models\Student;
use Maatwebsite\Excel\Concerns\FromQuery;

class StudentsExport implements FromQuery
{
    /**
     * Export students using a query.
     *
     * @return \Illuminate\Database\Eloquent\Builder
     */
    public function query()
    {
        return Student::query();
    }
}
