<script setup>
import { useEditor, EditorContent } from '@tiptap/vue-3'
import StarterKit from '@tiptap/starter-kit'
import { watch } from 'vue'

const props = defineProps({
    modelValue: String,
    default: ''
})

const emit = defineEmits(['update:modelValue'])

const editor = useEditor({
    content: props.modelValue,
    extensions: [
        StarterKit
    ],
    editorProps: {
        attributes: {
            class: 'w-full px-10 py-5 focus:outline-none prose prose-sm lg:prose',
        }
    },
    onUpdate: (context) => {
        emit('update:modelValue', context.editor.getHTML())
    }
})

watch(() => props.modelValue, (value) => {
    if(editor.value.getHTML() === value) {
        return
    }
    
    editor.value.commands.setContent(props.modelValue)
})
</script>


<template>
        <EditorContent :editor="editor" />
</template>


<style></style>