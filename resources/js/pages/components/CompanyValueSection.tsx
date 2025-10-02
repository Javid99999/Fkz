import { Card } from '@/components/ui/card'
import { Beaker, Shield, Truck } from 'lucide-react'
import companyval from '../../lang/companyvalue_lang.json'
import { useLang } from '../ContextHelper/LanguageContext'


export const CompanyValueSection = () => {

    const { lang } = useLang();

  return (
    <section className="py-16 px-4 sm:px-6 lg:px-8">
        <div className="container mx-auto flex flex-col gap-8">
            <div className="text-center">
                <h2 className="text-3xl font-bold tracking-tight">
                    {companyval.whyus[lang] ?? companyval.whyus.en}
                </h2>
                <p className="text-muted-foreground mt-2 max-w-2xl mx-auto text-lg">
                    {companyval.tellswhy[lang] ?? companyval.tellswhy.en}
                </p>
            </div>

            <div className="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-3 gap-6">
                <Card className="p-6">
                    <div className="flex flex-col gap-4 items-start sm:items-center text-center sm:text-center">
                        <div className="bg-primary/10 p-3 rounded-full w-fit mx-auto">
                            <Beaker className="h-6 w-6 text-primary" />
                        </div>
                        <h3 className="text-xl font-semibold">{companyval.reasonsF[lang] ?? companyval.reasonsF.en}</h3>
                        <p className="text-muted-foreground">
                            {companyval.reasonsFinfo[lang] ?? companyval.reasonsFinfo.en}
                        </p>
                    </div>
                </Card>

                <Card className="p-6">
                    <div className="flex flex-col gap-4 items-start sm:items-center text-center sm:text-center">
                        <div className="bg-primary/10 p-3 rounded-full w-fit mx-auto">
                            <Shield className="h-6 w-6 text-primary" />
                        </div>
                        <h3 className="text-xl font-semibold">{companyval.reasonsS[lang] ?? companyval.reasonsS.en}</h3>
                        <p className="text-muted-foreground">
                            {companyval.reasonsSinfo[lang] ?? companyval.reasonsSinfo.en}
                        </p>
                    </div>
                </Card>

                <Card className="p-6">
                    <div className="flex flex-col gap-4 items-start sm:items-center text-center sm:text-center">
                        <div className="bg-primary/10 p-3 rounded-full w-fit mx-auto">
                            <Truck className="h-6 w-6 text-primary" />
                        </div>
                        <h3 className="text-xl font-semibold">{companyval.reasonsTh[lang] ?? companyval.reasonsTh.en}</h3>
                        <p className="text-muted-foreground">
                            {companyval.reasonsThinfo[lang] ?? companyval.reasonsThinfo.en}
                        </p>
                    </div>
                </Card>
            </div>
        </div>
    </section>
  )
}