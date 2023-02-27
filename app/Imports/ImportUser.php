<?php

namespace App\Imports;

use Illuminate\Support\Collection;
use App\User;
use Illuminate\Support\Facades\Hash;
use Maatwebsite\Excel\Concerns\WithHeadingRow;
use Illuminate\Contracts\Queue\ShouldQueue;
use Maatwebsite\Excel\Concerns\ToCollection;
use Maatwebsite\Excel\Concerns\WithBatchInserts;
use Maatwebsite\Excel\Concerns\WithChunkReading;

class ImportUser implements ToCollection, WithHeadingRow, WithBatchInserts, WithChunkReading, ShouldQueue
{
    /**
     * @param Collection $collection
     */
    public function collection(Collection $rows)
    {

        foreach ($rows as $row) {
            $user = User::where('username', $row['username'])->first();

            $password = Hash::make($row['password']);

            if ($user == null) {
                $email = $row['email'] ?? $row['username'] . '@litbang.cirebonkab.go.id';
                // if ($row['email'] == null) {
                //     $email = $row['username'] . '@litbang.cirebonkab.go.id';
                // }
                $user = User::create([
                    'name' => $row['nick_name'],
                    'email' => $email,
                    'nick_name' => $row['nick_name'],
                    'username' => $row['username'],
                    'password' => $password,
                    'opd_name' => $row['name_opd']

                ]);
                $user->assignRole('admin opd');
            } else {
                $email = $row['email'] ?? $row['username'] . '@litbang.cirebonkab.go.id';
                // if ($row['email'] == null) {
                //     $email = $row['username'] . '@litbang.cirebonkab.go.id';
                // }
                $user->update([
                    'name' => $row['nick_name'],
                    'email' => $email,
                    'nick_name' => $row['nick_name'],
                    'username' => $row['username'],
                    'password' => $password,
                    'opd_name' => $row['name_opd']
                ]);
            }
        }
    }

    public function batchSize(): int
    {
        return 500;
    }
    public function chunkSize(): int
    {
        return 500;
    }
}
