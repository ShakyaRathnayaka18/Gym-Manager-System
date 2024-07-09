<?php

namespace App\Filament\Resources;

use App\Filament\Resources\AdditionalExpensesResource\Pages;
use App\Filament\Resources\AdditionalExpensesResource\RelationManagers;
use App\Models\AdditionalExpenses;
use Filament\Forms;
use Filament\Forms\Form;
use Filament\Resources\Resource;
use Filament\Tables;
use Filament\Tables\Table;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\SoftDeletingScope;
use Filament\Forms\Components\Select;
use Filament\Forms\Components\TextInput;
use Filament\Forms\Components\Textarea;

class AdditionalExpensesResource extends Resource
{
    protected static ?string $model = AdditionalExpenses::class;

    protected static ?string $navigationGroup = 'Manage Sales';
    
    protected static ?string $navigationIcon = 'heroicon-o-rectangle-stack';

    public static function form(Form $form): Form
    {
        return $form
               ->schema([
    
            Select::make('type')
            ->label('Expense Type')
            ->options([
                 'Bill Payment' => 'Bill Payment',
                 'Tax' => 'Tax Payment',
                 'Other' => 'Other Expenses',
                ])
                ->reactive(),
    
                TextInput::make('number')->label('Bill/Tax Number'),
                TextInput::make('amount')->label('Amount'),
                Textarea::make('note')
                    ->label('Note')
                    ->required(fn ($get) => $get('type') === 'other')
                    ->helperText(fn ($get) => $get('type') === 'other' ? 'Note is required for Other Expenses' : ''),
            ]);
    }


    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                Tables\Columns\TextColumn::make('type')->label('Expense Type'),
                Tables\Columns\TextColumn::make('number')->label('Bill/Tax Number'),
                Tables\Columns\TextColumn::make('amount')->label('Amount'),
                Tables\Columns\TextColumn::make('note')->label('Note'),
                Tables\Columns\TextColumn::make('date')->label('date'),
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
            'index' => Pages\ListAdditionalExpenses::route('/'),
            'create' => Pages\CreateAdditionalExpenses::route('/create'),
            'edit' => Pages\EditAdditionalExpenses::route('/{record}/edit'),
        ];
    }
}
