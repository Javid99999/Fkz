<?php

namespace App\Filament\Resources\SubCategories;

use App\Filament\Resources\SubCategories\Pages\CreateSubCategory;
use App\Filament\Resources\SubCategories\Pages\EditSubCategory;
use App\Filament\Resources\SubCategories\Pages\ListSubCategories;
use App\Filament\Resources\SubCategories\Schemas\SubCategoryForm;
use App\Filament\Resources\SubCategories\Tables\SubCategoriesTable;
use App\Models\Category;
use BackedEnum;
use Filament\Resources\Resource;
use Filament\Schemas\Schema;
use Filament\Support\Icons\Heroicon;
use Filament\Tables\Table;
use Illuminate\Database\Eloquent\Builder;

class SubCategoryResource extends Resource
{
    protected static ?string $model = Category::class;

    protected static string|BackedEnum|null $navigationIcon = Heroicon::OutlinedRectangleStack;



    public static function getNavigationLabel(): string
    {
        return 'Alt Kategori Yarat';
    }

    public static function getPluralLabel(): string
    {
        return 'Alt Kategoriler';
    }



    public static function getNavigationIcon(): string
    {
        return 'heroicon-o-h2'; // Etiket ikonu
    }

    public static function getNavigationGroup(): string
    {
        return 'Kategory-yarat';
    }

    public static function getEloquentQuery(): Builder
    {
        return parent::getEloquentQuery()
            ->whereNotNull('parent_id'); // sadece alt kategoriler
    }


    public static function getGloballySearchableAttributes(): array
    {
        return ['name->en', 'slug'];
    }



    public static function form(Schema $schema): Schema
    {
        return SubCategoryForm::configure($schema);
    }

    public static function table(Table $table): Table
    {
        return SubCategoriesTable::configure($table);
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
            'index' => ListSubCategories::route('/'),
            'create' => CreateSubCategory::route('/create'),
            'edit' => EditSubCategory::route('/{record}/edit'),
        ];
    }
}
