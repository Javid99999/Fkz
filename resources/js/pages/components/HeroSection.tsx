import { Button } from '@/components/ui/button'
import { Link } from '@inertiajs/react'
import langJson from "../../lang/herosection_lang.json"
import { useLang } from '../ContextHelper/LanguageContext';

interface Props {
  onCompanyClick?: () => void;
}

export const HeroSection = ({onCompanyClick} : Props) => {
    const { lang } = useLang();
    return (
        <section className="relative bg-gradient-to-b from-primary/10 to-background py-16 sm:py-20 px-4 sm:px-6 lg:px-8">
            <div className="flex flex-col items-center text-center gap-6 sm:gap-8 max-w-4xl mx-auto">
                
                <h1 className="text-3xl sm:text-4xl md:text-5xl lg:text-6xl font-bold tracking-tight leading-16">
                    {langJson.heropageinfo[lang] ?? langJson.heropageinfo.en} <br />
                    <span className="text-primary">{langJson.heropageinfonext[lang] ?? langJson.heropageinfonext.en}</span>
                </h1>
                <p className="text-lg sm:text-2xl text-muted-foreground max-w-5xl">
                    {langJson.supportinfo[lang] ?? langJson.supportinfo.en}
                </p>
                <div className="flex flex-col sm:flex-row gap-3 sm:gap-4 mt-4 sm:mt-6 w-full sm:w-auto">
                    <Button size="lg" className="text-lg w-full sm:w-auto" asChild>
                        <Link href="/products">{langJson.buton[lang] ?? langJson.buton.en}</Link>
                    </Button>
                    <Button size="lg" variant="outline" className="border-foreground text-lg w-full sm:w-auto" asChild>
                        <Link onClick={(e) => { e.preventDefault(); onCompanyClick?.(); }}>{langJson.butonabout[lang] ?? langJson.butonabout.en}</Link>
                    </Button>
                </div>
            </div>
        </section>
    )
}