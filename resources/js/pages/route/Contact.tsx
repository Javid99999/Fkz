import { Card, CardContent, CardHeader, CardTitle } from "@/components/ui/card";
import AppNavbarLayout from "@/layouts/app/app-navbar-layout";
import { Head } from "@inertiajs/react";
import { MapPin, Phone, Mail, User } from "lucide-react";
import { FooterSection } from "../components/FooterSection";

export default function Contact() {
  return (
    
    <div className="bg-background">
        <AppNavbarLayout>
            <Head title="Products" />
        </AppNavbarLayout>

        <div className="bg-background py-16 px-4">

            <div className="max-w-6xl mx-auto">
        {/* Header */}
        <div className="text-center mb-16">
          <h1 className="text-4xl font-bold text-foreground mb-6">
            Contact Us
          </h1>
          <p className="text-xl text-muted-foreground">
            Get in touch with our team for support or inquiries
          </p>
        </div>

        {/* Main Contact Information */}
        <div className="grid md:grid-cols-2 gap-8 mb-16">
          {/* Phone */}
          <Card>
            <CardHeader className="text-center mt-4">
              <Phone className="h-12 w-12 text-primary mx-auto mb-2" />
              <CardTitle className="text-xl">Phone</CardTitle>
            </CardHeader>
            <CardContent className="text-center">
              <p className="text-2xl font-semibold text-foreground">
                +994 (50) 327-50-72
              </p>
              <p className="text-lg font-medium text-primary mt-2 mb-4">
                Bagirov Bagir - Supervisor
              </p>
              <div className="flex items-center justify-center gap-2 mb-2">
                <Mail className="h-4 w-4 text-primary" />
                <p className="text-lg font-semibold">bagir.bagirov@fks.az</p>
              </div>
              
            </CardContent>
          </Card>

          {/* Address */}
          <Card>
            <CardHeader className="text-center mt-4">
              <MapPin className="h-12 w-12 text-primary mx-auto mb-4" />
              <CardTitle className="text-xl">Address</CardTitle>
            </CardHeader>
            <CardContent className="text-center">
              <p className="text-lg font-semibold text-foreground">
                Fks
              </p>
              <p className="text-muted-foreground">
                Sumgait, 5000, settlement G. Zeynalabdin. Guba-Baku highway-35.1A<br />
                Azerbaijan
              </p>
            </CardContent>
          </Card>

        </div>

        {/* Contact Persons */}
        <div className="mb-16">
          <h2 className="text-3xl font-bold text-center mb-8">Our Team</h2>
          <div className="grid md:grid-cols-2 gap-8">
            {/* Contact Person 1 */}
            <Card>
              <CardHeader className="text-center">
                <User className="h-16 w-16 text-primary mx-auto mb-4 mt-4" />
                <CardTitle className="text-2xl">Javad Javadov</CardTitle>
                <p className="text-muted-foreground">Deputy Head of Global Business Relations</p>
              </CardHeader>
              <CardContent className="text-center space-y-3">
                <div className="flex items-center justify-center gap-2">
                  <Phone className="h-4 w-4 text-primary" />
                  <p className="text-lg font-semibold">+994(50) 212-39-77</p>
                </div>
                <div className="flex items-center justify-center gap-2">
                  <Mail className="h-4 w-4 text-primary" />
                  <p className="text-lg font-semibold">javad.javadov@fks.az</p>
                </div>
                <p className="text-sm text-muted-foreground mt-4 mb-4">
                  Coordinates cross-border sourcing and supplier engagement for key inputs.
                </p>
              </CardContent>
            </Card>

            {/* Contact Person 2 */}
            <Card>
              <CardHeader className="text-center">
                <User className="h-16 w-16 text-primary mx-auto mb-4 mt-4" />
                <CardTitle className="text-2xl">Sahib Musayev</CardTitle>
                <p className="text-muted-foreground">Technical Support Lead</p>
              </CardHeader>
              <CardContent className="text-center space-y-3">
                <div className="flex items-center justify-center gap-2">
                  <Phone className="h-4 w-4 text-primary" />
                  <p className="text-lg font-semibold">not mentioned</p>
                </div>
                <div className="flex items-center justify-center gap-2">
                  <Mail className="h-4 w-4 text-primary" />
                  <p className="text-lg font-semibold">sahib.musayev@fks.az</p>
                </div>
                <p className="text-sm text-muted-foreground mt-4">
                  Expert in safety compliance and technical documentation
                </p>
              </CardContent>
            </Card>
          </div>
        </div>

        {/* Emergency Contact */}
        {/* <div className="text-center">
          <Card className="bg-muted">
            <CardContent className="p-8">
              <h3 className="text-2xl font-bold mb-4">Emergency Support</h3>
              <p className="text-muted-foreground mb-4">
                For urgent safety or compliance issues
              </p>
              <p className="text-xl font-semibold text-primary">
                +1 (555) 911-CHEM
              </p>
              <p className="text-sm text-muted-foreground mt-2">
                Available 24/7
              </p>
            </CardContent>
          </Card>
        </div> */}


      </div>


        </div>


        <FooterSection />
    </div>

  );
}