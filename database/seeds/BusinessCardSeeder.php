<?php

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
class BusinessCardSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $parentId = 1;
       DB::table('categories')->insert([
        [
            'name'=>'Airline',
            'slug'=>'airline',
            'image'=>'',
            'parent_id'=>$parentId
        ],
        [
            'name'=>'Car Service',
            'slug'=>'car-service',
            'image'=>'',
            'parent_id'=>$parentId
        ],
        [
            'name'=>'Cellphone',
            'slug'=>'cellphone',
            'image'=>'',
            'parent_id'=>$parentId
        ],
        [
            'name'=>'Cleaning Service',
            'slug'=>'cleaning-service',
            'image'=>'',
            'parent_id'=>$parentId
        ],
        [
            'name'=>'Construction',
            'slug'=>'construction',
            'image'=>'',
            'parent_id'=>$parentId
        ],
        [
            'name'=>'Driving School',
            'slug'=>'driving-school',
            'image'=>'',
            'parent_id'=>$parentId
        ],
        [
            'name'=>'Electrician',
            'slug'=>'electrician',
            'image'=>'',
            'parent_id'=>$parentId
        ],
        [
            'name'=>'Grocery',
            'slug'=>'grocery',
            'image'=>'',
            'parent_id'=>$parentId
        ],
        [
            'name'=>'Haircut',
            'slug'=>'haircut',
            'image'=>'',
            'parent_id'=>$parentId
        ],
        [
            'name'=>'Insurance',
            'slug'=>'insurance',
            'image'=>'',
            'parent_id'=>$parentId
        ],
        [
            'name'=>'IT Training',
            'slug'=>'it-training',
            'image'=>'',
            'parent_id'=>$parentId
        ],
        [
            'name'=>'Learning Center',
            'slug'=>'learning-center',
            'image'=>'',
            'parent_id'=>$parentId
        ]]);
    }
}
