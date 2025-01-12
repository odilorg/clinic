<?php

namespace App\Filament\Resources\PatientResource\RelationManagers;

use Filament\Forms;
use Filament\Forms\Form;
use Filament\Resources\RelationManagers\RelationManager;
use Filament\Tables;
use Filament\Tables\Table;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\SoftDeletingScope;

class PrescriptionsRelationManager extends RelationManager
{
    protected static string $relationship = 'prescriptions';

    public function form(Form $form): Form
    {
        return $form
            ->schema([
                Forms\Components\Select::make('visit_id')
                ->relationship('visit', 'visit_date') // Relates the prescription to a specific visit
                ->required()
                ->label('Дата визита'), // Visit Date
            Forms\Components\TextInput::make('medication_name')
                ->required()
                ->label('Название лекарства') // Medication Name
                ->maxLength(255),
            Forms\Components\TextInput::make('dosage')
                ->required()
                ->label('Дозировка') // Dosage
                ->maxLength(255),
            Forms\Components\TextInput::make('frequency')
                ->required()
                ->label('Частота') // Frequency
                ->maxLength(255),
            Forms\Components\TextInput::make('duration')
                ->required()
                ->label('Длительность') // Duration
                ->maxLength(255),
            Forms\Components\Textarea::make('notes')
                ->label('Заметки') // Notes
                ->maxLength(1000),
            ]);
    }

    public function table(Table $table): Table
    {
        return $table
            ->recordTitleAttribute('medication_name')
            ->columns([
                Tables\Columns\TextColumn::make('visit.visit_date')
                    ->label('Дата визита') // Visit Date
                    ->date('M j, Y') // Format date as Jan 1, 2024
                    ->sortable(),
                Tables\Columns\TextColumn::make('medication_name')
                    ->label('Название лекарства') // Medication Name
                    ->searchable(),
                Tables\Columns\TextColumn::make('dosage')
                    ->label('Дозировка') // Dosage
                    ->searchable(),
                Tables\Columns\TextColumn::make('frequency')
                    ->label('Частота') // Frequency
                    ->searchable(),
                Tables\Columns\TextColumn::make('duration')
                    ->label('Длительность') // Duration
                    ->searchable(),
                Tables\Columns\TextColumn::make('notes')
                    ->label('Заметки') // Notes
                    ->limit(50), // Display only a portion of the notes
            ])
            ->filters([
                //
            ])
            ->headerActions([
                Tables\Actions\CreateAction::make(),
            ])
            ->actions([
                Tables\Actions\EditAction::make(),
                Tables\Actions\DeleteAction::make(),
            ])
            ->bulkActions([
                Tables\Actions\BulkActionGroup::make([
                    Tables\Actions\DeleteBulkAction::make(),
                ]),
            ]);
    }
}
