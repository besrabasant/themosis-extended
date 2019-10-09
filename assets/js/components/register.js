import {registerComponent} from "../core/ThemosisExtendedAdmin";
import {AdminForm} from "./AdminForm";
import {AdminTable} from "./AdminTable";
import {SidebarTitle} from "./SidebarTitle";
import {
    ChoiceField, DateTimeInput, RichTextEditor,
    FormSubmit, IntegerField, TextField,
    TextAreaField, CheckboxField, RepeaterField,
    VirtualMultiSelect
} from "./FormFields"


registerComponent('themosis.core.adminform', {
    renderProp: AdminForm
})

registerComponent('themosis.core.admintable', {
    renderProp: AdminTable
})

registerComponent('themosis.core.sidebartitle', {
    renderProp: SidebarTitle
})

/**
 * Register Form Fields
 */

registerComponent('themosis.fields.text', {
    renderProp: TextField
})

registerComponent('themosis.fields.textarea', {
    renderProp: TextAreaField
})

registerComponent('themosis.fields.choice', {
    renderProp: ChoiceField
})

registerComponent('themosis.fields.checkbox', {
    renderProp: CheckboxField
})

registerComponent('themosis.fields.datetime', {
    renderProp: DateTimeInput
})

registerComponent('themosis.fields.editor', {
    renderProp: RichTextEditor
})

registerComponent('themosis.fields.integer', {
    renderProp: IntegerField
})

registerComponent('themosis.fields.repeater', {
    renderProp: RepeaterField
})

registerComponent('themosis.fields.submit', {
    renderProp: FormSubmit
})

registerComponent('themosis.fields.virtualmultiselect', {
    renderProp: VirtualMultiSelect
})


