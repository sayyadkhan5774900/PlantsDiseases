<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Disease;

class DeseasesTableSeader extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $deseases = [
            [
                'title' => 'Lorem ipsum dolor sit amet consectetur adipisicing elit. Quam, sunt.',
                'description' => 'Lorem ipsum, dolor sit amet consectetur adipisicing elit. Vero earum saepe commodi ut. Perferendis vel animi nemo soluta consectetur, consequatur, veritatis ex quisquam porro sequi ducimus mollitia reprehenderit, voluptates sapiente.',
            ],
            [
                'title' => 'Lorem ipsum dolor sit amet consectetur adipisicing elit. Quam, sunt.',
                'description' => 'Lorem ipsum, dolor sit amet consectetur adipisicing elit. Vero earum saepe commodi ut. Perferendis vel animi nemo soluta consectetur, consequatur, veritatis ex quisquam porro sequi ducimus mollitia reprehenderit, voluptates sapiente.',
            ],
            [
                'title' => 'Lorem ipsum dolor sit amet consectetur adipisicing elit. Quam, sunt.',
                'description' => 'Lorem ipsum, dolor sit amet consectetur adipisicing elit. Vero earum saepe commodi ut. Perferendis vel animi nemo soluta consectetur, consequatur, veritatis ex quisquam porro sequi ducimus mollitia reprehenderit, voluptates sapiente.',
            ],
            [
                'title' => 'Lorem ipsum dolor sit amet consectetur adipisicing elit. Quam, sunt.',
                'description' => 'Lorem ipsum, dolor sit amet consectetur adipisicing elit. Vero earum saepe commodi ut. Perferendis vel animi nemo soluta consectetur, consequatur, veritatis ex quisquam porro sequi ducimus mollitia reprehenderit, voluptates sapiente.',
            ],
        ];

        foreach ($deseases as $key => $desease) {
            $desease = Disease::create($desease);
            $photo_id = $key+1;
            $desease->addMedia(storage_path()."/seeders/deseases/$photo_id.jpg")->preservingOriginal()->toMediaCollection('images');
        }
    }
}
