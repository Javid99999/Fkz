import { useState } from "react";
import { Download, Info, X } from "lucide-react";
import { MediaPayload } from "@/types";

const DocumentCard: React.FC<MediaPayload> = ({ docs = [] }) => {
  const [visibleDoc, setVisibleDoc] = useState<string | null>(null);

  return (
    <div className="flex flex-col gap-4">
      {docs.map((file) => (
        <div key={file.url} className="border p-2 rounded flex flex-col gap-2">
          {/* Name left, Buttons right */}
          <div className="flex justify-between items-center">
            {/* PDF Name */}
            <span className="font-medium">{file.name}</span>

            {/* Buttons */}
            <div className="flex gap-2">
              <button
                className="flex items-center gap-1 px-2 py-1 border rounded hover:bg-gray-100"
                onClick={() =>
                  setVisibleDoc(visibleDoc === file.url ? null : file.url)
                }
              >
                <Info className="h-4 w-4" /> View
              </button>

              <a
                href={file.url}
                download={file.name}
                className="flex items-center gap-1 px-2 py-1 border rounded hover:bg-gray-100"
              >
                <Download className="h-4 w-4" /> Download
              </a>
            </div> {/* Buttons divi */}
          </div> {/* Name + Buttons divi */}

          {/* PDF Popup Viewer */}
          {visibleDoc === file.url && (
            <div className="fixed inset-0 z-50 flex items-center justify-center bg-black/50">
              <div className="bg-white rounded w-11/12 md:w-3/4 lg:w-1/2 relative overflow-hidden">
                {/* Modal Top Bar */}
                <div className="bg-white flex justify-end p-2 shadow-md">
                  <button
                    className="text-gray-700 hover:text-gray-900 text-2xl"
                    onClick={() => setVisibleDoc(null)}
                  >
                    <X className="h-8 w-8" />
                  </button>
                </div>

                {/* PDF Viewer */}
                <iframe
                  src={file.url}
                  className="w-full h-96 border-t"
                  title={file.name}
                />
              </div>
            </div>
          )}
        </div> /* file divi kapanışı */
      ))}
    </div> /* main container divi kapanışı */
  );
};

export default DocumentCard;
