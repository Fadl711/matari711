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
            'name' => 'محمد المطري',
            'email' => 'm@m.com',
            'password' => 'qweasdzxc111',
            'usertype' => 'admin'
        ]);
        $names = ['الفتاوى ', 'الكتب', 'الصوتيات', 'الفيديوهات', 'مقالات',];
        foreach ($names as $name) {
            Section::create([
                'section_Name' => $name,
            ]);
        }
        Post::create([
            'titleart' => 'تفصيل نافع في حكم التغني بالقرآن وقراءته بالألحان',
            'body' => 'مِن تلبيس إبليس على القراء إحداث قراءة الألحان، و مرادهم قراءة القرآن بالتنغيم فيه.وقد ذكر المصنف رحمه الله تعالى أن من أهل العلم من كرهها كأحمد بن حن',
            'idsection' => 1,
            'userid' => 1,
            'teypsection' => 1,
        ]);

        // إضافة 20 قسم فرعي لقسم الكتب (الذي هو القسم رقم 2)
        $bookSubSections = [
            'القرآن الكريم وعلومه',
            'التفسير',
            'العقيدة والتوحيد',
            'الحديث الشريف وعلومه',
            'السيرة النبوية',
            'الفقه وأصوله',
            'الفتاوى والأحكام',
            'التاريخ الإسلامي',
            'اللغة العربية والأدب',
            'الرقائق والمواعظ',
            'الزهد والتصوف',
            'الردود على الشبهات',
            'أصول الدعوة',
            'كتب الأطفال',
            'الأخلاق والآداب',
            'السياسة الشرعية',
            'فقه الأسرة والمجتمع',
            'التراجم والطبقات',
            'الاقتصاد الإسلامي',
            'كتب متنوعة'
        ];

        foreach ($bookSubSections as $index => $subName) {
            Section::create([
                'section_Name' => $subName,
                'parent_id' => 2, // 2 هو القيمة الافتراضية لقسم الكتب حسب ترتيب المصفوفة
                'sort_order' => $index + 1
            ]);
        }
    }
}
