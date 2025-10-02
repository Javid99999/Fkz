import { Badge } from "@/components/ui/badge";
import { Button } from "@/components/ui/button";
import { Card, CardContent, CardDescription, CardHeader, CardTitle } from "@/components/ui/card";
import { Carousel, CarouselApi, CarouselContent, CarouselItem, CarouselNext, CarouselPrevious } from "@/components/ui/carousel";
import { Separator } from "@/components/ui/separator";
import { Tabs, TabsContent, TabsList, TabsTrigger } from "@/components/ui/tabs";
import AppNavbarLayout from "@/layouts/app/app-navbar-layout";
import { DeliveryPayload, MediaPayload, ProductType, ShippingPayload } from "@/types";
import { Head, router, usePage } from "@inertiajs/react";
import { Beaker, ChevronLeft, FileText, Globe, ShieldAlert, Truck } from "lucide-react";
import React, { useEffect, useState } from "react";
import { FooterSection } from "../components/FooterSection";
import { useLang } from "../ContextHelper/LanguageContext";
import langJson from "../../lang/proddetail_lang.json";
import DeliveryData from "../components/DeliveryData";
import ShipmentData from "../components/ShipmentData";
import DocumentCard from "../components/DocumentCard";

interface PageProps {
  product: { data: ProductType };
  delivery: { data: DeliveryPayload } | null;
  shipping: { data: ShippingPayload } | null;
  documents: { data: MediaPayload } | null;
  [key: string]: unknown;
}

