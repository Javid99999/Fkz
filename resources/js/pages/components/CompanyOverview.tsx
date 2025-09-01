import React from 'react'
import { Tabs, TabsContent, TabsList, TabsTrigger } from "@/components/ui/tabs";
import { Button } from '@/components/ui/button';
import { Link } from '@inertiajs/react';

export const CompanyOverview = () => {
  return (
    <section className="py-16 bg-muted/50 px-4 sm:px-6 lg:px-8">
        <div className="container mx-auto flex flex-col gap-8">
            <div className="text-center">
                <h2 className="text-3xl font-bold tracking-tight">Our Company</h2>
                <p className="text-muted-foreground mt-2 max-w-2xl mx-auto">
                    Learn more about our expertise, facilities, and industry
                    certifications
                </p>
            </div>

            <Tabs defaultValue="expertise" className="w-full">
                <TabsList className="grid grid-cols-1 sm:grid-cols-3 w-full">
                    <TabsTrigger value="expertise">Expertise</TabsTrigger>
                    <TabsTrigger value="facilities">Facilities</TabsTrigger>
                    <TabsTrigger value="certifications">Certifications</TabsTrigger>
                </TabsList>

                {['expertise', 'facilities', 'certifications'].map((tab) => (
                    <TabsContent key={tab} value={tab} className="mt-6">
                        <div className="flex flex-col md:flex-row gap-6 md:gap-8">
                            <div className="md:w-1/2">
                                <img
                                    src={
                                        tab === 'expertise'
                                            ? "https://images.unsplash.com/photo-1581093450021-4a7360e9a6b5?w=800&q=80"
                                            : tab === 'facilities'
                                            ? "https://images.unsplash.com/photo-1581092918056-0c4c3acd3789?w=800&q=80"
                                            : "https://images.unsplash.com/photo-1454165804606-c3d57bc86b40?w=800&q=80"
                                    }
                                    alt={tab}
                                    className="rounded-lg w-full h-64 sm:h-72 md:h-80 object-cover"
                                />
                            </div>
                            <div className="md:w-1/2 flex flex-col gap-4">
                                {tab === 'expertise' && (
                                    <>
                                        <h3 className="text-2xl font-semibold">Industry-Leading Expertise</h3>
                                        <p className="text-muted-foreground">
                                            Our team of experienced chemists and engineers brings
                                            decades of combined experience in chemical formulation,
                                            process optimization, and application development.
                                        </p>
                                        <Button variant="outline" asChild>
                                            <Link href="/company">Learn More About Our Team</Link>
                                        </Button>
                                    </>
                                )}
                                {tab === 'facilities' && (
                                    <>
                                        <h3 className="text-2xl font-semibold">State-of-the-Art Facilities</h3>
                                        <p className="text-muted-foreground">
                                            Our modern manufacturing facilities are equipped with
                                            advanced production and testing equipment to ensure
                                            consistent product quality.
                                        </p>
                                        <Button variant="outline" asChild>
                                            <Link href="/company">View Our Facilities</Link>
                                        </Button>
                                    </>
                                )}
                                {tab === 'certifications' && (
                                    <>
                                        <h3 className="text-2xl font-semibold">Industry Certifications</h3>
                                        <p className="text-muted-foreground">
                                            ChemCorp maintains ISO 9001:2015 certification for quality
                                            management systems and ISO 14001:2015 for environmental
                                            management.
                                        </p>
                                        <Button variant="outline" asChild>
                                            <Link href="/company">View Our Certifications</Link>
                                        </Button>
                                    </>
                                )}
                            </div>
                        </div>
                    </TabsContent>
                ))}
            </Tabs>
        </div>
    </section>
  )
}