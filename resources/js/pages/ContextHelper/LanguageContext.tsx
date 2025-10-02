import { LangCode } from "@/types";
import { router } from "@inertiajs/react";
import React, { createContext, useContext, useState, useEffect } from "react";

interface LangContextType {
  lang: LangCode;
  setLang: (lang: LangCode) => void;
}

const LangContext = createContext<LangContextType | undefined>(undefined);

export const LangProvider: React.FC<{ children: React.ReactNode }> = ({ children }) => {
  const [lang, setLangState] = useState<LangCode>("en");

  useEffect(() => {
    const saved = localStorage.getItem("lang") as LangCode | null;
    if (saved) setLangState(saved);
    
  }, []);

  const setLang = (value: LangCode) => {
    setLangState(value);
    localStorage.setItem("lang", value);

    router.visit('/set-locale', {
      method: 'post',
      data: { locale: value },
      replace: true, // ✅ SPA gibi davranır, history'e eklemez
      preserveState: true,
      preserveScroll: true,
      only: [], // ✅ hiçbir veri çekilmez
    });
  };

  return <LangContext.Provider value={{ lang, setLang }}>{children}</LangContext.Provider>;
};

export const useLang = () => {
  const ctx = useContext(LangContext);
  if (!ctx) throw new Error("useLang must be used inside LangProvider");
  return ctx;
};
