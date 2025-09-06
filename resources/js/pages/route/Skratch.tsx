// import React, { useState } from "react";
// import { Tabs, TabsContent, TabsList, TabsTrigger } from "@/components/ui/tabs";
// import { Button } from "@/components/ui/button";
// import {
//   Card,
//   CardContent,
//   CardDescription,
//   CardFooter,
//   CardHeader,
//   CardTitle,
// } from "@/components/ui/card";
// import { Badge } from "@/components/ui/badge";
// import { Separator } from "@/components/ui/separator";
// import { Dialog, DialogContent, DialogTrigger } from "@/components/ui/dialog";
// import {
//   Carousel,
//   CarouselContent,
//   CarouselItem,
//   CarouselNext,
//   CarouselPrevious,
//   CarouselApi,
// } from "@/components/ui/carousel";
// import {
//   FileText,
//   Download,
//   Building2,
//   ShieldAlert,
//   Beaker,
//   Truck,
//   Info,
//   ChevronLeft,
//   DollarSign,
//   Globe,
//   Package,
//   Scale,
// } from "lucide-react";
// // import RFQForm from "@/components/RFQForm";
// // import TechnicalDocViewer from "@/components/TechnicalDocViewer";
// // import { useNavigate } from "react-router-dom";
// import { router } from '@inertiajs/react';


// interface ChemicalProperty {
//   name: string;
//   value: string;
// }

// interface SafetyInfo {
//   hazardClass: string;
//   hazardStatements: string[];
//   precautionaryStatements: string[];
//   pictograms: string[];
// }

// interface SupplierInfo {
//   name: string;
//   location: string;
//   certifications: string[];
//   leadTime: string;
//   minOrderQuantity: string;
// }

// interface ProductDetailProps {
//   id?: string;
// }

// const ProductDetails: React.FC<ProductDetailProps> = ({ id = "1" }) => {
//   // const navigate = useNavigate();
//   const [isRFQOpen, setIsRFQOpen] = useState(false);
//   const [isDocViewerOpen, setIsDocViewerOpen] = useState(false);
//   const [api, setApi] = React.useState<CarouselApi>();
//   const [current, setCurrent] = React.useState(0);
//   const [count, setCount] = React.useState(0);

//   React.useEffect(() => {
//     if (!api) {
//       return;
//     }

//     setCount(api.scrollSnapList().length);
//     setCurrent(api.selectedScrollSnap() + 1);

//     api.on("select", () => {
//       setCurrent(api.selectedScrollSnap() + 1);
//     });
//   }, [api]);

