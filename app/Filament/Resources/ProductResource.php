<?php

namespace App\Filament\Resources;

use Filament\Forms;
use Filament\Tables;
use App\Models\Product;
use Filament\Resources\Form;
use Filament\Resources\Table;
use Filament\Resources\Resource;
use Filament\Forms\Components\Card;
use Filament\Forms\Components\Select;
use Filament\Forms\Components\Toggle;
use Filament\Forms\Components\Textarea;
use Filament\Tables\Columns\TagsColumn;
use Filament\Tables\Columns\TextColumn;
use Filament\Forms\Components\TextInput;
use Filament\Tables\Columns\ImageColumn;
use Filament\Forms\Components\FileUpload;
use Illuminate\Database\Eloquent\Builder;
use Filament\Tables\Columns\BooleanColumn;
use App\Filament\Resources\ProductResource\Pages;
use Illuminate\Database\Eloquent\SoftDeletingScope;
use App\Filament\Resources\ProductResource\RelationManagers;

class ProductResource extends Resource
{
    protected static ?string $model = Product::class;

    protected static ?string $navigationIcon = 'heroicon-o-collection';
    protected static ?string $navigationGroup = 'Product Management';

    public static function form(Form $form): Form
    {
        return $form
            ->schema([
                Card::make()
                ->schema([
                    TextInput::make('name')->required(),
                    Textarea::make('description')->required(),
                    TextInput::make('cost_price')->numeric()->required(),
                    TextInput::make('price')->numeric()->required(),
                    TextInput::make('sale_price')
                        ->numeric()
                        ->required(),
                    TextInput::make('sku')->required(),
                    TextInput::make('quantity')->numeric()->required(),
                    Select::make('category_id')
                        ->relationship('category', 'name')->required(),
                    Select::make('brand_id')
                        ->relationship('brand', 'name')->required(),
                    FileUpload::make('featured_image')
                        //->disk('public/storage')
                        ->image()
                        ->visibility($visibility = 'public')
                        ->required(),
                    FileUpload::make('images')
                        //->disk('public/storage')
                        ->image()
                        ->visibility($visibility = 'public'),
                        //->imageCropAspectRatio('16:9')
                        //->imageResizeTargetWidth('1920')
                        //->imageResizeTargetHeight('1080')
                    Toggle::make('status')->required(),
                ])
            ]);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                TextColumn::make('id')->sortable(),
                ImageColumn::make('featured_image')->size(50)->label('Featured Image'),
                TextColumn::make('name')->sortable()->searchable(),
                TextColumn::make('price')->money('USD',true),
                TextColumn::make('sale_price')->money('USD', true)->label('Sale Price'),
                TextColumn::make('sku'),
                TextColumn::make('quantity'),
                TextColumn::make('category.name'),
                TextColumn::make('brand.name'),
                BooleanColumn::make('status'),
                ImageColumn::make('images')->size(50)->label('More Image'),
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
            'index' => Pages\ListProducts::route('/'),
            'create' => Pages\CreateProduct::route('/create'),
            'edit' => Pages\EditProduct::route('/{record}/edit'),
        ];
    }    
}
