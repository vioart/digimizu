<?php

namespace App\Filament\Resources;

use App\Filament\Resources\CalonMagangResource\Pages;
use App\Models\CalonMagang;
use App\Models\User;
use Filament\Forms;
use Filament\Tables;
use Filament\Resources\Resource;
use Illuminate\Support\Facades\Hash;

class CalonMagangResource extends Resource
{
    protected static ?string $model = CalonMagang::class;

    protected static ?string $navigationIcon = 'heroicon-o-academic-cap';

    protected static ?string $navigationLabel = 'Calon Magang';

    protected static ?string $modelLabel = 'Calon Magang';

    protected static ?string $pluralModelLabel = 'Calon Magang';

    public static function form(Forms\Form $form): Forms\Form
    {
        return $form
            ->schema([
                Forms\Components\TextInput::make('name')->required(),
                Forms\Components\TextInput::make('email')->email()->required(),
                Forms\Components\TextInput::make('password')->password()->required()->hiddenOn('edit'),
                Forms\Components\TextInput::make('asal_instansi')->required(),
                Forms\Components\FileUpload::make('image'),
                Forms\Components\TextInput::make('test_score')->numeric(),
                Forms\Components\DateTimePicker::make('test_date'),
            ]);
    }

    public static function table(Tables\Table $table): Tables\Table
    {
        return $table
            ->columns([
                Tables\Columns\TextColumn::make('name'),
                Tables\Columns\TextColumn::make('email'),
                Tables\Columns\TextColumn::make('asal_instansi'),
                Tables\Columns\TextColumn::make('test_score'),
                Tables\Columns\TextColumn::make('test_date'),
            ])
            ->filters([
                //
            ])
            ->actions([
                Tables\Actions\EditAction::make(),
                Tables\Actions\DeleteAction::make(),
                Tables\Actions\Action::make('approve')
                    ->action(fn (CalonMagang $record) => self::approveCandidate($record))
                    ->requiresConfirmation(),
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
            'index' => Pages\ListCalonMagang::route('/'),
            'create' => Pages\CreateCalonMagang::route('/create'),
            'edit' => Pages\EditCalonMagang::route('/{record}/edit'),
        ];
    }

    protected static function approveCandidate(CalonMagang $calonMagang)
    {
        User::create([
            'name' => $calonMagang->name,
            'email' => $calonMagang->email,
            'password' => $calonMagang->password,
            'asal_instansi' => $calonMagang->asal_instansi,
            'image' => $calonMagang->image,
            'role' => 'anggota_magang',
            'is_active' => true,
        ]);

        $calonMagang->delete();
    }
}