//   // Mock data for the product
//   const product = {
//     id,
//     name: "Sodium Hydroxide (NaOH)",
//     casNumber: "1310-73-2",
//     purity: "99%",
//     form: "Pellets",
//     packaging: "25kg bags, 1000kg bulk bags",
//     description:
//       "High purity sodium hydroxide (caustic soda) suitable for various industrial applications including chemical manufacturing, water treatment, and soap production.",
//     images: [
//       "https://images.unsplash.com/photo-1603126857599-f6e157fa2fe6?w=800&q=80",
//       "https://images.unsplash.com/photo-1532187863486-abf9dbad1b69?w=800&q=80",
//       "https://images.unsplash.com/photo-1582719478250-c89cae4dc85b?w=800&q=80",
//       "https://images.unsplash.com/photo-1559757148-5c350d0d3c56?w=800&q=80",
//     ],
//     availability: "In Stock",
//     manufacturerCountry: "Turkey",
//     origin: "Manufactured in Turkey",
//     properties: [
//       { name: "Molecular Weight", value: "40.00 g/mol" },
//       { name: "Melting Point", value: "318°C" },
//       { name: "Boiling Point", value: "1388°C" },
//       { name: "Density", value: "2.13 g/cm³" },
//       { name: "pH", value: "14 (5% solution)" },
//       { name: "Solubility in Water", value: "1090 g/L at 20°C" },
//     ],
//     safetyInfo: {
//       hazardClass: "Corrosive",
//       hazardStatements: [
//         "H314 - Causes severe skin burns and eye damage",
//         "H290 - May be corrosive to metals",
//       ],
//       precautionaryStatements: [
//         "P280 - Wear protective gloves/protective clothing/eye protection/face protection",
//         "P301+P330+P331 - IF SWALLOWED: Rinse mouth. Do NOT induce vomiting",
//         "P303+P361+P353 - IF ON SKIN (or hair): Take off immediately all contaminated clothing. Rinse skin with water",
//         "P305+P351+P338 - IF IN EYES: Rinse cautiously with water for several minutes. Remove contact lenses, if present and easy to do. Continue rinsing",
//       ],
//       pictograms: ["GHS05"],
//     },
//     supplier: {
//       name: "ChemSupply Industries",
//       location: "Houston, TX, USA",
//       certifications: ["ISO 9001", "ISO 14001", "REACH Registered"],
//       leadTime: "3-5 business days",
//       minOrderQuantity: "25kg",
//     },
//     deliveryInfo: {
//       availableCountries: [
//         "United States",
//         "Germany",
//         "United Kingdom",
//         "France",
//         "Italy",
//         "Spain",
//         "Netherlands",
//         "Belgium",
//         "Poland",
//         "Czech Republic",
//         "Hungary",
//         "Romania",
//         "Bulgaria",
//         "Greece",
//         "Portugal",
//         "Sweden",
//         "Norway",
//         "Denmark",
//         "Finland",
//         "Austria",
//         "Switzerland",
//         "India",
//         "China",
//         "Japan",
//         "South Korea",
//         "Singapore",
//         "Malaysia",
//         "Thailand",
//         "Vietnam",
//         "Indonesia",
//         "Philippines",
//         "Australia",
//         "New Zealand",
//         "Brazil",
//         "Argentina",
//         "Chile",
//         "Mexico",
//         "Canada",
//         "South Africa",
//         "Egypt",
//         "Morocco",
//         "UAE",
//         "Saudi Arabia",
//         "Qatar",
//         "Kuwait",
//       ],
//       deliveryMethods: {
//         fob: {
//           port: "Istanbul Port, Turkey",
//           description:
//             "Free on Board - Seller delivers goods on board the vessel at the named port of shipment",
//           buyerResponsibilities:
//             "Marine insurance, freight charges, import duties, local transportation",
//           availableFor: "All countries with sea access",
//         },
//         cif: {
//           description:
//             "Cost, Insurance and Freight - Seller pays for shipping and insurance to destination port",
//           sellerResponsibilities:
//             "Product cost, marine insurance, freight to destination port",
//           buyerResponsibilities:
//             "Import duties, local transportation from port",
//           availableFor: "Major ports worldwide",
//         },
//         cfr: {
//           description:
//             "Cost and Freight - Seller pays for shipping to destination port",
//           sellerResponsibilities: "Product cost, freight to destination port",
//           buyerResponsibilities:
//             "Marine insurance, import duties, local transportation",
//           availableFor: "All countries with sea access",
//         },
//         dap: {
//           description:
//             "Delivered at Place - Seller delivers goods to named destination",
//           sellerResponsibilities:
//             "All costs and risks until delivery at destination",
//           buyerResponsibilities: "Import duties, unloading at destination",
//           availableFor: "Major cities in Europe and North America",
//         },
//         exw: {
//           description: "Ex Works - Buyer collects goods from seller's premises",
//           sellerResponsibilities: "Make goods available at factory/warehouse",
//           buyerResponsibilities:
//             "All transportation, insurance, and export/import procedures",
//           availableFor: "Istanbul, Turkey pickup only",
//         },
//       },
//       paymentTerms: "30% advance, 70% against B/L copy",
//       deliveryTerms: "Multiple delivery options available",
//     },
//     tradingRules: {
//       qualityAssurance: "Each batch tested and certified before shipment",
//       inspection:
//         "SGS or equivalent third-party inspection available upon request",
//       packaging: "Standard industrial packaging, custom packaging available",
//       storage: "Store in dry, cool place away from incompatible materials",
//       shelfLife: "2 years from manufacturing date when stored properly",
//       returns:
//         "No returns accepted for chemical products due to safety regulations",
//       disputes:
//         "All disputes to be resolved through arbitration in Istanbul, Turkey",
//     },
//     shippingInfo: {
//       estimatedDelivery: "15-25 days to major ports worldwide",
//       packagingOptions: [
//         "25kg PP bags with PE liner",
//         "1000kg jumbo bags",
//         "Custom packaging available",
//       ],
//       containerLoading: "20 MT in 20ft container, 25 MT in 40ft container",
//       documentation: "Commercial invoice, packing list, B/L, CoA, MSDS",
//     },
//     documents: [
//       { name: "Safety Data Sheet (SDS)", type: "pdf" },
//       { name: "Certificate of Analysis (CoA)", type: "pdf" },
//       { name: "Technical Specification Sheet", type: "pdf" },
//       { name: "Handling Guidelines", type: "pdf" },
//       { name: "Export License", type: "pdf" },
//       { name: "ISO Certificates", type: "pdf" },
//     ],
//   };

