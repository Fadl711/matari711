<?php

namespace Database\Seeders;

use App\Models\Post;
use App\Models\Section;
use App\Models\User;
// use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        // User::factory(10)->create();

        User::create([
            'name' => 'Test User',
            'email' => 'test@example.com',
            'password' => 'qweasdzxc',
            'usertype'=>'admin'
        ]);
        $names= ['المقالات','الكتب','الصوتيات', 'الفيديوهات',];
        foreach($names as $name){
            Section::create([
                'section_Name'=>$name,
            ]);

        }
        Post::create([
            'titleart'=>'تفصيل نافع في حكم التغني بالقرآن وقراءته بالألحان',
            'body'=>'مِن تلبيس إبليس على القراء إحداث قراءة الألحان، و مرادهم قراءة القرآن بالتنغيم فيه.وقد ذكر المصنف رحمه الله تعالى أن من أهل العلم من كرهها كأحمد بن حن',
            'idsection'=>1,
            'userid'=>1,
            'teypsection'=>1,
        ]);

    }
}
