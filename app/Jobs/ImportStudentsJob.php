<?php

namespace App\Jobs;

use App\Models\Student;
use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldBeUnique;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Bus\Dispatchable;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Queue\SerializesModels;

class ImportStudentsJob implements ShouldQueue
{
    use Dispatchable, InteractsWithQueue, Queueable, SerializesModels;

    /**
     * Create a new job instance.
     *
     * @return void
     */
    public function __construct(public ImportStudentsJob $Students)
    {
        //
    }

    /**
     * Execute the job.
     *
     * @return void
     */
    public function handle()
    {
        foreach ($this->Students as $student) {
            Student::query()
                 ->create([
                     'name' => $student->name,
                     'class' => $student->class,
                     'age' => $student->age,
                     'photo' => $student->passport,
                     'sex' => $student->sex,
                     'email_address' => $student->email_address,
                     'entry_year' => $student->entry_year,
                     'religion' => $student->religion,
                     'phone_number' => $student->phone_number,
                
                 ]);
                }
    }
}
