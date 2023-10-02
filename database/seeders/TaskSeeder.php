<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Task;

class TaskSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {

       // Seed tasks with sample data
       Task::create([
        'title' => 'Task 1',
        'description' => 'Description for Task 1',
        'user_name' => 'john@example.com',
        'category_id' => 1, // Replace with an existing category ID from m_category_task
       ]);

       Task::create([
        'title' => 'Task 2',
        'description' => 'Description for Task 2',
        'user_name' => 'andika@gmail.com',
        'category_id' => 2,
       ]);
    }
}
