<?php

namespace App\Filament\Resources\Categories;

use App\Filament\Resources\Categories\Pages\CreateCategory;
use App\Filament\Resources\Categories\Pages\EditCategory;
use App\Filament\Resources\Categories\Pages\ListCategories;
use App\Filament\Resources\Categories\Schemas\CategoryForm;
use App\Filament\Resources\Categories\Tables\CategoriesTable;
use App\Models\Category;
use BackedEnum;
use Filament\Resources\Resource;
use Filament\Schemas\Schema;
use Filament\Support\Icons\Heroicon;
use Filament\Tables\Table;
use Illuminate\Database\Eloquent\Builder;

class CategoryResource extends Resource
{
    protected static ?string $model = Category::class;

    protected static string|BackedEnum|null $navigationIcon = Heroicon::OutlinedRectangleStack;


    public static function getEloquentQuery():Builder
    {
        return parent::getEloquentQuery()
            ->whereNull('parent_id');
    }

    public static function getGlobalSearchAttributes(): array
    {
        return ['name->en'];
    }

    public static function getGlobalSearchEloquentQuery(): Builder
    {
        $search = strtolower(request('search'));

        return static::getModel()::query()
            ->whereRaw("LOWER(JSON_UNQUOTE(JSON_EXTRACT(name, '$.en'))) LIKE ?", ["%{$search}%"]);
    }

    public static function getGloballySearchableAttributes(): array
    {
        return ['name->en', 'slug'];
    }

    public static function getPluralLabel(): string
    {
        return 'Kategoriler';
    }

    public static function getNavigationIcon(): string
    {
        return 'heroicon-o-h1'; // Etiket ikonu
    }
    

    public static function getNavigationLabel(): string
    {
        return 'Ust Kategori';
    }

    public static function getNavigationGroup(): string
    {
        return 'Kategory-yarat';
    }






    public static function form(Schema $schema): Schema
    {
        return CategoryForm::configure($schema);
    }

    public static function table(Table $table): Table
    {
        return CategoriesTable::configure($table);
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
            'index' => ListCategories::route('/'),
            'create' => CreateCategory::route('/create'),
            'edit' => EditCategory::route('/{record}/edit'),
        ];
    }
}
