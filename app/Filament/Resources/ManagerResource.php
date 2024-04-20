<?php

namespace App\Filament\Resources;

use App\Filament\Resources\ManagerResource\Pages;
use App\Filament\Resources\ManagerResource\RelationManagers;
use App\Models\Manager;
use Filament\Forms;
use Filament\Resources\Form;
use Filament\Resources\Resource;
use Filament\Resources\Table;
use Filament\Tables;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\SoftDeletingScope;

class ManagerResource extends Resource
{
    protected static ?string $model = Manager::class;

    protected static ?string $navigationIcon = 'heroicon-o-collection';

    public static function form(Form $form): Form
    {
        return $form
        ->schema([ // 表示/編集するカラムを記述
            Forms\Components\TextInput::make('name')
                ->required()
                ->maxLength(255),
            Forms\Components\TextInput::make('email')
                ->email()
                ->required()
                ->maxLength(255)
                ->unique(),
            Forms\Components\TextInput::make('password')
                ->password()
                ->required()
                ->maxLength(255),
                Forms\Components\TextInput::make('restaurant_id')
                ->required()
                ->numeric(),
                
        ]);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                //
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
            //
        ];
    }
    
    public static function getPages(): array
    {
        return [
            'index' => Pages\ListManagers::route('/'),
            'create' => Pages\CreateManager::route('/create'),
            'edit' => Pages\EditManager::route('/{record}/edit'),
        ];
    }    
}
