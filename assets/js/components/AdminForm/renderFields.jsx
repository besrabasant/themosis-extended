import {createComponent} from "../../core/component";

/**
 * Renders Form fields in a group.
 *
 * @param {FormField[]} fields
 * @param {FormFieldGroup} fieldGroup
 * @returns {Component[]}
 */
export function renderFields(fields, fieldGroup) {
    return fields.map((field, key) => {

        // console.log(field)

        let FieldComponent = createComponent(field.component)

        if (!FieldComponent) {
            return null
        }

        return (<FieldComponent key={`field-${key}`} attributes={field}/>)
    })
}