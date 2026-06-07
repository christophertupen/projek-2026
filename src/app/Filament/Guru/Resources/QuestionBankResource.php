<?php

namespace App\Filament\Guru\Resources;

use App\Filament\Guru\Resources\QuestionBankResource\Pages;
use App\Models\QuestionBank;
use Filament\Forms;
use Filament\Forms\Form;
use Filament\Resources\Resource;
use Filament\Tables;
use Filament\Tables\Table;

class QuestionBankResource extends Resource
{
    protected static ?string $model = QuestionBank::class;

    protected static ?string $navigationIcon = 'heroicon-o-document-arrow-up';

    protected static ?string $navigationLabel = 'Bank Soal';

    protected static ?string $modelLabel = 'Bank Soal';

    protected static ?string $pluralModelLabel = 'Bank Soal';

    protected static ?string $navigationGroup = 'Pembelajaran';

    protected static ?int $navigationSort = 2;

    public static function form(Form $form): Form
    {
        return $form
            ->schema([
                Forms\Components\Section::make('Informasi Bank Soal')
                    ->description('Upload bank soal dalam bentuk file PDF.')
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
                            ->label('Judul Bank Soal')
                            ->placeholder('Contoh: Bank Soal Matematika Bab 1')
                            ->required()
                            ->maxLength(255),

                        Forms\Components\Textarea::make('description')
                            ->label('Deskripsi')
                            ->placeholder('Masukkan deskripsi singkat bank soal')
                            ->rows(4)
                            ->columnSpanFull(),

                        Forms\Components\FileUpload::make('pdf_file')
                            ->label('File PDF')
                            ->directory('question-banks')
                            ->disk('public')
                            ->acceptedFileTypes(['application/pdf'])
                            ->downloadable()
                            ->openable()
                            ->required()
                            ->maxSize(5120)
                            ->columnSpanFull(),
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
                    ->label('Judul')
                    ->searchable()
                    ->sortable(),

                Tables\Columns\TextColumn::make('teacher.name')
                    ->label('Guru')
                    ->searchable()
                    ->sortable(),

                Tables\Columns\IconColumn::make('pdf_file')
                    ->label('PDF')
                    ->boolean()
                    ->trueIcon('heroicon-o-document-arrow-down')
                    ->falseIcon('heroicon-o-x-circle'),

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
            ->emptyStateHeading('Belum ada bank soal')
            ->emptyStateDescription('Upload bank soal PDF pertama untuk siswa.')
            ->emptyStateIcon('heroicon-o-document-arrow-up');
    }

    public static function getPages(): array
    {
        return [
            'index' => Pages\ListQuestionBanks::route('/'),
            'create' => Pages\CreateQuestionBank::route('/create'),
            'edit' => Pages\EditQuestionBank::route('/{record}/edit'),
        ];
    }
}