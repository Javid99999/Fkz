import { Badge } from '@/components/ui/badge';
import { Button } from '@/components/ui/button';
import { Card, CardContent } from '@/components/ui/card';
import { LocalizedText, Productt } from '@/types';
import { Link, router } from '@inertiajs/react';
import React, { useState } from 'react';


interface ProductCardProps {
  product: Productt;
}

const ProductCard: React.FC<ProductCardProps> = ({ product }) => {

    const [showFull, setShowFull] = useState(false);
    
    const DESCRIPTION_LIMIT = 88;


    let fullDesc = '';

    // 1. description varsa
    if (product.description) {
    // 2. description string ise direkt al
    if (typeof product.description === 'string') {
        fullDesc = product.description;
    } else {
        // 3. lang varsa ve string ise al
        const langVal = product.lang ? product.description[product.lang] : undefined;
        if (typeof langVal === 'string' && langVal.length > 0) {
        fullDesc = langVal;
        } else {
        // 4. fallback: LocalizedText objesindeki herhangi bir string değeri al
        const firstString = Object.values(product.description).find(
            (v) => typeof v === 'string' && v.length > 0
        );
        fullDesc = firstString ?? '';
        }
    }
    }

    const displayedDesc =
    fullDesc.length > DESCRIPTION_LIMIT && !showFull
        ? fullDesc.slice(0, DESCRIPTION_LIMIT) + '...'
        : fullDesc;

    const toggleDesc = () => setShowFull(!showFull);




    const lang = product.lang

    const imageUrl = product.image_url ?? '/placeholder.jpg';

  return (

    <Card
        key={product.id}
        className="overflow-hidden h-full flex flex-col"
    >
        <div className="relative h-48 bg-muted">
            <img
                src={imageUrl}
                alt={product.name as any}
                className="w-full h-full object-cover"
            />
        </div>
            <CardContent className="flex-1 flex flex-col">
                <div className="flex-1">
                    <h3 className="font-semibold text-lg">
                    {product.name as any}
                    </h3>
                    <div className="mt-2 mb-4 ml-1 text-sm text-muted flex space-x-2">
                        <h2 className='text-primary font-bold text-sm'>CAS: {product.cas_num}</h2>
                    </div>
                    <div className="flex items-center gap-2 mt-1">
                        <Badge variant="outline">{product.catag.name as any}</Badge>
                        
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
                                {showFull ? 'Show Less' : 'Read More'}
                            </button>
                        )}
                    </div>
                </div>

                <div className="flex-1 mb-4"></div>

                {/* Packaging her zaman en altta */}
                <div className="m-auto ml-2 flex text-sm  text-muted-foreground space-x-2">
                    <h2 className='text-primary font-bold font-xs'>Packaging:</h2>
                    <p>Available in: {product.packaging as any}</p>
                </div>

                <div className="mt-4 flex items-center justify-end">
                    <Link href={route('products.show', product.id)}>
                        <Button size="sm">View Details</Button>
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