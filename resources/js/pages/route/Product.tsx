import { Button } from "@/components/ui/button";
import { Card, CardContent } from "@/components/ui/card";
import { Input } from "@/components/ui/input";
import AppNavbarLayout from "@/layouts/app/app-navbar-layout";
import { ProductPageProps } from "@/types";
import { Head, usePage, useRemember } from "@inertiajs/react";
import { ChevronDown, ChevronRight, Filter, Search, X } from "lucide-react";
import { useState, useEffect, useCallback } from "react";
import { router } from '@inertiajs/react';
import debounce from "lodash.debounce";
import productlang from '../../lang/product_lang.json'
import ProductCard from "../components/ProductCard";
import Pagination from "../components/Pagination";
import { FooterSection } from "../components/FooterSection";
import { useLang } from "../ContextHelper/LanguageContext";

export default function Product() {
  const { products, category, selectedCategory } = usePage<ProductPageProps>().props;

  const [activeCategory, setActiveCategory] = useState<number | undefined>(selectedCategory);
  const [openParentId, setOpenParentId] = useRemember<number | null>(null, 'product-accordion');
  const [searchTerm, setSearchTerm] = useRemember('', 'product-search');
  const [isMobileFilterOpen, setIsMobileFilterOpen] = useState(false);
  const { lang } = useLang();



  

  function handleCategoryClick(categoryId: number) {
    setActiveCategory(categoryId);

    
    const query: Record<string, string | number> = { category_id: categoryId };
    if(searchTerm.trim() !== "") query.search = searchTerm; // search varsa ekle

    router.visit(route('products.index'), {
      method: 'get',
      data: query, 
      preserveState: true,
      preserveScroll: true,
      only: ['products', 'selectedCategory'],
    });

    setIsMobileFilterOpen(false); // mobilde seçim sonrası paneli kapat
  }

  function toggleChildren(categoryId: number) {
    setOpenParentId(prev => (prev === categoryId ? null : categoryId));
  }

  const searchProducts = useCallback(
    debounce((term: string) => {
      const query: Record<string, any> = {};

      if(term.trim() !== "") query.search = term; // arama varsa ekle
      if(selectedCategory) query.category_id = selectedCategory; // category varsa ekle

      router.get(route('products.index'), query, {
        preserveState: true,
        replace: true,
        only: ['products', 'selectedCategory'],
      });
    }, 300),
    [selectedCategory]
  );

  // useEffect(() => {
  //   if (searchTerm && searchTerm.trim() !== "") {
  //     // normal search
  //     searchProducts(searchTerm);
  //   } else {
  //     // search çubuğu boş → query temizle
  //     router.get(route('products.index'), {}, {
  //       preserveState: true,
  //       replace: true, // URL’yi temizler
  //       only: ['products'], 
  //     });
  //   }
  // }, [searchTerm]);

  // ✅ handleSearchChange input’a bağlandı
  const handleSearchChange = (e: React.ChangeEvent<HTMLInputElement>) => {
    setSearchTerm(e.target.value);   // input değerini state’e kaydeder
    searchProducts(e.target.value);  // debounce ile arama tetikler
  };

  return (
    <div className="min-h-screen bg-background">
      <AppNavbarLayout>
        <Head title="Products" />
      </AppNavbarLayout>

      <section className="relative bg-gradient-to-b from-primary/10 to-background py-10 px-4 sm:px-6 lg:px-8">
        {/* Urun Katalok Yazisi */}
        <div className="flex flex-col items-center text-center gap-4">
          <h1 className="text-3xl sm:text-4xl font-bold tracking-tight">
            {productlang.productcatalog[lang] ?? productlang.productcatalog.en}
          </h1>
          <p className="text-gray-600 text-base sm:text-lg">
            {productlang.browseproduct[lang] ?? productlang.browseproduct.en}
          </p>
        </div>

        {/* Search + Mobile Filter Button */}
        <div className="mt-6 flex justify-center">
          <div className="flex flex-col sm:flex-row gap-4 w-full max-w-3xl">
            <div className="relative flex-grow">
              <Search className="absolute left-3 top-2 h-5 w-5 text-gray-500" />
              <Input
                placeholder={productlang.searchpro[lang] ?? productlang.searchpro.en}
                className="pl-10 w-full border border-primary focus:border-primary focus:ring-0 rounded-md"
                value={searchTerm}
                onChange={handleSearchChange}
              />
            </div>
            <Button
              variant="outline"
              className="sm:hidden text-foreground"
              onClick={() => setIsMobileFilterOpen(true)}
            >
              <Filter className="h-4 w-4 mr-2" />
              {productlang.filters[lang] ?? productlang.filters.en}
            </Button>
          </div>
        </div>

        {/* Web Site body kismi */}
        <div className="flex flex-col md:flex-row gap-6 mt-6">

          {/* Desktop Sol filtre */}
          <div className="hidden md:block w-72 shrink-0 space-y-6">
            <Card className='p-0'>
              <CardContent className="p-4 space-y-3">
                <div className="flex items-center justify-between">
                  <h3 className="font-bold text-base">{productlang.filters[lang] ?? productlang.filters.en}</h3>
                  <Button
                    variant="ghost"
                    size="sm"
                    onClick={() => {
                      setActiveCategory(undefined);
                      setOpenParentId(null);
                      setSearchTerm('')
                      router.visit(route('products.index'), {
                        method: 'get',
                        data: { category_id: undefined },
                        preserveState: true,
                        preserveScroll: true,
                        only: ['products', 'selectedCategory'],
                      });
                    }}
                  >
                    {productlang.clearall[lang] ?? productlang.clearall.en}
                  </Button>
                </div>

                {/* Kategory Filter */}
                <div className="space-y-3 mb-4">
                  <h5 className="text-md font-medium">{productlang.categoryies[lang] ?? productlang.categoryies.en}:</h5>
                  <div className="space-y-2">
                    {category.map((cat) => (
                      <div key={cat.id}>
                        <button
                          className="flex items-center gap-2"
                          onClick={() => toggleChildren(cat.id)}
                        >
                          {openParentId === cat.id ? <ChevronDown /> : <ChevronRight />}
                          <div className={`font-bold text-md ${
                            activeCategory === cat.id ? 'text-primary' : 'text-foreground'
                          }`}>{cat.name[lang] ?? cat.name.en}</div>
                        </button>
                        <div
                          className={`ml-8 mt-2 mb-1 overflow-hidden transition-all duration-300 ${
                            openParentId === cat.id ? "max-h-40 opacity-100" : "max-h-0 opacity-0"
                          }`}
                        >
                          {cat.children.map((child) => (
                            <button
                              key={child.id}
                              className={`w-full flex justify-between items-center px-3 py-1 rounded hover:bg-gray-100 transition-colors ${
                                selectedCategory === child.id ? "font-semibold text-primary bg-primary/10" : "text-gray-700"
                              }`}
                              onClick={() => handleCategoryClick(child.id)}
                            >
                              <span className="text-md text-foreground">{child.name[lang] ?? child.name.en}</span>
                              <span className="text-xs font-medium bg-gray-200 text-gray-900 px-2 py-0.5 rounded-full">
                                {child.products_count}
                              </span>
                            </button>
                          ))}
                        </div>
                      </div>
                    ))}
                  </div>
                </div>

              </CardContent>
            </Card>
          </div>

          {/* Product Grid */}
          <div className="flex-1">
            <div className="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-3 gap-4">
              {products.data.length > 0 ? (
                products.data.map(product => (
                  <ProductCard key={product.id} product={product} />
                ))
              ) : (
                <div className="col-span-full flex items-center justify-center h-64">
                  <div className="text-center">
                    <h3 className="text-lg font-medium">{productlang.ifnoproduct[lang] ?? productlang.ifnoproduct.en}</h3>
                    <p className="text-muted-foreground mt-1">
                      {productlang.tryadjustfilter[lang] ?? productlang.tryadjustfilter.en}
                    </p>
                    <Button
                      variant="ghost"
                      size="sm"
                      className="cursor-pointer hover:bg-gray-400 mt-2"
                      onClick={() => {
                        setActiveCategory(undefined);
                        setOpenParentId(null);
                        router.visit(route('products.index'), {
                          method: 'get',
                          data: { category_id: undefined },
                          preserveState: true,
                          preserveScroll: true,
                          only: ['products', 'selectedCategory'],
                        });
                      }}
                    >
                      {productlang.clearall[lang] ?? productlang.clearall.en}
                    </Button>
                  </div>
                </div>
              )}
              
            </div>


          </div>

        </div>

        {/* Mobile Filter Panel */}
        {isMobileFilterOpen && (
          <>
            <div
              className="fixed inset-0 bg-black/30 z-40"
              onClick={() => setIsMobileFilterOpen(false)}
            />
            <div className={`fixed top-0 left-0 h-full w-72 bg-background z-50 transform transition-transform duration-300`}>
              <div className="flex items-center justify-between p-4 border-b">
                <h3 className="font-bold text-base">{productlang.filters[lang] ?? productlang.filters.en}</h3>
                <Button variant="ghost" size="sm" onClick={() => setIsMobileFilterOpen(false)}>
                  <X className="h-4 w-4" />
                </Button>
              </div>
              <Card className="p-0">
                <CardContent className="p-4 space-y-3">
                  {/* Kategory Filter */}
                  <div className="space-y-3 mb-4">
                    <h5 className="text-md font-medium">{productlang.categoryies[lang] ?? productlang.categoryies.en}:</h5>
                    <div className="space-y-2">
                      {category.map((cat) => (
                        <div key={cat.id}>
                          <button
                            className="flex items-center gap-2"
                            onClick={() => toggleChildren(cat.id)}
                          >
                            {openParentId === cat.id ? <ChevronDown /> : <ChevronRight />}
                            <div className="font-bold text-md">{cat.name[lang] ?? cat.name.en}</div>
                          </button>
                          <div
                            className={`ml-6 mt-2 mb-1 overflow-hidden transition-all duration-300 ${
                              openParentId === cat.id ? "max-h-40 opacity-100" : "max-h-0 opacity-0"
                            }`}
                          >
                            {cat.children.map((child) => (
                              <button
                                key={child.id}
                                className={`w-full flex justify-between items-center px-3 py-1 rounded hover:bg-gray-100 transition-colors ${
                                  selectedCategory === child.id ? "font-semibold text-primary bg-primary/10" : "text-gray-700"
                                }`}
                                onClick={() => handleCategoryClick(child.id)}
                              >
                                <span className="text-md text-foreground">{child.name[lang] ?? child.name.en}</span>
                                <span className="text-xs font-medium bg-gray-200 text-gray-900 px-2 py-0.5 rounded-full">
                                  {child.products_count}
                                </span>
                              </button>
                            ))}
                          </div>
                        </div>
                      ))}
                    </div>

                    <Button
                      variant="ghost"
                      size="sm"
                      className="mt-4 w-full"
                      onClick={() => {
                        setActiveCategory(undefined);
                        setOpenParentId(null);
                        router.visit(route('products.index'), {
                          method: 'get',
                          data: { category_id: undefined },
                          preserveState: true,
                          preserveScroll: true,
                          only: ['products', 'selectedCategory'],
                        });
                        setIsMobileFilterOpen(false);
                      }}
                    >
                      {productlang.clearall[lang] ?? productlang.clearall.en}
                    </Button>
                  </div>
                </CardContent>
              </Card>
            </div>
          </>
        )}

      </section>

      <Pagination 
        links={products.links}
        meta={products.meta}
        query={{ search: searchTerm || undefined, category_id: selectedCategory || undefined }}
        />
      <FooterSection />
    </div>
  );
}
