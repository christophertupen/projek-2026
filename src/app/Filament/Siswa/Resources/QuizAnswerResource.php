<?php

namespace App\Filament\Siswa\Resources;

use App\Filament\Siswa\Resources\QuizAnswerResource\Pages;
use App\Models\QuizAnswer;
use Filament\Forms;
use Filament\Forms\Form;
use Filament\Resources\Resource;
use Filament\Tables;
use Filament\Tables\Table;
use Illuminate\Database\Eloquent\Builder;

class QuizAnswerResource extends Resource
{
    protected static ?string $model = QuizAnswer::class;

    protected static ?string $navigationIcon = 'heroicon-o-rectangle-stack';

    protected static ?string $navigationLabel = 'Jawaban Quiz';

    protected static ?string $navigationGroup = 'Quiz';

    protected static bool $shouldRegisterNavigation = false;

    public static function form(Form $form): Form
    {
        return $form
            ->schema([
                Forms\Components\Select::make('quiz_attempt_id')
                    ->label('Pengerjaan')
                    ->relationship('attempt', 'id')
                    ->disabled(),

                Forms\Components\Select::make('question_id')
                    ->label('Pertanyaan')
                    ->relationship('question', 'question')
                    ->disabled(),

                Forms\Components\Select::make('selected_option_id')
                    ->label('Jawaban Dipilih')
                    ->relationship('selectedOption', 'option_text')
                    ->disabled(),

                Forms\Components\Toggle::make('is_correct')
                    ->label('Benar')
                    ->disabled(),
            ]);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                Tables\Columns\TextColumn::make('attempt.quiz.title')
                    ->label('Quiz')
                    ->searchable()
                    ->sortable(),

                Tables\Columns\TextColumn::make('question.question')
                    ->label('Pertanyaan')
                    ->limit(50)
                    ->searchable(),

                Tables\Columns\TextColumn::make('selectedOption.option_text')
                    ->label('Jawaban Dipilih')
                    ->limit(40),

                Tables\Columns\IconColumn::make('is_correct')
                    ->label('Benar')
                    ->boolean(),

                Tables\Columns\TextColumn::make('created_at')
                    ->label('Dijawab')
                    ->dateTime('d M Y H:i')
                    ->sortable(),
            ])
            ->filters([
                //
            ])
            ->actions([
                Tables\Actions\ViewAction::make(),
            ])
            ->bulkActions([]);
    }

    public static function getEloquentQuery(): Builder
    {
        return parent::getEloquentQuery()
            ->whereHas('attempt', function (Builder $query) {
                $query->where('student_id', auth()->id());
            });
    }

    public static function canCreate(): bool
    {
        return false;
    }

    public static function canEdit($record): bool
    {
        return false;
    }

    public static function canDelete($record): bool
    {
        return false;
    }

    public static function getRelations(): array
    {
        return [
            //
        ];
    }

    public static function getPages(): array
    {
        return [
            'index' => Pages\ListQuizAnswers::route('/'),
        ];
    }
}