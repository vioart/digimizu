<?php

namespace App\Filament\Resources;

use App\Filament\Exports\RiwayatAbsensiExporter;
use App\Filament\Resources\RiwayatAbsensiResource\Pages;
use App\Filament\Resources\RiwayatAbsensiResource\RelationManagers;
use App\Models\RiwayatAbsensi;
use Filament\Actions\Exports\Enums\ExportFormat;
use Filament\Forms;
use Filament\Forms\Form;
use Filament\Resources\Resource;
use Filament\Tables;
use Filament\Tables\Actions\ExportAction;
use Filament\Tables\Actions\ExportBulkAction;
use Filament\Tables\Enums\FiltersLayout as EnumsFiltersLayout;
use Filament\Tables\Table;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\SoftDeletingScope;


class RiwayatAbsensiResource extends Resource
{
    protected static ?string $model = RiwayatAbsensi::class;

    protected static ?string $navigationIcon = 'heroicon-o-rectangle-stack';

    public static function form(Form $form): Form
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
                Forms\Components\FileUpload::make('foto')->required(),
            ]);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                Tables\Columns\TextColumn::make('user.name'),
                Tables\Columns\TextColumn::make('tanggal')
                    ->date('Y-m-d'),
                Tables\Columns\TextColumn::make('waktu')
                    ->time('H:i:s'),
                Tables\Columns\ImageColumn::make('foto'),
                Tables\Columns\TextColumn::make('status'),
            ])
            ->filters([
                Tables\Filters\SelectFilter::make('user.name')
                    ->relationship('user', 'name'),
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
                
                ], layout: EnumsFiltersLayout::AboveContent) 
            ->actions([
                //
            ])
            ->headerActions([
                ExportAction::make()
                    ->exporter(RiwayatAbsensiExporter::class)
                    // ->formats([
                    //     ExportFormat::Csv
                    // ])
            ])
            ->bulkActions([
                Tables\Actions\BulkActionGroup::make([
                    Tables\Actions\DeleteBulkAction::make(),
                ]),
                ExportBulkAction::make()
                    ->exporter(RiwayatAbsensiExporter::class)
                    ->formats([
                        ExportFormat::Csv
                    ])
            ]);
    }

    public static function getRelations(): array
    {
        return [
            //
        ];
    }
    public static function getLabel(): string
    {
        return 'Riwayat Absensi';
    }

    public static function getPluralLabel(): string
    {
        return 'Riwayat Absensi';
    }

    public static function getPages(): array
    {
        return [
            'index' => Pages\ListRiwayatAbsensis::route('/'),
            'create' => Pages\CreateRiwayatAbsensi::route('/create'),
            'edit' => Pages\EditRiwayatAbsensi::route('/{record}/edit'),
        ];
    }
}
