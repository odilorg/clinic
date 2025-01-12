<?php

namespace App\Filament\Resources;

use App\Filament\Resources\PatientResource\Pages;
use App\Filament\Resources\PatientResource\RelationManagers;
use App\Models\Patient;
use Filament\Forms;
use Filament\Forms\Form;
use Filament\Resources\Resource;
use Filament\Tables;
use Filament\Tables\Table;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\SoftDeletingScope;

class PatientResource extends Resource
{
    protected static ?string $model = Patient::class;

    protected static ?string $navigationIcon = 'heroicon-o-rectangle-stack';

    public static function form(Form $form): Form
    {
        return $form
    ->schema([
        // User ID: Replace with a relationship select to link a patient to an existing user
        // Forms\Components\Select::make('user_id')
        //     ->relationship('user', 'name') // Links to the User model and shows the name field
        //     ->required()
        //     ->searchable()
        //     ->preload(), // Allows searching for users if the list is large
        
        // First Name
        Forms\Components\TextInput::make('name')
            ->label('ФИО пациента')
            ->required()
            ->maxLength(255), // Add a max length for data consistency
        
        // Date of Birth
        Forms\Components\DatePicker::make('dob')
            ->label('Дата рождения')
            ->required(), // DOB is usually required
        
        // Gender: Replace with a select field for consistent values
        Forms\Components\Select::make('gender')
            ->label('Пол')
            ->options([
                'male' => 'Male',
                'female' => 'Female',
               
            ])
            ->required()
            ->label('Gender'),
        
        // Address
        Forms\Components\Textarea::make('address')
            ->label('Address')
           //->columnSpanFull()
            ->maxLength(500), // Add max length to prevent excessively long entries
        
        // Phone: Validate for phone numbers
        Forms\Components\TextInput::make('phone')
            ->label('Телефон')
            ->tel()
            ->nullable()
            ->maxLength(15), // Limit phone number length
        
        // Email: Ensure valid email format
        Forms\Components\TextInput::make('email')
            ->label('Email')
            ->email()
            ->nullable()
            ->maxLength(255),
    ]);

    }

    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                // Tables\Columns\TextColumn::make('user_id')
                //     ->numeric()
                //     ->sortable(),
                Tables\Columns\TextColumn::make('name')
                    ->label('ФИО пациента')
                    ->searchable(),
                Tables\Columns\TextColumn::make('dob')
                ->label('Дата рождения')
                    ->date()
                    ->sortable(),
                Tables\Columns\TextColumn::make('gender')
                    ->label('Пол')
                    ->searchable(),
                Tables\Columns\TextColumn::make('phone')
                    ->label('Телефон')
                    ->searchable(),
                Tables\Columns\TextColumn::make('email')
                    ->label('Email')
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
            'index' => Pages\ListPatients::route('/'),
            'create' => Pages\CreatePatient::route('/create'),
            'edit' => Pages\EditPatient::route('/{record}/edit'),
        ];
    }
}
