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
use Filament\Forms\Components\DatePicker;
use Filament\Tables\Filters\Filter;
use Illuminate\Support\Facades\Log;
use Filament\Tables\Enums\FiltersLayout;


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
                Tables\Columns\TextColumn::make('user.name')
                    ->sortable(),
                Tables\Columns\TextColumn::make('tanggal')
                    ->date('Y-m-d')
                    ->sortable(),
                Tables\Columns\TextColumn::make('waktu')
                    ->time('H:i:s')
                    ->sortable(),
                Tables\Columns\ImageColumn::make('foto'),
                Tables\Columns\TextColumn::make('status'),
            ])
            ->filters([
                Tables\Filters\SelectFilter::make('user.name')
                    ->relationship('user', 'name'),

                Tables\Filters\SelectFilter::make('bulan')
                    ->options([
                        '1' => 'Januari',
                        '2' => 'Februari',
                        '3' => 'Maret',
                        '4' => 'April',
                        '5' => 'Mei',
                        '6' => 'Juni',
                        '7' => 'Juli',
                        '8' => 'Agustus',
                        '9' => 'September',
                        '10' => 'Oktober',
                        '11' => 'November',
                        '12' => 'Desember',
                    ])
                    ->query(function ($query, $data) {
                        $bulan = $data['value'] ?? null;

                        if (!in_array($bulan, ['1', '2', '3', '4', '5', '6', '7', '8', '9', '10', '11', '12'])) {
                            return $query;
                        }


                        return $query->whereMonth('tanggal', $bulan);

                    }),
                    

                Tables\Filters\SelectFilter::make('status')
                    ->options([
                        'absen' => 'Absen',
                        'izin' => 'Izin',
                    ]),
                
                     
                Filter::make('created_at')
                    ->form([
                        DatePicker::make('created_from')
                            ->label('Dari'),
                        DatePicker::make('created_until')
                            ->label('Sampai')
                    ])
                    ->query(function (Builder $query, array $data): Builder {
                        return $query
                            ->when(
                                $data['created_from'],
                                fn (Builder $query, $date): Builder => $query->whereDate('created_at', '>=', $date),
                            )
                            ->when(
                                $data['created_until'],
                                fn (Builder $query, $date): Builder => $query->whereDate('created_at', '<=', $date),
                            );
                    })

                ], layout: FiltersLayout::AboveContent) 
            ->actions([
                //
            ])
            ->headerActions([
                ExportAction::make()
                    ->exporter(RiwayatAbsensiExporter::class)
                    ->formats([
                        ExportFormat::Xlsx
                    ])
            ])
            ->bulkActions([
                Tables\Actions\BulkActionGroup::make([
                    Tables\Actions\DeleteBulkAction::make(),
                ]),
                ExportBulkAction::make()
                    ->exporter(RiwayatAbsensiExporter::class)
                    ->formats([
                        ExportFormat::Xlsx
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
