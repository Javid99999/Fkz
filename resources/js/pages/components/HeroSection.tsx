import { Button } from '@/components/ui/button'
import { Link } from '@inertiajs/react'

export const HeroSection = () => {
    return (
        <section className="relative bg-gradient-to-b from-primary/10 to-background py-16 sm:py-20 px-4 sm:px-6 lg:px-8">
            <div className="flex flex-col items-center text-center gap-6 sm:gap-8 max-w-4xl mx-auto">
                <h1 className="text-3xl sm:text-4xl md:text-5xl lg:text-6xl font-bold tracking-tight">
                    Advanced Chemical Solutions <br />
                    <span className="text-primary">for Modern Industries</span>
                </h1>
                <p className="text-lg sm:text-xl text-muted-foreground max-w-3xl">
                    Providing high-quality chemical products and technical expertise to
                    support your manufacturing processes and research needs.
                </p>
                <div className="flex flex-col sm:flex-row gap-3 sm:gap-4 mt-4 sm:mt-6 w-full sm:w-auto">
                    <Button size="lg" className="w-full sm:w-auto" asChild>
                        <Link href="/products">Explore Products</Link>
                    </Button>
                    <Button size="lg" variant="outline" className="w-full sm:w-auto" asChild>
                        <Link href="/company">About Our Company</Link>
                    </Button>
                </div>
            </div>
        </section>
    )
}