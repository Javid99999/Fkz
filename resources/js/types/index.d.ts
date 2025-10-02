import { InertiaLinkProps } from '@inertiajs/react';
import { LucideIcon } from 'lucide-react';
import type { Config } from 'ziggy-js';


export type LangCode = 'en' | 'tr' | 'ru' | 'zhcn';
export type LocalizedText = {
  // en: string;
  // tr: string;
  [key in LangCode]?: string;
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
  name: LocalizedText;
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
}

export interface NewTagCategory {
  id: number;
  name: string;
}



export interface Unit
{
    id: number;
    unit: string;
}

export interface ProductPropertyValue
{
    id: number;
    name: string;
    prop_value_type: string;
    value: string;
    numeric: number;
    type:string;
    unit: Unit;
}


export interface Productt {
    id: number;
    name: string;
    cas_num: string;
    description: string;
    packaging: string;
    catag: TagCategory;
    property: ProductPropertyValue
    catag: TagCategory;
    country: Country | null;
    image_url: string | null;
}

export interface Statemeents
{
  id: number;
  name:string | null;
  securecode: Securecode[];
}


export interface Securecode
{
  id: number;
  code: string | null;
  description: string;
}
export interface Classification
{
    id: number;
    name: string;
}

export interface Country
{
  id: number;
  name: string;
  iso_code: string;
}

export interface Picto
{
  id: number,
  name: string;
  code: string,
  symbol: string,
}

export interface ProductType {
    id: number;
    name: string;
    cas_number: string;
    description: string;
    packaging: string;
    country: Country | null;
    classification: Classification[];
    statements: Statemeents[];
    property: ProductPropertyValue[];
    picto: Picto[];
    img_url: string[];
    lang: keyof LocalizedText;
}


export interface Responsibilities{
  id: number;
  responsi_type: string;
  responsibility: string;
}

export interface Extra{
  additional_cost: number;
  currency: string;
  availability_type: string;
  location_name: string;
  custom_notes: string;
  specific_details: string;
  custom_attributes: string;
  estimated_days_min: number;
  estimated_days_max: number;

}

export interface Countryy
{
  id: number;
  name: string;
}

export interface DeliveryType {
  id: number;
  code: string;
  expansion: string;
  description: string;
  responsib: Responsibilities[];
  extradetail: Extra;
  countryship: Country[];
}

export interface ProductTerms {
  id: number;
  name: string;
  description: string;
  color: string;
}

export interface DeliveryPayload
{
  delivery_methods: DeliveryType[];
  available_countries: Countryy[];
  productTerms: ProductTerms[];
}

export interface LoadSend
{
  deliver: string;
  loading: string;
}

export interface Packaging
{
  id: number;
  packs: string;
}

export interface ReqDocks
{
  id: number;
  name: string;
  description: string;
}

export interface MediaPayload
{
  docs: MediaDocs[];
}


export interface MediaDocs
{
  url: string;
  name: string;
}


export interface ShippingPayload
{

  loadsend: LoadSend;
  wrapping: Packaging[];
  reqdocks: ReqDocks[];
  country: Countryy;
}


export interface PageProps {
  errors: Record<string, string>;
  flash?: {
    success?: string;
    error?: string;
  };
  // başka global prop'lar varsa buraya eklenebilir
}


export interface BasicProductInfo
{
  id:number,
  name:string;
  description:string;
  category: NewTagCategory;
  img_url: string;
}


export interface ProductPageProps {
  products: Paginated<Productt>;
  category: Category[];
  selectedCategory?: number;
  [key: string]: unknown; // Bu satır kritik
}


export interface Delivery {
  info: string;
  lang: keyof LocalizedText;
  // [key: string]: any;
}

