<?php

namespace App\Filament\Widgets;

use App\Models\Participant;
use App\Models\Schema;
use Filament\Widgets\StatsOverviewWidget;
use Filament\Widgets\StatsOverviewWidget\Stat;

class StatsOverview extends StatsOverviewWidget
{
    protected function getStats(): array
    {
        $user = auth()->user();

        if ($user->hasRole(['super_admin', 'admin'])) {
            return [
                Stat::make('Total Peserta', Participant::count())
                    ->description('Peserta yang terdaftar')
                    ->descriptionIcon('heroicon-m-users')
                    ->color('primary'),
                Stat::make('Total Skema', Schema::count())
                    ->description('Skema Sertifikasi aktif')
                    ->descriptionIcon('heroicon-m-academic-cap')
                    ->color('success'),
                Stat::make('Pendaftar Hari ini', Participant::whereDate('created_at', today())->count())
                    ->description('Peserta baru hari ini')
                    ->descriptionIcon('heroicon-m-calendar-days')
                    ->color('info'),
            ];
        }

        return [
            Stat::make('Status Saya', 'Terdaftar')
        ];
    }
}
