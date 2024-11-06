<?php

namespace Database\Seeders;

use Botble\Base\Supports\BaseSeeder;

class DatabaseSeeder extends BaseSeeder
{
    public function run(): void
    {
        $this->activateAllPlugins();

        $this->call([
            UserSeeder::class,
            LanguageSeeder::class,
            PageSeeder::class,
            BlogSeeder::class,
            GallerySeeder::class,
            ContactSeeder::class,
            WidgetSeeder::class,
            ThemeOptionSeeder::class,
            SettingSeeder::class,
            LocationSeeder::class,
            CareerLevelSeeder::class,
            DegreeLevelSeeder::class,
            DegreeTypeSeeder::class,
            FunctionalAreaSeeder::class,
            JobCategorySeeder::class,
            JobExperienceSeeder::class,
            JobShiftSeeder::class,
            JobSkillSeeder::class,
            JobTypeSeeder::class,
            CompanySeeder::class,
            LanguageLevelSeeder::class,
            JobSeeder::class,
            CurrencySeeder::class,
            AccountSeeder::class,
            PackageSeeder::class,
            ReviewSeeder::class,
            TeamSeeder::class,
            TestimonialSeeder::class,
            FaqSeeder::class,
            MenuSeeder::class,
            JobApplicationSeeder::class,
        ]);

        $this->finished();
    }
}
