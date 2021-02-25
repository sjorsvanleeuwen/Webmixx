<template>
    <div class="form-group row">
        <label :for="name" v-text="label" class="col-3 col-form-label"></label>
        <div class="col-9">
            <ckeditor :editor="editor" v-model="editorValue" :config="editorConfig"></ckeditor>
            <input type="text" class="d-none" :id="name" :name="name" :value="internalValue"/>
        </div>
    </div>
</template>

<script>
import ClassicEditor from 'ckeditor5-classic-plus';
import { getEditorConfig } from "../../helpers";

export default {
    name: "type-rich-text",

    props: {
        name: {
            required: true,
            type: String,
        },
        label: {
            required: true,
            type: String,
        },
        value: {
            required: false,
            type: String,
            default: '',
        }
    },

    data() {
        return {
            editor: ClassicEditor,
            editorConfig: getEditorConfig(),
            internalValue: this.value,
        };
    },

    computed: {
        editorValue: {
            get() {
                return this.value;
            },
            set(value) {
                this.internalValue = value;
            }
        }
    }
}
</script>

<style>
.ck.ck-editor__editable {
    min-height: 200px;
}
</style>
