import {FieldGroup} from "../Form/FieldGroup";
import {filter} from "lodash";
import {renderFields} from "./renderFields";

/**
 * Renders FormField Groups.
 *
 * @param {FormFieldGroup[]} fieldGroups
 * @param {FormField[]} fields
 * @returns {Component[]}
 */
export function renderFieldGroups(fieldGroups, fields) {

    // console.log(fieldGroups)

    return fieldGroups.map((fieldGroup, key) => {
        /**
         * @type FormField[]
         */
        let fieldsInThisGroup = filter(fields, ['options.group', fieldGroup.id])

        return (fieldsInThisGroup.length) ? (
            <FieldGroup key={`field-group-${key}`} fieldGroup={fieldGroup}>
                {renderFields(fieldsInThisGroup, fieldGroup)}
            </FieldGroup>
        ) : null
    })
}