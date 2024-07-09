<?php

namespace App\Filament\Resources;

use App\Filament\Resources\CustomersResource\Pages;
use App\Models\Customers;
use App\Models\AdditionalServices;
use Filament\Tables\Actions\Action;
use Filament\Forms;
use Filament\Forms\Form;
use Filament\Forms\Components\Radio;
use Filament\Resources\Resource;
use Filament\Tables;
use Filament\Tables\Table;
use App\Models\Plans;
use Filament\Forms\Components\Select;

class CustomersResource extends Resource
{
    protected static ?string $model = Customers::class;

    protected static ?string $navigationIcon = 'icon-male-icon';

    protected static ?string $navigationGroup = 'Manage Community';

    public static function form(Form $form): Form
    {
        return $form
            ->schema([
                Forms\Components\TextInput::make('full_name')->label('Full Name'),
                Forms\Components\TextInput::make('registration_number')->label('Registration Number'),
                Forms\Components\TextInput::make('rfid_code')->label('RFID Code'),
                Forms\Components\TextInput::make('email')->label('Email'),
                Forms\Components\DatePicker::make('date_of_birth')->label('Date of Birth'),
                Forms\Components\TextInput::make('contact')->label('Contact'),
                Forms\Components\TextInput::make('gender')->label('Gender'),
                Select::make('plan')->label('Plan')->options(Plans::all()->pluck('name', 'id'))->required(),
                Select::make('other_services')->label('Additional Services')->options(AdditionalServices::all()->pluck('name', 'id')),
                Forms\Components\TextInput::make('height')->label('Height'),
                Radio::make('status')
                    ->options([
                        'active' => 'Active',
                        'inactive' => 'In-Active',
                        'removed' => 'Removed',
                    ]),
            ]);
    }

    public static function table(Table $table): Table
    {
        return $table

            ->columns([
                Tables\Columns\TextColumn::make('id'),
                Tables\Columns\TextColumn::make('full_name')->searchable(),
                Tables\Columns\TextColumn::make('registration_number'),
                Tables\Columns\TextColumn::make('rfid_code'),
                Tables\Columns\TextColumn::make('email'),
                Tables\Columns\TextColumn::make('date_of_birth'),
                Tables\Columns\TextColumn::make('date_of_register')->sortable(),
                Tables\Columns\TextColumn::make('contact'),
                Tables\Columns\TextColumn::make('gender'),
                Tables\Columns\TextColumn::make('plan')->label('Plan')->searchable(),
                Tables\Columns\TextColumn::make('other_services')->searchable(),
                Tables\Columns\TextColumn::make('height'),
                Tables\Columns\TextColumn::make('status'),
            ])
            ->filters([
                // Add your filters here
            ])
            ->actions([
                Tables\Actions\EditAction::make(),
                Action::make('Make Payment')
                    ->color('success')
                    ->icon('heroicon-m-banknotes')
                    ->url(
                        fn (Customers $record): string => Pages\MembershipPayments::getUrl(['record' => $record])
                         ),
            ]);
    }

    public static function getRelations(): array
    {
        return [
            // Add your relations here
        ];
    }

    public static function getPages(): array
{
    return [
        'index' => Pages\ListCustomers::route('/'),
        'make-payment' => Pages\MembershipPayments::route('/{record}/make-payment'), // Pass record parameter
    ];
}
}