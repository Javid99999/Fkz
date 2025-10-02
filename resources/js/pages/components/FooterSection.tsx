import { Link } from '@inertiajs/react'
import { Beaker } from 'lucide-react'
import footerL from "../../lang/footer_lang.json"
import { useLang } from '../ContextHelper/LanguageContext';

export const FooterSection = () => {
    const { lang } = useLang();
  return (
    <footer className="border-t py-12 bg-muted/30 px-4 sm:px-6 lg:px-8">
        <div className="container mx-auto">
            <div className="grid grid-cols-1 sm:grid-cols-2 md:grid-cols-3 gap-62">
                <div className="flex flex-col gap-4">
                    <div className="flex items-center gap-2">
                        <Beaker className="h-6 w-6 text-primary" />
                        <span className="text-xl font-bold">Fks</span>
                    </div>
                    <p className="text-muted-foreground text-sm sm:text-base">
                        {footerL.providingHighQuality[lang] ?? footerL.providingHighQuality.en}
                    </p>
                </div>

                {/* <div>
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
                </div> */}

                <div>
                    <h3 className="font-semibold mb-4">{footerL.company[lang] ?? footerL.company.en}</h3>
                    <ul className="space-y-2">
                        <li>
                            <Link href={route('products.about')} className="text-muted-foreground hover:text-primary underline">
                                {footerL.aboutUs[lang] ?? footerL.aboutUs.en}
                            </Link>
                        </li>
                        <li>
                            <Link href={route('products.index')} className="text-muted-foreground hover:text-primary underline">
                                {footerL.viewOurProducts[lang] ?? footerL.viewOurProducts.en}
                            </Link>
                        </li>
                        
                    </ul>
                </div>

                <div>
                    <h3 className="font-semibold mb-4">{footerL.contact[lang] ?? footerL.contact.en}</h3>
                    <ul className="space-y-2 text-sm sm:text-base"> 
                        <li className="text-muted-foreground">Sumgait, 5000, settlement G. Zeynalabdin.</li>
                        <li className="text-muted-foreground">Guba-Baku highway-35.1A</li>
                        <li className="text-muted-foreground">+994(50) 327-50-72</li>
                    </ul>
                </div>
            </div>

            <div className="border-t mt-8 pt-8 flex flex-col sm:flex-row justify-center items-center gap-4">
                <p className="text-sm text-muted-foreground">
                    {footerL.allRightReserved[lang] ?? footerL.allRightReserved.en}
                </p>
                {/* <div className="flex flex-wrap gap-4 justify-center sm:justify-end">
                    <Link href="/terms" className="text-sm text-muted-foreground hover:text-primary">
                        Terms of Service
                    </Link>
                    <Link href="/privacy" className="text-sm text-muted-foreground hover:text-primary">
                        Privacy Policy
                    </Link>
                    <Link href="/safety" className="text-sm text-muted-foreground hover:text-primary">
                        Safety Data Sheets
                    </Link>
                </div> */}
            </div>
        </div>
    </footer>
  )
}