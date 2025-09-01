import { Card } from '@/components/ui/card'
import { Beaker, Shield, Truck } from 'lucide-react'
import React from 'react'

export const CompanyValueSection = () => {
  return (
    <section className="py-16 px-4 sm:px-6 lg:px-8">
        <div className="container mx-auto flex flex-col gap-8">
            <div className="text-center">
                <h2 className="text-3xl font-bold tracking-tight">
                    Why Choose ChemCorp
                </h2>
                <p className="text-muted-foreground mt-2 max-w-2xl mx-auto">
                    We combine industry expertise with cutting-edge chemical
                    solutions to deliver exceptional value
                </p>
            </div>

            <div className="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-3 gap-6">
                <Card className="p-6">
                    <div className="flex flex-col gap-4 items-start sm:items-center text-center sm:text-center">
                        <div className="bg-primary/10 p-3 rounded-full w-fit mx-auto">
                            <Beaker className="h-6 w-6 text-primary" />
                        </div>
                        <h3 className="text-xl font-semibold">Premium Quality</h3>
                        <p className="text-muted-foreground">
                            All our products undergo rigorous quality control to ensure
                            the highest standards of purity and performance.
                        </p>
                    </div>
                </Card>

                <Card className="p-6">
                    <div className="flex flex-col gap-4 items-start sm:items-center text-center sm:text-center">
                        <div className="bg-primary/10 p-3 rounded-full w-fit mx-auto">
                            <Shield className="h-6 w-6 text-primary" />
                        </div>
                        <h3 className="text-xl font-semibold">Safety First</h3>
                        <p className="text-muted-foreground">
                            We prioritize safety in all aspects of our operations, from
                            product development to handling and transportation.
                        </p>
                    </div>
                </Card>

                <Card className="p-6">
                    <div className="flex flex-col gap-4 items-start sm:items-center text-center sm:text-center">
                        <div className="bg-primary/10 p-3 rounded-full w-fit mx-auto">
                            <Truck className="h-6 w-6 text-primary" />
                        </div>
                        <h3 className="text-xl font-semibold">Reliable Supply</h3>
                        <p className="text-muted-foreground">
                            Our efficient supply chain ensures timely delivery of
                            products to meet your production schedules.
                        </p>
                    </div>
                </Card>
            </div>
        </div>
    </section>
  )
}