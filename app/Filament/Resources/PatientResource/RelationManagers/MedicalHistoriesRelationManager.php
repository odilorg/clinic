<?php

namespace App\Filament\Resources\PatientResource\RelationManagers;

use Filament\Forms;
use Filament\Forms\Form;
use Filament\Resources\RelationManagers\RelationManager;
use Filament\Tables;
use Filament\Tables\Table;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\SoftDeletingScope;

class MedicalHistoriesRelationManager extends RelationManager
{
    protected static string $relationship = 'medicalHistories';

    public function form(Form $form): Form
    {
        return $form
            ->schema([
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
                ->label('Название') // Name
                ->maxLength(255),
            Forms\Components\DatePicker::make('date')
                ->label('Дата'), // Date
            Forms\Components\TextInput::make('doctor_name')
                ->label('Имя доктора') // Doctor Name
                ->maxLength(255),
            Forms\Components\TextInput::make('hospital_name')
                ->label('Название больницы') // Hospital Name
                ->maxLength(255),
            Forms\Components\Textarea::make('notes')
                ->label('Дополнительные заметки'), // Notes
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

    public function table(Table $table): Table
    {
        return $table
            ->recordTitleAttribute('name')
            ->columns([
                Tables\Columns\TextColumn::make('date')
                ->label('Дата') // Date
                ->date()
                ->sortable(),
            
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
                ->toggleable(isToggledHiddenByDefault: true),            ])
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
