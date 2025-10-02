
import { Separator } from '@/components/ui/separator';
import { Globe, Scale } from 'lucide-react';
import { useLang } from '../ContextHelper/LanguageContext';
import langs from "../../lang/productdelivery_lang.json"
import { DeliveryPayload } from '@/types';

const DeliveryData: React.FC<DeliveryPayload> = ({ delivery_methods = [], available_countries = [], productTerms = [] }) => {

    const {lang} = useLang();

    return (
        <>
            
            <div className="space-y-6 mb-4">
                <div>
                    <h3 className='text-lg font-semibold mb-4 flex items-center gap-2'>
                        <Globe className="h-5 w-5 text-blue-600" /> {langs.deliverAvailable[lang] ?? langs.deliverAvailable.en}
                    </h3>
                    <div className="space-y-4">
                        {delivery_methods.map((deliver) => (
                            <div key={deliver.id} className="p-4 border rounded-md">
                                <h4 className='font-semibold mb-2 uppercase'>
                                    {deliver.code} - {deliver.expansion}
                                </h4>
                                <p className="text-md mb-2">{deliver.description}</p>
                                {deliver.extradetail.availability_type && deliver.extradetail.location_name && (
                                    <p className="text-md mb-2">
                                        <strong>{deliver.extradetail.availability_type}: </strong>
                                        {deliver.extradetail.location_name}
                                    </p>
                                )}
                                {deliver.responsib.filter((ddel) => ddel.responsi_type === 'seller').map((ddel) =>(
                                    <p key={ddel.id} className="text-md mb-2">
                                        <strong>Seller Responsibilities:</strong>{"  "}
                                        {ddel.responsibility}
                                    </p>
                                    
                                ))}
                                {deliver.responsib.filter((ddel) => ddel.responsi_type === 'buyer').map((ddel) =>(
                                    <p key={ddel.id} className="text-md mb-2">
                                        <strong>Buyer Responsibilities:</strong>{"  "}
                                        {ddel.responsibility}
                                    </p>
                                    
                                ))}
                                <div className="mt-3 p-2 bg-blue-50 rounded">
                                    <p className="text-md font-medium text-blue-800">
                                        {langs.availableFor[lang] ?? langs.availableFor.en}: {deliver.extradetail.specific_details}
                                    </p>
                                </div>
                            </div>
                        ))}
                    </div>

                </div>

                <Separator />
                    
                <div>

                    <h3 className="text-lg font-semibold mb-4 flex items-center gap-2">
                        <Globe className="h-5 w-5 text-green-600" /> {langs.countriesWeCanShip[lang] ?? langs.countriesWeCanShip.en}
                    </h3>
                    <div className="grid grid-cols-2 md:grid-cols-3 lg:grid-cols-4 gap-2">
                        {available_countries.map((country) => (
                            <div key={country.id} className="p-2 border rounded text-sm">
                                {country.name}
                            </div>
                        ))}
                    </div>


                </div>

                <Separator />


                <div>

                    <h3 className="text-lg font-semibold mb-4 flex items-center gap-2">
                        <Scale className="h-5 w-5 text-orange-600" /> {langs.tradingTerms[lang] ?? langs.tradingTerms.en}
                    </h3>
                    <div className='space-y-3'>
                        {productTerms.map((terms) => (
                            <div
                                key={terms.id}
                                className={`p-3 border-l-4 border-${terms.color}-500 bg-${terms.color}-50`}
                            >
                                <p className="font-medium">{terms.name}</p>
                                <p className="text-sm">{terms.description}</p>
                            </div>
                        ))}
                    </div>

                </div>








            </div>
            
        </>
    );

}
export default DeliveryData;
