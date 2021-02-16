import ClassicEditor from '@ckeditor/ckeditor5-build-classic';

const functions = {
    bootEditor() {
        if (document.querySelector('.form-control-editor') !== null) {
            ClassicEditor.create(document.querySelector('.form-control-editor'), {
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
                        // 'imageUpload',
                        'blockQuote',
                        'insertTable',
                        // 'mediaEmbed',
                        'undo',
                        'redo',
                    ]
                }
            })
                .catch(error => {
                    console.log(error);
                });
        }
    }
};

export default function() {
    functions.bootEditor();
};

export function bootEditor() {
    functions.bootEditor();
}
