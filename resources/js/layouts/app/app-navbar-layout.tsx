import React, { useState, useEffect } from 'react';
import { Link, usePage } from '@inertiajs/react';
import { Beaker, Moon, Sun, Menu } from 'lucide-react';
import { SharedData } from '@/types';
import { Button } from '@/components/ui/button';
import { route } from 'ziggy-js';

import {
  Select,
  SelectContent,
  SelectItem,
  SelectTrigger,
  SelectValue,
} from "@/components/ui/select";
import clsx from 'clsx';

interface Props {
  children: React.ReactNode;
}

const AppNavbarLayout = ({ children }: Props) => {
  const { ziggy } = usePage<SharedData>().props;
  const currentPath = ziggy.location;
  const [lang, setLang] = useState("en");
  const [darkMode, setDarkMode] = useState(false);
  const [isMobileMenuOpen, setMobileMenuOpen] = useState(false);

  useEffect(() => {
    const saved = localStorage.getItem('darkMode') === 'true';
    document.documentElement.classList.toggle('dark', saved);
    setDarkMode(saved);

    const savedLang = localStorage.getItem("lang") || "en";
    setLang(savedLang);
  }, []);

  const toggleDarkMode = () => {
    const html = document.documentElement;
    const newValue = !darkMode;
    html.classList.toggle('dark', newValue);
    setDarkMode(newValue);
    localStorage.setItem('darkMode', String(newValue));
  };

  const handleLangChange = (value: string) => {
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
              Products
            </Link>
            <Link href="/company" className={linkClass('/company')}>
              Company
            </Link>
            <Link href="/contact" className={linkClass('/contact')}>
              Contact
            </Link>
          </nav>
        </div>

        {/* Actions */}
        <div className="flex items-center gap-3 md:gap-4">
          {/* Language Selector */}
          <Select value={lang} onValueChange={handleLangChange}>
            <SelectTrigger className="w-full max-w-[120px] md:w-[100px] text-sm">
              <SelectValue placeholder="Lang" />
            </SelectTrigger>
            <SelectContent>
              <SelectItem value="en">
                <span className="flex items-center gap-2">🇬🇧 Eng</span>
              </SelectItem>
              <SelectItem value="ru">
                <span className="flex items-center gap-2">🇷🇺 Rus</span>
              </SelectItem>
              <SelectItem value="tr">
                <span className="flex items-center gap-2">🇹🇷 Türk</span>
              </SelectItem>
            </SelectContent>
          </Select>

          {/* Request Info Button */}
          <Button asChild className="hidden sm:block text-sm md:text-base">
            <Link href="/contact">Request Information</Link>
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
            Products
          </Link>
          <Link href="/company" className={mobileLinkClass('/company')}>
            Company
          </Link>
          <Link href="/contact" className={mobileLinkClass('/contact')}>
            Contact
          </Link>
          <Button asChild className="w-full mt-2">
            <Link href="/contact">Request Information</Link>
          </Button>
        </div>
      )}

      {children}
    </header>
  );
};

export default AppNavbarLayout;