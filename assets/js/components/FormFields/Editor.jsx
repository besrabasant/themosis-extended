import {registerComponent} from "../../core/ThemosisExtendedAdmin";
import {FieldWrapper} from "./FieldWrapper";
import {Editor} from '@tinymce/tinymce-react';
import {useState} from '@wordpress/element';

const editorSettings = {
    plugins: 'lists link',
    toolbar: 'bold italic underline blockquote strikethrough bullist numlist alignleft aligncenter alignright undo redo link',
    menubar: false,
    branding: false,
    content_style: ' p { line-height: 1.5; }',
    height: 175
}

export const RichTextEditor = ({attributes}) => {

    let [value, setValue] = useState((attributes.value || attributes.default))

    /**
     * @param {*} value
     */
    function onChange(value) {
        setValue(value)
    }

    return (
        <FieldWrapper attributes={attributes}>
            <textarea readOnly={true} style={{display: 'none'}} name={attributes.name} id={attributes.attributes.id}
                      value={value}/>
            <Editor value={value} onEditorChange={onChange} init={editorSettings}/>
        </FieldWrapper>)
}

registerComponent('themosis.fields.editor', {
    renderProp: RichTextEditor
})