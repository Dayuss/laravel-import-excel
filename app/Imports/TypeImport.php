<?php

namespace App\Imports;

use App\Models\Type;
use Maatwebsite\Excel\Concerns\ToModel;
use Maatwebsite\Excel\Concerns\WithHeadingRow;
use Maatwebsite\Excel\Concerns\WithValidation;
use Maatwebsite\Excel\Concerns\Importable;
class TypeImport implements ToModel, WithHeadingRow, WithValidation
{
    use Importable;
    public function rules(): array
    {
        return [
            'field_a' => 'required',
            'field_b' => 'regex:/^[a-z\d\-_\s]+$/i',
            'field_d' => 'required',
            'field_e' => 'required',
        ];
    }
 
    public function customValidationMessages()
    {
        return [
                'field_b.regex' => 'The :attribute field is should not contain any space',
        ];
    }
 
 

    /**
    * @param array $row
    *
    * @return \Illuminate\Database\Eloquent\Model|null
    */
    public function model(array $row)
    {
        return new Type([
            'field_a' => $row['field_a'],
            'field_b' => $row['field_b'],
            'field_c' => $row['field_c'],
            'field_d' => $row['field_d'],
            'field_e' => $row['field_e']
        ]);
    }

    public function onError(\Throwable $e)
    {
        // Handle the exception how you'd like.
        var_dump($e);
    }
}      