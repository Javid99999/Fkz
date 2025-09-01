import { InertiaLinkProps } from '@inertiajs/react';
import { LucideIcon } from 'lucide-react';
import type { Config } from 'ziggy-js';


export type LangCode = 'en' | 'tr';
export type LocalizedText = {
  en: string;
  tr: string;
};


export interface SharedData {
    name: string;
    quote: { message: string; author: string };
    sidebarOpen: boolean;
    [key: string]: unknown;
    ziggy: Config & { location: string };
}

export interface Paginated<T> {
  data: T[];
  links: {
    first: string | null;
    last: string | null;
    prev: string | null;
    next: string | null;
  };
  meta: {
    current_page: number;
    from: number;
    last_page: number;
    path: string;
    per_page: number;
    to: number;
    total: number;
  };
}


export interface Category {
  id: number;
  name: Record<LangCode, string>;
  children: Category[];
  products_count: number;
  // product: Product | null
  lang: keyof LocalizedText;
}

export interface Auth {
    user: User;
}

export interface BreadcrumbItem {
    title: string;
    href: string;
}

export interface NavGroup {
    title: string;
    items: NavItem[];
}

export interface NavItem {
    title: string;
    href: NonNullable<InertiaLinkProps['href']>;
    icon?: LucideIcon | null;
    isActive?: boolean;
}




export interface TagCategory {
  id: number;
  name: string;
  lang: keyof LocalizedText;
}





export interface Unit
{
    id: number;
    unit: LocalizedText;
}

export interface ProductPropertyValue
{
    id: number;
    name: LocalizedText;
    prop_value_type: string;
    value: LocalizedText;
    numeric: number;
    type:string;
    unit: Unit;
}


export interface Productt {
    id: number;
    name: LocalizedText;
    cas_num: string;
    description: LocalizedText;
    packaging: LocalizedText;
    catag: TagCategory;
    property: ProductPropertyValue
    catag: TagCategory;
    country: Country | null;
    image_url: string | null;
    lang: keyof LocalizedText;

}

export interface ProductType {
    id: number;
    name: LocalizedText;
    cas_num: string;
    description: LocalizedText;
    packaging: LocalizedText;
    country: Country | null;
    category_id: Category | null;
    image_url: string | null;
    lang: keyof LocalizedText;
    // property: ProductPropertyValue
    // catag: TagCategory;
    

}


export interface PageProps {
  errors: Record<string, string>;
  flash?: {
    success?: string;
    error?: string;
  };
  // başka global prop'lar varsa buraya eklenebilir
}



export interface ProductPageProps {
  products: Paginated<Productt>;
  category: Category[];
  selectedCategory?: number;
  [key: string]: unknown; // Bu satır kritik
}



