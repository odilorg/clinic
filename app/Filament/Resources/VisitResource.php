<?php

namespace App\Filament\Resources;

use App\Filament\Resources\VisitResource\Pages;
use App\Filament\Resources\VisitResource\RelationManagers;
use App\Models\Visit;
use Filament\Forms;
use Filament\Forms\Form;
use Filament\Resources\Resource;
use Filament\Tables;
use Filament\Tables\Table;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\SoftDeletingScope;

class VisitResource extends Resource
{
    protected static ?string $model = Visit::class;

    protected static ?string $navigationIcon = 'heroicon-o-rectangle-stack';

    public static function form(Form $form): Form
    {
        return $form
        ->schema([
            Forms\Components\Select::make('patient_id')
                ->relationship('patient', 'name') // Assuming a relationship with the Patient model
                ->required()
                ->label('Пациент'), // Patient
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
            Forms\Components\Textarea::make('diagnosis')
                ->columnSpanFull()
                ->label('Диагноз'), // Diagnosis
            Forms\Components\Textarea::make('notes')
                ->columnSpanFull()
                ->label('Заметки'), // Notes
        ]);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                

Tables\Columns\TextColumn::make('patient.name')
    ->label('Пациент') // Patient
    ->sortable()
    ->searchable(), // Assumes a relationship with the Patient model
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
            'index' => Pages\ListVisits::route('/'),
            'create' => Pages\CreateVisit::route('/create'),
            'edit' => Pages\EditVisit::route('/{record}/edit'),
        ];
    }
}
