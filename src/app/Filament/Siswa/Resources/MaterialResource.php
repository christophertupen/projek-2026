<?php

namespace App\Filament\Siswa\Resources;

use App\Filament\Siswa\Resources\MaterialResource\Pages;
use App\Filament\Siswa\Resources\MaterialResource\RelationManagers;
use App\Models\Material;
use Filament\Forms;
use Filament\Forms\Form;
use Filament\Resources\Resource;
use Filament\Tables;
use Filament\Tables\Table;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\SoftDeletingScope;

class MaterialResource extends Resource
{
    protected static ?string $model = Material::class;

    protected static ?string $navigationIcon = 'heroicon-o-rectangle-stack';

    protected static ?string $navigationLabel = 'Materi';

    protected static ?string $navigationGroup = 'Pembelajaran';

    public static function form(Form $form): Form
    {
        return $form
            ->schema([
                Forms\Components\Select::make('subject_id')
                    ->label('Mata Pelajaran')
                    ->relationship('subject', 'name')
                    ->disabled(),

                Forms\Components\TextInput::make('title')
                    ->label('Judul Materi')
                    ->disabled(),

                Forms\Components\RichEditor::make('content')
                    ->label('Isi Materi')
                    ->disabled()
                    ->columnSpanFull(),

                Forms\Components\FileUpload::make('file')
                    ->label('File')
                    ->disk('public')
                    ->disabled()
                    ->columnSpanFull(),

                Forms\Components\TextInput::make('youtube_url')
                    ->label('Video YouTube')
                    ->disabled()
                    ->columnSpanFull(),
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
                    ->boolean(),

                Tables\Columns\TextColumn::make('youtube_url')
                    ->label('Video')
                    ->limit(35)
                    ->toggleable(),

                Tables\Columns\TextColumn::make('created_at')
                    ->label('Dibuat')
                    ->dateTime('d M Y H:i')
                    ->sortable(),
            ])
            ->filters([
                //
            ])
            ->actions([
                Tables\Actions\ViewAction::make(),
            ]);
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
