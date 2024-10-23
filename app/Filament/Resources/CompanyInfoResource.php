<?php

namespace App\Filament\Resources;

use App\Filament\Resources\CompanyInfoResource\Pages;
use App\Filament\Resources\CompanyInfoResource\RelationManagers;
use App\Models\CompanyInfo;
use Filament\Forms;
use Filament\Forms\Form;
use Filament\Resources\Resource;
use Filament\Tables;
use Filament\Tables\Table;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\SoftDeletingScope;

class CompanyInfoResource extends Resource
{
    protected static ?string $model = CompanyInfo::class;

    protected static ?string $navigationIcon = 'heroicon-o-building-office';

    protected static ?string $navigationGroup = 'Company Info';

    protected static ?string $modelLabel = 'Settings';

    protected static ?int $navigationSort = 10;

    public static function form(Form $form): Form
    {
        return $form
            ->schema([
                Forms\Components\FileUpload::make('hero_image')
                    ->image()
                    ->required(),
                Forms\Components\TextInput::make('social_media')
                    ->required(),
                Forms\Components\TextInput::make('hq_address')
                    ->required()
                    ->maxLength(255),
                Forms\Components\TextInput::make('employees')
                    ->required(),
            ]);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                Tables\Columns\ImageColumn::make('hero_image'),
                Tables\Columns\TextColumn::make('hq_address')
                ->label('Headquarters Address'),
                Tables\Columns\TextColumn::make('employees')
                ->getStateUsing(function ($record) {
                    return count($record->employees) . ' Employees';
                }),
            ])
            ->filters([
                //
            ])
            ->actions([
                Tables\Actions\ViewAction::make(),
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
            'index' => Pages\ListCompanyInfos::route('/'),
            'create' => Pages\CreateCompanyInfo::route('/create'),
            'view' => Pages\ViewCompanyInfo::route('/{record}'),
            'edit' => Pages\EditCompanyInfo::route('/{record}/edit'),
        ];
    }
}
