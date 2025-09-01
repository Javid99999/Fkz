import { Button } from '@/components/ui/button'
import { Link } from '@inertiajs/react'
import { Phone } from 'lucide-react'

export const CallAction = () => {
  return (
    <section className="py-16 bg-primary/10 px-4 sm:px-6 lg:px-8">
        <div className="container mx-auto flex flex-col items-center text-center gap-6">
            <div className="bg-primary/20 p-4 rounded-full">
                <Phone className="h-8 w-8 text-primary" />
            </div>
            <h2 className="text-3xl font-bold tracking-tight">
                Ready to discuss your chemical needs?
            </h2>
            <p className="text-xl text-muted-foreground max-w-2xl">
                Our technical team is available to help you find the right
                products for your specific applications.
            </p>
            <Button size="lg" className="mt-4" asChild>
                <Link href="/contact">Contact Us Today</Link>
            </Button>
        </div>
    </section>
  )
}