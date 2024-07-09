<?php

namespace App\Filament\Resources;

use App\Filament\Resources\StaffResource\Pages;
use App\Filament\Resources\StaffResource\RelationManagers;
use App\Models\Staff;
use Filament\Forms;
use Filament\Forms\Form;
use Filament\Resources\Resource;
use Filament\Tables;
use Filament\Tables\Table;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\SoftDeletingScope;

class StaffResource extends Resource
{
    protected static ?string $model = Staff::class;

    protected static ?string $navigationIcon = 'icon-staff-icon';

    protected static ?string $navigationGroup = 'Manage Community';

    public static function form(Form $form): Form
    {
        return $form
            ->schema([
            
        Forms\Components\TextInput::make('full_name')->label('Full Name'),
            Forms\Components\TextInput::make('rfid_code')->label('RFID Code'),
            Forms\Components\TextInput::make('email')->label('Email'),
            Forms\Components\TextInput::make('designation')->label('Designation'),
            Forms\Components\TextInput::make('address')->label('Adress'),
            Forms\Components\Datepicker::make('date_of_registration')->label('Date of Register'),
            Forms\Components\Datepicker::make('last_paid')->label('Last Paid'),
            Forms\Components\TextInput::make('contact')->label('Contact'),
            Forms\Components\TextInput::make('notes')->label('Notes'),

            ]);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                Tables\Columns\TextColumn::make('full_name')->label('Full Name')->sortable(),
                Tables\Columns\TextColumn::make('rfid_code')->label('RFID Code')->sortable(),
                Tables\Columns\TextColumn::make('email')->label('Email')->sortable(),
                Tables\Columns\TextColumn::make('designation')->label('Designation')->sortable(),
                Tables\Columns\TextColumn::make('address')->label('Address')->sortable(),
                Tables\Columns\TextColumn::make('contact')->label('Contact')->sortable(),
                Tables\Columns\TextColumn::make('date_of_registration')->label('Date of Registration')->sortable(),
                Tables\Columns\TextColumn::make('last_paid')->label('Last Paid')->sortable(),
                Tables\Columns\TextColumn::make('notes')->label('Notes')->sortable(),
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
            'index' => Pages\ListStaff::route('/'),
            'create' => Pages\CreateStaff::route('/create'),
            'edit' => Pages\EditStaff::route('/{record}/edit'),
        ];
    }
}
