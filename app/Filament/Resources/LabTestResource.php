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
            // Patient Selection
            Forms\Components\Select::make('patient_id')
                ->label('Пациент')
                ->relationship('patient', 'name') // Links to the Patient model, showing first name
                ->required()
                ->preload()
                ->searchable(), // Allows searching for patients if the list is large
    
            // Test Name
            Forms\Components\TextInput::make('test_name')
                ->label('Название теста')
                ->required()
                ->maxLength(255), // Ensures data consistency with max length
    
            // Results
            Forms\Components\Textarea::make('results')
                ->label('Результаты')
                ->columnSpanFull()
                ->maxLength(2000) // Optional: Prevent excessively large results
                ->nullable(), // Allows results to be added later if necessary
    
            // Test Date
            Forms\Components\DateTimePicker::make('test_date')
                ->label('Дата теста')
                ->required()
                ->default(now()), // Optional: Set default to the current date and time
        ]);
    
    }

    public static function table(Table $table): Table
    {
        return $table
        ->columns([
            // Patient Name Column
            Tables\Columns\TextColumn::make('patient.name')
                ->label('Имя пациента')
                ->searchable() // Allows searching by patient name
                ->sortable(),  // Enables sorting by patient name
    
            // Test Name Column
            Tables\Columns\TextColumn::make('test_name')
                ->label('Название теста')
                ->searchable(), // Allows searching by test name
    
            // Test Date Column
            Tables\Columns\TextColumn::make('test_date')
                ->label('Дата теста')
                ->dateTime('F j, Y, g:i A') // Formats date and time in a readable format
                ->sortable(),
    
            // Created At Column
            Tables\Columns\TextColumn::make('created_at')
                ->label('Created At')
                ->dateTime('F j, Y, g:i A')
                ->sortable()
                ->toggleable(isToggledHiddenByDefault: true), // Hidden by default but toggleable
    
            // Updated At Column
            Tables\Columns\TextColumn::make('updated_at')
                ->label('Updated At')
                ->dateTime('F j, Y, g:i A')
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
