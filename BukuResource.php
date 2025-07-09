<?php

namespace App\Filament\Resources;

use App\Filament\Resources\BukuResource\Pages;
use App\Models\Buku;
use Filament\Forms;
use Filament\Resources\Form;
use Filament\Resources\Table;
use Filament\Resources\Resource;
use Filament\Tables;

class BukuResource extends Resource
{
    protected static ?string $model = Buku::class;

    public static function form(Form $form): Form
    {
        return $form->schema([
            Forms\Components\Grid::make(2)->schema([
                Forms\Components\TextInput::make('judul')->required(),
                Forms\Components\TextInput::make('pengarang')->required(),
                Forms\Components\Select::make('kategori')
                    ->options([
                        'Fiksi' => 'Fiksi',
                        'Non Fiksi' => 'Non Fiksi',
                    ])
                    ->required(),
            ]),
        ]);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                Tables\Columns\TextColumn::make('judul')->searchable(),
                Tables\Columns\TextColumn::make('pengarang')->searchable(),
                Tables\Columns\BadgeColumn::make('kategori')
                    ->colors([
                        'primary' => 'Fiksi',
                        'success' => 'Non Fiksi',
                    ]),
                Tables\Columns\TextColumn::make('terjual')->label('Terjual'),
                Tables\Columns\TextColumn::make('penjualans_count')->label('Jumlah Transaksi'),
            ])
            ->filters([
                Tables\Filters\SelectFilter::make('kategori')->options([
                    'Fiksi' => 'Fiksi',
                    'Non Fiksi' => 'Non Fiksi',
                ])
            ])
            ->defaultSort('judul');
    }

    public static function getEloquentQuery()
    {
        return parent::getEloquentQuery()->withCount('penjualans');
    }

    public static function getPages(): array
    {
        return [
            'index' => Pages\ListBukus::route('/'),
            'create' => Pages\CreateBuku::route('/create'),
            'edit' => Pages\EditBuku::route('/{record}/edit'),
        ];
    }
}