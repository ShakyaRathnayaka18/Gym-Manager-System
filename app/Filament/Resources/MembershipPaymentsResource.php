<?php

namespace App\Filament\Resources;

use App\Filament\Resources\MembershipPaymentsResource\Pages;
use App\Models\MembershipPayment;
use App\Models\Customers;
use Filament\Tables\Columns\TextColumn;
use App\Models\Plans;
use App\Models\AdditionalServices;
use Filament\Forms;
use Filament\Forms\Form;
use Filament\Resources\Resource;
use Filament\Tables;
use Filament\Tables\Table;
use Filament\Forms\Components\Select;
use Filament\Forms\Components\TextInput;
use Filament\Forms\Components\Toggle;
use Filament\Forms\Components\Radio;

class MembershipPaymentsResource extends Resource
{
    protected static ?string $model = MembershipPayment::class;

    protected static ?string $navigationIcon = 'icon-payment-member-icon';

    protected static ?string $navigationGroup = 'Manage Sales';

    public static function form(Form $form): Form
    {
        return $form
            ->schema([
                Select::make('full_name')
                    ->label('Full Name')
                    ->options(Customers::all()->pluck('Full Name', 'id'))
                    ->reactive()
                    ->afterStateUpdated(function (callable $set, $get, $state) {
                        $customer = Customers::find($state);
                        $plan = $customer->plan; // Access the plan from the Customer model
                        $additionalServices = $customer->other_services; // Access additional services from the Customer model

                        $set('plan_name', $plan ? $plan->name : ''); // Set plan name based on Customer's plan
                        $set('additional_services', $additionalServices); // Set additional services
                        $set('plan_amount', $plan ? $plan->amount : 0.00); // Set plan amount based on Customer's plan
                        $totalAmount = $get('plan_amount') + 0.00; // Initialize total amount

                        if ($get('new_member_fees')) {
                            $totalAmount += 500.00;
                        }

                        $set('total_amount', $totalAmount);
                    }),
                TextInput::make('plan_name')
                    ->label('Plan Name')
                    ->readOnly(),
                TextInput::make('additional_services')
                    ->label('Additional Services')
                    ->readOnly(),
                Toggle::make('new_member_fees')
                    ->label('New Member?')
                    ->reactive()
                    ->afterStateUpdated(function (callable $set, callable $get, $state) {
                        $planAmount = $get('plan_amount');
                        $additionalServiceAmount = 0.00; // Assuming no additional service cost by default
                        $totalAmount = $planAmount + $additionalServiceAmount;

                        if ($state) {
                            $totalAmount += 500.00;
                        }

                        $set('total_amount', $totalAmount);
                    }),
                TextInput::make('total_amount')
                    ->label('Total Amount')
                    ->readOnly(),
                TextInput::make('note')
                    ->label('Note'),
                Radio::make('payment_method')
                    ->options([
                        'cash' => 'Cash',
                        'bank_transfer' => 'Bank Transfer',
                        'other' => 'Other'
                    ]),
            ]);
    }


    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                TextColumn::make('full_name')->label('Customer Name'),
                TextColumn::make('plan_name')->label('Plan Name'),
                TextColumn::make('additional_services')->label('Additional Services'),
                TextColumn::make('total_amount')->label('Total Amount'),
                TextColumn::make('note')->label('Note'),
                TextColumn::make('payment_method')->label('Payment Method'),
                   
            ])
            ->filters([
                // Define your table filters here
            ])
            ->headerActions([
                //
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
            // Define your relations here
        ];
    }

    public static function getPages(): array
{
    return [
        'index' => Pages\ListMembershipPayments::route('/'),
        'create' => Pages\MakeMembershipPayments::route('/create'),
        'edit-contact' => Pages\EditCustomerContact::route('/{record}/edit/contact'),
    ];
}
}
