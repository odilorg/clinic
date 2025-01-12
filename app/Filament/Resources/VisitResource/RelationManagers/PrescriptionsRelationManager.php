<?php

namespace App\Filament\Resources\VisitResource\RelationManagers;

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
                Forms\Components\TextInput::make('medication_name')
                ->label('Название лекарства') // Medication Name
                ->required()
                ->maxLength(255),
            Forms\Components\TextInput::make('dosage')
                ->label('Дозировка') // Dosage
                ->required()
                ->maxLength(255),
            Forms\Components\TextInput::make('frequency')
                ->label('Частота') // Frequency
                ->required()
                ->maxLength(255),
            Forms\Components\TextInput::make('duration')
                ->label('Длительность') // Duration
                ->required()
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
                ->limit(50),
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