//   return (
//     <div className="container mx-auto py-8 px-4 bg-background">
//       <Button
//         variant="ghost"
//         className="mb-6 flex items-center gap-1"
//         onClick={() => router.visit('/products')}

//       >
//         <ChevronLeft className="h-4 w-4" /> Back to Materials
//       </Button>

//       <div className="grid grid-cols-1 md:grid-cols-3 gap-8">
//         {/* Left Column - Image and Quick Info */}
//         <div className="md:col-span-1">  {/* hal hazirda burdayam */}
          
          
//           <Card className="mb-6">
//             <CardContent className="p-0">
//               <div className="aspect-square relative overflow-hidden rounded-t-lg">
//                 <Carousel className="w-full" setApi={setApi}>
//                   <CarouselContent>
//                     {product.images.map((image, index) => (
//                       <CarouselItem key={index}>
//                         <img
//                           src={image}
//                           alt={`${product.name} - Image ${index + 1}`}
//                           className="object-cover w-full h-full aspect-square"
//                         />
//                       </CarouselItem>
//                     ))}
//                   </CarouselContent>
//                   <CarouselPrevious className="left-2" />
//                   <CarouselNext className="right-2" />
//                 </Carousel>

//                 {/* Pagination Dots */}
//                 <div className="absolute bottom-4 left-1/2 transform -translate-x-1/2 flex space-x-2">
//                   {product.images.map((_, index) => (
//                     <button
//                       key={index}
//                       className={`w-2 h-2 rounded-full transition-all duration-200 ${
//                         current === index + 1
//                           ? "bg-white shadow-lg"
//                           : "bg-white/50 hover:bg-white/70"
//                       }`}
//                       onClick={() => api?.scrollTo(index)}
//                       aria-label={`Go to slide ${index + 1}`}
//                     />
//                   ))}
//                 </div>
//               </div>
//               <div className="p-6">
//                 <Badge className="mb-2">{product.availability}</Badge>
//                 <h2 className="text-2xl font-bold mb-1">{product.name}</h2>
//                 <p className="text-sm text-muted-foreground mb-4">
//                   CAS: {product.casNumber}
//                 </p>

//                 <div className="grid grid-cols-2 gap-2 text-sm">
//                   <div>
//                     <p className="font-medium">Purity</p>
//                     <p>{product.purity}</p>
//                   </div>
//                   <div>
//                     <p className="font-medium">Form</p>
//                     <p>{product.form}</p>
//                   </div>
//                   <div>
//                     <p className="font-medium">Origin</p>
//                     <p>{product.manufacturerCountry}</p>
//                   </div>
//                   <div>
//                     <p className="font-medium">Delivery</p>
//                     <p>{product.deliveryInfo.deliveryTerms}</p>
//                   </div>
//                   <div className="col-span-2">
//                     <p className="font-medium">Packaging</p>
//                     <p>{product.packaging}</p>
//                   </div>
//                 </div>
//               </div>
//             </CardContent>
//           </Card>



//           {/* Card burda bitir */}


//           {/* Buton request for loi */}

//           <Dialog open={isRFQOpen} onOpenChange={setIsRFQOpen}>
//             <DialogTrigger asChild>
//               <Button className="w-full mb-4">Request Quotation</Button>
//             </DialogTrigger>
//             <DialogContent className="sm:max-w-[600px]">
//               {/* <RFQForm
//                 productId={product.id}
//                 productName={product.name}
//                 onSubmit={() => setIsRFQOpen(false)}
//               /> */}
//             </DialogContent>
//           </Dialog>

//           <Card>
//             <CardHeader>
//               <CardTitle className="flex items-center gap-2">
//                 <Building2 className="h-5 w-5" /> Supplier Information
//               </CardTitle>
//             </CardHeader>
//             <CardContent>
//               <h3 className="font-bold text-lg">{product.supplier.name}</h3>
//               <p className="text-muted-foreground mb-4">
//                 {product.supplier.location}
//               </p>

