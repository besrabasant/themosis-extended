import {SyntheticEvent} from "react";
import {useState} from "@wordpress/element";
import {concat, without} from "lodash";
import {FieldWrapper} from "../FieldWrapper";
import {withDelegatedComponent} from "../withDelegatedComponent";
import {createSwitchCase} from "../../../core/utils";
import {ChoiceSelectField} from "./ChoiceSelectField";
import {ChoiceRadioField} from "./ChoiceRadioField";
import {ChoiceCheckboxField} from "./ChoiceCheckboxField";


const ChoiceFieldMap = createSwitchCase({
    'select': ChoiceSelectField,
    'radio': ChoiceRadioField,
    'checkbox': ChoiceCheckboxField,
});


const ChoiceFieldComponent = ({attributes, delegatedCallback}) => {
    let [value, setValue] = useState((attributes.value || attributes.default))

    /**
     * @param {SyntheticEvent} event
     */
    function onChange(event) {
        setValue(event.target.value)
        delegatedCallback(event.target.value)
        attributes.handlers.onChange && attributes.handlers.onChange(event.target.value, event)
    }

    /**
     * @param {SyntheticEvent} event
     */
    function onChangeMultiple(event) {
        if (value.includes(event.target.value)) {
            setValue(without(value, event.target.value))
        } else {
            setValue(concat(value, event.target.value))
        }

        delegatedCallback(event.target.value)
        attributes.handlers.onChange && attributes.handlers.onChange(event.target.value, event)
    }

    let ChoiceComponent = ChoiceFieldMap(attributes.options.layout)

    return (
        <FieldWrapper attributes={attributes}>
            <ChoiceComponent attributes={attributes} value={value}
                             onChange={(attributes.options.layout === 'checkbox') ? onChangeMultiple : onChange}/>
        </FieldWrapper>
    )
}

ChoiceFieldComponent.defaultProps = {
    delegatedCallback: () => {
    }
}


export const ChoiceField = ({attributes}) => {
    return (attributes.options.group === 'sidebar-fields') ?
        (withDelegatedComponent({attributes})(ChoiceFieldComponent))
        :
        (<ChoiceFieldComponent attributes={attributes}/>)
}

