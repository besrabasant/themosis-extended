import {registerComponent} from "../../core/ThemosisExtendedAdmin";
import {FieldWrapper} from "./FieldWrapper";
import {Editor} from '@tinymce/tinymce-react';
import {useState} from '@wordpress/element';

let editorSettings = {
    plugins: 'lists link',
    toolbar: 'bold italic underline blockquote strikethrough bullist numlist alignleft aligncenter alignright undo redo link',
    menubar: false,
    branding: false,
    content_style: ' p { line-height: 1.5; }',
    height: 500
}

export const RichTextEditor = ({attributes}) => {

    let [value, setValue] = useState((attributes.value || attributes.default))

    if (attributes.options.settings.textarea_rows) {
        editorSettings.height = attributes.options.settings.textarea_rows * (20 * 1.5)
    }

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