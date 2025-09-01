import React from 'react';
import { Link } from '@inertiajs/react';

interface PaginationLinks {
  first: string | null;
  last: string | null;
  prev: string | null;
  next: string | null;
}

interface Props {
  links: PaginationLinks;
}

const Pagination: React.FC<Props> = ({ links }) => {
  return (
    <div className="flex justify-center gap-2 mt-6 mb-12">
      {links.prev && (
        <Link
          href={links.prev}
          className="px-3 py-1 border rounded hover:bg-gray-100 transition"
          preserveScroll
        >
          ← Prev
        </Link>
      )}
      {links.next && (
        <Link
          href={links.next}
          className="px-3 py-1 border rounded hover:bg-gray-100 transition"
          preserveScroll
        >
          Next →
        </Link>
      )}
    </div>
  );
};

export default Pagination;