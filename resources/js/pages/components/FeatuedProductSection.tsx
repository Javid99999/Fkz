import { Button } from '@/components/ui/button';
import { Card, CardContent } from '@/components/ui/card';
import { BasicProductInfo } from '@/types';
import { Link } from '@inertiajs/react';
import { ArrowRight } from 'lucide-react';

interface Props {
  products: BasicProductInfo[];
}


export const FeatuedProductSection: React.FC<Props> = ({ products }) => {
    

    return (
        <section className="py-16 bg-muted/50">
            <div className="container px-4 sm:px-6 lg:px-8">
                <div className="flex flex-col gap-8">
                    <div className="flex flex-col gap-2 text-center">
                        <h2 className="text-3xl font-bold tracking-tight">
                            Featured Products
                        </h2>
                        <p className="text-muted-foreground">
                            Discover our most popular chemical solutions
                        </p>
                    </div>

                    <div className="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-3 gap-6">
                        {products?.map((product) => (
                            <Card key={product.id} className="overflow-hidden p-0">
                                <div className="aspect-video w-full overflow-hidden">
                                    <img
                                        src={product.img_url}
                                        alt={product.name as unknown as string}
                                        className="w-full h-full object-cover transition-transform hover:scale-105"
                                    />
                                </div>
                                <CardContent className="p-4 sm:p-6">
                                    <div className="flex flex-col gap-2">
                                        <span className="text-sm text-primary font-medium">
                                            {product.category.name as any}
                                        </span>
                                        <h3 className="text-xl font-semibold">{product.name as unknown as string}</h3>
                                        <p className="text-muted-foreground">
                                            {product.description as any}
                                        </p>
                                        <Button variant="outline" className="mt-4 w-full sm:w-auto" asChild>
                                            <Link href={route('products.show', product.id)}>View Details</Link>
                                        </Button>
                                    </div>
                                </CardContent>
                            </Card>
                        ))}
                    </div>

                    <div className="flex justify-center mt-8">
                        <Button variant="outline" asChild className="w-full sm:w-auto">
                            <Link href={route('products.index')} className="flex items-center justify-center gap-2">
                                View All Products <ArrowRight className="h-4 w-4" />
                            </Link>
                        </Button>
                    </div>
                </div>
            </div>
        </section>
    )
}