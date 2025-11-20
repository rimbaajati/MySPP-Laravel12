<?php

namespace App\Filament\Resources\Transactions\Schemas;

use App\Models\Departement;
use Filament\Forms\Components\Fieldset;
use Filament\Forms\Components\Select;
use Filament\Forms\Components\TextInput;
use Filament\Schemas\Components\Section;
use Filament\Schemas\Schema;

class TransactionForm
{
    public static function configure(Schema $schema): Schema
    {
        return $schema
            ->components([
                
                // CODE
                TextInput::make('code')
                    ->required()
                    ->default(fn() => 'TRX-' . mt_rand(100000, 999999)),

                // USER ID (Catatan: TextInput tidak support ->relationship, tapi saya tetap biarkan karena
                // kamu bilang "jangan ubah fungsi/algoritma")
                Select::make('user_id')
                    ->required()
                    ->label('User')
                    ->relationship('user', 'name'),

                // PAYMENT STATUS
                TextInput::make('payment_status')
                    ->readOnly()
                    ->default('PENDING'),

                // FIELDSET
                Section::make("Departement")
                ->schema([
                    Select::make('departement_id')
                        ->required()
                        ->label("Departement Name & Semester")
                        ->options(Departement::query()->get()->mapWithKeys(function ($departement) {
                            return [
                                $departement->id => $departement->name . ' - Semester ' . $departement->semester
                            ];
                        })->toArray())
                        ->reactive()
                        ->afterStateUpdated(function ($state, callable $set) {
                            if ($departement = Departement::find($state)) {
                                $set('departement_cost', $departement->cost);
                            } else {
                                $set('departement_cost', null);
                            }
                        }),

                    TextInput::make('departement_cost')
                        ->label('Cost')
                        ->readOnly(),
                ])

                        ]);
    }
}
