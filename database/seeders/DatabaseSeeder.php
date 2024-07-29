<?php

namespace Database\Seeders;

use App\Models\Brands;
use App\Models\Merchants;
use App\Models\Role;
use App\Models\Services;
use App\Models\User;
// use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {

        Role::insert([
            ['name' => 'Admin'],
            ['name' => 'Developer'],
            ['name' => 'Team Lead'],
            ['name' => 'Agent'],
        ]);

        User::insert([
            [
                'first_name' => 'Developer',
                'last_name' => 'Admin',
                'email' => 'developer@nextacllc.org',
                'password' => Hash::make('password'),
                'phone_number' => '',
                'user_type' => 'Admin',
                'role_id' => 1,
                'user_id' => null,
            ],
            [
                'first_name' => 'Humayun',
                'last_name' => 'Ayaz',
                'email' => 'humayun.ayaz@nextacllc.org',
                'password' => Hash::make('password'),
                'phone_number' => '923362198380',
                'user_type' => 'Team Lead',
                'role_id' => 2, // Assuming 2 is the role_id for Team Lead
                'user_id' => null,
            ],
            [
                'first_name' => 'Nabeel',
                'last_name' => 'Khan',
                'email' => 'nabeel.khan@nextacllc.org',
                'password' => Hash::make('password'),
                'phone_number' => '923402382998',
                'user_type' => 'Team Lead',
                'role_id' => 2,
                'user_id' => null,
            ],
            [
                'first_name' => 'Munzallin',
                'last_name' => 'Munaf',
                'email' => 'munzallin.munaf@nextacllc.org',
                'password' => Hash::make('password'),
                'phone_number' => '03343909636',
                'user_type' => 'Admin',
                'role_id' => 1,
                'user_id' => null,
            ],
            [
                'first_name' => 'Zain',
                'last_name' => 'Ulabdien',
                'email' => 'zain.ulabdien@nextacllc.org',
                'password' => Hash::make('password'),
                'phone_number' => '1234',
                'user_type' => 'Admin',
                'role_id' => 1,
                'user_id' => null,
            ],
            [
                'first_name' => 'Ayesha',
                'last_name' => 'Ali',
                'email' => 'ayesha.ali@nextacllc.org',
                'password' => Hash::make('password'),
                'phone_number' => '123',
                'user_type' => 'Team Lead',
                'role_id' => 2,
                'user_id' => null,
            ],
        ]);

        Services::insert([
            ['name' => 'Premium Package', 'created_at' => '2023-08-17 16:16:00'],
            ['name' => 'Basic Package', 'created_at' => '2023-08-17 16:16:00'],
            ['name' => 'Premium', 'created_at' => '2023-08-17 16:16:00'],
            ['name' => 'Basic', 'created_at' => '2023-08-17 16:16:00'],
            ['name' => 'Custom Package', 'created_at' => '2023-08-17 16:16:00'],
            ['name' => 'Consultation', 'created_at' => '2023-08-17 16:15:00'],
            ['name' => 'Billboard Advertisement', 'created_at' => '2023-08-17 18:11:00'],
            ['name' => 'Radio Interview', 'created_at' => '2023-08-17 18:11:00'],
            ['name' => 'Radio Show', 'created_at' => '2023-08-17 18:11:00'],
            ['name' => 'Brand Designing', 'created_at' => '2023-08-17 18:11:00'],
            ['name' => 'Branding', 'created_at' => '2023-08-17 18:11:00'],
            ['name' => 'Website Designing', 'created_at' => '2023-08-17 18:11:00'],
            ['name' => 'Website Development', 'created_at' => '2023-08-17 18:11:00'],
            ['name' => 'Logo Designing', 'created_at' => '2023-08-17 18:10:00'],
            ['name' => 'Paper Publication', 'created_at' => '2023-08-17 18:10:00'],
            ['name' => 'Book Marketing', 'created_at' => '2023-08-17 18:10:00'],
            ['name' => 'Book Cover Designing', 'created_at' => '2023-08-17 18:10:00'],
            ['name' => 'Video Trailer', 'created_at' => '2023-08-17 18:10:00'],
            ['name' => 'Copy Editing', 'created_at' => '2023-08-17 18:10:00'],
            ['name' => 'Book Proofreading', 'created_at' => '2023-08-17 18:10:00'],
            ['name' => 'Research Paper Formatting', 'created_at' => '2023-08-17 18:10:00'],
            ['name' => 'Book Formatting', 'created_at' => '2023-08-17 18:10:00'],
            ['name' => 'Audio Book Publishing', 'created_at' => '2023-08-17 18:09:00'],
            ['name' => 'Book Publishing', 'created_at' => '2023-08-17 18:09:00'],
            ['name' => 'Amazon Marketing', 'created_at' => '2023-08-17 18:09:00'],
            ['name' => 'Amazon Publishing', 'created_at' => '2023-08-17 18:09:00'],
            ['name' => 'Research Writing', 'created_at' => '2023-08-17 18:09:00'],
            ['name' => 'Book Illustration', 'created_at' => '2023-08-17 18:09:00'],
            ['name' => 'Ghostwriting', 'created_at' => '2023-08-17 18:07:00'],
            ['name' => 'Book Writing', 'created_at' => '2023-08-17 18:07:00'],
        ]);

        Brands::insert([
            ['name' => 'Barnes and Noble Official', 'link' => 'http://barnesandnobleofficial.com/', 'email' => 'info@barnesandnobleofficial.com', 'image' => null, 'created_at' => '2024-06-10 07:20:00'],
            ['name' => 'The Professional Authors', 'link' => 'https://theprofessionalauthors.com/', 'email' => 'info@theprofessionalauthors.com', 'image' => null, 'created_at' => '2024-06-10 07:18:00'],
            ['name' => 'Meta Ghostwriters', 'link' => 'https://metaghostwriters.com/', 'email' => 'info@metaghostwriters.com', 'image' => null, 'created_at' => '2024-06-10 07:16:00'],
            ['name' => 'Amazon Self Publishing', 'link' => 'https://amazonselfpublishing.co/', 'email' => 'info@amazonselfpublishing.co', 'image' => null, 'created_at' => '2024-06-10 07:14:00'],
            ['name' => 'Amazon Publishing Rights', 'link' => 'https://amazonpublishingrights.co/', 'email' => 'info@amazonpublishingrights.co', 'image' => null, 'created_at' => '2024-06-10 07:12:00'],
            ['name' => 'Xetro Cube', 'link' => 'https://xetrocube.co.uk/', 'email' => 'N/A', 'image' => null, 'created_at' => '2023-11-03 05:27:00'],
            ['name' => 'Genix Flooring', 'link' => 'Genix Flooring', 'email' => 'N/A', 'image' => null, 'created_at' => '2023-08-28 15:20:00'],
            ['name' => 'Fleuron Publishers', 'link' => 'Fleuron Publishers', 'email' => 'N/A', 'image' => null, 'created_at' => '2023-08-28 15:18:00'],
            ['name' => 'Amercan Publishers Group', 'link' => 'Amercan Publishers Group', 'email' => 'N/A', 'image' => null, 'created_at' => '2023-08-28 15:17:00'],
            ['name' => 'Nextac LLC', 'link' => 'Nextac LLC', 'email' => 'N/A', 'image' => null, 'created_at' => '2023-08-28 15:16:00'],
        ]);

        Merchants::create([
            'name' => 'First Merchant',
            'payment_gateway_type' => 'Paypal',
            'payment_gateway_link' => 'https://checkout.jaitpurtrading.com',
            'payment_gateway_credentials' => json_encode([]),
            'created_at' => '2024-07-05 00:39:00'
        ]);
    }
}
