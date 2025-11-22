<?php

namespace App\Filament\Resources\Transactions\Schemas;

use App\Models\Departement;
use App\Models\Transaction;
use Filament\Forms\Components\Fieldset;
use Filament\Forms\Components\Select;
use Filament\Forms\Components\TextInput;
use Filament\Schemas\Components\Section;
use Filament\Schemas\Schema;

class TransactionForm
{
    protected static ?string $model = Transaction::class;
    protected static ?string $navigationIcon = 'heroicon-o-rectangle-stack';
    public static function configure(Schema $schema): Schema
    {
        return $schema->components([
                // CODE
                TextInput::make('code')
                    ->required()
                    ->default(fn() => 'TRX-' . mt_rand(100000, 999999)),
                // USER ID 
                Select::make('user_id')
                    ->required()
                    ->label('User')
                    ->relationship('user', 'name'),
                // PAYMENT STATUS
                TextInput::make('payment_status')
                    ->readOnly()
                    ->default('PENDING'),
                // DEPARTEMENT  SELECT AND COST DISPLAY
                Section::make("Departement")
                    ->schema([
                        Select::make('departement_id')
                            ->required()
                            ->label("Departement Name & Semester")
                            ->options(
                                Departement::query()
                                ->get()
                                ->mapWithKeys(fn ($d) => [
                                    $d->id => "{$d->name} - Semester {$d->semester}"
                                ])
                            )
                            ->reactive()
                            ->afterStateUpdated(function ($state, callable $set) {
                                $departement = Departement::find($state);
                                $set('departement_cost', $departement?->cost);
                                }),
                        TextInput::make('departement_cost')
                            ->label('Cost')
                            ->readOnly(),
                    ])

                            ]);
        }
    }