//               <div className="space-y-3">
//                 <div>
//                   <p className="font-medium">Certifications</p>
//                   <div className="flex flex-wrap gap-2 mt-1">
//                     {product.supplier.certifications.map((cert, index) => (
//                       <Badge key={index} variant="outline">
//                         {cert}
//                       </Badge>
//                     ))}
//                   </div>
//                 </div>

//                 <div>
//                   <p className="font-medium">Lead Time</p>
//                   <p className="text-sm">{product.supplier.leadTime}</p>
//                 </div>

//                 <div>
//                   <p className="font-medium">Minimum Order</p>
//                   <p className="text-sm">{product.supplier.minOrderQuantity}</p>
//                 </div>
//               </div>
//             </CardContent>
//           </Card>
//         </div>




//         {/* Right Column - Tabs with Detailed Information */}
//         <div className="md:col-span-2">
//           <Card>
//             <CardHeader>
//               <CardTitle>{product.name}</CardTitle>
//               <CardDescription>{product.description}</CardDescription>
//             </CardHeader>
//             <CardContent>
//               <Tabs defaultValue="properties">

//                 <TabsList className="grid grid-cols-5 mb-6">
//                   <TabsTrigger
//                     value="properties"
//                     className="flex items-center gap-2"
//                   >
//                     <Beaker className="h-4 w-4" /> Properties
//                   </TabsTrigger>
//                   <TabsTrigger
//                     value="safety"
//                     className="flex items-center gap-2"
//                   >
//                     <ShieldAlert className="h-4 w-4" /> Safety
//                   </TabsTrigger>
//                   <TabsTrigger
//                     value="delivery"
//                     className="flex items-center gap-2"
//                   >
//                     <Globe className="h-4 w-4" /> Delivery
//                   </TabsTrigger>
//                   <TabsTrigger
//                     value="shipping"
//                     className="flex items-center gap-2"
//                   >
//                     <Truck className="h-4 w-4" /> Shipping
//                   </TabsTrigger>
//                   <TabsTrigger
//                     value="documents"
//                     className="flex items-center gap-2"
//                   >
//                     <FileText className="h-4 w-4" /> Documents
//                   </TabsTrigger>
//                 </TabsList>



                  
                
//                 <TabsContent value="properties">
//                   <div className="grid grid-cols-1 md:grid-cols-2 gap-4">
//                     {product.properties.map((prop, index) => (
//                       <div key={index} className="p-4 border rounded-md">
//                         <p className="font-medium text-sm text-muted-foreground">
//                           {prop.name}
//                         </p>
//                         <p className="font-semibold">{prop.value}</p>
//                       </div>
//                     ))}
//                   </div>
//                 </TabsContent>

//                 <TabsContent value="safety">
//                   <div className="space-y-6">
//                     <div>
//                       <h3 className="text-lg font-semibold mb-2 flex items-center gap-2">
//                         <ShieldAlert className="h-5 w-5 text-destructive" />{" "}
//                         Hazard Classification
//                       </h3>
//                       <Badge variant="destructive" className="mb-4">
//                         {product.safetyInfo.hazardClass}
//                       </Badge>

//                       <h4 className="font-medium mb-2">Hazard Statements</h4>
//                       <ul className="space-y-2 mb-4">
//                         {product.safetyInfo.hazardStatements.map(
//                           (statement, index) => (
//                             <li key={index} className="text-sm">
//                               {statement}
//                             </li>
//                           ),
//                         )}
//                       </ul>

//                       <h4 className="font-medium mb-2">
//                         Precautionary Statements
//                       </h4>
//                       <ul className="space-y-2">
//                         {product.safetyInfo.precautionaryStatements.map(
//                           (statement, index) => (
//                             <li key={index} className="text-sm">
//                               {statement}
//                             </li>
//                           ),
//                         )}
//                       </ul>
//                     </div>

//                     <Separator />

//                     <div>
//                       <h3 className="text-lg font-semibold mb-4">Pictograms</h3>
//                       <div className="flex gap-4">
//                         {product.safetyInfo.pictograms.map(
//                           (pictogram, index) => (
//                             <div
//                               key={index}
//                               className="border p-4 rounded-md w-24 h-24 flex items-center justify-center"
//                             >
//                               <p className="font-bold text-center">
//                                 {pictogram}
//                               </p>
//                             </div>
//                           ),
//                         )}
//                       </div>
//                     </div>
//                   </div>
//                 </TabsContent>

