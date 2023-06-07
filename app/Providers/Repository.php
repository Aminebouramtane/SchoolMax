<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;
use App\Repository\TeacherRepository;
use App\Repository\TeacherRepositoryInterface;
use App\Repository\StudentRepository;
use App\Repository\StudentRepositoryInterface;
use App\Repository\PromotionRepository;
use App\Repository\PromotionRepositoryInterface;
use App\Repository\GraduatRepository;
use App\Repository\GraduatRepositoryInterface;

class Repository extends ServiceProvider
{
    /**
     * Register services.
     */
    public function register(): void
    {
        $this->app->bind(TeacherRepositoryInterface::class, TeacherRepository::class);
        $this->app->bind(StudentRepositoryInterface::class, StudentRepository::class);
        $this->app->bind(PromotionRepositoryInterface::class, PromotionRepository::class);
        $this->app->bind(GraduatRepositoryInterface::class, GraduatRepository::class);
    }

    /**
     * Bootstrap services.
     */
    public function boot(): void
    {
        //
    }
}
