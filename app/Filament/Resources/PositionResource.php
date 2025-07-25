<?php

namespace App\Filament\Resources;

use App\Enums\CurrencyCodeEnum;
use App\Enums\EmploymentTypeEnum;
use App\Enums\PositionStatusEnum;
use App\Enums\SalaryTypeEnum;
use App\Enums\ScheduleEnum;
use App\Enums\SeniorityEnum;
use App\Filament\Resources\PositionResource\Pages;
use App\Filament\Resources\PositionResource\RelationManagers;
use App\Models\Position;
use Filament\Forms;
use Filament\Forms\Form;
use Filament\Resources\Resource;
use Filament\Tables;
use Filament\Tables\Table;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\SoftDeletingScope;
use Filament\Forms\Components\Select;
use Filament\Support\RawJs;
use Filament\Tables\Filters\SelectFilter;
use Illuminate\Support\Facades\Auth;

class PositionResource extends Resource
{
    protected static ?string $model = Position::class;

    protected static ?string $navigationIcon = 'heroicon-o-bookmark';

    public static function form(Form $form): Form
    {
        return $form
            ->schema([
                Forms\Components\Fieldset::make('Primary')
                ->schema([
                    Forms\Components\TextInput::make('title')->required(),
                    Forms\Components\TextInput::make('company')->required(),
                    Forms\Components\TextInput::make('office')->required(),
                    Forms\Components\TextInput::make('keywords')->label("Job Keywords ")->hint('seperated with commas'),
                ]),
                Forms\Components\Fieldset::make('Employment')
                ->schema([
                    Forms\Components\Select::make('employment_type')->options(EmploymentTypeEnum::associativeValues())->label("Type")->required(),
                    Forms\Components\Select::make('schedule')->options(ScheduleEnum::associativeValues())->required()->label("Work Schedule"),
                    Forms\Components\Checkbox::make('is_remote'),
                ]),
                Forms\Components\Fieldset::make('Seniority')
                ->schema([
                    Forms\Components\Select::make('seniority')->options(SeniorityEnum::associativeValues())->label('Level')->required(),
                    Forms\Components\TextInput::make('years_of_experience'),
                ]),
                
                Forms\Components\Fieldset::make('Salary')
                ->schema([
                    Forms\Components\TextInput::make('salary_min')->numeric()->label("Min"),
                    Forms\Components\TextInput::make('salary_max')->numeric()->label("Max"),
                    Forms\Components\Select::make('salary_currency_code')->options(CurrencyCodeEnum::associativeValues())->label("Currency"),
                    Forms\Components\Select::make('salary_type')->options(SalaryTypeEnum::associativeValues())->label("Payment Interval"),
                ]),
                Select::make('status')
                            ->options(PositionStatusEnum::associativeValues())
                            ->visible(Auth::user()->is_moderator)->required(),
                Forms\Components\RichEditor::make('description')->columnSpanFull()->required(),
            ]);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                Tables\Columns\TextColumn::make('status')->formatStateUsing(fn ($state) => $state->label()),
                Tables\Columns\TextColumn::make('title'),
                Tables\Columns\TextColumn::make('company'),
                Tables\Columns\TextColumn::make('employment_type')->formatStateUsing(fn ($state) => $state->label()),
            ])
            ->filters([
                SelectFilter::make('status')
                    ->options(PositionStatusEnum::associativeValues()),
                SelectFilter::make('employment_type')
                    ->options(PositionStatusEnum::associativeValues())
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
            'index' => Pages\ManagePositions::route('/'),
        ];
    }
}
