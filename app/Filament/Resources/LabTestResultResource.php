<?php

namespace App\Filament\Resources;

use App\Filament\Resources\LabTestResultResource\Pages;
use App\Filament\Resources\LabTestResultResource\RelationManagers;
use App\Models\LabTestResult;
use Filament\Forms;
use Filament\Forms\Form;
use Filament\Resources\Resource;
use Filament\Tables;
use Filament\Tables\Table;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\SoftDeletingScope;

class LabTestResultResource extends Resource
{
    protected static ?string $model = LabTestResult::class;

    protected static ?string $navigationIcon = 'heroicon-o-rectangle-stack';

    public static function form(Form $form): Form
    {
        return $form
            ->schema([
                Forms\Components\Select::make('lab_test_id')
    ->options(function () {
        return \App\Models\LabTest::with(['labTestType', 'visit.patient'])
            ->get()
            ->mapWithKeys(function ($labTest) {
                $patientName = $labTest->visit->patient->name ?? 'Не указан';
                $labTestTypeName = $labTest->labTestType->name ?? 'Не указан';
                return [
                    $labTest->id => "{$patientName} - {$labTestTypeName} - Test ID: {$labTest->id}",
                ];
            });
    })
    ->searchable() // Enable search
    ->required()
    ->label('Лабораторный тест'), // Lab Test



                Forms\Components\TextInput::make('parameter_name')
                    ->required()
                    ->maxLength(255)
                    ->label('Название параметра'), // Parameter Name

                Forms\Components\TextInput::make('result')
                    ->required()
                    ->maxLength(255)
                    ->label('Результат'), // Result

                Forms\Components\TextInput::make('unit')
                    ->maxLength(255)
                    ->default(null)
                    ->label('Единица измерения'), // Unit

                Forms\Components\FileUpload::make('image_path')
                    ->image()
                    ->label('Изображение') // Image
                    ->directory('lab-test-results'),

            ]);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                Tables\Columns\TextColumn::make('labTest.labTestType.name')
                    ->label('Лабораторный тест') // Lab Test
                    ->sortable()
                    ->searchable(),

                Tables\Columns\TextColumn::make('parameter_name')
                    ->label('Название параметра') // Parameter Name
                    ->searchable(),

                Tables\Columns\TextColumn::make('result')
                    ->label('Результат') // Result
                    ->searchable(),

                Tables\Columns\TextColumn::make('unit')
                    ->label('Единица измерения') // Unit
                    ->searchable(),

                Tables\Columns\ImageColumn::make('image_path')
                    ->label('Изображение'), // Image

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
            'index' => Pages\ListLabTestResults::route('/'),
            'create' => Pages\CreateLabTestResult::route('/create'),
            'edit' => Pages\EditLabTestResult::route('/{record}/edit'),
        ];
    }
}