//                 <TabsContent value="delivery">
//                   <div className="space-y-6">
//                     <div>
//                       <h3 className="text-lg font-semibold mb-4 flex items-center gap-2">
//                         <Globe className="h-5 w-5 text-blue-600" /> Available
//                         Delivery Methods
//                       </h3>
//                       {/* <div className="space-y-4">
//                         {Object.entries(
//                           product.deliveryInfo.deliveryMethods,
//                         ).map(([key, method]) => (
//                           <div key={key} className="p-4 border rounded-md">
//                             <h4 className="font-semibold mb-2 uppercase">
//                               {key} - {method.description.split(" - ")[0]}
//                             </h4>
//                             <p className="text-sm mb-2">{method.description}</p>
//                             {method.port && (
//                               <p className="text-sm mb-2">
//                                 <strong>Port:</strong> {method.port}
//                               </p>
//                             )}
//                             {method.sellerResponsibilities && (
//                               <p className="text-sm mb-2">
//                                 <strong>Seller Responsibilities:</strong>{" "}
//                                 {method.sellerResponsibilities}
//                               </p>
//                             )}
//                             {method.buyerResponsibilities && (
//                               <p className="text-sm mb-2">
//                                 <strong>Buyer Responsibilities:</strong>{" "}
//                                 {method.buyerResponsibilities}
//                               </p>
//                             )}
//                             <div className="mt-3 p-2 bg-blue-50 rounded">
//                               <p className="text-sm font-medium text-blue-800">
//                                 Available for: {method.availableFor}
//                               </p>
//                             </div>
//                           </div>
//                         ))}
//                       </div> */}
//                     </div>

//                     <Separator />

//                     <div>
//                       <h3 className="text-lg font-semibold mb-4 flex items-center gap-2">
//                         <Globe className="h-5 w-5 text-green-600" /> Countries
//                         We Can Ship To
//                       </h3>
//                       <div className="grid grid-cols-2 md:grid-cols-3 lg:grid-cols-4 gap-2">
//                         {product.deliveryInfo.availableCountries.map(
//                           (country, index) => (
//                             <div
//                               key={index}
//                               className="p-2 border rounded text-center text-sm"
//                             >
//                               {country}
//                             </div>
//                           ),
//                         )}
//                       </div>
//                     </div>

//                     <Separator />

//                     <div>
//                       <h3 className="text-lg font-semibold mb-4 flex items-center gap-2">
//                         <DollarSign className="h-5 w-5 text-purple-600" />{" "}
//                         Payment Terms
//                       </h3>
//                       <div className="p-4 border rounded-md bg-purple-50">
//                         <p className="font-semibold">
//                           {product.deliveryInfo.paymentTerms}
//                         </p>
//                       </div>
//                     </div>

//                     <Separator />

//                     <div>
//                       <h3 className="text-lg font-semibold mb-4 flex items-center gap-2">
//                         <Scale className="h-5 w-5 text-orange-600" /> Trading
//                         Rules & Conditions
//                       </h3>
//                       <div className="space-y-3">
//                         <div className="p-3 border-l-4 border-blue-500 bg-blue-50">
//                           <p className="font-medium">Quality Assurance</p>
//                           <p className="text-sm">
//                             {product.tradingRules.qualityAssurance}
//                           </p>
//                         </div>
//                         <div className="p-3 border-l-4 border-green-500 bg-green-50">
//                           <p className="font-medium">Inspection</p>
//                           <p className="text-sm">
//                             {product.tradingRules.inspection}
//                           </p>
//                         </div>
//                         <div className="p-3 border-l-4 border-yellow-500 bg-yellow-50">
//                           <p className="font-medium">Storage Requirements</p>
//                           <p className="text-sm">
//                             {product.tradingRules.storage}
//                           </p>
//                         </div>
//                         <div className="p-3 border-l-4 border-orange-500 bg-orange-50">
//                           <p className="font-medium">Shelf Life</p>
//                           <p className="text-sm">
//                             {product.tradingRules.shelfLife}
//                           </p>
//                         </div>
//                         <div className="p-3 border-l-4 border-red-500 bg-red-50">
//                           <p className="font-medium">Returns Policy</p>
//                           <p className="text-sm">
//                             {product.tradingRules.returns}
//                           </p>
//                         </div>
//                         <div className="p-3 border-l-4 border-gray-500 bg-gray-50">
//                           <p className="font-medium">Dispute Resolution</p>
//                           <p className="text-sm">
//                             {product.tradingRules.disputes}
//                           </p>
//                         </div>
//                       </div>
//                     </div>
//                   </div>
//                 </TabsContent>

