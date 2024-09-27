<?php

namespace App\Filament\Resources;

use App\Filament\Resources\SoalTestResource\Pages;
use App\Models\SoalTest;
use Filament\Forms;
use Filament\Tables;
use Filament\Resources\Resource;

class SoalTestResource extends Resource
{
    protected static ?string $model = SoalTest::class;

    protected static ?string $navigationIcon = 'heroicon-o-question-mark-circle';

    protected static ?string $navigationLabel = 'Soal Test';

    protected static ?string $modelLabel = 'Soal Test';

    protected static ?string $pluralModelLabel = 'Soal Test';

    public static function form(Forms\Form $form): Forms\Form
    {
        return $form
            ->schema([
                Forms\Components\Textarea::make('pertanyaan')->required(),
                Forms\Components\TextInput::make('pilihan_a')->required(),
                Forms\Components\TextInput::make('pilihan_b')->required(),
                Forms\Components\TextInput::make('pilihan_c')->required(),
                Forms\Components\TextInput::make('pilihan_d')->required(),
                Forms\Components\Select::make('jawaban_benar')
                    ->options([
                        'a' => 'A',
                        'b' => 'B',
                        'c' => 'C',
                        'd' => 'D',
                    ])
                    ->required(),
            ]);
    }

    public static function table(Tables\Table $table): Tables\Table
    {
        return $table
            ->columns([
                Tables\Columns\TextColumn::make('pertanyaan')->limit(50),
                Tables\Columns\TextColumn::make('jawaban_benar'),
            ])
            ->filters([
                //
            ])
            ->actions([
                Tables\Actions\EditAction::make(),
                Tables\Actions\DeleteAction::make(),
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
            'index' => Pages\ListSoalTest::route('/'),
            'create' => Pages\CreateSoalTest::route('/create'),
            'edit' => Pages\EditSoalTest::route('/{record}/edit'),
        ];
    }
}