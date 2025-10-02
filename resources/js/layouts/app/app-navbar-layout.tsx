import React, { useState, useEffect } from 'react';
import { Link, router, usePage } from '@inertiajs/react';
import { Beaker, Moon, Sun, Menu } from 'lucide-react';
import { LangCode, SharedData } from '@/types';
import { Button } from '@/components/ui/button';
import navlink from "../../lang/navbar_lang.json"
import { route } from 'ziggy-js';

import {
  Select,
  SelectContent,
  SelectItem,
  SelectTrigger,
  SelectValue,
} from "@/components/ui/select";
import clsx from 'clsx';
import { useLang } from '@/pages/ContextHelper/LanguageContext';

interface Props {
  children: React.ReactNode;
}

interface Props {
  children: React.ReactNode;
  onCompanyClick?: () => void;
}

const AppNavbarLayout = ({ children }: Props) => {
  const { ziggy } = usePage<SharedData>().props;
  const currentPath = ziggy.location;
  const [darkMode, setDarkMode] = useState(false);
  const [isMobileMenuOpen, setMobileMenuOpen] = useState(false);
  const { lang, setLang } = useLang();
  
  

  useEffect(() => {
    const saved = localStorage.getItem('darkMode') === 'true';
    document.documentElement.classList.toggle('dark', saved);
    setDarkMode(saved);

  }, []);

  const toggleDarkMode = () => {
    const html = document.documentElement;
    const newValue = !darkMode;
    html.classList.toggle('dark', newValue);
    setDarkMode(newValue);
    localStorage.setItem('darkMode', String(newValue));
  };

  const handleLangChange = (value: LangCode) => {
    setLang(value);
    localStorage.setItem("lang", value);

  };

  const linkClass = (path: string) =>
  clsx(
    'text-sm font-medium font-bold transition-colors duration-200',
    currentPath.includes(path)
      ? 'text-primary font-bold underline decoration-primary decoration-3 underline-offset-30'
      : 'hover:text-[var(--mouseon)] text-primary hover:shadow-[0_4px_6px_rgba(0,0,0,0.3)] transition-shadow duration-200 p-1 rounded-lg'
  );


  const mobileLinkClass = (path: string) =>
    clsx(
      'w-full py-2 px-3 rounded-md text-left transition-colors duration-200',
      currentPath.includes(path)
        ? 'bg-green-600 text-white font-semibold'
        : 'dark:hover:bg-gray-700'
    );

    
    

  return (
    <>
    
      <header className="sticky top-0 z-20 w-full border-b bg-background backdrop-blur">
        <div className="container flex h-16 items-center justify-between">
          {/* Logo + Desktop Menu */}
          <div className="flex items-center gap-6">
            {/* Logo */}
            <Link href="/" className="flex items-center gap-2">
              <Beaker className="h-6 w-6 text-primary" />
              <span className="text-sm md:text-base font-bold">Fkz</span>
            </Link>

            {/* Desktop Menu */}
            <nav className="hidden md:flex gap-6">
              <Link href={route('products.index')} className={linkClass('/products')}>
                {navlink.product[lang] ?? navlink.product.en}
              </Link>
              {/* <Link
                href={route('home')}
                onClick={(e) => {
                  e.preventDefault();
                  setActiveMenu('/company'); // manuel active state

                  if (window.location.pathname === route('home')) {
                    // Aynı sayfadaysak direkt scroll
                    onCompanyClick?.();
                  } else {
                    // Farklı sayfadaysak home’a git ve scroll et
                    router.visit(route('home'), {
                      preserveState: true,
                      preserveScroll: true,
                      onSuccess: () => {
                      window.dispatchEvent(new Event('homeReady'));
                    },
                      
                    });
                  }
                }} className={linkClass('/company')}>
                {navlink.company[lang] ?? navlink.company.en}
              </Link> */}
              <Link href={route('products.about')} className={linkClass('/about')}>
                {navlink.about[lang] ?? navlink.about.en}
              </Link>
              {/* <Link href="/contact" className={linkClass('/contact')}>
                {navlink.contact[lang] ?? navlink.contact.en}
              </Link> */}
            </nav>
          </div>

          {/* Actions */}
          <div className="flex items-center gap-3 md:gap-4">
            {/* Language Selector */}
            <Select value={lang} onValueChange={handleLangChange}>
              <SelectTrigger className="w-full max-w-[120px] md:w-[120px] text-md">
                <SelectValue placeholder="Lang" />
              </SelectTrigger>
              <SelectContent>
                <SelectItem value="en">
                  <span className="flex items-center gap-2">🇬🇧 Eng</span>
                </SelectItem>
                <SelectItem value="az">
                  <span className="flex items-center gap-2">🇦🇿 Aze</span>
                </SelectItem>
                <SelectItem value="tr">
                  <span className="flex items-center gap-2">🇹🇷 Türk</span>
                </SelectItem>
                <SelectItem value="ru">
                  <span className="flex items-center gap-2">🇷🇺 Rus</span>
                </SelectItem>
                <SelectItem value="zhcn">
                  <span className="flex items-center gap-2">🇨🇳 普通话</span>
                </SelectItem>
                <SelectItem value="ar">
                  <span className="flex items-center gap-2">🇸🇦 عربي</span>
                </SelectItem>
                <SelectItem value="he">
                  <span className="flex items-center gap-2">🇮🇱 עברית</span>
                </SelectItem>
              </SelectContent>
            </Select>

            {/* Request Info Button */}
            <Button asChild className="hidden sm:block text-sm md:text-base">
              <Link href={route('company.contact')}>{navlink.contact[lang] ?? navlink.contact.en}</Link>
            </Button>

            {/* Dark Mode Toggle */}
            <button
              onClick={toggleDarkMode}
              className="p-1.5 md:p-2 rounded-full bg-gray-600 dark:bg-yellow-500 hover:bg-gray-500 dark:hover:bg-yellow-400 transition-colors"
            >
              {darkMode ? <Sun className="w-4 h-4 md:w-5 md:h-5 text-white" /> : <Moon className="w-4 h-4 md:w-5 md:h-5 text-white" />}
            </button>

            {/* Mobile Hamburger */}
            <button
              className="md:hidden p-2 rounded-md hover:bg-gray-200 dark:hover:bg-gray-700"
              onClick={() => setMobileMenuOpen(!isMobileMenuOpen)}
            >
              <Menu className="w-6 h-6" />
            </button>
          </div>
        </div>

        {/* Mobile Menu */}
        {isMobileMenuOpen && (
          <div className="md:hidden absolute top-16 left-0 w-full bg-background shadow-lg z-10 flex flex-col items-start p-4 gap-2 border-t">
            <Link href={route('products.index')} className={mobileLinkClass('/products')}>
              {navlink.product[lang] ?? navlink.product.en}
            </Link>
            {/* <Link onClick={(e) => { e.preventDefault(); onCompanyClick?.(); setMobileMenuOpen(false) }} className={mobileLinkClass('/company')}>
              {navlink.company[lang] ?? navlink.company.en}
            </Link> */}
            <Link href={route('products.about')} className={mobileLinkClass('/about')}>
                {navlink.about[lang] ?? navlink.about.en}
            </Link>
            {/* <Link href="/contact" className={mobileLinkClass('/contact')}>
              {navlink.contact[lang] ?? navlink.contact.en}
            </Link> */}
            <Button asChild className="w-full mt-2">
              <Link href="/contact">{navlink.requestinfo[lang] ?? navlink.requestinfo.en}</Link>
            </Button>
          </div>
        )}

      </header>

      <main>
        {children}
      </main>

    </>
    
  );
};

export default AppNavbarLayout;