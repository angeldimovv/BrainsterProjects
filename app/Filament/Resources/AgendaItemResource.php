<?php

namespace App\Filament\Resources;

use App\Filament\Resources\AgendaItemResource\Pages;
use App\Filament\Resources\AgendaItemResource\RelationManagers;
use App\Models\AgendaItem;
use Carbon\Carbon;
use Filament\Forms;
use Filament\Forms\Form;
use Filament\Resources\Resource;
use Filament\Tables;
use Filament\Tables\Table;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\SoftDeletingScope;

class AgendaItemResource extends Resource
{
    protected static ?string $model = AgendaItem::class;

    protected static ?string $navigationIcon = 'heroicon-o-list-bullet';

    protected static ?string $navigationGroup = 'Event Management';

    protected static ?int $navigationSort = 8;

    protected static bool $shouldRegisterNavigation = false;


    public static function form(Form $form): Form
    {
        return $form
            ->schema([
                Forms\Components\Select::make('agenda_id')
                    ->relationship('agenda', 'title')
                    ->required(),
                Forms\Components\DatePicker::make('agenda_date_id')
                    ->label('Agenda Date')
                    ->required(),
                Forms\Components\TimePicker::make('time')
                    ->required(),
                Forms\Components\TextInput::make('title')
                    ->required()
                    ->maxLength(255),
                Forms\Components\Textarea::make('description')
                    ->required()
                    ->columnSpanFull(),
            ]);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                Tables\Columns\TextColumn::make('agenda.title')
                    ->numeric()
                    ->sortable(),
                Tables\Columns\TextColumn::make('agenda_date_id')
                    ->numeric()
                    ->sortable(),
                Tables\Columns\TextColumn::make('time'),
                Tables\Columns\TextColumn::make('title')
                    ->searchable(),
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
//            'index' => Pages\ListAgendaItems::route('/'),
//            'create' => Pages\CreateAgendaItem::route('/create'),
//            'view' => Pages\ViewAgendaItem::route('/{record}'),
//            'edit' => Pages\EditAgendaItem::route('/{record}/edit'),
        ];
    }
}
