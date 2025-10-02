import AppNavbarLayout from "@/layouts/app/app-navbar-layout";
import { Head, router, usePage } from "@inertiajs/react";
import { HeroSection } from "./components/HeroSection";
import { FeatuedProductSection } from "./components/FeatuedProductSection";
import { CompanyValueSection } from "./components/CompanyValueSection";
import { CompanyOverview } from "./components/CompanyOverview";
import { CallAction } from "./components/CallAction";
import { FooterSection } from "./components/FooterSection";
import { BasicProductInfo } from "@/types";
import { useRef } from "react";


export interface OverviewData {
  name: string;
  description: string;
  img_url: string;
}

export interface PageProps {
  tab: string
  overview: {
    data: OverviewData | null
  }
  products: BasicProductInfo[];
  [key: string]: unknown;
}

const Home = () => {
  const { tab, overview, products } = usePage<PageProps>().props;

  
  // const { tab, overview } = usePage<PageProps>().props

  const handleTabChange = (newTab: string) => {
    router.visit(route('home', { tab: newTab }), {
      preserveScroll: true,
      preserveState: true,
    })
  }
  const overviewRef = useRef<HTMLDivElement>(null);
 
  const handleScrollToCompany = () => {
    overviewRef.current?.scrollIntoView({ behavior: 'smooth' });
  }
  

  return (
    <div className="min-h-screen bg-background">
        <AppNavbarLayout>
            <Head title="FuadKimya" />
        </AppNavbarLayout>

        <HeroSection onCompanyClick={handleScrollToCompany} />

        <FeatuedProductSection products={products} />

        <CompanyValueSection />

        <CompanyOverview ref={overviewRef} tab={tab} overview={overview} onTabChange={handleTabChange} />

        <CallAction />

        <FooterSection />
    </div>
  );
};

export default Home;