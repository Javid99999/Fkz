import React from 'react';
import { Link } from '@inertiajs/react';
import prevNext from '../../lang/prevNext_lang.json'
import { useLang } from '../ContextHelper/LanguageContext';

interface PaginationLinks {
  first: string | null;
  last: string | null;
  prev: string | null;
  next: string | null;
}

interface PaginationMeta {
  current_page: number;
  last_page: number;
  per_page: number;
  total: number;
}

interface Props {
  links: PaginationLinks;
  meta: PaginationMeta;
  query?: Record<string, any>; // ✅ query prop
}

const Pagination: React.FC<Props> = ({ links, meta, query = {} }) => {
  const pages = Array.from({ length: meta.last_page }, (_, i) => i + 1);
  const { lang } = useLang();

  const buildQueryString = (page: number) => {
    const params: Record<string, string> = { page: page.toString() };

    if (query.category_id) params.category_id = query.category_id.toString();
    if (query.search && query.search.trim() !== '') params.search = query.search;

    const searchParams = new URLSearchParams(params);
    return `?${searchParams.toString()}`;
  };

  return (
    <div className="flex justify-center gap-2 mt-6 mb-12">
      {links.prev && (
        <Link
          href={buildQueryString(meta.current_page - 1)}
          className="px-3 py-1 border rounded hover:bg-gray-100 transition"
          preserveScroll
        >
          ← {prevNext.prev[lang] ?? prevNext.prev.en}
        </Link>
      )}

      {pages.map((page) => (
        <Link
          key={page}
          href={buildQueryString(page)} // ✅ Sayfa + mevcut query
          className={`px-3 py-1 border rounded transition ${
            meta.current_page === page
              ? 'bg-primary text-white'
              : 'hover:bg-gray-100'
          }`}
          preserveScroll
          preserveState
        >
          {page}
        </Link>
      ))}

      {links.next && (
        <Link
          href={buildQueryString(meta.current_page + 1)}
          className="px-3 py-1 border rounded hover:bg-gray-100 transition"
          preserveScroll
          preserveState
        >
          {prevNext.next[lang] ?? prevNext.next.en} →
        </Link>
      )}
    </div>
  );
};

export default Pagination;
