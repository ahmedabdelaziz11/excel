<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;
use Maatwebsite\Excel\Facades\Excel;
use App\Imports\UserImport;
use Illuminate\Support\Str;

class ExcelController extends Controller
{
    public function users()
    {
        $users = User::all();
        return view('users.index', compact('users'));
    }

    public function importExcel(Request $request)
    {
        if ($request->hasFile('excel_file')) {
            $file = $request->file('excel_file');

            $data = Excel::toArray(new UserImport(), $file);


            $full_name_column = Str::slug($request->input('full_name_column'), '_');
            $phone_number_column = Str::slug($request->input('phone_number_column'), '_');
            $email_column = Str::slug($request->input('email_column'), '_');

            foreach ($data[0] as $row) {
                $user = new User;

                $user->full_name = $row[$full_name_column];
                $user->phone_number = $row[$phone_number_column];
                $user->email = $row[$email_column];

                $user->save();
            }
            return redirect()->route('admin.show_all_data')->with('success', 'Data imported successfully!');
        }
        return back();
    }
}






