<?php

namespace App\Imports;

use App\Models\Type;
use Maatwebsite\Excel\Concerns\Importable;
use Maatwebsite\Excel\Concerns\SkipsFailures;
use Maatwebsite\Excel\Validators\ValidationException;
use Maatwebsite\Excel\Concerns\SkipsOnFailure;
use Maatwebsite\Excel\Concerns\ToCollection;
use Maatwebsite\Excel\Concerns\WithHeadingRow;
use Maatwebsite\Excel\Concerns\WithValidation;
use Illuminate\Support\Collection;
use Illuminate\Support\Facades\Validator;
class TypeImport implements ToCollection, WithHeadingRow, WithValidation
{
    use Importable;
    private $errors=[];

    /**
     * @param Collection $collection
     */
    public function collection(Collection $rows)
    {
        foreach ($rows as $row) {
                $type = new Type();
                $type->field_a = $row['field_a'];
                $type->field_b = $row['field_b'];
                $type->field_c = $row['field_c'];
                $type->field_d = $row['field_d'];
                $type->field_e = $row['field_e'];
                $type->save();
        }
    }

    public function customValidationMessages()
    {
        return [
            'field_b.regex' => 'The :attribute field is should not contain any space',
        ];
    }
    public function rules() :array
    {
       return [
            'field_a' => 'required',
            // 'field_b' => ['regex:/^(|\d)+$/'],
            'field_b' => ['nullable','regex:/^(\s*|\d+)$/'],
            'field_d' => 'required',
            'field_e' => 'required',
        ];
    }
}