import ClassicEditor from '@ckeditor/ckeditor5-build-classic';

export default {
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
    },
};