//                 <TabsContent value="shipping">
//                   <div className="space-y-6">
//                     <div>
//                       <h3 className="text-lg font-semibold mb-4 flex items-center gap-2">
//                         <Package className="h-5 w-5 text-brown-600" /> Packaging
//                         & Loading
//                       </h3>
//                       <div className="grid grid-cols-1 md:grid-cols-2 gap-4">
//                         <div className="p-4 border rounded-md">
//                           <p className="font-medium text-sm text-muted-foreground">
//                             Estimated Delivery
//                           </p>
//                           <p className="font-semibold">
//                             {product.shippingInfo.estimatedDelivery}
//                           </p>
//                         </div>
//                         <div className="p-4 border rounded-md">
//                           <p className="font-medium text-sm text-muted-foreground">
//                             Container Loading
//                           </p>
//                           <p className="font-semibold">
//                             {product.shippingInfo.containerLoading}
//                           </p>
//                         </div>
//                       </div>
//                     </div>

//                     <div>
//                       <h4 className="font-semibold mb-3">
//                         Available Packaging Options
//                       </h4>
//                       <div className="space-y-2">
//                         {product.shippingInfo.packagingOptions.map(
//                           (option, index) => (
//                             <div
//                               key={index}
//                               className="flex items-center gap-2 p-2 border rounded"
//                             >
//                               <Package className="h-4 w-4 text-muted-foreground" />
//                               <span className="text-sm">{option}</span>
//                             </div>
//                           ),
//                         )}
//                       </div>
//                     </div>

//                     <Separator />

//                     <div>
//                       <h4 className="font-semibold mb-3">
//                         Required Documentation
//                       </h4>
//                       <p className="text-sm text-muted-foreground">
//                         {product.shippingInfo.documentation}
//                       </p>
//                     </div>

//                     <div className="p-4 bg-blue-50 border border-blue-200 rounded-md">
//                       <h4 className="font-semibold text-blue-800 mb-2">
//                         Manufacturing Origin
//                       </h4>
//                       <p className="text-blue-700">{product.origin}</p>
//                     </div>
//                   </div>
//                 </TabsContent>

//                 <TabsContent value="documents">
//                   <div className="space-y-4">
//                     {product.documents.map((doc, index) => (
//                       <div
//                         key={index}
//                         className="flex items-center justify-between p-4 border rounded-md"
//                       >
//                         <div className="flex items-center gap-3">
//                           <FileText className="h-5 w-5 text-primary" />
//                           <span>{doc.name}</span>
//                         </div>
//                         <div className="flex gap-2">
//                           <Dialog
//                             open={isDocViewerOpen}
//                             onOpenChange={setIsDocViewerOpen}
//                           >
//                             <DialogTrigger asChild>
//                               <Button
//                                 variant="outline"
//                                 size="sm"
//                                 onClick={() => setIsDocViewerOpen(true)}
//                               >
//                                 <Info className="h-4 w-4 mr-1" /> View
//                               </Button>
//                             </DialogTrigger>
//                             <DialogContent className="max-w-4xl">
//                               {/* <TechnicalDocViewer
//                                 documentName={doc.name}
//                                 documentType={doc.type}
//                               /> */}
//                             </DialogContent>
//                           </Dialog>

//                           <Button variant="outline" size="sm">
//                             <Download className="h-4 w-4 mr-1" /> Download
//                           </Button>
//                         </div>
//                       </div>
//                     ))}
//                   </div>
//                 </TabsContent>


//               </Tabs>



//             </CardContent>
//             <CardFooter className="flex justify-between border-t pt-6">
//               <div className="flex items-center gap-2 text-sm text-muted-foreground">
//                 <Truck className="h-4 w-4" />
//                 <span>Shipping options available worldwide</span>
//               </div>
//               <Button onClick={() => setIsRFQOpen(true)}>
//                 Request Quotation
//               </Button>
//             </CardFooter>
//           </Card>
//         </div>
//       </div>
//     </div>
//   );
// };

// export default ProductDetails;
