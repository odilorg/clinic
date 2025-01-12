<?php

namespace App\Filament\Resources;

use App\Filament\Resources\InvoiceResource\Pages;
use App\Filament\Resources\InvoiceResource\RelationManagers;
use App\Models\Invoice;
use Filament\Forms;
use Filament\Forms\Form;
use Filament\Resources\Resource;
use Filament\Tables;
use Filament\Tables\Table;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\SoftDeletingScope;

class InvoiceResource extends Resource
{
    protected static ?string $model = Invoice::class;

    protected static ?string $navigationIcon = 'heroicon-o-rectangle-stack';

    public static function form(Form $form): Form
    {
        return $form
            ->schema([
                // Patient Selection
                Forms\Components\Select::make('patient_id')
                    ->label('Patient')
                    ->relationship('patient', 'name') // Links to the Patient model, showing first name
                    ->required()
                    ->preload()
                    ->searchable(), // Allows searching for patients if the list is large

                // Payment Amount
                Forms\Components\TextInput::make('amount')
                    ->label('Amount')
                    ->required()
                    ->numeric()
                    ->prefix('$') // Adds a currency prefix
                    ->placeholder('Enter payment amount'),

                // Payment Status
                Forms\Components\Select::make('status')
                    ->label('Payment Status')
                    ->options([
                        'pending' => 'Pending',
                        'paid' => 'Paid',
                        'failed' => 'Failed',
                    ])
                    ->required()
                    ->default('pending'), // Sets a default value

                // Payment Date
                Forms\Components\DateTimePicker::make('payment_date')
                    ->label('Payment Date')
                    ->default(now()) // Optional: Prefills with the current date and time
                    ->required(),
            ]);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                // Patient Name Column
                Tables\Columns\TextColumn::make('patient.name')
                    ->label('Patient Name')
                    ->searchable() // Allows searching by patient name
                    ->sortable(),  // Enables sorting by patient name

                // Payment Amount Column
                Tables\Columns\TextColumn::make('amount')
                    ->label('Amount')
                    ->formatStateUsing(fn($state) => '$' . number_format($state, 2)) // Formats as currency
                    ->sortable(), // Enables sorting by amount

                // Payment Status Column
                Tables\Columns\TextColumn::make('status')
                    ->label('Payment Status')
                    ->formatStateUsing(fn($state) => match ($state->value) { // Use `value` to get string from enum
                        'pending' => 'Pending',
                        'paid' => 'Paid',
                        'failed' => 'Failed',
                        default => ucfirst($state->value), // Capitalize the string value
                    })
                    ->badge(),

                // Payment Date Column
                Tables\Columns\TextColumn::make('payment_date')
                    ->label('Payment Date')
                    ->dateTime('F j, Y, g:i A') // Formats as readable date and time
                    ->sortable(), // Enables sorting by payment date

                // Created At Column
                Tables\Columns\TextColumn::make('created_at')
                    ->label('Created At')
                    ->dateTime('F j, Y, g:i A') // Formats as readable date and time
                    ->sortable()
                    ->toggleable(isToggledHiddenByDefault: true), // Hidden by default but toggleable

                // Updated At Column
                Tables\Columns\TextColumn::make('updated_at')
                    ->label('Updated At')
                    ->dateTime('F j, Y, g:i A') // Formats as readable date and time
                    ->sortable()
                    ->toggleable(isToggledHiddenByDefault: true),
            ])
            ->filters([
                //
            ])
            ->actions([
                Tables\Actions\EditAction::make(),
            ])
            ->bulkActions([
                Tables\Actions\BulkActionGroup::make([
                    Tables\Actions\DeleteBulkAction::make(),
                ]),
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
            'index' => Pages\ListInvoices::route('/'),
            'create' => Pages\CreateInvoice::route('/create'),
            'edit' => Pages\EditInvoice::route('/{record}/edit'),
        ];
    }
}
