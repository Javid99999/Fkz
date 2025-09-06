import { Button } from "@/components/ui/button";
import { Card, CardContent } from "@/components/ui/card";
import { Input } from "@/components/ui/input";
import AppNavbarLayout from "@/layouts/app/app-navbar-layout";
import { Category, LangCode, PageProps, Paginated, ProductPageProps, Productt, ProductType } from "@/types";
import { Head, usePage } from "@inertiajs/react";
import { ChevronDown, ChevronRight, Filter, Search } from "lucide-react";
import { useState } from "react";
import { router } from '@inertiajs/react';
import { Accordion, AccordionContent, AccordionItem, AccordionTrigger } from "@/components/ui/accordion";
import ProductCard from "../components/ProductCard";
import Pagination from "../components/Pagination";
import { FooterSection } from "../components/FooterSection";



export default function Product() {

  const { products, category, selectedCategory } = usePage<ProductPageProps>().props;

  const [, setActiveCategory] = useState<number | undefined>(selectedCategory);

  const [openParentId, setOpenParentId] = useState<number | null>(null);


  // const lang: LangCode = 'en';

  function handleCategoryClick(categoryId: number) {
    setActiveCategory(categoryId);
    router.visit(route('products.index'), {
      method: 'get',
      data: { category_id: categoryId },
      preserveState: true,
      preserveScroll: true,
      only: ['products', 'selectedCategory'],
    });
  } 

  function toggleChildren(categoryId: number) {
    setOpenParentId(prev => (prev === categoryId ? null : categoryId));
  }


  
  // Onemli not inertia da 2 turlu laravelden veri cekme var biri visit digeri get

  return (
    // <div className="grid grid-cols-3 gap-6">
    //   {productList.map((product:ProductType) => (
    //     <div key={product.id} className="border p-4 rounded shadow-sm">
    //       <h2 className="text-lg font-semibold">{product.name}</h2>
    //       <p className="text-sm text-gray-600">CAS No: {product.cas_num}</p>
          
    //     </div>
    //   ))}
    // </div>



    // {products.data.map(product => (
    //   <ProductCard key={product.id} product={product} />
    // ))}

    // <Pagination links={products.links} />


    <div className="min-h-screen bg-background">
      <AppNavbarLayout>
            <Head title="Products" />
        </AppNavbarLayout>


        <section className="relative bg-gradient-to-b from-primary/10 to-background py-10 px-4 sm:px-6 lg:px-8">
        
          {/* Urun Katalok Yazisi */}
          <div className="flex flex-col items-center text-center gap-4">
            <h1 className="text-4xl md:text-3xl font-bold tracking-tight">
              Product Catalog
            </h1>
            <p className="text-gray-600">
              Browse our comprehensive range of chemical products
            </p>
          </div>



          {/* Search kismi */}
          <div className="mt-6 flex justify-center">
            <div className="flex flex-col sm:flex-row gap-4 w-full max-w-3xl">
              <div className="relative flex-grow">
                <Search className="absolute left-3 top-2 h-5 w-5 text-gray-500" />
                
                <Input
                  placeholder="Search products..."
                  className="pl-10 w-full border border-primary focus:border-primary focus:ring-0 rounded-md"
                  // value={searchTerm} burda fonksiyon olduktan sonra calisir 
                  // onChange={(e) => setSearchTerm(e.target.value)}
                />
              </div>
              <Button
                variant="outline"
                className="md:hidden"
                // onClick={() => setIsMobileFilterOpen(!isMobileFilterOpen)}
              >
                <Filter className="h-4 w-4 mr-2" />
                  Filters
              </Button>
            </div>
          </div>



          {/* Web Site body kismi */}
          <div className="flex flex-col md:flex-row gap-6 mt-6">
            



            {/* Sol teref Card */}
            <div className="hidden md:block w-64 shrink-0 space-y-6">


              <Card className='p-0'>

                <CardContent className="p-4 space-y-3">
                  
                  <div>
                    <div className="flex items-center justify-between">
                      <h3 className="font-bold text-base">Filters</h3>
                      <Button
                        variant="ghost"
                        size="sm"
                        onClick={() => {
                          setActiveCategory(undefined);      // state sıfırlanıyor
                          setOpenParentId(null);             // alt kategori açık olan varsa kapatılıyor

                          router.visit(route('products.index'), {
                            method: 'get',
                            data: { category_id: undefined },  // tüm kategoriler için
                            preserveState: true,
                            preserveScroll: true,
                            only: ['products', 'selectedCategory'],
                          });
                        }}
                      >
                        Clear all
                      </Button>
                    </div>
                  </div>


                  {/* Kategory Filter */}
                  <div className="space-y-3 mb-4">

                    <h5 className="text-sm font-medium">Categories:</h5>

                    <div className="space-y-2">

                        <div>
                          {category.map((cat) => (
                            <div key={cat.id}>
                              <button
                                className="flex items-center gap-2"
                                onClick={() => toggleChildren(cat.id)}
                              >
                                {openParentId === cat.id ? <ChevronDown /> : <ChevronRight />}
                                <div className="font-bold text-sm">{cat.name.en}</div>
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
                                    <span className="text-sm text-foreground">{child.name.en}</span>
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
                    <h3 className="text-lg font-medium">No products found</h3>
                    <p className="text-muted-foreground mt-1">
                      Try adjusting your filters
                    </p>
                    <Button
                        variant="ghost"
                        size="sm"
                        className="cursor-pointer  hover:bg-gray-400 mt-2"
                        onClick={() => {
                          setActiveCategory(undefined);      // state sıfırlanıyor
                          setOpenParentId(null);             // alt kategori açık olan varsa kapatılıyor

                          router.visit(route('products.index'), {
                            method: 'get',
                            data: { category_id: undefined },  // tüm kategoriler için
                            preserveState: true,
                            preserveScroll: true,
                            only: ['products', 'selectedCategory'],
                          });
                        }}
                      >
                        Clear all
                      </Button>
                  </div>
                </div>
              )}

                

              </div>

                          

            </div>
              

          </div>
          
          



        
        </section>

        <Pagination links={products.links} />

      <FooterSection />
    </div>



  );
}