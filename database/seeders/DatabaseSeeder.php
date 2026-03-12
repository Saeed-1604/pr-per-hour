<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    use WithoutModelEvents;

    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        // create admin account for الدكتورة
        User::factory()->create([
            'first_name' => 'فاتنة',
            'father_name' => 'معلي',
            'last_name' => '',
            'email' => 'f.maali@prperhour.com',
            'password' => bcrypt('password'),
        ]);

        // create a sample normal user
        User::factory()->create([
            'first_name' => 'عميل',
            'father_name' => 'تجريبي',
            'last_name' => 'مثال',
            'email' => 'customer@example.com',
            'password' => bcrypt('password'),
        ]);

        // seed services
        \App\Models\Service::insert([
            [
                'title' => 'استشارة سريعة',
                'slug' => 'consultation',
                'intro' => 'خدمة مصممة لحل مشكلة محددة أو سؤال واحد، نقدم خلالها تحليلًا سريعًا وواقعيًا.',
                'outputs' => 'تشخيص المشكلة، خطة حل فورية، توصيات تنفيذية، رد خلال 24 ساعة، متابعة واحدة إضافية عند الطلب.',
                'price' => '$10',
                'execution_policy' => 'يتم الرد خلال 24 ساعة من استلام الطلب. الخدمة مخصصة حتى 3 أسئلة أو موضوع واحد فقط.',
                'duration' => '1 يوم',
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'title' => 'باقة المحتوى الأساسية',
                'slug' => 'starter-content-package',
                'intro' => 'مصممة للشركات والأفراد الذين يحتاجون إلى محتوى جاهز مع هوية متسقة. تشمل النصوص جميع منصات التواصل المطلوبة.',
                'outputs' => '10 منشورات مكتوبة، 5 سكريبتات ريل، 5 تصاميم كاروسيل (في صيغة نصية لتسليم للمصمم)، 20 Hook مفتوحة، و20 CTA جذاب.',
                'price' => '$80',
                'execution_policy' => 'بعد استلام المعلومات الأساسية، يتم تسليم الباقة كاملة خلال 7 أيام مع إمكانية تعديل حتى 3 مرات.',
                'duration' => '7 أيام',
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'title' => 'الخطة الاستراتيجية',
                'slug' => 'growth-content-strategy',
                'intro' => 'أداة كاملة لتنمية حضورك الرقمي. ندرس علامتك التجارية وجمهورك ثم نصيغ خطة محتوى تضمن التفاعل والنمو.',
                'outputs' => 'وثيقة استراتيجية تشمل تحليل المنافسين، مقترحات لـ30 منشور، تقويم نشر، وأفكار لهوية بصرية مكتوبة.',
                'price' => '$100',
                'execution_policy' => 'تُسلم الخطة خلال أسبوعين من بداية المشروع، مع جلسة مراجعة واحدة لملاحظات العميل.',
                'duration' => '14 يوم',
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'title' => 'PR Core™',
                'slug' => 'pr-core',
                'intro' => 'خدمة متقدمة لتأسيس هويتك العامة بشكل احترافي: تشمل كتابة الغاية، الرؤية، الرسالة، القيم، شخصية العلامة، وقصة العلامة.',
                'outputs' => 'وثيقة هوية علامة تجارية متكاملة، دليل أساسي، ومقترحات لتطبيق الهوية في المحتوى والتصميم.',
                'price' => 'يبدأ من $2000',
                'execution_policy' => 'السعر والمدة يُحددان بعد جلسة استكشافية أولية لتقييم الاحتياجات.',
                'duration' => 'حسب المشروع',
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'title' => 'Celebrity Builder™',
                'slug' => 'celebrity-builder',
                'intro' => 'برنامج شامل لصناعة مشاهير وتحويل الشخصية إلى علامة تجارية، يتضمن التدريب، إنتاج المحتوى، وإطلاق رسمي.',
                'outputs' => 'خطة تطوير شخصية، جدول تدريبي، إنتاج محتوى، وحملة إطلاق متكاملة.',
                'price' => 'حسب المشروع',
                'execution_policy' => 'يُحدد الجدول الزمني والتكلفة بعد لقاء تقييم شامل.',
                'duration' => 'حسب المشروع',
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'title' => 'Ad Account Rescue™',
                'slug' => 'ad-account-rescue',
                'intro' => 'خدمة عاجلة لإصلاح الحسابات الإعلانية المعطلة أو الممنوعة، نقدم فحصًا دقيقًا لكل الأسباب.',
                'outputs' => 'فحص أولي بسعر 25$، وتكلفة حل تتراوح بين 50$ إلى 150$ حسب تعقيد المشكلة.',
                'price' => 'يبدأ من $25',
                'execution_policy' => 'يتم تحديد السعر النهائي بعد تقييم الحالة وتقديم عرض للعميل.',
                'duration' => '1-3 أيام',
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'title' => 'Creative Advertising Solutions™',
                'slug' => 'creative-advertising',
                'intro' => 'تخطيط إعلاني مبتكر؛ يمكن طلب الفكرة فقط أو تضمين إنتاج الحملة كاملة.',
                'outputs' => 'عرض فكرة إعلانية أو تنفيذ حملة مع الإنتاج الكامل وفق اختيار العميل.',
                'price' => '$300 - $1200',
                'execution_policy' => 'تسليم الفكرة خلال 5 أيام، مدة الإنتاج تتوقف على حجم المشروع واتفاق الأطراف.',
                'duration' => '5-20 أيام',
                'created_at' => now(),
                'updated_at' => now(),
            ],
        ]);
    }
}
