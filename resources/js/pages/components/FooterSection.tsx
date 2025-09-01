import { Link } from '@inertiajs/react'
import { Beaker } from 'lucide-react'

export const FooterSection = () => {
  return (
    <footer className="border-t py-12 bg-muted/30 px-4 sm:px-6 lg:px-8">
        <div className="container mx-auto">
            <div className="grid grid-cols-1 sm:grid-cols-2 md:grid-cols-4 gap-8">
                <div className="flex flex-col gap-4">
                    <div className="flex items-center gap-2">
                        <Beaker className="h-6 w-6 text-primary" />
                        <span className="text-xl font-bold">ChemCorp</span>
                    </div>
                    <p className="text-muted-foreground text-sm sm:text-base">
                        Providing high-quality chemical solutions for industrial and
                        laboratory applications since 1985.
                    </p>
                </div>

                <div>
                    <h3 className="font-semibold mb-4">Products</h3>
                    <ul className="space-y-2">
                        <li>
                            <Link href="/products/solvents" className="text-muted-foreground hover:text-primary">
                                Solvents
                            </Link>
                        </li>
                        <li>
                            <Link href="/products/reagents" className="text-muted-foreground hover:text-primary">
                                Reagents
                            </Link>
                        </li>
                        <li>
                            <Link href="/products/additives" className="text-muted-foreground hover:text-primary">
                                Additives
                            </Link>
                        </li>
                        <li>
                            <Link href="/products/custom" className="text-muted-foreground hover:text-primary">
                                Custom Solutions
                            </Link>
                        </li>
                    </ul>
                </div>

                <div>
                    <h3 className="font-semibold mb-4">Company</h3>
                    <ul className="space-y-2">
                        <li>
                            <Link href="/company/about" className="text-muted-foreground hover:text-primary">
                                About Us
                            </Link>
                        </li>
                        <li>
                            <Link href="/company/facilities" className="text-muted-foreground hover:text-primary">
                                Facilities
                            </Link>
                        </li>
                        <li>
                            <Link href="/company/certifications" className="text-muted-foreground hover:text-primary">
                                Certifications
                            </Link>
                        </li>
                        <li>
                            <Link href="/company/careers" className="text-muted-foreground hover:text-primary">
                                Careers
                            </Link>
                        </li>
                    </ul>
                </div>

                <div>
                    <h3 className="font-semibold mb-4">Contact</h3>
                    <ul className="space-y-2 text-sm sm:text-base">
                        <li className="text-muted-foreground">123 Kimya Küçəsi</li>
                        <li className="text-muted-foreground">Sənaye Parkı, Bakı AZ1001</li>
                        <li className="text-muted-foreground">info@blahblah.com</li>
                        <li className="text-muted-foreground">(555) 123-4567</li>
                    </ul>
                </div>
            </div>

            <div className="border-t mt-8 pt-8 flex flex-col sm:flex-row justify-between items-center gap-4">
                <p className="text-sm text-muted-foreground">
                    © 2025 ChemCorp. All rights reserved.
                </p>
                <div className="flex flex-wrap gap-4 justify-center sm:justify-end">
                    <Link href="/terms" className="text-sm text-muted-foreground hover:text-primary">
                        Terms of Service
                    </Link>
                    <Link href="/privacy" className="text-sm text-muted-foreground hover:text-primary">
                        Privacy Policy
                    </Link>
                    <Link href="/safety" className="text-sm text-muted-foreground hover:text-primary">
                        Safety Data Sheets
                    </Link>
                </div>
            </div>
        </div>
    </footer>
  )
}