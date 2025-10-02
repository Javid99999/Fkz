import { ShippingPayload } from '@/types'
import { Package } from 'lucide-react'
import React from 'react'
import langs from "../../lang/shippinglang_lang.json"
import { useLang } from '../ContextHelper/LanguageContext';
import { Separator } from '@radix-ui/react-separator';

const ShipmentData: React.FC<ShippingPayload> = ({ loadsend, wrapping, reqdocks, country }) => {
  
  const {lang} = useLang();

  

  return (
    <div className="space-y-6">

      <div>

        <h3 className="text-lg font-semibold mb-4 flex items-center gap-2">
            <Package className="h-5 w-5 text-brown-600" />{langs.packagingLoading[lang] ?? langs.packagingLoading.en}
        </h3>
        <div className="grid grid-cols-1 md:grid-cols-2 gap-4">

          <div className="p-4 border rounded-md">
            <p className="font-medium text-sm text-muted-foreground">
              {langs.estimatedDelivery[lang] ?? langs.estimatedDelivery.en}
            </p>
            <p className="font-semibold">
              {loadsend.deliver}
            </p>
          </div>

          <div className="p-4 border rounded-md">
            <p className="font-medium text-sm text-muted-foreground">
              {langs.containerLoading[lang] ?? langs.containerLoading.en}
            </p>
            <p className="font-semibold">
              {loadsend.loading}
            </p>
          </div>
          
        </div>

      </div>


      <div>
        <h4 className="font-semibold mb-3">
          {langs.availablePackagingOprions[lang] ?? langs.availablePackagingOprions.en}
        </h4>

        <div>
          {wrapping.map((packs) => (
            <div key={packs.id} className="flex items-center gap-2 p-2 border rounded">
              <Package className="h-4 w-4 text-muted-foreground" />
                <span className="text-sm">{packs.packs}</span>
            </div>
          ))}
        </div>
      </div>

      <Separator />

      <div>
        <h4 className="font-semibold mb-3">
          Required Documentation
        </h4>
        <div className="space-x-4">
          {reqdocks.map((dock) => (
            <div key={dock.id} className="inline-block relative group">
              <p className="text-sm text-muted-foreground cursor-pointer underline transition-all duration-300 hover:text-foreground hover:scale-115">
                {dock.name} /
              </p>
              {/* Tooltip */}
              <div className="absolute bottom-full left-1/2 transform -translate-x-1/2 mb-2 px-4 py-4 bg-black text-white text-md rounded-lg opacity-0 scale-95 group-hover:opacity-100 group-hover:scale-100 transition-all duration-300 ease-out whitespace-nowrap z-10 shadow-lg">
                {dock.description}
                {/* Ok işareti */}
                <div className="absolute top-full left-1/2 transform -translate-x-1/2 border-l-4 border-r-4 border-t-4 border-transparent border-t-black"></div>
              </div>
            </div>
          ))}
        </div>
      </div>


       <div className="p-4 bg-blue-50 border border-blue-200 rounded-md mb-4">
          <h4 className="font-semibold text-blue-800 mb-2">
            Manufacturing Origin
          </h4>
          <p className="text-blue-700">{country.name}</p>
        </div>





    </div>
  )
}

export default ShipmentData