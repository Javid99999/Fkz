import { Tabs, TabsContent, TabsList, TabsTrigger } from "@/components/ui/tabs";
import companyOverview from "../../lang/companyOverview_lang.json"
import { useLang } from '../ContextHelper/LanguageContext';
import React, { forwardRef } from 'react'


interface CompanyOverviewProps {
  tab: string
  overview: {
    data: {
      name: string
      description: string
      img_url: string
    }
  }
  onTabChange: (newTab: string) => void
}


export const CompanyOverview = forwardRef<HTMLDivElement, CompanyOverviewProps>(
  ({ tab, overview, onTabChange }, ref) => {

    const { lang } = useLang();
  return (
    <section ref={ref} className="py-16 bg-muted/50 px-4 sm:px-6 lg:px-8">
        <div className="container mx-auto flex flex-col gap-8">
            <div className="text-center">
                <h2 className="text-3xl font-bold tracking-tight">{companyOverview.companySnapshot[lang] ?? companyOverview.companySnapshot.en}</h2>
                <p className="text-muted-foreground mt-2 max-w-2xl mx-auto">
                    {companyOverview.oneExampleEach[lang] ?? companyOverview.oneExampleEach.en}
                </p>
            </div>


        <Tabs value={tab ?? 'expertise'} onValueChange={onTabChange} className="w-full">
            <TabsList className="flex w-full sm:grid sm:grid-cols-3 sm:overflow-visible gap-0">
                <TabsTrigger className="whitespace-nowrap flex-1 sm:flex-auto" value="expertise">
                    {companyOverview.expertise[lang] ?? companyOverview.expertise.en}
                </TabsTrigger>
                <TabsTrigger className="whitespace-nowrap flex-1 sm:flex-auto" value="facilities">
                    {companyOverview.facilities[lang] ?? companyOverview.facilities.en}
                </TabsTrigger>
                <TabsTrigger className="whitespace-nowrap flex-1 sm:flex-auto" value="certifications">
                    {companyOverview.certifications[lang] ?? companyOverview.certifications.en}
                </TabsTrigger>
            </TabsList>

          <TabsContent value="expertise" className="mt-6">
            {tab === 'expertise' && (
              <div className="flex flex-col md:flex-row gap-6 md:gap-8">
                <div className="md:w-1/2">
                  <img
                    src={overview.data.img_url}
                    alt="expertise"
                    className="rounded-lg w-full h-64 sm:h-72 md:h-80 object-cover"
                  />
                </div>
                <div className="md:w-1/2 flex flex-col gap-4">
                  <h3 className="text-2xl font-semibold">{overview.data.name}</h3>
                  <p className="text-muted-foreground">{overview.data.description}</p>
                </div>
              </div>
            )}
          </TabsContent>

          <TabsContent value="facilities" className="mt-6">
            {tab === 'facilities' && (
              <div className="flex flex-col md:flex-row gap-6 md:gap-8">
                <div className="md:w-1/2">
                  <img
                    src={overview.data.img_url}
                    alt="facilities"
                    className="rounded-lg w-full h-64 sm:h-72 md:h-80 object-cover"
                  />
                </div>
                <div className="md:w-1/2 flex flex-col gap-4">
                  <h3 className="text-2xl font-semibold">{overview.data.name}</h3>
                  <p className="text-muted-foreground">{overview.data.description}</p>
                </div>
              </div>
            )}
          </TabsContent>

          <TabsContent value="certifications" className="mt-6">
            {tab === 'certifications' && (
              <div className="flex flex-col md:flex-row gap-6 md:gap-8">
                <div className="md:w-1/2">
                  <img
                    src={overview.data.img_url}
                    alt="certifications"
                    className="rounded-lg w-full h-64 sm:h-72 md:h-80 object-cover"
                  />
                </div>
                <div className="md:w-1/2 flex flex-col gap-4">
                  <h3 className="text-2xl font-semibold">{overview.data.name}</h3>
                  <p className="text-muted-foreground">{overview.data.description}</p>
                </div>
              </div>
            )}
          </TabsContent>
        </Tabs>

            
        </div>
    </section>
  )
})

















{/* <Tabs defaultValue="expertise" className="w-full">
                <TabsList className="grid grid-cols-1 sm:grid-cols-3 w-full">
                    <TabsTrigger value="expertise">{companyOverview.expertise[lang] ?? companyOverview.expertise.en}</TabsTrigger>
                    <TabsTrigger value="facilities">{companyOverview.facilities[lang] ?? companyOverview.facilities.en}</TabsTrigger>
                    <TabsTrigger value="certifications">{companyOverview.certifications[lang] ?? companyOverview.certifications.en}</TabsTrigger>
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
                                    </>
                                )}
                            </div>
                        </div>
                    </TabsContent>
                ))}
            </Tabs> */}