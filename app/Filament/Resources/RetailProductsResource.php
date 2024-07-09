<?php

namespace App\Filament\Resources;

use App\Filament\Resources\RetailProductsResource\Pages;
use App\Filament\Resources\RetailProductsResource\RelationManagers;
use App\Models\RetailProducts;
use Filament\Forms;
use Filament\Forms\Form;
use Filament\Resources\Resource;
use Filament\Tables;
use Filament\Tables\Table;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\SoftDeletingScope;
use Filament\Forms\Components\Select;
 

class RetailProductsResource extends Resource
{
    protected static ?string $model = RetailProducts::class;

    protected static ?string $navigationIcon = 'icon-retail-icon';

    protected static ?string $navigationGroup = 'Manage Gym Operations';

    public static function form(Form $form): Form
    {
        return $form
            ->schema([
                Forms\Components\Select::make('type')
                ->label('Type')
               ->options([
               'supliments' => 'Suppliments',
               'accessories' => 'Accessories',
               'apperel' => 'apperal',
               'other' => 'Other',
               ]),
              Forms\Components\TextInput::make('name')->label('Name'),
              Forms\Components\Textarea::make('amount')->label('Amount'),
              Forms\Components\Textarea::make('note')->label('Note (ex:-size...'),

            ]);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                Tables\Columns\TextColumn::make('type')->label('Type')->sortable(),
                Tables\Columns\TextColumn::make('name')->label('Name'),
                Tables\Columns\TextColumn::make('amount')->label('Price')->sortable(),
                Tables\Columns\TextColumn::make('note')->label('Note'),
    
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
            'index' => Pages\ManageRetailProducts::route('/'),
        ];
    }
}
