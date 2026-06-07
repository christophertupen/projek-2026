<?php

namespace App\Filament\Guru\Resources;

use App\Filament\Guru\Resources\QuestionResource\Pages;
use App\Models\Question;
use Filament\Forms;
use Filament\Forms\Form;
use Filament\Resources\Resource;
use Filament\Tables;
use Filament\Tables\Table;

class QuestionResource extends Resource
{
    protected static ?string $model = Question::class;

    protected static ?string $navigationIcon = 'heroicon-o-question-mark-circle';

    protected static ?string $navigationLabel = 'Soal Quiz';

    protected static ?string $modelLabel = 'Soal Quiz';

    protected static ?string $pluralModelLabel = 'Soal Quiz';

    protected static ?string $navigationGroup = 'Quiz Online';

    protected static ?int $navigationSort = 2;

    public static function form(Form $form): Form
    {
        return $form
            ->schema([
                Forms\Components\Section::make('Informasi Soal')
                    ->description('Buat soal pilihan ganda untuk quiz.')
                    ->schema([
                        Forms\Components\Select::make('quiz_id')
                            ->label('Quiz')
                            ->relationship('quiz', 'title')
                            ->searchable()
                            ->preload()
                            ->required(),

                        Forms\Components\Textarea::make('question')
                            ->label('Pertanyaan')
                            ->placeholder('Masukkan pertanyaan')
                            ->required()
                            ->rows(4)
                            ->columnSpanFull(),

                        Forms\Components\TextInput::make('score')
                            ->label('Skor')
                            ->numeric()
                            ->default(10)
                            ->required(),

                        Forms\Components\Repeater::make('options')
                            ->label('Pilihan Jawaban')
                            ->relationship('options')
                            ->schema([
                                Forms\Components\TextInput::make('option_text')
                                    ->label('Pilihan')
                                    ->placeholder('Masukkan pilihan jawaban')
                                    ->required()
                                    ->maxLength(255),

                                Forms\Components\Toggle::make('is_correct')
                                    ->label('Jawaban Benar')
                                    ->default(false),
                            ])
                            ->columns(2)
                            ->minItems(2)
                            ->maxItems(5)
                            ->defaultItems(4)
                            ->columnSpanFull(),
                    ])
                    ->columns(2),
            ]);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                Tables\Columns\TextColumn::make('quiz.title')
                    ->label('Quiz')
                    ->searchable()
                    ->sortable(),

                Tables\Columns\TextColumn::make('question')
                    ->label('Pertanyaan')
                    ->limit(60)
                    ->searchable(),

                Tables\Columns\TextColumn::make('score')
                    ->label('Skor')
                    ->sortable(),

                Tables\Columns\TextColumn::make('options_count')
                    ->label('Jumlah Pilihan')
                    ->counts('options'),

                Tables\Columns\TextColumn::make('created_at')
                    ->label('Dibuat')
                    ->dateTime('d M Y H:i')
                    ->sortable()
                    ->toggleable(isToggledHiddenByDefault: true),
            ])
            ->actions([
                Tables\Actions\EditAction::make(),
                Tables\Actions\DeleteAction::make(),
            ])
            ->bulkActions([
                Tables\Actions\BulkActionGroup::make([
                    Tables\Actions\DeleteBulkAction::make(),
                ]),
            ])
            ->emptyStateHeading('Belum ada soal quiz')
            ->emptyStateDescription('Tambahkan soal pilihan ganda untuk quiz.')
            ->emptyStateIcon('heroicon-o-question-mark-circle');
    }

    public static function getPages(): array
    {
        return [
            'index' => Pages\ListQuestions::route('/'),
            'create' => Pages\CreateQuestion::route('/create'),
            'edit' => Pages\EditQuestion::route('/{record}/edit'),
        ];
    }
}