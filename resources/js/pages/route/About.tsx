import { Badge } from "@/components/ui/badge";
import { Card, CardContent, CardHeader, CardTitle } from "@/components/ui/card";
import AppNavbarLayout from "@/layouts/app/app-navbar-layout";
import { Head } from "@inertiajs/react";
import { FooterSection } from "../components/FooterSection";
import aboutfks from '../../lang/about_lang.json'
import { useLang } from "../ContextHelper/LanguageContext";

export default function About() {
    const { lang } = useLang();
    return (
        <div className="min-h-screen bg-background">

            <AppNavbarLayout>
                <Head title="Products" />
            </AppNavbarLayout>

            <div className="bg-background min-h-screen py-12 px-4 sm:px-6">
                <div className="max-w-6xl mx-auto">

                    {/* Hero Section */}
                    <div className="text-center mb-12 sm:mb-16 px-2 sm:px-0">
                        <h1 className="text-3xl sm:text-4xl font-bold text-foreground mb-4 sm:mb-6">
                            {aboutfks.aboutFks[lang] ?? aboutfks.aboutFks.en}
                        </h1>
                        <p className="text-lg sm:text-xl text-muted-foreground max-w-3xl mx-auto">
                            {aboutfks.connectionChemicaluppliers[lang] ?? aboutfks.connectionChemicaluppliers.en}
                        </p>
                    </div>

                    {/* Mission & Vision */}
                    <div className="grid grid-cols-1 md:grid-cols-2 gap-6 md:gap-8 mb-12 md:mb-16">
                        <Card>
                            <CardHeader>
                                <CardTitle className="text-2xl mt-2">
                                    {aboutfks.ourMission[lang] ?? aboutfks.ourMission.en}
                                </CardTitle>
                            </CardHeader>
                            <CardContent>
                                <p className="text-muted-foreground mb-2">
                                    {aboutfks.toRevolutionize[lang] ?? aboutfks.toRevolutionize.en}
                                </p>
                            </CardContent>
                        </Card>

                        <Card>
                            <CardHeader>
                                <CardTitle className="text-2xl mt-2">
                                    {aboutfks.ourVision[lang] ?? aboutfks.ourVision.en}
                                </CardTitle>
                            </CardHeader>
                            <CardContent>
                                <p className="text-muted-foreground mb-2">
                                    {aboutfks.toBecomeTheGlobalLeader[lang] ?? aboutfks.toBecomeTheGlobalLeader.en}
                                </p>
                            </CardContent>
                        </Card>
                    </div>

                    {/* Key Features */}
                    <div className="mb-12 md:mb-16">
                        <h2 className="text-2xl sm:text-3xl font-bold text-center mb-8 sm:mb-12">
                            {aboutfks.whyChooseFks[lang] ?? aboutfks.whyChooseFks.en}
                        </h2>
                        <div className="grid grid-cols-1 sm:grid-cols-2 md:grid-cols-3 gap-6 md:gap-8">
                            <Card>
                                <CardHeader>
                                    <CardTitle className="text-xl mt-2">
                                        {aboutfks.safetyFirst[lang] ?? aboutfks.safetyFirst.en}
                                    </CardTitle>
                                </CardHeader>
                                <CardContent>
                                    <p className="text-muted-foreground mb-4">
                                        {aboutfks.completeSDS[lang] ?? aboutfks.completeSDS.en}
                                    </p>
                                    <div className="flex flex-wrap gap-2 mb-2">
                                        <Badge variant="secondary">{aboutfks.sdsVerified[lang] ?? aboutfks.sdsVerified.en}</Badge>
                                        <Badge variant="secondary">{aboutfks.safetyCertified[lang] ?? aboutfks.safetyCertified.en}</Badge>
                                    </div>
                                </CardContent>
                            </Card>

                            <Card>
                                <CardHeader>
                                    <CardTitle className="text-xl mt-2">
                                        {aboutfks.globalNetwork[lang] ?? aboutfks.globalNetwork.en}
                                    </CardTitle>
                                </CardHeader>
                                <CardContent>
                                    <p className="text-muted-foreground mb-4">
                                        {aboutfks.connectWithVerified[lang] ?? aboutfks.connectWithVerified.en}
                                    </p>
                                    <div className="flex flex-wrap gap-2 mb-2">
                                        <Badge variant="secondary">{aboutfks.fiveZeroPlusCountries[lang] ?? aboutfks.fiveZeroPlusCountries.en}</Badge>
                                        <Badge variant="secondary">{aboutfks.thothousandPlusSuppliers[lang] ?? aboutfks.thothousandPlusSuppliers.en}</Badge>
                                    </div>
                                </CardContent>
                            </Card>

                            <Card>
                                <CardHeader>
                                    <CardTitle className="text-xl mt-2">
                                        {aboutfks.transparentTrading[lang] ?? aboutfks.transparentTrading.en}
                                    </CardTitle>
                                </CardHeader>
                                <CardContent>
                                    <p className="text-muted-foreground mb-4">
                                        {aboutfks.clearPricingSpecifications[lang] ?? aboutfks.clearPricingSpecifications.en}
                                    </p>
                                    <div className="flex flex-wrap gap-2 mb-2">
                                        <Badge variant="secondary">{aboutfks.realRimeUpdates[lang] ?? aboutfks.realRimeUpdates.en}</Badge>
                                        <Badge variant="secondary">{aboutfks.verifiedData[lang] ?? aboutfks.verifiedData.en}</Badge>
                                    </div>
                                </CardContent>
                            </Card>
                        </div>
                    </div>

                    {/* Team Section */}
                    <div className="text-center px-2 sm:px-0">
                        <h2 className="text-2xl sm:text-3xl font-bold mb-6 sm:mb-8">
                            {aboutfks.ourCommitment[lang] ?? aboutfks.ourCommitment.en}
                        </h2>
                        <p className="text-lg sm:text-xl text-muted-foreground max-w-4xl mx-auto">
                            {aboutfks.weAreCommittedToMaintaining[lang] ?? aboutfks.weAreCommittedToMaintaining.en}
                        </p>
                    </div>

                </div>
            </div>

            <FooterSection />
        </div>
    )
}
