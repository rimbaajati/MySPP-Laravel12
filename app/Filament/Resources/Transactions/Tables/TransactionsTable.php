<?php

namespace App\Filament\Resources\Transactions\Tables;

use Filament\Actions\BulkActionGroup;
use Filament\Actions\DeleteBulkAction;
use Filament\Actions\EditAction;
use Filament\Tables\Columns\ImageColumn;
use Filament\Tables\Columns\TextColumn;
use Filament\Tables\Table;

class TransactionsTable
{
    public static function configure(Table $table): Table
    {
        return $table
            ->columns([
                TextColumn::make('code')
                    ->label("Code")
                    ->searchable(),

                TextColumn::make('users.name')
                    ->label("User Name")
                    ->searchable(),

                TextColumn::make('users.phone')
                    ->label("Phone"),

                TextColumn::make('payment_method')
                    ->label("Payment Method"),

                TextColumn::make('payment_status')
                    ->badge()
                    ->color(fn ($state) => match ($state) {
                        'PENDING' => 'warning',
                        'COMPLETED' => 'success',
                        'FAILED' => 'danger',
                        default => 'secondary',
                    }),

                // FIX: gunakan relasi departement
                TextColumn::make('departement.name')
                    ->label("Departement"),

                TextColumn::make('departement.semester')
                    ->label("Semester")
                    ->searchable(),

                TextColumn::make('departement.cost')
                    ->label("Cost")
                    ->money("IDR"),
            ])
            ->filters([
                //
            ])
            ->recordActions([
                EditAction::make(),
            ])
            ->toolbarActions([
                BulkActionGroup::make([
                    DeleteBulkAction::make(),
                ]),
            ]);
    }
}
