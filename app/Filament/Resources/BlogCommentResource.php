<?php

namespace App\Filament\Resources;

use App\Filament\Resources\BlogCommentResource\Pages;
use App\Filament\Resources\BlogCommentResource\RelationManagers;
use App\Models\BlogComment;
use Faker\Provider\Text;
use Filament\Forms;
use Filament\Forms\Form;
use Filament\Resources\Resource;
use Filament\Tables;
use Filament\Tables\Table;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\SoftDeletingScope;

class BlogCommentResource extends Resource
{
    protected static ?string $model = BlogComment::class;

    protected static ?string $navigationIcon = 'heroicon-o-chat-bubble-left-right';

    protected static ?string $modelLabel = 'Comment';

    protected static ?string $navigationGroup = 'Blog Management';

    protected static ?int $navigationSort = 4;


    public static function form(Form $form): Form
    {
        return $form
            ->schema([
                Forms\Components\Select::make('blog_id')
                    ->relationship('blog', 'title')
                    ->required(),
                Forms\Components\TextInput::make('likes')
                    ->label('Number of Likes')
                    ->formatStateUsing(
                        fn ($record) => $record->likes()->count()
                    )
                    ->disabled(),
                Forms\Components\TextInput::make('user_id')
                    ->label('Commented By')
                    ->formatStateUsing(function ($record) {
                        return $record->user->getFilamentName();
                    })
                    ->disabled(),
                Forms\Components\TextInput::make('replied_to')
                    ->label('Replied To')
                    ->formatStateUsing(function ($record) {
                        $repliedTo = $record->repliedTo()->first();
                        return $repliedTo ? $repliedTo->user->getFilamentName() : 'N/A';
                    })
                    ->disabled(),
                Forms\Components\Textarea::make('content')
                    ->required()
                    ->columnSpanFull(),
            ]);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                Tables\Columns\TextColumn::make('user.first_name')
                    ->label('Posted By')
                    ->formatStateUsing(function ($record) {
                        return $record->user->getFilamentName();
                    })
                    ->sortable(),
                Tables\Columns\TextColumn::make('blog.title')
                    ->label('Blog Title')
                    ->limit(30)
                    ->sortable(),
                Tables\Columns\TextColumn::make('content')
                ->limit(40),
                Tables\Columns\TextColumn::make('likes_count')
                    ->label('Likes')
                    ->counts('likes')
                    ->sortable(),
                Tables\Columns\TextColumn::make('replied_to')
                    ->label('Replied To')
                    ->formatStateUsing(function ($record) {
                        $repliedTo = $record->repliedTo()->with('user')->first();
                        return $repliedTo ? $repliedTo->user->getFilamentName() : null;
                    })
                    ->sortable(),
                Tables\Columns\TextColumn::make('created_at')
                    ->dateTime()
                    ->sortable()
                    ->toggleable(isToggledHiddenByDefault: true),
                Tables\Columns\TextColumn::make('updated_at')
                    ->dateTime()
                    ->sortable()
                    ->toggleable(isToggledHiddenByDefault: true),
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
            RelationManagers\LikesRelationManager::class,
        ];
    }

    public static function getPages(): array
    {
        return [
            'index' => Pages\ListBlogComments::route('/'),
            'create' => Pages\CreateBlogComment::route('/create'),
            'view' => Pages\ViewBlogComment::route('/{record}'),
            'edit' => Pages\EditBlogComment::route('/{record}/edit'),
        ];
    }
}
