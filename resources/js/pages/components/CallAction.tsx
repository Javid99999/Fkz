import { Button } from '@/components/ui/button'
import { Link } from '@inertiajs/react'
import { Phone } from 'lucide-react'
import letstalk from '../../lang/callaction_lang.json'
import { useLang } from '../ContextHelper/LanguageContext'

export const CallAction = () => {
    const {lang} = useLang();
  return (
    <section className="py-16 bg-primary/10 px-4 sm:px-6 lg:px-8">
        <div className="container mx-auto flex flex-col items-center text-center gap-6">
            <div className="bg-primary/20 p-4 rounded-full">
                <Phone className="h-8 w-8 text-primary" />
            </div>
            <h2 className="text-3xl font-bold tracking-tight">
                {letstalk.preperedforcall[lang] ?? letstalk.preperedforcall.en}
            </h2>
            <p className="text-xl text-muted-foreground max-w-2xl">
                {letstalk.techteam[lang] ?? letstalk.techteam.en}
            </p>
            <Button size="lg" className="mt-4 text-md" asChild>
                <Link href={route('company.contact')}>{letstalk.contactustoday[lang] ?? letstalk.contactustoday.en}</Link>
            </Button>
        </div>
    </section>
  )
}