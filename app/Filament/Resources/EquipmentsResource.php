<?php

namespace App\Filament\Resources;

use App\Filament\Resources\EquipmentsResource\Pages;
use Filament\Forms\Components\DatePicker;
use Filament\Forms\Components\Number;
use Filament\Forms\Components\Select;
use Filament\Forms\Components\Textarea;
use Filament\Forms\Components\TextInput;
use Filament\Tables\Columns\TextColumn;
use App\Filament\Resources\EquipmentsResource\RelationManagers;
use App\Models\Equipments;
use Filament\Forms;
use Filament\Forms\Form;
use Filament\Resources\Resource;
use Filament\Tables;
use Filament\Tables\Table;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\SoftDeletingScope;

class EquipmentsResource extends Resource
{
    protected static ?string $model = Equipments::class;

    protected static ?string $navigationIcon = 'icon-treadmill-icon';

    protected static ?string $navigationGroup = 'Manage Gym Operations';


    public static function form(Form $form): Form
    {
        return $form
        ->schema([
            TextInput::make('equipment_type')->label('Equipment Type'),
            Textarea::make('description')->label('Description'),
            TextInput::make('vendor')->label('Vendor'),
            TextInput::make('quantity')->label('Quantity'),
            textInput::make('amount')->label('Amount'),
            DatePicker::make('purchased_date')->label('Purchased Date'),
            TextInput::make('telephone_number')->label('Telephone Number')->nullable(),
        ]);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                TextColumn::make('equipment_type')->label('Equipment Type'),
                TextColumn::make('description')->label('Description'),
                TextColumn::make('vendor')->label('Vendor'),
                TextColumn::make('quantity')->label('Quantity'),
                TextColumn::make('amount')->label('Amount'),
                TextColumn::make('purchased_date')->label('Purchased Date'),
                TextColumn::make('telephone_number')->label('Telephone Number'),
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
            'index' => Pages\ListEquipments::route('/'),
            'create' => Pages\CreateEquipments::route('/create'),
            'edit' => Pages\EditEquipments::route('/{record}/edit'),
        ];
    }
}
