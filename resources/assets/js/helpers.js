import ClassicEditor from 'ckeditor5-classic-plus';

const functions = {
    bootEditor() {
        if (document.querySelector('.form-control-editor') !== null) {
            ClassicEditor.create(document.querySelector('.form-control-editor'), this.getEditorConfig())
            .catch(error => {
                console.log(error);
            });
        }
    },
    getEditorConfig() {
        return {
            simpleUpload: {
                // The URL that the images are uploaded to.
                uploadUrl: "/webmixx/api/editor/upload",

                // Headers sent along with the XMLHttpRequest to the upload server.
                headers: {
                    "X-Requested-With": "XMLHttpRequest",
                    "X-CSRF-TOKEN": document.head.querySelector('meta[name="csrf-token"]').content,
                }
            },
            toolbar: {
                items: [
                    'heading',
                    '|',
                    'bold',
                    'italic',
                    'link',
                    'bulletedList',
                    'numberedList',
                    '|',
                    'indent',
                    'outdent',
                    '|',
                    'imageUpload',
                    'blockQuote',
                    'insertTable',
                    // 'mediaEmbed',
                    'undo',
                    'redo',
                ]
            }
        };
    },
    namespaceComponents(namespace, components) {
        return Object.fromEntries(Object.entries(components).map(([key, value]) => [`${namespace}:${key}`, value]));
    }
};

export default function() {
    return functions.bootEditor();
};

export function bootEditor() {
    return functions.bootEditor();
}

export function getEditorConfig() {
    return functions.getEditorConfig();
}

export function namespaceComponents(namespace, components) {
    return functions.namespaceComponents(namespace, components);
}
