import {registerComponent} from "../../core/ThemosisExtendedAdmin";
import {FieldWrapper} from "./FieldWrapper";
import {useRef, useState} from "@wordpress/element";
import {SidebarFieldsFill} from "../../core/slotfills";

function renderOptions(attributes) {
    return attributes.options.choices.map(choice => {
        return (
            <option key={choice.value} value={choice.value}>{choice.key}</option>
        )
    })
}

const ChoiceFieldComponent = ({attributes, delegatedOnChange}) => {
    let [value, setValue] = useState((attributes.value || attributes.default))

    /**
     * @param {SyntheticEvent} event
     */
    function onChange(event) {
        setValue(event.target.value)
        delegatedOnChange(event.target.value)
    }

    return (
        <FieldWrapper attributes={attributes}>
            <select className="form-control" name={attributes.name} id={attributes.attributes.id}
                    onChange={onChange} defaultValue={value}>
                {renderOptions(attributes)}
            </select>
        </FieldWrapper>)
}

ChoiceFieldComponent.defaultProps = {
    delegatedOnChange: () => {
    }
}

const DelegatedChoiceFieldComponent = ({attributes}) => {

    let [value, setValue] = useState((attributes.value || attributes.default))

    function delegatedOnChange(value) {
        setValue(value)
    }

    return (
        <>
            <input type="hidden" name={attributes.name} id={attributes.attributes.id} defaultValue={value}/>
            <SidebarFieldsFill>
                <ChoiceFieldComponent attributes={attributes} delegatedOnChange={delegatedOnChange}/>
            </SidebarFieldsFill>
        </>)
}

export const ChoiceField = ({attributes}) => {

    return (attributes.options.group == 'sidebar-fields') ? (
        <DelegatedChoiceFieldComponent attributes={attributes}/>) : (<ChoiceFieldComponent attributes={attributes}/>)
}

registerComponent('themosis.fields.choice', {
    renderProp: ChoiceField
})