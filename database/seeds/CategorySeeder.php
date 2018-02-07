<?php


use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class CategorySeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('categories')->insert([[
         'name'=>'Business Cards',
         'image'=>'',
         'slug'=>'business-cards'
        ],
        ['name'=>'T Shirt',
            'image'=>'',
         'slug'=>'t-shirt'
        ],
        ['name'=>'Post Card',
            'image'=>'',
         'slug'=>'post-card'
        ],
        ['name'=>'Poster',
            'image'=>'',
            'slug'=>'poster'
        ],
        ['name'=>'Flyer',
            'image'=>'',
            'slug'=>'flyer'
        ],
        ['name'=>'Envelop',
            'image'=>'',
            'slug'=>'envelop'
        ],
        ['name'=>'Letterhead',
            'image'=>'',
            'slug'=>'letterhead'
        ],
        ['name'=>'Invoice',
            'image'=>'',
            'slug'=>'invoice'
        ],
        ['name'=>'Magazine',
            'image'=>'',
            'slug'=>'magazine'
        ],
        ['name'=>'Invitation',
            'image'=>'',
            'slug'=>'invitation'
        ],
        ['name'=>'ID Card',
            'image'=>'',
            'slug'=>'id-card'
        ],
        ['name'=>'Menus',
            'image'=>'',
            'slug'=>'menus'
        ]]);
    }
}
