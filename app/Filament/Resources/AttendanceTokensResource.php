<?php

namespace App\Filament\Resources;

use App\Filament\Resources\AttendanceTokensResource\Pages;
use App\Filament\Resources\AttendanceTokensResource\RelationManagers;
use App\Models\AttendanceTokens;
use Filament\Forms;
use Filament\Forms\Form;
use Filament\Resources\Resource;
use Filament\Tables;
use Filament\Tables\Table;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\SoftDeletingScope;

class AttendanceTokensResource extends Resource
{
    protected static ?string $model = AttendanceTokens::class;

    protected static ?string $navigationIcon = 'heroicon-o-key';

    public static function form(Form $form): Form
    {
        return $form
            ->schema([
                Forms\Components\DatePicker::make('tanggal')->required(),
                Forms\Components\TextInput::make('token')
                    ->required()
                    ->maxLength(6)
                    ->reactive()
                    ->afterStateUpdated(fn ($state, callable $set) => $set('token', strtoupper($state))),
                Forms\Components\Select::make('status')
                    ->options([
                        '1' => 'Aktif',
                        '0' => 'Tidak Aktif',
                    ])
                    ->required(),
            ]);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                Tables\Columns\TextColumn::make('tanggal')
                    ->date('Y-m-d')
                    ->sortable(),
                Tables\Columns\TextColumn::make('token'),
                Tables\Columns\TextColumn::make('is_active')
                    ->label('Status')
                    ->formatStateUsing(fn ($state) => $state == '1' ? 'Aktif' : 'Tidak Aktif')
                    ->sortable(),
            ])
            ->filters([
                Tables\Filters\SelectFilter::make('Status')
                ->options([
                    '1' => 'Aktif',
                    '0' => 'Tidak Aktif',
                ]),
            ])
            ->actions([
                Tables\Actions\EditAction::make(),
                Tables\Actions\DeleteAction::make(),
            ])
            ->bulkActions([
                Tables\Actions\BulkActionGroup::make([
                    Tables\Actions\DeleteBulkAction::make(),
                ]),
            ]);
    }
    public static function getLabel(): string
    {
        return 'Token';
    }

    public static function getPluralLabel(): string
    {
        return 'Token';
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
            'index' => Pages\ListAttendanceTokens::route('/'),
            'create' => Pages\CreateAttendanceTokens::route('/create'),
            'edit' => Pages\EditAttendanceTokens::route('/{record}/edit'),
        ];
    }
}
