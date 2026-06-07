<?php

namespace App\Filament\Guru\Resources;

use App\Filament\Guru\Resources\QuizResource\Pages;
use App\Models\Quiz;
use Filament\Forms;
use Filament\Forms\Form;
use Filament\Resources\Resource;
use Filament\Tables;
use Filament\Tables\Table;

class QuizResource extends Resource
{
    protected static ?string $model = Quiz::class;

    protected static ?string $navigationIcon = 'heroicon-o-clipboard-document-check';

    protected static ?string $navigationLabel = 'Quiz';

    protected static ?string $modelLabel = 'Quiz';

    protected static ?string $pluralModelLabel = 'Quiz';

    protected static ?string $navigationGroup = 'Quiz Online';

    protected static ?int $navigationSort = 1;

    public static function form(Form $form): Form
    {
        return $form
            ->schema([
                Forms\Components\Section::make('Informasi Quiz')
                    ->description('Buat quiz online berdasarkan mata pelajaran.')
                    ->schema([
                        Forms\Components\Select::make('subject_id')
                            ->label('Mata Pelajaran')
                            ->relationship('subject', 'name')
                            ->searchable()
                            ->preload()
                            ->required(),

                        Forms\Components\Hidden::make('teacher_id')
                            ->default(fn () => auth()->id()),

                        Forms\Components\TextInput::make('title')
                            ->label('Judul Quiz')
                            ->placeholder('Contoh: Quiz Matematika Bab 1')
                            ->required()
                            ->maxLength(255),

                        Forms\Components\Textarea::make('description')
                            ->label('Deskripsi')
                            ->rows(4)
                            ->columnSpanFull(),

                        Forms\Components\TextInput::make('duration')
                            ->label('Durasi Menit')
                            ->numeric()
                            ->default(60)
                            ->required(),

                        Forms\Components\DateTimePicker::make('start_time')
                            ->label('Waktu Mulai')
                            ->seconds(false),

                        Forms\Components\DateTimePicker::make('end_time')
                            ->label('Waktu Selesai')
                            ->seconds(false),

                        Forms\Components\Toggle::make('is_active')
                            ->label('Aktifkan Quiz')
                            ->default(false),
                    ])
                    ->columns(2),
            ]);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                Tables\Columns\TextColumn::make('subject.name')
                    ->label('Mata Pelajaran')
                    ->searchable()
                    ->sortable(),

                Tables\Columns\TextColumn::make('title')
                    ->label('Judul Quiz')
                    ->searchable()
                    ->sortable(),

                Tables\Columns\TextColumn::make('duration')
                    ->label('Durasi')
                    ->suffix(' menit')
                    ->sortable(),

                Tables\Columns\IconColumn::make('is_active')
                    ->label('Status')
                    ->boolean(),

                Tables\Columns\TextColumn::make('start_time')
                    ->label('Mulai')
                    ->dateTime('d M Y H:i')
                    ->sortable(),

                Tables\Columns\TextColumn::make('end_time')
                    ->label('Selesai')
                    ->dateTime('d M Y H:i')
                    ->sortable(),
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
            ->emptyStateHeading('Belum ada quiz')
            ->emptyStateDescription('Buat quiz pertama untuk siswa.')
            ->emptyStateIcon('heroicon-o-clipboard-document-check');
    }

    public static function getPages(): array
    {
        return [
            'index' => Pages\ListQuizzes::route('/'),
            'create' => Pages\CreateQuiz::route('/create'),
            'edit' => Pages\EditQuiz::route('/{record}/edit'),
        ];
    }
}