import { Badge } from '@/components/ui/badge';
import { Button } from '@/components/ui/button';
import { Card, CardContent } from '@/components/ui/card';
import { Productt } from '@/types';
import { Link } from '@inertiajs/react';
import React, { useState } from 'react';
import cardlang from '../../lang/productcard_lang.json'
import { useLang } from '../ContextHelper/LanguageContext';


interface ProductCardProps {
  product: Productt;
}

const ProductCard: React.FC<ProductCardProps> = ({ product }) => {

    const { lang } = useLang();
    const [showFull, setShowFull] = useState(false);
    
    const DESCRIPTION_LIMIT = 68;


    let fullDesc = product.description;

    const displayedDesc =
    fullDesc.length > DESCRIPTION_LIMIT && !showFull
        ? fullDesc.slice(0, DESCRIPTION_LIMIT) + '...'
        : fullDesc;

    const toggleDesc = () => setShowFull(!showFull);

    const imageUrl = product.image_url ?  product.image_url :'/imgs/productimagecomingsoon.jpeg';

  return (

    <Card
        key={product.id}
        className="overflow-hidden h-full flex flex-col"
    >
        <div className="relative h-48 bg-muted">
            <img
                src={imageUrl}
                alt={product.name}
                className="w-full h-full object-cover"
                loading='lazy'
            />
        </div>
            <CardContent className="flex-1 flex flex-col">
                <div className="flex-1">
                    <h3 className="font-semibold text-lg">
                    {product.name}
                    </h3>
                    <div className="mt-2 mb-4 ml-1 text-sm text-muted flex space-x-2">
                        <h2 className='text-primary font-bold text-sm'>CAS: {product.cas_num}</h2>
                    </div>
                    <div className="flex items-center gap-2 mt-1">
                        <Badge variant="outline">{product.catag.name}</Badge>
                        
                        {/* <Badge variant="outline">{product.form}</Badge> */}
                        {/* <Badge variant="outline">{product.purity}</Badge> */}
                    </div>
                    <div className='mt-2 ml-2 text-sm text-muted-foreground'>
                        {displayedDesc}
                        {fullDesc.length > DESCRIPTION_LIMIT && (
                            <button
                                className="ml-1 text-primary font-semibold text-sm underline"
                                onClick={toggleDesc}
                            >
                                {showFull ? cardlang.showLess[lang] ?? cardlang.showLess.en : cardlang.readMore[lang] ?? cardlang.readMore.en}
                            </button>
                        )}
                    </div>
                </div>

                <div className="flex-1 mb-4"></div>

                {/* Packaging her zaman en altta */}
                <div className="m-auto ml-2 flex text-sm  text-muted-foreground space-x-2">
                    <h2 className='text-primary font-bold font-xs'>{cardlang.packaging[lang] ?? cardlang.packaging.en}:</h2>
                    <p>{cardlang.availableIn[lang] ?? cardlang.availableIn.en}: {product.packaging}</p>
                </div>

                <div className="mt-2 flex items-center justify-end">
                    <Link href={route('products.show', product.id)}>
                        <Button className='mb-4' size="sm">{cardlang.viewDetails[lang] ?? cardlang.viewDetails.en}</Button>
                    </Link>
                </div>
            </CardContent>
        
    </Card>

    
  );
};

export default ProductCard;











// <div className="rounded border p-4 shadow-sm hover:shadow-md transition">
    //   <img
    //     src={imageUrl}
    //     alt={product.name.en}
    //     className="w-full h-48 object-cover rounded mb-2"
    //   />
    //   <h3 className="text-lg font-semibold">{product.name.en}</h3>
    // </div>