<?php

namespace App\Filament\Resources;

use App\Filament\Resources\PenjualanResource\Pages;
use App\Models\Penjualan;
use Filament\Forms;
use Filament\Resources\Form;
use Filament\Resources\Table;
use Filament\Resources\Resource;
use Filament\Tables;

class PenjualanResource extends Resource
{
    protected static ?string $model = Penjualan::class;

    public static function form(Form $form): Form
    {
        return $form->schema([
            Forms\Components\Grid::make(2)->schema([
                Forms\Components\Select::make('buku_id')
                    ->relationship('buku', 'judul')
                    ->required(),
                Forms\Components\DatePicker::make('tanggal')->required(),
                Forms\Components\TextInput::make('eksemplar')
                    ->numeric()
                    ->minValue(1)
                    ->required(),
            ]),
        ]);
    }

    public static function table(Table $table): Table
    {
        return $table->columns([
            Tables\Columns\TextColumn::make('buku.judul')->label('Buku')->searchable(),
            Tables\Columns\TextColumn::make('tanggal')->date(),
            Tables\Columns\TextColumn::make('eksemplar')->sortable(),
        ])->defaultSort('tanggal', 'desc');
    }

    public static function getPages(): array
    {
        return [
            'index' => Pages\ListPenjualans::route('/'),
            'create' => Pages\CreatePenjualan::route('/create'),
            'edit' => Pages\EditPenjualan::route('/{record}/edit'),
        ];
    }
}