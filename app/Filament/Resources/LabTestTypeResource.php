<?php

namespace App\Filament\Resources;

use App\Filament\Resources\LabTestTypeResource\Pages;
use App\Filament\Resources\LabTestTypeResource\RelationManagers;
use App\Models\LabTestType;
use Filament\Forms;
use Filament\Forms\Form;
use Filament\Resources\Resource;
use Filament\Tables;
use Filament\Tables\Table;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\SoftDeletingScope;

class LabTestTypeResource extends Resource
{
    protected static ?string $model = LabTestType::class;

    protected static ?string $navigationIcon = 'heroicon-o-rectangle-stack';

    public static function form(Form $form): Form
    {
        return $form
            ->schema([
                Forms\Components\TextInput::make('name')
                ->required()
                ->maxLength(255)
                ->label('Название теста'), // Test Name
            
            Forms\Components\Repeater::make('parameters')
                ->label('Параметры') // Parameters
                ->schema([
                    Forms\Components\TextInput::make('parameter_name')
                        ->required()
                        ->label('Название параметра') // Parameter Name
                        ->maxLength(255),
                    Forms\Components\TextInput::make('default_value')
                        ->label('Значение по умолчанию') // Default Value
                        ->maxLength(255),
                    Forms\Components\TextInput::make('unit')
                        ->label('Единица измерения') // Unit
                        ->maxLength(50),
                ])
                ->required()
                ->columnSpanFull()
               // ->createItemButtonLabel('Добавить параметр') // Add Parameter Button Label
                ->default([]), // Default to an empty array
            
            ]);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                Tables\Columns\TextColumn::make('name')
                    ->searchable(),
                Tables\Columns\TextColumn::make('created_at')
                    ->dateTime()
                    ->sortable()
                    ->toggleable(isToggledHiddenByDefault: true),
                Tables\Columns\TextColumn::make('updated_at')
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
            'index' => Pages\ListLabTestTypes::route('/'),
            'create' => Pages\CreateLabTestType::route('/create'),
            'edit' => Pages\EditLabTestType::route('/{record}/edit'),
        ];
    }
}