const ProductDetails: React.FC = () => {
  const { product, delivery: initialDelivery, shipping: shipData, documents: docData } = usePage<PageProps>().props;
  const prod: ProductType = product.data;

  const [delivery, setDelivery] = useState<DeliveryPayload | null>(initialDelivery?.data ?? null);
  const [shipping, setShipping] = useState<ShippingPayload | null>(shipData?.data ?? null);
  const [documents, setDocuments] = useState<MediaPayload | null>(docData?.data ?? null);

  const [api, setApi] = useState<CarouselApi>();
  const [current, setCurrent] = useState(0);
  const [, setCount] = useState(0);

  const deliverList = delivery?.delivery_methods ?? [];
  const countryList = delivery?.available_countries ?? [];
  const productTerms = delivery?.productTerms ?? [];
  const shipinfo = shipping?.loadsend ?? { deliver: "", loading: "" };
  const packaging = shipping?.wrapping ?? [];
  const docks = shipping?.reqdocks ?? [];
  const countryoy = shipping?.country ?? { id: 0, name: "" };
  const mediaDock = documents?.docs ?? [];

  const { lang } = useLang();

  const getInitialTab = () => new URLSearchParams(window.location.search).get("tab") || "properties";
  const [currentTab, setCurrentTab] = useState(getInitialTab());
  const handleTabChange = (val: string) => {
    setCurrentTab(val);
    const url = new URL(window.location.href);
    url.searchParams.set("tab", val);
    window.history.replaceState({}, "", url.toString());
  };

  useEffect(() => {
    if (!api) return;
    setCount(api.scrollSnapList().length);
    setCurrent(api.selectedScrollSnap() + 1);
    api.on("select", () => setCurrent(api.selectedScrollSnap() + 1));
  }, [api]);

  const fetchDelivery = () =>
    router.get(route("products.show", { product: prod.id }), { tab: "delivery" }, {
      preserveState: true,
      preserveScroll: true,
      only: ["delivery", "product"],
      onSuccess: (page: any) => setDelivery(page.props.delivery?.data ?? null),
    });

  const fetchShipping = () =>
    router.get(route("products.show", { product: prod.id }), { tab: "shipping" }, {
      preserveState: true,
      preserveScroll: true,
      only: ["shipping","product"],
      onSuccess: (page: any) => setShipping(page.props.shipping?.data ?? null),
    });

  const fetchDocs = () =>
    router.get(route("products.show", { product: prod.id }), { tab: "documents" }, {
      preserveState: true,
      preserveScroll: true,
      only: ["documents","product"],
      onSuccess: (page: any) => setDocuments(page.props.documents?.data ?? null),
    });

  useEffect(() => {
    
    if (currentTab === "delivery") fetchDelivery();
    if (currentTab === "shipping") fetchShipping();
    if (currentTab === "documents") fetchDocs();
  }, [lang, currentTab]);

  return (
    <div className="min-h-screen bg-background">
      <AppNavbarLayout>
        <Head title="Product Details" />
      </AppNavbarLayout>

      <div className="container mx-auto py-8 px-4 bg-background">
        <Button
          variant="ghost"
          className="flex items-center gap-1 mt-2 mb-4 border bg-primary-foreground"
          onClick={() => router.visit("/products")}
        >
          <ChevronLeft className="h-4 w-4" /> {langJson.backtoProducts[lang] ?? langJson.backtoProducts.en}
        </Button>

        <div className="grid grid-cols-1 md:grid-cols-3 gap-4">
          {/* Sol Kolon */}
          <div className="md:col-span-1">
            <Card className="mb-6">
              <CardContent className="p-0">
                <div className="aspect-square relative overflow-hidden rounded-t-lg">
                  <Carousel className="w-full" setApi={setApi}>
                    <CarouselContent>
                      {(prod.img_url?.length ? prod.img_url : ["/imgs/productimagecomingsoon.jpeg"]).map((img, idx) => (
                        <CarouselItem key={idx}>
                          <img
                            src={img}
                            alt={`${prod.name} - Image ${idx + 1}`}
                            className="object-cover w-full h-full aspect-square"
                            width={432}
                            height={432}
                            loading={idx === 0 ? "eager" : "lazy"}
                            fetchPriority={idx === 0 ? "high" : "auto"}
                          />
                        </CarouselItem>
                      ))}
                    </CarouselContent>
                    <CarouselPrevious className="left-2 w-10 h-10" />
                    <CarouselNext className="right-2 w-10 h-10" />
                  </Carousel>

                  <div className="absolute bottom-6 left-1/2 transform -translate-x-1/2 flex space-x-4">
                    {prod.img_url?.map((_, idx) => (
                      <button
                        key={idx}
                        className={`border border-amber-400 w-4 h-4 rounded-full transition-all duration-400 ${
                          current === idx + 1 ? "bg-white/90 shadow-lg" : "bg-white/30 hover:bg-white/70"
                        }`}
                        onClick={() => api?.scrollTo(idx)}
                        aria-label={`Go to slide ${idx + 1}`}
                      />
                    ))}
                  </div>
                </div>

                <div className="p-6">
                  <Badge className="mb-2">
                    {prod.classification ? langJson.withClassifications[lang] ?? langJson.withClassifications.en : ""}
                  </Badge>
                  <h2 className="text-3xl font-bold mb-1">{prod.name}</h2>
                  <p className="text-md text-muted-foreground mb-4 mt-2 ml-1">CAS: {prod.cas_number}</p>

                  <div className="grid grid-cols-2 gap-2 text-base">
                    {prod.property.map((prop, idx) => (
                      <div key={idx}>
                        <p className="font-medium text-xl">{prop.name}</p>
                        <p className="text-md text-muted-foreground ml-1">
                          {prop.numeric ?? prop.value} {prop.unit?.unit}
                        </p>
                      </div>
                    ))}
                  </div>

                  {/* Origin ve Packaging yan yana */}
                  <div className="mt-6 flex flex-col md:flex-row md:space-x-6 gap-4">
                    <div className="flex-1">
                      <p className="font-semibold text-xl">{langJson.origin[lang] ?? langJson.origin.en}:</p>
                      <p className="text-md text-muted-foreground">{prod.country?.name}</p>
                    </div>
                    <div className="flex-1">
                      <p className="font-medium text-xl">{langJson.packaging[lang] ?? langJson.packaging.en}:</p>
                      <p className="text-md text-muted-foreground">{prod.packaging}</p>
                    </div>
                  </div>
                </div>
              </CardContent>
            </Card>
          </div>

          {/* Sağ Kolon */}
          <div className="md:col-span-2">
            <Card>
              <CardHeader>
                <CardTitle className="mt-6 text-xl">{prod.name}</CardTitle>
                <CardDescription>{prod.description}</CardDescription>
              </CardHeader>

              <CardContent>
                <Tabs value={currentTab} onValueChange={handleTabChange}>
                  {/* Kaydırılabilir Tabs */}
                  <div className="overflow-x-auto scrollbar-hide">
                    <TabsList className="flex space-x-2 sm:space-x-12 p-1 min-w-max">
                      {[
                        { val: "properties", icon: <Beaker className="h-4 w-4" />, label: langJson.properties[lang] ?? langJson.properties.en },
                        { val: "safety", icon: <ShieldAlert className="h-4 w-4" />, label: langJson.safety[lang] ?? langJson.safety.en },
                        { val: "delivery", icon: <Globe className="h-4 w-4" />, label: langJson.delivery[lang] ?? langJson.delivery.en },
                        { val: "shipping", icon: <Truck className="h-4 w-4" />, label: langJson.shipping[lang] ?? langJson.shipping.en },
                        { val: "documents", icon: <FileText className="h-4 w-4" />, label: langJson.documents[lang] ?? langJson.documents.en },
                      ].map(tab => (
                        <TabsTrigger key={tab.val} value={tab.val} className="flex items-center gap-2 whitespace-nowrap">
                          {tab.icon} {tab.label}
                        </TabsTrigger>
                      ))}
                    </TabsList>
                  </div>

                  {/* Tabs Content */}
                  <TabsContent value="properties">
                    <div className="grid grid-cols-1 md:grid-cols-2 gap-4 mt-4">
                      {prod.property.map((prop, idx) => (
                        <div key={idx} className="p-4 border rounded-md mb-4">
                          <p className="font-medium text-sm text-muted-foreground">{prop.name}</p>
                          <p className="font-semibold">{prop.numeric ?? prop.value} - {prop.unit?.unit}</p>
                        </div>
                      ))}
                    </div>
                  </TabsContent>

                  <TabsContent value="safety">
                    <div className="space-y-6 mt-4">
                      {prod.classification?.map((c, idx) => (
                        <h2 key={idx} className="text-xl font-semibold mb-2 flex items-center gap-2">
                          <ShieldAlert className="h-5 w-5 text-destructive" /> {c.name}
                        </h2>
                      ))}

                      <div className="ml-2 flex flex-wrap gap-2">
                        {prod.picto?.map((pico, idx) => (
                          <Badge key={idx} variant="destructive">{pico.name}</Badge>
                        ))}
                      </div>

                      {prod.statements?.map((s, idx) => (
                        <div key={idx} className="m-4 mt-8">
                          <h2 className="text-lg font-semibold">{s.name}</h2>
                          <ul className="space-y-2 mb-2">
                            {s.securecode?.map((sc, sidx) => (
                              <li key={sidx} className="text-lg ml-2 mt-2">{sc.code} - {sc.description}</li>
                            ))}
                          </ul>
                        </div>
                      ))}

                      {/* Pictogram Section */}
                      <Separator />
                      <div className="mt-4 mb-4">
                        <h3 className="text-lg font-semibold mb-4">Pictograms</h3>
                        <div className="flex gap-4 flex-wrap">
                          {prod.picto?.map((ppico, pin) => (
                            <div key={pin} className="border p-4 rounded-md w-24 h-24 flex items-center justify-center">
                              <p className="font-bold text-center">{ppico.code}</p>
                            </div>
                          ))}
                        </div>
                      </div>
                    </div>
                  </TabsContent>

                  <TabsContent value="delivery">
                    {delivery ? (
                      <DeliveryData delivery_methods={deliverList} available_countries={countryList} productTerms={productTerms} />
                    ) : <p className="text-sm text-muted-foreground mt-2">Loading delivery info...</p>}
                  </TabsContent>

                  <TabsContent value="shipping">
                    {shipping ? <ShipmentData loadsend={shipinfo} wrapping={packaging} reqdocks={docks} country={countryoy} /> : <p className="text-sm text-muted-foreground mt-2">Loading Shipping info...</p>}
                  </TabsContent>

                  <TabsContent value="documents">
                    {documents ? <DocumentCard docs={mediaDock} /> : <p className="text-sm text-muted-foreground mt-2">Loading documents...</p>}
                  </TabsContent>
                </Tabs>
              </CardContent>
            </Card>
          </div>
        </div>
      </div>

      <FooterSection />
    </div>
  );
};

export default ProductDetails;
