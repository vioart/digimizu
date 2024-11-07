<?php

namespace App\Filament\Resources;

use App\Filament\Resources\AbsensiResource\Pages;
use App\Models\Absensi;
use Filament\Forms;
use Filament\Tables;
use Filament\Resources\Resource;

class AbsensiResource extends Resource
{
    protected static ?string $model = Absensi::class;

    protected static ?string $navigationIcon = 'heroicon-o-clipboard-document-check';

    protected static ?string $navigationLabel = 'Absensi';

    protected static ?string $modelLabel = 'Absensi';

    protected static ?string $pluralModelLabel = 'Absensi';

    public static function form(Forms\Form $form): Forms\Form
    {
        return $form
            ->schema([
                Forms\Components\Select::make('user_id')
                    ->relationship('user', 'name')
                    ->required(),
                Forms\Components\DatePicker::make('tanggal')->required(),
                Forms\Components\TimePicker::make('waktu')->required(),
                Forms\Components\Select::make('status')
                    ->options([
                        'absen' => 'Absen',
                        'izin' => 'Izin',
                    ])
                    ->required(),
                Forms\Components\TextInput::make('keterangan'),
                Forms\Components\FileUpload::make('foto')
                ->directory('absensi-fotos')
                ,
            ]);
    }

    public static function table(Tables\Table $table): Tables\Table
    {
        return $table
            ->columns([
                Tables\Columns\TextColumn::make('user.name')
                    ->sortable(),
                Tables\Columns\TextColumn::make('tanggal')
                    ->date('Y-m-d')
                    ->sortable(),
                Tables\Columns\TextColumn::make('waktu')
                    ->time('H:i:s')
                    ->sortable(),
                Tables\Columns\ImageColumn::make('foto')
                    ->label('Foto'),
                Tables\Columns\TextColumn::make('status'),
                Tables\Columns\TextColumn::make('keterangan'),
            ])
            ->filters([
                Tables\Filters\SelectFilter::make('tanggal')
                    ->options([
                        'today' => 'Hari Ini',
                        'yesterday' => 'Kemarin',
                        'last_7_days' => '7 Hari Terakhir',
                        'last_30_days' => '30 Hari Terakhir',
                    ])
                    ->query(function ($query, $data) {
                        $today = now()->toDateString();
                        switch ($data) {
                            case 'today':
                                return $query->whereDate('tanggal', $today);
                            case 'yesterday':
                                return $query->whereDate('tanggal', now()->subDay()->toDateString());
                            case 'last_7_days':
                                return $query->whereDate('tanggal', '>=', now()->subDays(7));
                            case 'last_30_days':
                                return $query->whereDate('tanggal', '>=', now()->subDays(30));
                        }
                    }),
                Tables\Filters\SelectFilter::make('status')
                    ->options([
                        'absen' => 'Absen',
                        'izin' => 'Izin',
                    ]),
                Tables\Filters\SelectFilter::make('user.name')
                    ->relationship('user', 'name')
                
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
            'index' => Pages\ListAbsensi::route('/'),
            'create' => Pages\CreateAbsensi::route('/create'),
            'edit' => Pages\EditAbsensi::route('/{record}/edit'),
        ];
    }
}