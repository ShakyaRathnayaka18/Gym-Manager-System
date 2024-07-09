<?php

namespace App\Filament\Resources\CustomersResource\Pages;

use App\Filament\Resources\CustomersResource;
use Filament\Resources\Pages\Page;
use Filament\Forms\Contracts\HasForms;
use Filament\Forms\Form;
use App\Models\Customers;
use App\Models\Plans;
use App\Models\AdditionalServices;
use App\Models\MembershipPayment;
use Filament\Forms\Components\TextInput;
use Filament\Forms\Components\Toggle;
use Filament\Forms\Components\Radio;
use Filament\Pages\Actions\Action;

class MembershipPayments extends Page implements HasForms
{
    protected static string $resource = CustomersResource::class;

    protected static string $view = 'filament.resources.membership-payments-resource.pages.membership-payments';

    public $record;
    public $full_name;
    public $plan_name;
    public $additional_services;
    public $total_amount;
    public $new_member_fees = false;
    public $note;
    public $payment_method;

    public function mount($record): void
    {
        $this->record = Customers::findOrFail($record);

        $this->full_name = $this->record->full_name;
        $this->plan_name = $this->record->plan;
        $this->additional_services = $this->record->other_services;

        // Calculate the initial total amount
        $this->calculateTotalAmount();
    }

    public function form(Form $form): Form
    {
        return $form
            ->schema([
                TextInput::make('full_name')
                    ->label('Full Name')
                    ->default($this->full_name)
                    ->readOnly(),

                TextInput::make('plan_name')
                    ->label('Plan Name')
                    ->default($this->plan_name)
                    ->readOnly(),

                TextInput::make('additional_services')
                    ->label('Additional Services')
                    ->default($this->additional_services)
                    ->readOnly(),

                Toggle::make('new_member_fees')
                    ->label('New Member?')
                    ->reactive()
                    ->afterStateUpdated(function (callable $get, callable $set) {
                        $this->new_member_fees = $get('new_member_fees');
                        $this->calculateTotalAmount();
                        $set('total_amount', $this->total_amount);
                    }),

                TextInput::make('total_amount')
                    ->label('Total Amount')
                    ->default($this->total_amount)
                    ->readOnly(),

                TextInput::make('note')
                    ->label('Note')
                    ->default($this->note)
                    ->reactive(),

                Radio::make('payment_method')
                ->default($this->payment_method)
                    ->options([
                        'Cash' => 'Cash',
                        'Bank Transfer' => 'Bank Transfer',
                        'Other' => 'Other',
                    ]),
            ]);
    }

    public function calculateTotalAmount(): void
    {
        $planCost = Plans::where('name', $this->plan_name)->value('amount') ?? 0;
        $additionalServiceCost = AdditionalServices::where('name', $this->additional_services)->value('amount') ?? 0;
        $membershipFee = $this->new_member_fees ? 500 : 0;

        $this->total_amount = $planCost + $additionalServiceCost + $membershipFee;
    }

    protected function createMembershipPayment(array $data): void
    {
        MembershipPayment::create([
            'full_name' => $this->full_name,
            'plan_name' => $this->plan_name,
            'additional_services' => $this->additional_services,
            'total_amount' => $this->total_amount,
            'note' => $this->note,
            'payment_method' => $this->payment_method,
        ]);

        $this->redirect(CustomersResource::getUrl('index'));
    }

    protected function getActions(): array
    {
        return [
            Action::make('submit')
                ->label('Submit')
                ->color('primary')
                ->icon('heroicon-s-check')
                ->action(function (array $data) {
                    $this->createMembershipPayment($data);
                }),
        ];
    }
}
