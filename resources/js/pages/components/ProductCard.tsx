import { Badge } from '@/components/ui/badge';
import { Button } from '@/components/ui/button';
import { Card, CardContent } from '@/components/ui/card';
import { LocalizedText, Productt } from '@/types';
import { Link, router } from '@inertiajs/react';
import React from 'react';


interface ProductCardProps {
  product: Productt;
}

const ProductCard: React.FC<ProductCardProps> = ({ product }) => {


  const imageUrl = product.image_url ?? '/placeholder.jpg';

  function t(text: LocalizedText, lang: keyof LocalizedText) {
    return text[lang];
    }

  return (

    <Card
        key={product.id}
        className="overflow-hidden h-full flex flex-col p-0"
    >
        <div className="relative h-48 bg-muted">
            <img
                src={imageUrl}
                alt={product.name as any}
                className="w-full h-full object-cover"
            />
        </div>
            <CardContent className="p-4 flex-1 flex flex-col">
                <div className="flex-1">
                    <h3 className="font-semibold text-lg">
                    {product.name as any}
                    </h3>
                    <div className="mb-4 ml-2 text-sm text-muted flex space-x-2">
                        <h2 className='text-primary font-bold text-sm'>CAS: {product.cas_num}</h2>
                    </div>
                    <div className="flex items-center gap-2 mt-1">
                        <Badge variant="outline">{product.catag.name as any}</Badge>
                        
                        {/* <Badge variant="outline">{product.form}</Badge> */}
                        {/* <Badge variant="outline">{product.purity}</Badge> */}
                    </div>
                    <div className='mt-2 ml-2 text-sm text-muted-foreground'>
                        {product.description as any}
                    </div>
                    <div className="mt-6 ml-2 text-sm text-muted-foreground flex space-x-2">
                        <h2 className='text-primary font-bold font-xs'>Packaging:</h2>
                        <p>Available in: {product.packaging.en}</p>
                    </div>
                </div>
                <div className="mt-4 flex items-center justify-end">
                    <Link href={route('products.show', product.id)}>
                        <Button size="sm">View Details</Button>
                    </Link>
                </div>
            </CardContent>
        
    </Card>

    // <div className="rounded border p-4 shadow-sm hover:shadow-md transition">
    //   <img
    //     src={imageUrl}
    //     alt={product.name.en}
    //     className="w-full h-48 object-cover rounded mb-2"
    //   />
    //   <h3 className="text-lg font-semibold">{product.name.en}</h3>
    // </div>
  );
};

export default ProductCard;