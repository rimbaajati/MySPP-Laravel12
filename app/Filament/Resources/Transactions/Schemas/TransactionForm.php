<?php

namespace App\Filament\Resources\Transactions\Schemas;

use Filament\Forms\Components\TextInput;
use Filament\Schemas\Schema;

class TransactionForm
{
    public static function configure(Schema $schema): Schema
    {
        return $schema
            ->components([
                TextInput::make('code')
                    ->required(),
                TextInput::make('payment_method')
                    ->default(null),
                TextInput::make('payment_status')
                    ->default(null),
                TextInput::make('payment_proof')
                    ->default(null),
                TextInput::make('user_id')
                    ->required()
                    ->numeric(),
                TextInput::make('departement_id')
                    ->required()
                    ->numeric(),
            ]);
    }
}
