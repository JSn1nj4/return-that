<?php

namespace App\Filament\Resources;

use App\Filament\Resources\HouseholdResource\Pages;
use App\Filament\Resources\HouseholdResource\RelationManagers\ItemsRelationManager;
use App\Filament\Resources\HouseholdResource\RelationManagers\UsersRelationManager;
use App\Models\Household;
use Filament\Forms\Components\TextInput;
use Filament\Resources\Form;
use Filament\Resources\Resource;
use Filament\Resources\Table;
use Filament\Tables;

class HouseholdResource extends Resource
{
    protected static string|null $model = Household::class;

    protected static string|null $navigationIcon = 'heroicon-s-home';

    public static function form(Form $form): Form
    {
        return $form
            ->schema([
                TextInput::make('name'),
            ]);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                Tables\Columns\TextColumn::make('nickname'),
                Tables\Columns\TextColumn::make('users_count')
                    ->counts('users')
                    ->label('Members'),
            ])
            ->filters([
                //
            ])
            ->actions([
                Tables\Actions\EditAction::make(),
            ])
            ->bulkActions([
                Tables\Actions\DeleteBulkAction::make(),
            ]);
    }

    public static function getRelations(): array
    {
        return [
            UsersRelationManager::class,
        ];
    }

    public static function getPages(): array
    {
        return [
            'index' => Pages\ListHouseholds::route('/'),
            'create' => Pages\CreateHousehold::route('/create'),
            'edit' => Pages\EditHousehold::route('/{record}/edit'),
        ];
    }
}
