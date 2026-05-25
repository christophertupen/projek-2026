<?php

namespace App\Filament\Guru\Resources\QuestionResource\Pages;

use App\Filament\Guru\Resources\QuestionResource;
use Filament\Actions;
use Filament\Resources\Pages\CreateRecord;

class CreateQuestion extends CreateRecord
{
    protected static string $resource = QuestionResource::class;
}
