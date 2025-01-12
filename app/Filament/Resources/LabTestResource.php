<?php

namespace App\Filament\Resources;

use App\Filament\Resources\LabTestResource\Pages;
use App\Filament\Resources\LabTestResource\RelationManagers;
use App\Models\LabTest;
use Filament\Forms;
use Filament\Forms\Form;
use Filament\Resources\Resource;
use Filament\Tables;
use Filament\Tables\Table;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\SoftDeletingScope;

class LabTestResource extends Resource
{
    protected static ?string $model = LabTest::class;

    protected static ?string $navigationIcon = 'heroicon-o-rectangle-stack';

    public static function form(Form $form): Form
    {
        return $form
            ->schema([
                Forms\Components\Select::make('visit_id')
                ->options(function () {
                    return \App\Models\Visit::with('patient') // Eager load the patient relationship
                        ->get()
                        ->mapWithKeys(function ($visit) {
                            return [
                                $visit->id => "{$visit->patient->name} - {$visit->visit_date}", // Combine patient name and visit date
                            ];
                        });
                })
                ->required()
                ->label('Дата визита'), // Visit Date
            


Forms\Components\Select::make('lab_test_type_id')
    ->relationship('labTestType', 'name') // Link to LabTestType
    ->required()
    ->label('Тип лабораторного теста'), // Lab Test Type

Forms\Components\Textarea::make('notes')
    ->columnSpanFull()
    ->label('Заметки'), // Notes

            
            ]);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                Tables\Columns\TextColumn::make('visit.visit_date')
    ->label('Дата визита') // Visit Date
    ->sortable()
    ->searchable(),

Tables\Columns\TextColumn::make('labTestType.name')
    ->label('Тип лабораторного теста') // Lab Test Type
    ->sortable()
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
            'index' => Pages\ListLabTests::route('/'),
            'create' => Pages\CreateLabTest::route('/create'),
            'edit' => Pages\EditLabTest::route('/{record}/edit'),
        ];
    }
}
