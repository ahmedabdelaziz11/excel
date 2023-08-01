<?php

namespace App\Imports;

use App\Models\User;
use Maatwebsite\Excel\Concerns\ToModel;
use Maatwebsite\Excel\Concerns\WithHeadingRow;

class UserImport implements ToModel, WithHeadingRow
{
    public function model(array $row)
    {
        return new User([
            'full_name' => $row['full_name_column'],
            'phone_number' => $row['phone_number_column'],
            'email' => $row['email_column'],
        ]);
    }
}
