<?php

namespace App\Filament\Resources;

use App\Filament\Resources\AdditionalServicesResource\Pages;
use App\Filament\Resources\AdditionalServicesResource\RelationManagers;
use App\Models\AdditionalServices;
use Filament\Forms;
use Filament\Forms\Form;
use Filament\Resources\Resource;
use Filament\Tables;
use Filament\Tables\Table;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\SoftDeletingScope;

class AdditionalServicesResource extends Resource
{
    protected static ?string $model = AdditionalServices::class;

    protected static ?string $navigationIcon = 'icon-service-icon';

    protected static ?string $navigationGroup = 'Manage Gym Operations';

   
    public static function form(Form $form): Form
    {
        return $form
            ->schema([
            Forms\Components\TextInput::make('name')->label('Service Name'),
            Forms\Components\TextInput::make('amount')->label('Service Amount'),
            Forms\Components\Textarea::make('description')->label('Description'),
            Forms\Components\Textarea::make('note')->label('Note'),
            ]);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                Tables\Columns\TextColumn::make('name')->label('Service Name')->sortable(),
                Tables\Columns\TextColumn::make('amount')->label('Service Amount')->sortable(),
                Tables\Columns\TextColumn::make('description')->label('Description')->sortable(),
            ])
            ->filters([
                //
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

    public static function getPages(): array
    {
        return [
            'index' => Pages\ManageAdditionalServices::route('/'),
        ];
    }
}
