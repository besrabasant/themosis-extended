import {createComponent} from "../../core/component";

function attachFieldHandlers(field) {
    let defaultFieldHandlers = {
        onChange: (value, event) => {
        }
    }

    return Object.assign({}, {
        handlers: defaultFieldHandlers
    }, field)
}

/**
 * Renders Form fields in a group.
 *
 * @param {FormField[]} fields
 * @param {FormFieldGroup} fieldGroup
 * @returns {Component[]}
 */
export function renderFields(fields, fieldGroup = null) {
    return fields.map((field, key) => {

        let FieldComponent = createComponent(field.component)

        if (!FieldComponent) {
            return null
        }

        return (<FieldComponent key={`field-${key}`} attributes={attachFieldHandlers(field)}/>)
    })
}