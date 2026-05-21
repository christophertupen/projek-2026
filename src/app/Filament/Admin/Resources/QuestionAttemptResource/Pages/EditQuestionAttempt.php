<?php

namespace App\Filament\Admin\Resources\QuestionAttemptResource\Pages;

use App\Filament\Admin\Resources\QuestionAttemptResource;
use Filament\Actions;
use Filament\Resources\Pages\EditRecord;

class EditQuestionAttempt extends EditRecord
{
    protected static string $resource = QuestionAttemptResource::class;

    protected function getHeaderActions(): array
    {
        return [
            Actions\DeleteAction::make(),
        ];
    }
}
