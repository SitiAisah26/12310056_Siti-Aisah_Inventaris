<?php

namespace App\Exports;

use App\Models\User;
use Maatwebsite\Excel\Concerns\FromCollection;
use Maatwebsite\Excel\Concerns\WithHeadings;
use Maatwebsite\Excel\Concerns\WithMapping;

class UsersExport implements FromCollection, WithHeadings, WithMapping
{
    protected $role;

    public function __construct($role)
    {
        $this->role = $role;
    }

    public function collection()
    {
        // Mengambil user berdasarkan role yang dikirim (admin/operator)
        return User::where('role', $this->role)->get();
    }

    public function headings(): array
    {
        return ["Name", "Email", "Password"];
    }

    public function map($user): array
    {
        // Logika tampilan password sesuai permintaanmu
        return [
            $user->name,
            $user->email,
            "This account already edited the password"
        ];
    }
}