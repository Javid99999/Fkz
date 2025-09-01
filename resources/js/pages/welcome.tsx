import AppNavbarLayout from "@/layouts/app/app-navbar-layout";
import { Head } from "@inertiajs/react";
import { HeroSection } from "./components/HeroSection";
import { FeatuedProductSection } from "./components/FeatuedProductSection";
import { CompanyValueSection } from "./components/CompanyValueSection";
import { CompanyOverview } from "./components/CompanyOverview";
import { CallAction } from "./components/CallAction";
import { FooterSection } from "./components/FooterSection";


const Home = () => {
  return (
    <div className="min-h-screen bg-background">
        <AppNavbarLayout>
            <Head title="FuadKimya" />
        </AppNavbarLayout>

        <HeroSection />

        <FeatuedProductSection />

        <CompanyValueSection />

        <CompanyOverview />

        <CallAction />

        <FooterSection />
    </div>
  );
};

export default Home;