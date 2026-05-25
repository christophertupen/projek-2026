<?php

namespace App\Filament\OrangTua\Resources\QuizAttemptResource\Pages;

use App\Filament\OrangTua\Resources\QuizAttemptResource;
use Filament\Actions;
use Filament\Resources\Pages\ListRecords;

class ListQuizAttempts extends ListRecords
{
    protected static string $resource = QuizAttemptResource::class;

    protected function getHeaderActions(): array
    {
        return [
            Actions\CreateAction::make(),
        ];
    }
}
