<?php

namespace App\Filament\Guru\Resources;

use App\Filament\Guru\Resources\MaterialResource\Pages;
use App\Models\Material;
use Filament\Forms;
use Filament\Forms\Form;
use Filament\Resources\Resource;
use Filament\Tables;
use Filament\Tables\Table;

class MaterialResource extends Resource
{
    protected static ?string $model = Material::class;

    protected static ?string $navigationIcon = 'heroicon-o-document-text';

    protected static ?string $navigationLabel = 'Materi';

    protected static ?string $modelLabel = 'Materi';

    protected static ?string $pluralModelLabel = 'Materi';

    protected static ?string $navigationGroup = 'Pembelajaran';

    protected static ?int $navigationSort = 1;

    public static function form(Form $form): Form
    {
        return $form
            ->schema([
                Forms\Components\Section::make('Informasi Materi')
                    ->description('Kelola materi pembelajaran yang dapat diakses oleh siswa.')
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
                            ->label('Judul Materi')
                            ->placeholder('Contoh: Pengenalan Aljabar')
                            ->required()
                            ->maxLength(255),

                        Forms\Components\RichEditor::make('content')
                            ->label('Isi Materi')
                            ->placeholder('Tulis isi materi pembelajaran')
                            ->columnSpanFull(),

                        Forms\Components\FileUpload::make('file')
                            ->label('File Materi')
                            ->directory('materials')
                            ->disk('public')
                            ->downloadable()
                            ->openable()
                            ->acceptedFileTypes([
                                'application/pdf',
                                'application/msword',
                                'application/vnd.openxmlformats-officedocument.wordprocessingml.document',
                                'application/vnd.ms-powerpoint',
                                'application/vnd.openxmlformats-officedocument.presentationml.presentation',
                            ])
                            ->maxSize(5120)
                            ->columnSpanFull(),

                        Forms\Components\TextInput::make('youtube_url')
                            ->label('Link Video YouTube')
                            ->placeholder('https://youtube.com/...')
                            ->url()
                            ->maxLength(255)
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
                    ->label('Judul Materi')
                    ->searchable()
                    ->sortable(),

                Tables\Columns\TextColumn::make('teacher.name')
                    ->label('Guru')
                    ->searchable()
                    ->sortable(),

                Tables\Columns\IconColumn::make('file')
                    ->label('File')
                    ->boolean()
                    ->trueIcon('heroicon-o-document-arrow-down')
                    ->falseIcon('heroicon-o-x-circle'),

                Tables\Columns\TextColumn::make('youtube_url')
                    ->label('Video')
                    ->limit(30)
                    ->toggleable(),

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
            ->emptyStateHeading('Belum ada materi')
            ->emptyStateDescription('Tambahkan materi pembelajaran pertama untuk siswa.')
            ->emptyStateIcon('heroicon-o-document-text');
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
            'index' => Pages\ListMaterials::route('/'),
            'create' => Pages\CreateMaterial::route('/create'),
            'edit' => Pages\EditMaterial::route('/{record}/edit'),
        ];
    }
}