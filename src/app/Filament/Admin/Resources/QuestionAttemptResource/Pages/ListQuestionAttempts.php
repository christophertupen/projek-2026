<?php

namespace App\Filament\Admin\Resources\QuestionAttemptResource\Pages;

use App\Filament\Admin\Resources\QuestionAttemptResource;
use Filament\Actions;
use Filament\Resources\Pages\ListRecords;

class ListQuestionAttempts extends ListRecords
{
    protected static string $resource = QuestionAttemptResource::class;

    protected function getHeaderActions(): array
    {
        return [
            Actions\CreateAction::make(),
        ];
    }
}
