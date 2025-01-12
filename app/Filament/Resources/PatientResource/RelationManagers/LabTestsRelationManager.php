<?php

namespace App\Filament\Resources\PatientResource\RelationManagers;

use Filament\Forms;
use Filament\Forms\Form;
use Filament\Resources\RelationManagers\RelationManager;
use Filament\Tables;
use Filament\Tables\Table;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\SoftDeletingScope;

class LabTestsRelationManager extends RelationManager
{
    protected static string $relationship = 'labTests'; // Updated relationship to use hasManyThrough

    public function form(Form $form): Form
    {
        return $form
            ->schema([
                Forms\Components\Select::make('lab_test_type_id')
                    ->relationship('labTestType', 'name')
                    ->label('Тип теста') // Lab Test Type
                    ->required(),
                Forms\Components\Textarea::make('notes')
                    ->label('Заметки') // Notes
                    ->maxLength(1000),
            ]);
    }

    public function table(Table $table): Table
    {
        return $table
            ->recordTitleAttribute('result')
            ->columns([
                Tables\Columns\TextColumn::make('labTestType.name')
                ->label('Тип теста') // Lab Test Type
                ->sortable()
                ->searchable(),
            Tables\Columns\TextColumn::make('visit.visit_date')
                ->label('Дата визита') // Visit Date
                ->sortable()
                ->date(),
            Tables\Columns\TextColumn::make('notes')
                ->label('Заметки') // Notes
                ->limit(50),
            Tables\Columns\TextColumn::make('results.parameter_name')
                ->label('Параметры') // Parameters
                ->limit(50),
            Tables\Columns\TextColumn::make('results.result')
                ->label('Результат') // Result
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
