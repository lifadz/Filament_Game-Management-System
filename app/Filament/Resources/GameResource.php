<?php

namespace App\Filament\Resources;

use App\Filament\Resources\GameResource\Pages;
use App\Filament\Resources\GameResource\RelationManagers;
use App\Models\Developer;
use App\Models\Game;
use App\Models\Genre;
use App\Models\Platform;
use Filament\Forms;
use Filament\Forms\Components\DatePicker;
use Filament\Forms\Components\FileUpload;
use Filament\Forms\Components\MultiSelect;
use Filament\Forms\Components\Section;
use Filament\Forms\Components\Select;
use Filament\Forms\Form;
use Filament\Resources\Resource;
use Filament\Tables;
use Filament\Tables\Columns\ImageColumn;
use Filament\Tables\Columns\TextColumn;
use Filament\Tables\Table;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\SoftDeletingScope;

class GameResource extends Resource
{
    protected static ?string $model = Game::class;
    
    protected static ?string $navigationIcon = 'heroicon-o-computer-desktop';
    
    public static function form(Form $form): Form
    {
        return $form
        ->schema([
            
            Section::make('Game Details')
            ->schema([
                Select::make('genre_id')
                ->relationship('genre','genre_name')
                ->required(),
                
                Forms\Components\TextInput::make('title')
                ->required(),

                FileUpload::make('cover')
                ->image()
                ->required(),
                
                DatePicker::make('release_date')
                ->required(),
                
                Select::make('developer_id')
                ->relationship('developer','developer_name')
                ->required(),
                
                Forms\Components\RichEditor::make('description')
                ->required(),
                
                Forms\Components\TextInput::make('price')
                ->required(),
                
                Select::make('platform_id')
                ->relationship('platform','platform_name')
                ->required(),
                
             ])->columnSpan(2),
                
                
            ])->columns(2);
        }
        
        public static function table(Table $table): Table
        {
            return $table
            ->columns([
                TextColumn::make('title')->searchable(),
                ImageColumn::make('cover'),
                TextColumn::make('genre.genre_name')->label('genre'),
                TextColumn::make('release_date'),
                TextColumn::make('developer.developer_name')->label('Developer'),
                TextColumn::make('platform.platform_name')->label('Platform'),
                TextColumn::make('price')->label('Price'),
                
                ])
                ->filters([
                    //
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
                    
                    public static function getRelations(): array
                    {
                        return [
                            //
                        ];
                    }
                    
                    public static function getPages(): array
                    {
                        return [
                            'index' => Pages\ListGames::route('/'),
                            // 'create' => Pages\CreateGame::route('/create'),
                            // 'edit' => Pages\EditGame::route('/{record}/edit'),
                        ];
                    }
                }
