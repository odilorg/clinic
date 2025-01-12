<?php

namespace App\Filament\Resources;

use App\Filament\Resources\MedicalHistoryResource\Pages;
use App\Filament\Resources\MedicalHistoryResource\RelationManagers;
use App\Models\MedicalHistory;
use Filament\Forms;
use Filament\Forms\Form;
use Filament\Resources\Resource;
use Filament\Tables;
use Filament\Tables\Table;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\SoftDeletingScope;

class MedicalHistoryResource extends Resource
{
    protected static ?string $model = MedicalHistory::class;

    protected static ?string $navigationIcon = 'heroicon-o-rectangle-stack';

    public static function form(Form $form): Form
    {
        return $form
            ->schema([
                Forms\Components\Select::make('patient_id')
    ->relationship('patient', 'name') // Relationship with Patient model
    ->required()
    ->label('Пациент'), // Patient
Forms\Components\Select::make('type')
    ->options([
        'illness' => 'Болезнь',  // Illness
        'surgery' => 'Операция', // Surgery
        'allergy' => 'Аллергия', // Allergy
    ])
    ->required()
    ->label('Тип'), // Type
Forms\Components\TextInput::make('name')
    ->required()
    ->maxLength(255)
    ->label('Название болезни/операции/аллергии'), // Illness/Surgery/Allergy Name
Forms\Components\DatePicker::make('date')
    ->label('Дата'), // Date
Forms\Components\TextInput::make('doctor_name')
    ->maxLength(255)
    ->default(null)
    ->label('Имя доктора'), // Doctor Name
Forms\Components\TextInput::make('hospital_name')
    ->maxLength(255)
    ->default(null)
    ->label('Название больницы'), // Hospital Name
Forms\Components\Textarea::make('notes')
    ->columnSpanFull()
    ->label('Дополнительные заметки'), // Additional Notes
Forms\Components\TextInput::make('medications')
    ->maxLength(255)
    ->default(null)
    ->label('Лекарства'), // Medications
Forms\Components\Select::make('status')
    ->options([
        'active' => 'Активный',  // Active
        'resolved' => 'Решено',  // Resolved
    ])
    ->required()
    ->label('Статус'), // Status
Forms\Components\Select::make('severity')
    ->options([
        'mild' => 'Легкая',      // Mild
        'moderate' => 'Средняя', // Moderate
        'severe' => 'Тяжелая',   // Severe
    ])
    ->label('Серьезность'), // Severity

            
            ]);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->columns([
               
                Tables\Columns\TextColumn::make('patient.name')
                    ->label('Имя пациента') // Patient Name
                    ->sortable()
                    ->searchable(),
                
                Tables\Columns\TextColumn::make('type')
                    ->label('Тип') // Type
                    ->badge() // Display as a badge
                    ->color(fn (string $state): string => match ($state) {
                        'illness' => 'primary',   // Blue for illness
                        'surgery' => 'info',      // Light blue for surgery
                        'allergy' => 'warning',   // Yellow for allergy
                        default => 'gray',        // Fallback color
                    })
                    ->sortable(),
                
                Tables\Columns\TextColumn::make('name')
                    ->label('Название болезни/операции/аллергии') // Illness/Surgery/Allergy Name
                    ->searchable(),
                
                Tables\Columns\TextColumn::make('date')
                    ->label('Дата') // Date
                    ->date()
                    ->sortable(),
                
                Tables\Columns\TextColumn::make('doctor_name')
                    ->label('Имя доктора') // Doctor Name
                    ->searchable(),
                
                Tables\Columns\TextColumn::make('hospital_name')
                    ->label('Название больницы') // Hospital Name
                    ->searchable(),
                
                Tables\Columns\TextColumn::make('medications')
                    ->label('Лекарства') // Medications
                    ->searchable(),
                
                Tables\Columns\TextColumn::make('status')
                    ->label('Статус') // Status
                    ->badge() // Display as a badge
                    ->color(fn (string $state): string => match ($state) {
                        'active' => 'success',     // Green for active
                        'resolved' => 'secondary', // Gray for resolved
                        default => 'gray',         // Fallback color
                    })
                    ->sortable(),
                
                Tables\Columns\TextColumn::make('severity')
                    ->label('Серьезность') // Severity
                    ->badge() // Display as a badge
                    ->color(fn (string $state): string => match ($state) {
                        'mild' => 'success',       // Green for mild
                        'moderate' => 'warning',   // Yellow for moderate
                        'severe' => 'danger',      // Red for severe
                        default => 'gray',         // Fallback color
                    }),
                
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
            'index' => Pages\ListMedicalHistories::route('/'),
            'create' => Pages\CreateMedicalHistory::route('/create'),
            'edit' => Pages\EditMedicalHistory::route('/{record}/edit'),
        ];
    }
}
