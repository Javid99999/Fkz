import { Badge } from "@/components/ui/badge";
import { Button } from "@/components/ui/button";
import { Card, CardContent, CardDescription, CardHeader, CardTitle } from "@/components/ui/card";
import { Carousel, CarouselApi, CarouselContent, CarouselItem, CarouselNext, CarouselPrevious } from "@/components/ui/carousel";
import { Tabs, TabsContent, TabsList, TabsTrigger } from "@/components/ui/tabs";
import AppNavbarLayout from "@/layouts/app/app-navbar-layout";
import { LocalizedText, Productt, ProductType } from "@/types";
import { Head, router, usePage } from "@inertiajs/react";
// import { TabsList, TabsTrigger } from "@radix-ui/react-tabs";
import { Beaker, Car, ChevronLeft, FileText, Globe, ShieldAlert, Truck } from "lucide-react";
import React, { useContext } from "react";


interface PageProps {
  product: {
    data: ProductType;
    
  };
  [key: string]: unknown;
}



const ProductDetails: React.FC = () => {

  const { product } = usePage<PageProps>().props;

  const [api, setApi] = React.useState<CarouselApi>();
  const [current, setCurrent] = React.useState(0);
  const [count, setCount] = React.useState(0);
  const { currentLang } = usePage().props;
  const prod: ProductType = product.data;

  React.useEffect(() => {
      if (!api) {
        return;
      }
  
      setCount(api.scrollSnapList().length);
      setCurrent(api.selectedScrollSnap() + 1);
  
      api.on("select", () => {
        setCurrent(api.selectedScrollSnap() + 1);
      });
    }, [api]);



    function getLocalizedText(text: LocalizedText) {
      return text?.[currentLang as keyof LocalizedText] ?? '';
    }

  return (
    

    <div className="container mx-auto py-8 px-4 bg-background">

    <AppNavbarLayout>
            <Head title="Product Details" />
    </AppNavbarLayout>



    <Button
        variant="ghost"
        className="flex items-center gap-1 mt-6"
        onClick={() => router.visit('/products')}

      >
      <ChevronLeft className="h-4 w-4" /> Back to Materials
    </Button>


    <div className="grid grid-cols-1 md:grid-cols-3 gap-4 p-8">

      <div className="md:col-span-1">
        
        <Card className="mb-6">

          <CardContent className="p-0">

            <div className="aspect-square relative overflow-hidden rounded-t-lg">

              <Carousel className="w-full" setApi={setApi}>
                  <CarouselContent>
                    {prod.image_url?.map((image:string, index:number) => (
                      <CarouselItem key={index}>
                        <img
                          src={image}
                          alt={`${prod.name} - Image ${index + 1}`}
                          className="object-cover w-full h-full aspect-square"
                        />
                        
                      </CarouselItem>
                    ))}
                  </CarouselContent>
                  <CarouselPrevious className="left-2 w-10 h-10" />
                  <CarouselNext className="right-2 w-10 h-10" />
                </Carousel>


                <div className="absolute bottom-6 left-1/2 transform -translate-x-1/2 flex space-x-4">
                  {prod.image_url.map((_, index) => (
                    <button
                      key={index}
                      className={`border border-amber-400 w-4 h-4 rounded-full transition-all duration-400 ${
                        current === index + 1
                          ? "bg-white/90 shadow-lg"
                          : "bg-white/30 hover:bg-white/70"
                      }`}
                      onClick={() => api?.scrollTo(index)}
                      aria-label={`Go to slide ${index + 1}`}
                    />
                  ))}
                </div>

            </div>

            <div className="p-6">

              <Badge className="mb-2">{prod.classification ? 'with classifications' : ''}</Badge>
              <h2 className="text-2xl font-bold mb-1">{prod.name as any}</h2>
              <p className="text-sm text-muted-foreground mb-4">
                  CAS: {prod.cas_number}
              </p>


              <div className="grid grid-cols-2 gap-2 text-base">
                {prod.property.map((prop, index) => (
                  <div key={index}>
                    <p className="font-medium text-lg">{prop.name as any}:</p>
                    <p className="text-sm text-muted-foreground">{prop.numeric ?? prop.value}  {prop.unit?.unit.en}</p>
                  </div>
                ))}
                {/* <div>
                  <p className="font-medium">Form</p>
                  <p>{product.form}</p>
                </div> */}
                <div className="mt-12">
                  <p className="font-semibold text-lg">Origin:</p>
                  <p className="text-sm text-muted-foreground">{prod.country?.name}</p>
                </div>

                
                {/* <div>
                  <p className="font-medium">Delivery</p>
                  <p>{product.deliveryInfo.deliveryTerms}</p>
                </div> */}
                <div className="mt-12">
                  <p className="font-medium">Packaging:</p>
                  <p>{prod.packaging as any}</p>
                </div>
              </div>

            </div>

          </CardContent>

        </Card>

        

      </div>


      {/* Right Column - Tabs with Detailed Information */}
      <div className="md:col-span-2">

        <Card>

          {/* card baslik */}
          <CardHeader>
            <CardTitle className="mt-6 text-xl">{prod.name as any}</CardTitle>
            <CardDescription className="">{prod.description as any}</CardDescription>
          </CardHeader>

          <CardContent>
            
            <Tabs defaultValue="properties">
              
              <TabsList className="grid grid-cols-5 mb-6 bg-cyan-300/10 h-12 border rounded-xl">
                <TabsTrigger
                    value="properties"
                    className="flex items-center gap-2"
                  >
                    <Beaker className="h-4 w-4" /> Properties
                </TabsTrigger>

                <TabsTrigger
                    value="safety"
                    className="flex items-center gap-2"
                  >
                    <ShieldAlert className="h-4 w-4" /> Safety
                </TabsTrigger>

                <TabsTrigger
                    value="delivery"
                    className="flex items-center gap-2"
                  >
                  <Globe className="h-4 w-4" /> Delivery
                </TabsTrigger>

                <TabsTrigger
                    value="shipping"
                    className="flex items-center gap-2"
                  >
                  <Truck className="h-4 w-4" /> Shipping
                </TabsTrigger>
                <TabsTrigger
                  value="documents"
                  className="flex items-center gap-2"
                >
                  <FileText className="h-4 w-4" /> Documents
                </TabsTrigger>

              </TabsList>

              <TabsContent value="properties">
                  <div className="grid grid-cols-1 md:grid-cols-2 gap-4">
                    {prod.property.map((prop, index) => (
                      <div key={index} className="p-4 border rounded-md">
                        <p className="font-medium text-sm text-muted-foreground">
                          {prop.name as any}
                        </p>
                        <p className="font-semibold">{prop.numeric ?? prop.value} - {getLocalizedText(prop.unit?.unit)}</p>
                      </div>
                    ))}
                  </div>
              </TabsContent>




            </Tabs>


          </CardContent>




        </Card>



      </div>
      



    </div>



    </div>


  );


}

export default ProductDetails;