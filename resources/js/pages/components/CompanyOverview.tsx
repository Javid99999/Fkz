import { Tabs, TabsContent, TabsList, TabsTrigger } from "@/components/ui/tabs";
import companyOverview from "../../lang/companyOverview_lang.json";
import { useLang } from '../ContextHelper/LanguageContext';
import React, { forwardRef } from 'react';

interface CompanyOverviewProps {
  tab: string;
  overview?: {
    data?: {
      name?: string;
      description?: string;
      img_url?: string;
    }
  };
  onTabChange: (newTab: string) => void;
}

export const CompanyOverview = forwardRef<HTMLDivElement, CompanyOverviewProps>(
  ({ tab, overview, onTabChange }, ref) => {
    const { lang } = useLang();

    // fallback ile güvenli objeyi oluştur
    const safeOverview = overview?.data ?? {
      name: '—',
      description: companyOverview.noDesc[lang] ?? companyOverview.noDesc.en,
      img_url: '/imgs/productimagecomingsoon.jpeg',
    };

    return (
      <section ref={ref} className="py-16 bg-muted/50 px-4 sm:px-6 lg:px-8">
        <div className="container mx-auto flex flex-col gap-8">
          <div className="text-center">
            <h2 className="text-3xl font-bold tracking-tight">
              {companyOverview.companySnapshot[lang] ?? companyOverview.companySnapshot.en}
            </h2>
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

            {['expertise', 'facilities', 'certifications'].map((t) => (
              <TabsContent key={t} value={t} className="mt-6">
                {tab === t && (
                  <div className="flex flex-col md:flex-row gap-6 md:gap-8">
                    <div className="md:w-1/2">
                      <img
                        src={safeOverview.img_url}
                        alt={t}
                        className="rounded-lg w-full h-64 sm:h-72 md:h-80 object-cover"
                      />
                    </div>
                    <div className="md:w-1/2 flex flex-col gap-4">
                      <h3 className="text-2xl font-semibold">{safeOverview.name}</h3>
                      <p className="text-muted-foreground">{safeOverview.description}</p>
                    </div>
                  </div>
                )}
              </TabsContent>
            ))}
          </Tabs>
        </div>
      </section>
    );
  }
);
