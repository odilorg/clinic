<?php

namespace App\Filament\Resources\PatientResource\RelationManagers;

use Filament\Forms;
use Filament\Forms\Form;
use Filament\Resources\RelationManagers\RelationManager;
use Filament\Tables;
use Filament\Tables\Table;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\SoftDeletingScope;

class VisitsRelationManager extends RelationManager
{
    protected static string $relationship = 'visits';

    public function form(Form $form): Form
    {
        return $form
            ->schema([
                Forms\Components\Select::make('doctor_id')
                    ->relationship('doctor', 'name') // Assuming a relationship with the Doctor model
                    ->label('Доктор') // Doctor
                    ->default(null),

                Forms\Components\DatePicker::make('visit_date')
                    ->required()
                    ->label('Дата визита'), // Visit Date

                Forms\Components\TextInput::make('reason')
                    ->required()
                    ->maxLength(255)
                    ->label('Причина'), // Reason

                Forms\Components\Textarea::make('notes')
                    ->columnSpanFull()
                    ->label('Заметки'), // Notes

                Forms\Components\Repeater::make('diagnoses')
                    ->relationship() // Link to the hasMany relationship
                    ->label('Диагнозы') // Diagnoses
                    ->schema([
                        Forms\Components\TextInput::make('diagnosis_name')
                            ->required()
                            ->label('Название диагноза') // Diagnosis Name
                            ->maxLength(255),
                        Forms\Components\Textarea::make('description')
                            ->label('Описание') // Description
                            ->maxLength(1000),
                        Forms\Components\Textarea::make('notes')
                            ->label('Заметки') // Notes
                            ->maxLength(1000),
                    ])
                    ->collapsible() // Allow collapsing sections for a cleaner UI
                    ->columnSpanFull(),

                    Forms\Components\Repeater::make('lab_tests')
                    ->relationship('labTests') // Link to the hasMany relationship with Lab Tests
                    ->label('Лабораторные тесты') // Lab Tests
                    ->schema([
                        Forms\Components\Select::make('lab_test_type_id')
                            ->relationship('labTestType', 'name') // Relationship with Lab Test Type
                            ->required()
                            ->label('Тип теста'), // Test Type
                
                        Forms\Components\Textarea::make('notes')
                            ->label('Заметки') // Notes for the lab test
                            ->maxLength(1000),
                    ])
                    ->collapsible() // Allow collapsing sections for cleaner UI
                    ->columnSpanFull(),
                

            ]);
    }

    public function table(Table $table): Table
    {
        return $table
            ->recordTitleAttribute('diagnosis')
            ->columns([
                Tables\Columns\TextColumn::make('doctor.name')
                    ->label('Доктор') // Doctor
                    ->sortable()
                    ->searchable() // Assumes a relationship with the Doctor model
                    ->default('Не указан'), // Default to "Not Specified" in Russian
                Tables\Columns\TextColumn::make('visit_date')
                    ->label('Дата визита') // Visit Date
                    ->date()
                    ->sortable(),
                Tables\Columns\TextColumn::make('reason')
                    ->label('Причина') // Reason
                    ->searchable(),
                Tables\Columns\TextColumn::make('created_at')
                    ->label('Дата создания') // Created At
                    ->dateTime()
                    ->sortable()
                    ->toggleable(isToggledHiddenByDefault: true),
                Tables\Columns\TextColumn::make('updated_at')
                    ->label('Дата изменения') // Updated At
                    ->dateTime()
                    ->sortable()
                    ->toggleable(isToggledHiddenByDefault: true),
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
